<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:34*/
/* Location: ./application/modules/backend/models/Kendaraan_model.php*/
/* Please DO NOT modify this information */

class Kendaraan_model extends MY_Model{

  private $table        = "tb_kendaraan";
  private $primary_key  = "id_kendaraan";
  private $column_order = ["no_pendaftaran","no_mesin","no_rangka","mrk_kendaraan","thn_kendaraan","masa_berlaku"];
  private $order        = ["id_kendaraan"=>"DESC"];
  private $select       = "id_kendaraan,no_pendaftaran,no_mesin,no_rangka,mrk_kendaraan,thn_kendaraan,masa_berlaku";

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
      
			if($this->input->post('no_mesin')){
				$this->db->where('no_mesin', $this->input->post('no_mesin'));
			}
			if($this->input->post('no_rangka')){
				$this->db->where('no_rangka', $this->input->post('no_rangka'));
			}
			if($this->input->post('mrk_kendaraan')){
				$this->db->where('mrk_kendaraan', $this->input->post('mrk_kendaraan'));
			}
			if($this->input->post('thn_kendaraan')){
				$this->db->where('thn_kendaraan', $this->input->post('thn_kendaraan'));
			}
			if($this->input->post('masa_berlaku')){
				$this->db->where('masa_berlaku', $this->input->post('masa_berlaku'));
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


    public function get_datatables($no_pendaftaran=null)
    {
        $this->_get_datatables_query();
        if ($no_pendaftaran) {
          $this->db->where('no_pendaftaran', $no_pendaftaran);
        }
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
