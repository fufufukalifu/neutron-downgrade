<?php 
class Kelompokkelas_model extends CI_Model
{

	function __construct(){
	}

	/*Mengambil semua cabang*/
	function get_kelompok_kelas_byid_cabang($data){
		$this->db->select('kk.id as id_kk,kk.KelompokKelas');
		$this->db->from('tb_cabang cabang');
        $this->db->join('tb_kelompok_kelas kk','cabang.id=kk.cabangID');		
		$this->db->where('cabang.id', $data);	
		$this->db->where('status',1);
		$this->db->order_by('kk.id desc');
		$query = $this->db->get();
		return $query->result();
	}	

	function insert_kk($data){
		$this->db->insert('tb_kelompok_kelas', $data);		
	}

	function up_status($id_kk){
		$this->db->where('id',$id_kk);
		$this->db->set('status',0);
		$this->db->update('tb_kelompok_kelas');
	}

	function drop_cabang($data){
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_cabang');
	}
	function update_cabang($data){
	$this->db->where('id', $data['id']);
	$array_update = array("namaCabang"=>$data['namaCabang'],
					"alamat"=>$data['alamat'],
					"kodeCabang"=>$data['kodeCabang']);
	$this->db->set($array_update);
	$this->db->update('tb_cabang');
}
	function ch_kelompokKelas($id_kk,$kk){
		$this->db->where('id',$id_kk);
		$this->db->set('KelompokKelas',$kk);
		$this->db->update('tb_kelompok_kelas');
	}
}
?>