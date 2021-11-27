<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:41*/
/* Location: ./application/modules/backend/controllers/Pembayaran.php*/
/* Please DO NOT modify this information */


class Pembayaran extends Backend{

  private $title = "Data Pembayaran";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Pembayaran_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('tgl_pembayaran', 'Tgl Pembayaran', 'trim|xss_clean|required');
		$this->form_validation->set_rules('no_pendaftaran', 'No Pendaftaran', 'trim|xss_clean|required');
		$this->form_validation->set_rules('no_kendaraan', 'No Kendaraan', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('pembayaran_list');
    $this->template->set_title("$this->title");
    
    $this->template->view("content/pembayaran/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('pembayaran_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
					$row[] = $get->tgl_pembayaran;
					$row[] = $get->no_pendaftaran." - ".$get->nama_pemilik;
          $row[] = $get->no_kendaraan." - ".$get->mrk_kendaraan;
					$row[] = "Rp. ".number_format($get->biaya,2,',','.') ;
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/pembayaran/detail/".enc_url($get->id_pembayaran)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                          <a href="'.site_url("backend/pembayaran/update/".enc_url($get->id_pembayaran)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.site_url("backend/pembayaran/delete/".enc_url($get->id_pembayaran)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
    $this->template->view("content/pembayaran/filter",[],false);
  }

  function detail($id = null)
  {
    
    $this->is_allowed('pembayaran_detail');
    if ($row = $this->model->getDetail(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'tgl_pembayaran' => set_value('tgl_pembayaran',dateTimeFormat($row->tgl_pembayaran)),
										'no_pendaftaran' => set_value('no_pendaftaran',$row->no_pendaftaran.' - '.$row->nama_pemilik),
										'no_kendaraan' => set_value('no_kendaraan',$row->no_kendaraan.' - '.$row->mrk_kendaraan),
                    'biaya' => set_value('biaya',$row->biaya),
                    'jenis' => set_value('jenis',$row->jenis_mobil),
                    'sub_jenis' => set_value('sub_jenis',$row->sub_jenis),
                    'sifat' => set_value('sifat',$row->sifat),
                );
      $this->template->view("content/pembayaran/detail",$data);
    }
  }


  function add()
  {
    $this->is_allowed('pembayaran_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/pembayaran/add_action"),
                  'params' => "add",
									'tgl_pembayaran' => set_value('tgl_pembayaran'),
									'no_pendaftaran' => set_value('no_pendaftaran'),
									'no_kendaraan' => set_value('no_kendaraan'),
                  );
    $data['pemohon']=$this->db->get('tb_pemohon')->result();
    $data['kend']=$this->db->get('tb_kendaraan')->result();
    $this->template->view("content/pembayaran/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pembayaran_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['tgl_pembayaran'] = date('Y-m-d H:i',strtotime($this->input->post('tgl_pembayaran',true)));
				$save_data['no_pendaftaran'] = $this->input->post('no_pendaftaran',true);
				$save_data['no_kendaraan'] = $this->input->post('no_kendaraan',true);

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/pembayaran");
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
    $this->is_allowed('pembayaran_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/pembayaran/update_action/$id"),
                    'params' => "update",
										'tgl_pembayaran' => set_value('tgl_pembayaran',dateTimeFormat($row->tgl_pembayaran)),
										'no_pendaftaran' => set_value('no_pendaftaran',$row->no_pendaftaran),
										'no_kendaraan' => set_value('no_kendaraan',$row->no_kendaraan),
                    );
      $data['pemohon']=$this->db->get('tb_pemohon')->result();
      $data['kend']=$this->db->get('tb_kendaraan')->result();
      $this->template->view("content/pembayaran/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pembayaran_update',false)) {
        return $this->response([
        'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['tgl_pembayaran'] = date('Y-m-d H:i',strtotime($this->input->post('tgl_pembayaran',true)));
				$save_data['no_pendaftaran'] = $this->input->post('no_pendaftaran',true);
				$save_data['no_kendaraan'] = $this->input->post('no_kendaraan',true);

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/pembayaran");
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

        if (!$this->is_allowed('pembayaran_delete',false)) {
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
  public function opKend()
  {
    $pem=$_GET['nopend'];
    $noken=$_GET['seleted'];
    $this->db->where('no_pendaftaran', $pem);
    $data=$this->db->get('tb_kendaraan',)->result();
    foreach ($data as $key) {
      echo "<option value='$key->id_kendaraan'";
      echo   ($noken == $key->id_kendaraan) ? 'selected>' : '>';
      echo    "$key->id_kendaraan - $key->mrk_kendaraan </option>";
    }

  }



}
