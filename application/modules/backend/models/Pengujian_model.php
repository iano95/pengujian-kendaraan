<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:17*/
/* Location: ./application/modules/backend/models/Pengujian_model.php*/
/* Please DO NOT modify this information */

class Pengujian_model extends MY_Model{

  private $table        = "tb_pengujian";
  private $primary_key  = "id";
  private $column_order = ["no_pemeriksaan","tgl_pemeriksaan","no_kendaraan"];
  private $order        = ["id"=>"DESC"];
  private $select       = "id,no_pemeriksaan,tgl_pemeriksaan,no_kendaraan";

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
			if($this->input->post('no_pemeriksaan')){
				$this->db->where('no_pemeriksaan', $this->input->post('no_pemeriksaan'));
			}
			if($this->input->post('tgl_pemeriksaan')){
				$this->db->where('tgl_pemeriksaan', $this->input->post('tgl_pemeriksaan'));
			}
			if($this->input->post('no_kendaraan')){
				$this->db->where('no_kendaraan', $this->input->post('no_kendaraan'));
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
