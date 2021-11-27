<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:21*/
/* Location: ./application/modules/backend/controllers/Karyawan.php*/
/* Please DO NOT modify this information */


class Karyawan extends Backend{

  private $title = "Data Karyawan";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Karyawan_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('nip', 'Nip', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|xss_clean|required');
		$this->form_validation->set_rules('jk', 'Jk', 'trim|xss_clean|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|xss_clean|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|xss_clean|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|xss_clean|required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('karyawan_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/karyawan/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('karyawan_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
					$row[] = $get->nip;
					$row[] = $get->nama;
					$row[] = $get->jk;
					$row[] = $get->tempat_lahir;
					$row[] = $get->tgl_lahir;
					$row[] = $get->jabatan;
					$row[] = $get->alamat;
					$row[] = $get->telepon;
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/karyawan/detail/".enc_url($get->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                          <a href="'.site_url("backend/karyawan/update/".enc_url($get->id)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.site_url("backend/karyawan/delete/".enc_url($get->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
    $this->template->view("content/karyawan/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('karyawan_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'nip' => set_value('nip',$row->nip),
										'nama' => set_value('nama',$row->nama),
										'jk' => set_value('jk',$row->jk),
										'tempat_lahir' => set_value('tempat_lahir',$row->tempat_lahir),
										'tgl_lahir' => set_value('tgl_lahir',date('Y-m-d',strtotime($row->tgl_lahir))),
										'jabatan' => set_value('jabatan',$row->jabatan),
										'alamat' => set_value('alamat',$row->alamat),
										'telepon' => set_value('telepon',$row->telepon),
                    );
      $this->template->view("content/karyawan/detail",$data);
    }
  }


  function add()
  {
    $this->is_allowed('karyawan_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/karyawan/add_action"),
                  'params' => "add",
									'nip' => set_value('nip'),
									'nama' => set_value('nama'),
									'jk' => set_value('jk'),
									'tempat_lahir' => set_value('tempat_lahir'),
									'tgl_lahir' => set_value('tgl_lahir'),
									'jabatan' => set_value('jabatan'),
									'alamat' => set_value('alamat'),
									'telepon' => set_value('telepon'),
                  );
    $this->template->view("content/karyawan/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('karyawan_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['nip'] = $this->input->post('nip',true);
				$save_data['nama'] = $this->input->post('nama',true);
				$save_data['jk'] = $this->input->post('jk',true);
				$save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
				$save_data['tgl_lahir'] = date('Y-m-d',strtotime($this->input->post('tgl_lahir',true)));
				$save_data['jabatan'] = $this->input->post('jabatan',true);
				$save_data['alamat'] = $this->input->post('alamat',true);
				$save_data['telepon'] = $this->input->post('telepon',true);

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/karyawan");
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
    $this->is_allowed('karyawan_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/karyawan/update_action/$id"),
                    'params' => "update",
										'nip' => set_value('nip',$row->nip),
										'nama' => set_value('nama',$row->nama),
										'jk' => set_value('jk',$row->jk),
										'tempat_lahir' => set_value('tempat_lahir',$row->tempat_lahir),
										'tgl_lahir' => set_value('tgl_lahir',date('Y-m-d',strtotime($row->tgl_lahir))),
										'jabatan' => set_value('jabatan',$row->jabatan),
										'alamat' => set_value('alamat',$row->alamat),
										'telepon' => set_value('telepon',$row->telepon),
                    );
      $this->template->view("content/karyawan/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('karyawan_update',false)) {
        return $this->response([
        'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['nip'] = $this->input->post('nip',true);
				$save_data['nama'] = $this->input->post('nama',true);
				$save_data['jk'] = $this->input->post('jk',true);
				$save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
				$save_data['tgl_lahir'] = date('Y-m-d',strtotime($this->input->post('tgl_lahir',true)));
				$save_data['jabatan'] = $this->input->post('jabatan',true);
				$save_data['alamat'] = $this->input->post('alamat',true);
				$save_data['telepon'] = $this->input->post('telepon',true);

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/karyawan");
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

        if (!$this->is_allowed('karyawan_delete',false)) {
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
