<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:39*/
/* Location: ./application/modules/backend/controllers/Pemohon.php*/
/* Please DO NOT modify this information */


class My_profile extends Backend{

  private $title = "Profil Saya";

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





  function index($id = null)
  {
    $email=profile('email');

    $this->is_allowed('pemohon_detail');
    if ($row = $this->db->get_where('tb_pemohon',"email='$email'")->row()) {
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
										'password' => set_value('password',$row->password),
										'id' => enc_url($row->id),
                    );
      $this->template->view("content/my_profile/detail",$data);
    }
  }


  function update($id = null)
  {
    $this->is_allowed('pemohon_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/my_profile/update_action/$id"),
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

        $data=[

          "name"=>$this->input->post('nama_pemilik',true),
          "email"=>$this->input->post('email',true),
        ];
        $email=profile('email');
        $this->db->where('email', $email);
        $this->db->update('auth_user', $data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/my_profile");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }
      return $this->response($json);
    }
  }



}
