<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 20/11/2021 17:41*/
/* Location: ./application/modules/backend/models/Pembayaran_model.php*/
/* Please DO NOT modify this information */

class Pembayaran_model extends MY_Model{

  private $table        = "tb_pembayaran";
  private $primary_key  = "id_pembayaran";
  private $column_order = ["tgl_pembayaran","no_pendaftaran","no_kendaraan"];
  private $order        = ["id_pembayaran"=>"DESC"];
  private $select       = "tb_pembayaran.id_pembayaran,tb_pembayaran.tgl_pembayaran,tb_pembayaran.no_pendaftaran,tb_pembayaran.no_kendaraan";

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
      $this->db->select($this->select.",tb_pemohon.nama_pemilik,tb_kendaraan.mrk_kendaraan,tb_tarif.biaya,tb_tarif.jenis_mobil,tb_tarif.sub_jenis,tb_tarif.sifat");
      $this->db->from($this->table);
      $this->db->join('tb_pemohon', 'tb_pemohon.no_pendaftaran = tb_pembayaran.no_pendaftaran', 'left');
      $this->db->join('tb_kendaraan', 'tb_kendaraan.id_kendaraan = tb_pembayaran.no_kendaraan', 'left');
      $this->db->join('tb_tarif', 'tb_tarif.id_jenis = tb_kendaraan.jenis', 'left');

      //filter
			if($this->input->post('tgl_pembayaran')){
				$this->db->where('tgl_pembayaran', $this->input->post('tgl_pembayaran'));
			}
			if($this->input->post('no_pendaftaran')){
				$this->db->where('no_pendaftaran', $this->input->post('no_pendaftaran'));
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
    public function getDetail($id=null)
    {
        $this->_get_datatables_query();
        $this->db->where('tb_pembayaran.id_pembayaran', $id);
        $query = $this->db->get();
        return $query->row();
    }


}
