<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:48*/
/* Location: ./application/modules/backend/models/Tarif_model.php*/
/* Please DO NOT modify this information */

class Tarif_model extends MY_Model{

  private $table        = "tb_tarif";
  private $primary_key  = "id_jenis";
  private $column_order = ["jenis_mobil","sub_jenis","sifat","biaya"];
  private $order        = ["id_jenis"=>"DESC"];
  private $select       = "id_jenis,jenis_mobil,sub_jenis,sifat,biaya";

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
			if($this->input->post('jenis_mobil')){
				$this->db->where('jenis_mobil', $this->input->post('jenis_mobil'));
			}
			if($this->input->post('sub_jenis')){
				$this->db->where('sub_jenis', $this->input->post('sub_jenis'));
			}
			if($this->input->post('sifat')){
				$this->db->where('sifat', $this->input->post('sifat'));
			}
			if($this->input->post('biaya')){
				$this->db->where('biaya', $this->input->post('biaya'));
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
    public function getAll()
    {
      $query = $this->db->get($this->table);
      return $query->result();
    }


}
