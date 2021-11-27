<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:39*/
/* Location: ./application/modules/backend/models/Pemohon_model.php*/
/* Please DO NOT modify this information */

class Pemohon_model extends MY_Model{

  private $table        = "tb_pemohon";
  private $primary_key  = "id";
  private $column_order = ["no_pendaftaran","jenis_identitas","id_identitas","tgl_pendaftaran","nama_pemilik","alamat_pemilik","jenis_kelamin","pekerjaan","username","email"];
  private $order        = ["id"=>"DESC"];
  private $select       = "id,no_pendaftaran,jenis_identitas,id_identitas,tgl_pendaftaran,nama_pemilik,alamat_pemilik,jenis_kelamin,pekerjaan,username,email";

public function __construct()
	{
		$config = array(
      'table' 	      => $this->table,
			'primary_key' 	=> $this->primary_key,
		 	'select' 	      => $this->select,
      'column_order' 	=> $this->column_order,
      'order' 	      => $this->order,
		 );

		parent::__construct($config);
	}


  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);

      //filter
			if($this->input->post('no_pendaftaran')){
				$this->db->where('no_pendaftaran', $this->input->post('no_pendaftaran'));
			}
			if($this->input->post('jenis_identitas')){
				$this->db->where('jenis_identitas', $this->input->post('jenis_identitas'));
			}
			if($this->input->post('id_identitas')){
				$this->db->where('id_identitas', $this->input->post('id_identitas'));
			}
			if($this->input->post('tgl_pendaftaran')){
				$this->db->where('tgl_pendaftaran', $this->input->post('tgl_pendaftaran'));
			}
			if($this->input->post('nama_pemilik')){
				$this->db->where('nama_pemilik', $this->input->post('nama_pemilik'));
			}
			if($this->input->post('alamat_pemilik')){
				$this->db->where('alamat_pemilik', $this->input->post('alamat_pemilik'));
			}
			if($this->input->post('jenis_kelamin')){
				$this->db->where('jenis_kelamin', $this->input->post('jenis_kelamin'));
			}
			if($this->input->post('pekerjaan')){
				$this->db->where('pekerjaan', $this->input->post('pekerjaan'));
			}
			if($this->input->post('username')){
				$this->db->where('username', $this->input->post('username'));
			}
			if($this->input->post('email')){
				$this->db->where('email', $this->input->post('email'));
			}


      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);
      return $this->db->count_all_results();
    }
    public function getAll($email=null,$tahun=null)
    {
      if($email){
        $this->db->where("email='$email'");
      }
      if($tahun){
        $this->db->where("YEAR(tgl_pendaftaran)=$tahun");
      }
      $query = $this->db->get($this->table);
      return $query->result();
    }


}
