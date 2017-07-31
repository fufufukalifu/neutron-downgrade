<?php 
/**
 * 
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Admincabang_back_model extends CI_model 
{
 	public function in_pengguna($dataP)
 	{
 		 $this->db->insert('tb_pengguna', $dataP);
 	}

 	public function get_idPengguna($namaPengguna)
 	{
 		 $this->db->select("id");
 		 $this->db->from("tb_pengguna");
 		 $this->db->where("namaPengguna",$namaPengguna);
 		 $query=$this->db->get();
 		 return $query->result_array()[0]["id"];
 	}

 	public function in_pengguna_cabang($data)
 	{
 		$this->db->where("id",$data["id_cabang"]);
 		 		$this->db->set("idPengguna",$data["id_pengguna"]);
 		$this->db->update("tb_cabang");
 	}

 	public function get_admincabang($records_per_page,$pageSelek,$keySearch)
 	{
 		$this->db->select("p.id,p.namaPengguna,p.eMail,p.regTime as tgldaftar,c.namaCabang,c.id as idCabang");
 		// $this->db->from("tb_pengguna p");
 		$this->db->join("tb_cabang c","c.idPengguna=p.id");
 		$this->db->where("status",1);
 		$this->db->where("hakAkses","admin_cabang");
 		if ($keySearch!='' && $keySearch!=' ') {
 			$this->db->like("p.namaPengguna",$keySearch);
 			$this->db->or_like("c.namaCabang",$keySearch);
 		}
 		$this->db->order_by("p.regTime","desc");
 		$query=$this->db->get("tb_pengguna p",$records_per_page,$pageSelek);
 		return $query->result();
 	}

 	public function sum_admincabang($pageSelek,$keySearch)
 	{
 		$this->db->select("p.id");
 		$this->db->from("tb_pengguna p");
 		$this->db->join("tb_cabang c","c.idPengguna=p.id");
 		$this->db->where("status",1);
 		$this->db->where("hakAkses","admin_cabang");
 		if ($keySearch!='' && $keySearch!=' ') {
 			$this->db->like("p.namaPengguna",$keySearch);
 			$this->db->or_like("c.namaCabang",$keySearch);
 			$this->db->or_like("p.eMail",$keySearch);
 		}
 		$query=$this->db->get();
 		return $query->num_rows();
 	}

 	public function ch_status_admincabang($id_pengguna)
 	{
 		$this->db->where("id",$id_pengguna);
 		$this->db->set("status",0);
 		$this->db->update("tb_pengguna");
 	}

 	public function ch_status_idPengguna_cabang($idCabang='')
 	{
 		$this->db->where("id",$idCabang);
 		$this->db->set("idPengguna",null);
 		$this->db->update("tb_cabang");
 	}

 	public function get_cabang()
 	{
 		$this->db->select("id,namaCabang");
 		$this->db->from("tb_cabang");
 		$this->db->where("idPengguna",null);
 		$query=$this->db->get();
 		return $query->result();
 	}

 } ?>