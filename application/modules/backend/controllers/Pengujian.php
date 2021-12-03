<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:17*/
/* Location: ./application/modules/backend/controllers/Pengujian.php*/
/* Please DO NOT modify this information */


class Pengujian extends Backend{

  private $title = "Data Pengujian";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Pengujian_model","model");
    
    $this->load->model("pemohon_model","pemohon");
  }

  function _rules()
  {
		$this->form_validation->set_rules('no_pemeriksaan', 'No Pemeriksaan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('tgl_pemeriksaan', 'Tgl Pemeriksaan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('no_kendaraan', 'No Kendaraan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('peralatan', 'Peralatan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('penerangan', 'Penerangan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('kemudi', 'Kemudi', 'trim|xss_clean|required');
		$this->form_validation->set_rules('suspensi', 'Suspensi', 'trim|xss_clean|required');
		$this->form_validation->set_rules('ban', 'Ban', 'trim|xss_clean|required');
		$this->form_validation->set_rules('rangka', 'Rangka', 'trim|xss_clean|required');
		$this->form_validation->set_rules('rem', 'Rem', 'trim|xss_clean|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('pengujian_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/pengujian/index");
  }

  function json()
  {
   
    $no=null;
    if (profile('group')=='pemohon') {
      $no=$this->pemohon->getAll(profile('email'))[0]->no_pendaftaran;
  
    }
    if (!$this->is_allowed('pengujian_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables($no);
      $data = array();
      foreach ($rows as $get) {
          $pem=$this->db->get_where('tb_kendaraan',['id_kendaraan'=>"$get->no_kendaraan"])->row();

          $nmpem=$this->db->get_where('tb_pemohon',['no_pendaftaran'=>"$pem->no_pendaftaran"])->row();
          $row = array();
					$row[] = $get->no_pemeriksaan;
					$row[] = $get->tgl_pemeriksaan;
					$row[] = $get->no_kendaraan." ($pem->mrk_kendaraan)";
          $row[] = $nmpem->nama_pemilik;
          if (!$this->is_allowed('pengujian_add',false)) {
            $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/pengujian/detail/".enc_url($get->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                      </div>
                   ';
          }
          else{
            $row[] = '
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.site_url("backend/pengujian/detail/".enc_url($get->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                  <i class="ti-file"></i>
                </a>

                <a href="'.site_url("backend/pengujian/update/".enc_url($get->id)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                  <i class="ti-pencil"></i>
                </a>
                <a href="'.site_url("backend/pengujian/delete/".enc_url($get->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
                  <i class="ti-trash"></i>
                </a>
              </div>
         ';

          }
          
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


  function filter()
  {
    $this->template->view("content/pengujian/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('pengujian_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'no_pemeriksaan' => set_value('no_pemeriksaan',$row->no_pemeriksaan),
										'tgl_pemeriksaan' => set_value('tgl_pemeriksaan',date('Y-m-d',strtotime($row->tgl_pemeriksaan))),
										'no_kendaraan' => set_value('no_kendaraan',$row->no_kendaraan),
										'peralatan' => set_value('peralatan',$row->peralatan),
										'penerangan' => set_value('penerangan',$row->penerangan),
										'kemudi' => set_value('kemudi',$row->kemudi),
										'suspensi' => set_value('suspensi',$row->suspensi),
										'ban' => set_value('ban',$row->ban),
										'rangka' => set_value('rangka',$row->rangka),
										'rem' => set_value('rem',$row->rem),
										'keterangan' => set_value('keterangan',$row->keterangan),
                    );
      $this->template->view("content/pengujian/detail",$data);
    }
  }


  function add()
  {
    
    $this->is_allowed('pengujian_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/pengujian/add_action"),
                  'params' => "add",
									'no_pemeriksaan' => set_value('no_pemeriksaan'),
									'tgl_pemeriksaan' => set_value('tgl_pemeriksaan'),
                  'no_kendaraan' => set_value('no_kendaraan'),
									'no_pendaftaran' => '',
									'peralatan' => set_value('peralatan'),
									'penerangan' => set_value('penerangan'),
									'kemudi' => set_value('kemudi'),
									'suspensi' => set_value('suspensi'),
									'ban' => set_value('ban'),
									'rangka' => set_value('rangka'),
									'rem' => set_value('rem'),
									'keterangan' => set_value('keterangan'),
                  );
    $data['pemohon']=$this->db->get('tb_pemohon')->result();
    $this->template->view("content/pengujian/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pengujian_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pemeriksaan'] = $this->input->post('no_pemeriksaan',true);
				$save_data['tgl_pemeriksaan'] = date('Y-m-d',strtotime($this->input->post('tgl_pemeriksaan',true)));
				$save_data['no_kendaraan'] = $this->input->post('no_kendaraan',true);
				$save_data['peralatan'] = $this->input->post('peralatan',true);
				$save_data['penerangan'] = $this->input->post('penerangan',true);
				$save_data['kemudi'] = $this->input->post('kemudi',true);
				$save_data['suspensi'] = $this->input->post('suspensi',true);
				$save_data['ban'] = $this->input->post('ban',true);
				$save_data['rangka'] = $this->input->post('rangka',true);
				$save_data['rem'] = $this->input->post('rem',true);
				$save_data['keterangan'] = $this->input->post('keterangan',true);

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/pengujian");
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
    $this->is_allowed('pengujian_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/pengujian/update_action/$id"),
                    'params' => "update",
										'no_pemeriksaan' => set_value('no_pemeriksaan',$row->no_pemeriksaan),
										'tgl_pemeriksaan' => set_value('tgl_pemeriksaan',date('Y-m-d',strtotime($row->tgl_pemeriksaan))),
										'no_kendaraan' => set_value('no_kendaraan',$row->no_kendaraan),
										'peralatan' => set_value('peralatan',$row->peralatan),
										'penerangan' => set_value('penerangan',$row->penerangan),
										'kemudi' => set_value('kemudi',$row->kemudi),
										'suspensi' => set_value('suspensi',$row->suspensi),
										'ban' => set_value('ban',$row->ban),
										'rangka' => set_value('rangka',$row->rangka),
										'rem' => set_value('rem',$row->rem),
										'keterangan' => set_value('keterangan',$row->keterangan),
                    );
      $pem=$this->db->get_where('tb_kendaraan',['id_kendaraan'=>$row->no_kendaraan])->row();
      $data['no_pendaftaran']=$pem->no_pendaftaran;
      $data['pemohon']=$this->db->get('tb_pemohon')->result();
      $this->template->view("content/pengujian/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('pengujian_update',false)) {
        return $this->response([
        'is_allowed' => "maaf Anda tidak Memiliki Akses"
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pemeriksaan'] = $this->input->post('no_pemeriksaan',true);
				$save_data['tgl_pemeriksaan'] = date('Y-m-d',strtotime($this->input->post('tgl_pemeriksaan',true)));
				$save_data['no_kendaraan'] = $this->input->post('no_kendaraan',true);
				$save_data['peralatan'] = $this->input->post('peralatan',true);
				$save_data['penerangan'] = $this->input->post('penerangan',true);
				$save_data['kemudi'] = $this->input->post('kemudi',true);
				$save_data['suspensi'] = $this->input->post('suspensi',true);
				$save_data['ban'] = $this->input->post('ban',true);
				$save_data['rangka'] = $this->input->post('rangka',true);
				$save_data['rem'] = $this->input->post('rem',true);
				$save_data['keterangan'] = $this->input->post('keterangan',true);

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/pengujian");
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

        if (!$this->is_allowed('pengujian_delete',false)) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Maaf Anda Tidak Memilik Akses"
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
