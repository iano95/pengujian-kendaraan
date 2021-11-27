<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:39*/
/* Location: ./application/modules/backend/controllers/Pemohon.php*/
/* Please DO NOT modify this information */


class Pemohon extends Backend{

  private $title = "Data Pemohon";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Pemohon_model","model");
  }

  function _rules()
  {
		
		$this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'trim|xss_clean|required');
		$this->form_validation->set_rules('id_identitas', 'Id Identitas', 'trim|xss_clean|required');
		$this->form_validation->set_rules('tgl_pendaftaran', 'Tgl Pendaftaran', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alamat_pemilik', 'Alamat Pemilik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|xss_clean|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('pemohon_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/pemohon/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('pemohon_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
					$row[] = $get->no_pendaftaran;
					$row[] = $get->jenis_identitas;
					$row[] = $get->id_identitas;
					$row[] = $get->tgl_pendaftaran;
					$row[] = $get->nama_pemilik;
					$row[] = $get->alamat_pemilik;
					$row[] = $get->jenis_kelamin;
					$row[] = $get->pekerjaan;
					$row[] = $get->username;
					$row[] = $get->email;
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/pemohon/detail/".enc_url($get->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
            
                          <a href="'.site_url("backend/pemohon/delete/".enc_url($get->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
    $this->template->view("content/pemohon/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('pemohon_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'no_pendaftaran' => set_value('no_pendaftaran',$row->no_pendaftaran),
										'jenis_identitas' => set_value('jenis_identitas',$row->jenis_identitas),
										'id_identitas' => set_value('id_identitas',$row->id_identitas),
										'tgl_pendaftaran' => set_value('tgl_pendaftaran',date('Y-m-d',strtotime($row->tgl_pendaftaran))),
										'nama_pemilik' => set_value('nama_pemilik',$row->nama_pemilik),
										'alamat_pemilik' => set_value('alamat_pemilik',$row->alamat_pemilik),
										'jenis_kelamin' => set_value('jenis_kelamin',$row->jenis_kelamin),
										'pekerjaan' => set_value('pekerjaan',$row->pekerjaan),
										'username' => set_value('username',$row->username),
										'email' => set_value('email',$row->email),
                    );
      $this->template->view("content/pemohon/detail",$data);
    }
  }


  function add()
  {
    
    $this->is_allowed('pemohon_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/pemohon/add_action"),
                  'params' => "add",
									'jenis_identitas' => set_value('jenis_identitas'),
									'id_identitas' => set_value('id_identitas'),
									'tgl_pendaftaran' => set_value('tgl_pendaftaran'),
									'nama_pemilik' => set_value('nama_pemilik'),
									'alamat_pemilik' => set_value('alamat_pemilik'),
									'jenis_kelamin' => set_value('jenis_kelamin'),
									'pekerjaan' => set_value('pekerjaan'),
									'username' => set_value('username'),
									'email' => set_value('email'),
									'password' => set_value('password'),
                  'add'=>'yes',
                  );
    $this->template->view("content/pemohon/form",$data);
  }


  function add_action()
  {
    $no_pendaftaran = $this->db->query("SELECT (no_pendaftaran +1) as no FROM tb_pemohon ORDER BY no_pendaftaran DESC LIMIT 1")->row()->no;

    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pemohon_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pendaftaran'] = $no_pendaftaran;
				$save_data['jenis_identitas'] = $this->input->post('jenis_identitas',true);
				$save_data['id_identitas'] = $this->input->post('id_identitas',true);
				$save_data['tgl_pendaftaran'] = date('Y-m-d',strtotime($this->input->post('tgl_pendaftaran',true)));
				$save_data['nama_pemilik'] = $this->input->post('nama_pemilik',true);
				$save_data['alamat_pemilik'] = $this->input->post('alamat_pemilik',true);
				$save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
				$save_data['pekerjaan'] = $this->input->post('pekerjaan',true);
				$save_data['username'] = $this->input->post('username',true);
				$save_data['email'] = $this->input->post('email',true);
				$save_data['password'] = $this->input->post('password',true);

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/pemohon");
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
    $this->is_allowed('pemohon_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/pemohon/update_action/$id"),
                    'params' => "update",
										'jenis_identitas' => set_value('jenis_identitas',$row->jenis_identitas),
										'id_identitas' => set_value('id_identitas',$row->id_identitas),
										'tgl_pendaftaran' => set_value('tgl_pendaftaran',date('Y-m-d',strtotime($row->tgl_pendaftaran))),
										'nama_pemilik' => set_value('nama_pemilik',$row->nama_pemilik),
										'alamat_pemilik' => set_value('alamat_pemilik',$row->alamat_pemilik),
										'jenis_kelamin' => set_value('jenis_kelamin',$row->jenis_kelamin),
										'pekerjaan' => set_value('pekerjaan',$row->pekerjaan),
										'username' => set_value('username',$row->username),
										'email' => set_value('email',$row->email),
										'password' => set_value('password',$row->password),
                    );
      $this->template->view("content/pemohon/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pemohon_update',false)) {
        return $this->response([
        'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['jenis_identitas'] = $this->input->post('jenis_identitas',true);
				$save_data['id_identitas'] = $this->input->post('id_identitas',true);
				$save_data['tgl_pendaftaran'] = date('Y-m-d',strtotime($this->input->post('tgl_pendaftaran',true)));
				$save_data['nama_pemilik'] = $this->input->post('nama_pemilik',true);
				$save_data['alamat_pemilik'] = $this->input->post('alamat_pemilik',true);
				$save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
				$save_data['pekerjaan'] = $this->input->post('pekerjaan',true);
				$save_data['username'] = $this->input->post('username',true);
				$save_data['email'] = $this->input->post('email',true);
				$save_data['password'] = $this->input->post('password',true);

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/pemohon");
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

        if (!$this->is_allowed('pemohon_delete',false)) {
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
