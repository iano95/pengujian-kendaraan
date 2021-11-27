<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Register extends CI_Controller{


  public function __construct()
  {
    parent::__construct();
    $this->load->library(array("encryption",'form_validation'));
    $this->load->helper(array("backend/app","public",'form','app','language'));
    
    $this->load->model("Pemohon_model","model");
    $this->load->model("User_model","user");
  }

  function _rules()
  {
		$this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'trim|xss_clean|required');
		$this->form_validation->set_rules('id_identitas', 'Id Identitas', 'trim|xss_clean|required');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('alamat_pemilik', 'Alamat Pemilik', 'trim|xss_clean|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|xss_clean|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  public function response($data, $status = 200)
  {
      // $data['csrf_name'] = $this->security->get_csrf_token_name();
      // $data['csrf_token'] = $this->security->get_csrf_hash();

      header('Content-type:application/json');
      die(json_encode($data));
      $this->output
          ->set_content_type('application/json')
          ->set_status_header($status)
          ->set_output(json_encode($data));
  }

  function index()
  {
    $no_pendaftaran = $this->db->query("SELECT (no_pendaftaran +1) as no FROM tb_pemohon ORDER BY no_pendaftaran DESC LIMIT 1")->row()->no;
    $data = array('action' => site_url("backend/pemohon/add_action"),
    'no_pendaftaran' => $no_pendaftaran,
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
    );
    $this->load->view("register",$data);
    
  }


  function action()
  {
    
    $no_pendaftaran = $this->db->query("SELECT (no_pendaftaran +1) as no FROM tb_pemohon ORDER BY no_pendaftaran DESC LIMIT 1")->row()->no;
    if($this->input->is_ajax_request()){
      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pendaftaran'] = $no_pendaftaran;
				$save_data['jenis_identitas'] = $this->input->post('jenis_identitas',true);
				$save_data['id_identitas'] = $this->input->post('id_identitas',true);
				$save_data['nama_pemilik'] = $this->input->post('nama_pemilik',true);
				$save_data['alamat_pemilik'] = $this->input->post('alamat_pemilik',true);
				$save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
				$save_data['pekerjaan'] = $this->input->post('pekerjaan',true);
				$save_data['username'] = $this->input->post('username',true);
				$save_data['email'] = $this->input->post('email',true);
				$save_data['password'] = $this->input->post('password',true);

        $this->model->insert($save_data);
        $token =  randomKey();
        $data=[

          "name"=>$this->input->post('nama_pemilik',true),
          "email"=>$this->input->post('email',true),
          "is_active"=>'1',
          'password' => pass_encrypt($token,$this->input->post('password')),
          'is_delete' => "0",
          'token'=>$token,
          'created' => date('Y-m-d H:i:s'),
        ];
        $this->user->get_insert("auth_user",$data);
        $last_id_user = $this->db->insert_id();

        $insert_trans = array('id_user' => $last_id_user,
                              'id_group' => '17'
                            );
        $this->user->get_insert("auth_user_to_group",$insert_trans);
        set_message("success","Berhasil");

        $json['redirect'] = site_url("backend/login");
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
