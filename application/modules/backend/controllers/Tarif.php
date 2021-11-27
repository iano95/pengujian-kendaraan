<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:48*/
/* Location: ./application/modules/backend/controllers/Tarif.php*/
/* Please DO NOT modify this information */


class Tarif extends Backend{

  private $title = "Tb Tarif";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Tarif_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('jenis_mobil', 'Jenis Mobil', 'trim|xss_clean|required');
		$this->form_validation->set_rules('sub_jenis', 'Sub Jenis', 'trim|xss_clean|required');
		$this->form_validation->set_rules('sifat', 'Sifat', 'trim|xss_clean|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('tarif_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/tarif/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('tarif_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
					$row[] = $get->jenis_mobil;
					$row[] = $get->sub_jenis;
					$row[] = $get->sifat;
					$row[] = "Rp. ".number_format($get->biaya,2,',','.');
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/tarif/detail/".enc_url($get->id_jenis)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                          <a href="'.site_url("backend/tarif/update/".enc_url($get->id_jenis)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.site_url("backend/tarif/delete/".enc_url($get->id_jenis)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
                            <i class="ti-trash"></i>
                          </a>
                        </div>
                   ';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->model->count_all(),
                      "recordsFiltered" => $this->model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      return $this->response($output);
    }
  }


  function filter()
  {
    $this->template->view("content/tarif/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('tarif_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'jenis_mobil' => set_value('jenis_mobil',$row->jenis_mobil),
										'sub_jenis' => set_value('sub_jenis',$row->sub_jenis),
										'sifat' => set_value('sifat',$row->sifat),
										'biaya' => set_value('biaya',$row->biaya),
                    );
      $this->template->view("content/tarif/detail",$data);
    }
  }


  function add()
  {
    $this->is_allowed('tarif_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/tarif/add_action"),
                  'params' => "add",
									'jenis_mobil' => set_value('jenis_mobil'),
									'sub_jenis' => set_value('sub_jenis'),
									'sifat' => set_value('sifat'),
									'biaya' => set_value('biaya'),
                  );
    $this->template->view("content/tarif/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('tarif_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['jenis_mobil'] = $this->input->post('jenis_mobil',true);
				$save_data['sub_jenis'] = $this->input->post('sub_jenis',true);
				$save_data['sifat'] = $this->input->post('sifat',true);
				$save_data['biaya'] = $this->input->post('biaya',true);

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/tarif");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }
      return $this->response($json);
    }
  }

  function update($id = null)
  {
    $this->is_allowed('tarif_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/tarif/update_action/$id"),
                    'params' => "update",
										'jenis_mobil' => set_value('jenis_mobil',$row->jenis_mobil),
										'sub_jenis' => set_value('sub_jenis',$row->sub_jenis),
										'sifat' => set_value('sifat',$row->sifat),
										'biaya' => set_value('biaya',$row->biaya),
                    );
      $this->template->view("content/tarif/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('tarif_update',false)) {
        return $this->response([
        'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['jenis_mobil'] = $this->input->post('jenis_mobil',true);
				$save_data['sub_jenis'] = $this->input->post('sub_jenis',true);
				$save_data['sifat'] = $this->input->post('sifat',true);
				$save_data['biaya'] = $this->input->post('biaya',true);

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/tarif");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }
      return $this->response($json);
    }
  }


  function delete($id = null)
  {
    if ($this->input->is_ajax_request()) {

        if (!$this->is_allowed('tarif_delete',false)) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }

        $remove = $this->model->remove(dec_url($id));
        if ($remove) {
          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");
        }else {
          $json['type_msg'] = "error";
          $json['msg'] = cclang("notif_delete_failed");
        }
        return $this->response($json);
    }
  }


}
