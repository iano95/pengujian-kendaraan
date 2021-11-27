<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan_pemohon extends Backend{

  private $title = "Laporan Pemohon";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Pemohon_model","model");
  }

 

  function index($tahun=null)
  { 
    if (isset($_GET['tahun'])) {
      $tahun=$_GET['tahun']; 
    }
    
    $this->template->set_title("$this->title ".$tahun);
    $data['data']=$this->model->getAll(null,$tahun);
    $data['tahun']=$tahun;
    $this->template->view("content/laporan/pemohon",$data);
    
  }




}
