<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan_pengujian extends Backend{

  private $title = "Laporan Pengujian";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Kendaraan_model","model");
  }

 

  function index($tahun=null,$jenis=null,$merek=null)
  { 
    $this->db->select('tb_pengujian.*,tb_kendaraan.*,tb_tarif.*,tb_pemohon.nama_pemilik');
    $this->db->from('tb_pengujian');
    $this->db->join('tb_kendaraan', 'tb_kendaraan.id_kendaraan = tb_pengujian.no_kendaraan', 'left');
    $this->db->join('tb_pemohon', 'tb_pemohon.no_pendaftaran = tb_kendaraan.no_pendaftaran', 'left');
    $this->db->join('tb_tarif', 'tb_tarif.id_jenis = tb_kendaraan.jenis', 'left');

    if (isset($_GET['tahun'])) {
      $tahun=$_GET['tahun'];
      $this->db->where('tb_kendaraan.thn_kendaraan', $tahun);
    }
    if (isset($_GET['jenis'])) {
      $jenis=$_GET['jenis']; 
      $this->db->where('tb_kendaraan.jenis', $jenis);
    }
    if (isset($_GET['merek'])) {
      $merek=$_GET['merek']; 
      $this->db->where('tb_kendaraan.mrk_kendaraan', $merek);
    }
    
    $this->template->set_title("$this->title");
    $data['datat']=$this->db->get()->result();
    $data['tahun']=$tahun;
    $data['jenis']=$jenis;
    $data['merek']=$merek;
    $data['dtMerek']=$this->db->query("SELECT * FROM tb_kendaraan group by mrk_kendaraan")->result();
    $this->template->view("content/laporan/pengujian",$data);
    
  }




}
