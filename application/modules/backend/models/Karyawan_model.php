<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:21*/
/* Location: ./application/modules/backend/models/Karyawan_model.php*/
/* Please DO NOT modify this information */

class Karyawan_model extends MY_Model{

  private $table        = "tb_karyawan";
  private $primary_key  = "id";
  private $column_order = ["nip","nama","jk","tempat_lahir","tgl_lahir","jabatan","alamat","telepon"];
  private $order        = ["id"=>"DESC"];
  private $select       = "id,nip,nama,jk,tempat_lahir,tgl_lahir,jabatan,alamat,telepon";

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
			if($this->input->post('nip')){
				$this->db->where('nip', $this->input->post('nip'));
			}
			if($this->input->post('nama')){
				$this->db->where('nama', $this->input->post('nama'));
			}
			if($this->input->post('jk')){
				$this->db->where('jk', $this->input->post('jk'));
			}
			if($this->input->post('tempat_lahir')){
				$this->db->where('tempat_lahir', $this->input->post('tempat_lahir'));
			}
			if($this->input->post('tgl_lahir')){
				$this->db->where('tgl_lahir', $this->input->post('tgl_lahir'));
			}
			if($this->input->post('jabatan')){
				$this->db->where('jabatan', $this->input->post('jabatan'));
			}
			if($this->input->post('alamat')){
				$this->db->where('alamat', $this->input->post('alamat'));
			}
			if($this->input->post('telepon')){
				$this->db->where('telepon', $this->input->post('telepon'));
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


}
