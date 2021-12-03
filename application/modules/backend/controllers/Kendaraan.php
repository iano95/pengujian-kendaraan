<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Kendaraan extends Backend{

  private $title = "Data Kendaraan";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Kendaraan_model","model");
    $this->load->model("pemohon_model","pemohon");
    $this->load->model("tarif_model","jenis");
  }

  function _rules()
  {
		$this->form_validation->set_rules('no_pendaftaran', 'No Pendaftaran', 'trim|xss_clean|required');
		$this->form_validation->set_rules('no_mesin', 'No Mesin', 'trim|xss_clean|required');
		$this->form_validation->set_rules('no_rangka', 'No Rangka', 'trim|xss_clean|required');
		$this->form_validation->set_rules('mrk_kendaraan', 'Mrk Kendaraan', 'trim|xss_clean|required');
		$this->form_validation->set_rules('thn_kendaraan', 'Thn Kendaraan', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|xss_clean|required');
		$this->form_validation->set_rules('berat_jbkb', 'Berat Jbkb', 'trim|xss_clean|required');
		$this->form_validation->set_rules('berta_kosong', 'Berta Kosong', 'trim|xss_clean|required');
		$this->form_validation->set_rules('daya_barang', 'Daya Barang', 'trim|xss_clean|required');
		$this->form_validation->set_rules('daya_orang', 'Daya Orang', 'trim|xss_clean|required');
		$this->form_validation->set_rules('masa_berlaku', 'Masa Berlaku', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('kendaraan_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/kendaraan/index");
  }

  function json()
  {
    $no=null;
    if (profile('group')=='pemohon') {
      $no=$this->pemohon->getAll(profile('email'))[0]->no_pendaftaran;
    }

    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('kendaraan_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables($no);
      $data = array();
      foreach ($rows as $get) {
          $pemohon=$this->db->get_where('tb_pemohon',['no_pendaftaran'=>$get->no_pendaftaran])->row();
          $row = array();
					$row[] = $get->no_pendaftaran." - $pemohon->nama_pemilik";
					$row[] = $get->no_mesin;
					$row[] = $get->no_rangka;
					$row[] = $get->mrk_kendaraan;
					$row[] = $get->thn_kendaraan;
					$row[] = $get->masa_berlaku;
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/kendaraan/detail/".enc_url($get->id_kendaraan)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                          <a href="'.site_url("backend/kendaraan/update/".enc_url($get->id_kendaraan)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.site_url("backend/kendaraan/delete/".enc_url($get->id_kendaraan)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
    $this->template->view("content/kendaraan/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('kendaraan_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $pemohon=$this->db->get_where('tb_pemohon',['no_pendaftaran'=>$row->no_pendaftaran])->row();
      $data = array(
										'no_pendaftaran' => set_value('no_pendaftaran',$row->no_pendaftaran)." - $pemohon->nama_pemilik",
										'no_mesin' => set_value('no_mesin',$row->no_mesin),
										'no_rangka' => set_value('no_rangka',$row->no_rangka),
										'mrk_kendaraan' => set_value('mrk_kendaraan',$row->mrk_kendaraan),
										'thn_kendaraan' => set_value('thn_kendaraan',$row->thn_kendaraan),
										'jenis' => set_value('jenis',$row->jenis),
										'berat_jbkb' => set_value('berat_jbkb',$row->berat_jbkb),
										'berta_kosong' => set_value('berta_kosong',$row->berta_kosong),
										'daya_barang' => set_value('daya_barang',$row->daya_barang),
										'daya_orang' => set_value('daya_orang',$row->daya_orang),
										'masa_berlaku' => set_value('masa_berlaku',date('Y-m-d',strtotime($row->masa_berlaku))),
                    );
      $this->template->view("content/kendaraan/detail",$data);
    }
  }


  function add()
  {

    $this->is_allowed('kendaraan_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/kendaraan/add_action"),
                  'params' => "add",
									'no_pendaftaran' => set_value('no_pendaftaran'),
									'no_mesin' => set_value('no_mesin'),
									'no_rangka' => set_value('no_rangka'),
									'mrk_kendaraan' => set_value('mrk_kendaraan'),
									'thn_kendaraan' => set_value('thn_kendaraan'),
									'jenis' => set_value('jenis'),
									'berat_jbkb' => set_value('berat_jbkb'),
									'berta_kosong' => set_value('berta_kosong'),
									'daya_barang' => set_value('daya_barang'),
									'daya_orang' => set_value('daya_orang'),
									'masa_berlaku' => set_value('masa_berlaku'),
                  'pemohon'=>$this->pemohon->getAll(),
                  'jenism'=>$this->jenis->getAll()
                  );
    if (profile('group')=='pemohon') {
      $data['pemohon']=$this->pemohon->getAll(profile('email'));
    }
    $this->template->view("content/kendaraan/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('kendaraan_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pendaftaran'] = $this->input->post('no_pendaftaran',true);
				$save_data['no_mesin'] = $this->input->post('no_mesin',true);
				$save_data['no_rangka'] = $this->input->post('no_rangka',true);
				$save_data['mrk_kendaraan'] = $this->input->post('mrk_kendaraan',true);
				$save_data['thn_kendaraan'] = $this->input->post('thn_kendaraan',true);
				$save_data['jenis'] = $this->input->post('jenis',true);
				$save_data['berat_jbkb'] = $this->input->post('berat_jbkb',true);
				$save_data['berta_kosong'] = $this->input->post('berta_kosong',true);
				$save_data['daya_barang'] = $this->input->post('daya_barang',true);
				$save_data['daya_orang'] = $this->input->post('daya_orang',true);
				$save_data['masa_berlaku'] = date('Y-m-d',strtotime($this->input->post('masa_berlaku',true)));

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/kendaraan");
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
    
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/kendaraan/update_action/$id"),
                    'params' => "update",
										'no_pendaftaran' => set_value('no_pendaftaran',$row->no_pendaftaran),
										'no_mesin' => set_value('no_mesin',$row->no_mesin),
										'no_rangka' => set_value('no_rangka',$row->no_rangka),
										'mrk_kendaraan' => set_value('mrk_kendaraan',$row->mrk_kendaraan),
										'thn_kendaraan' => set_value('thn_kendaraan',$row->thn_kendaraan),
										'jenis' => set_value('jenis',$row->jenis),
										'berat_jbkb' => set_value('berat_jbkb',$row->berat_jbkb),
										'berta_kosong' => set_value('berta_kosong',$row->berta_kosong),
										'daya_barang' => set_value('daya_barang',$row->daya_barang),
										'daya_orang' => set_value('daya_orang',$row->daya_orang),
										'masa_berlaku' => set_value('masa_berlaku',date('Y-m-d',strtotime($row->masa_berlaku))),
                    'pemohon'=>$this->pemohon->getAll(),
                    'jenism'=>$this->jenis->getAll()
                    );
                    if (profile('group')=='pemohon') {
                      $data['pemohon']=$this->pemohon->getAll(profile('email'));
                    }
      $this->template->view("content/kendaraan/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      // if (!$this->is_allowed('kendaraan_update',false)) {
      //   return $this->response([
      //   'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
      //   ]);
      // }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['no_pendaftaran'] = $this->input->post('no_pendaftaran',true);
				$save_data['no_mesin'] = $this->input->post('no_mesin',true);
				$save_data['no_rangka'] = $this->input->post('no_rangka',true);
				$save_data['mrk_kendaraan'] = $this->input->post('mrk_kendaraan',true);
				$save_data['thn_kendaraan'] = $this->input->post('thn_kendaraan',true);
				$save_data['jenis'] = $this->input->post('jenis',true);
				$save_data['berat_jbkb'] = $this->input->post('berat_jbkb',true);
				$save_data['berta_kosong'] = $this->input->post('berta_kosong',true);
				$save_data['daya_barang'] = $this->input->post('daya_barang',true);
				$save_data['daya_orang'] = $this->input->post('daya_orang',true);
				$save_data['masa_berlaku'] = date('Y-m-d',strtotime($this->input->post('masa_berlaku',true)));

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/kendaraan");
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

        if (!$this->is_allowed('kendaraan_delete',false)) {
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
