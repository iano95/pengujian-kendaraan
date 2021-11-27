<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan_karyawan extends Backend{

  private $title = "Laporan Karyawan";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Pemohon_model","model");
  }

 

  function index()
  { 
    
    $this->template->set_title("$this->title");
    $data['data']=$this->db->get('tb_karyawan')->result();
    $this->template->view("content/laporan/karyawan",$data);
    
  }




}
