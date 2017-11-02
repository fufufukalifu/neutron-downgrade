<?php 
/**
 * 
 */
 class Monitoring_to_model extends CI_model
 {
 	
 	public function get_siswa_to($post,$type_return)
 	{
 		$kurikulum_id=$post["kurikulum"];
 		$tingkat_id=$post["tingkat"];
 		$cabang_id=$post["cabang"];
 		$tryout_id=$post["tryout"];
 		$paket_id=$post["paket"];
 		$status_pengerjaan = $post["status_pengerjaan"];

 		$keysearch = $post["keysearch"]; 
 		# main query
 		$this->db->select(" s.`id`,p.`namaPengguna`, s.`namaDepan`,s.`namaBelakang`,tkt.`aliasTingkat`,kk.`nama_kurikulum`,c.`namaCabang`,tryo.`nm_tryout`,s.`noIndukNeutron`,paket.`nm_paket`");
 		// $this->db->from("tb_siswa s");
 		$this->db->join("`tb_cabang` c","s.`cabangID` = c.id");
 		$this->db->join("`tb_tingkat` tkt","s.`tingkatID`=tkt.`id`");
 		$this->db->join("`tb_kurikulum` kk","s.`kurikulum_id`=kk.`id`");
 		$this->db->join("`tb_pengguna` p","p.`id` = s.`penggunaID`");
 		$this->db->join("`tb_hakakses-to` hto","hto.`id_siswa` = s.`id`");
 		$this->db->join("`tb_tryout` tryo","hto.`id_tryout`=tryo.`id_tryout`");
 		$this->db->join("`tb_mm-tryoutpaket` mmto","tryo.`id_tryout` = mmto.`id_tryout`");
 		$this->db->join("`tb_paket` paket","paket.`id_paket` = mmto.`id_paket` ");
 		$this->db->order_by("p.`namaPengguna`","asc");
 		if ($keysearch != null) {
 			$this->db->like("s.`noIndukNeutron`",$keysearch);
 		}
 		if ($status_pengerjaan == 0) {
 			$this->db->where("s.`id` NOT IN (	SELECT rpaket.`siswaID` FROM `tb_report-paket` rpaket JOIN tb_siswa s ON s.`id` = rpaket.`siswaID`)", NULL, FALSE);
 		}

 		if ($kurikulum_id != "all") {
 			$this->db->where("kk.id",$kurikulum_id);
 		}
 		if ($tingkat_id != "all") {
 			$this->db->where("s.tingkatID",$tingkat_id);
 		}
 		if ($cabang_id != "all") {
 			$this->db->where("s.cabangID",$cabang_id);
 		}
 		if ($tryout_id != "all") {
 			 $this->db->where("tryo.`id_tryout`",$tryout_id);
 		}
 		if ($paket_id != "all") {
 			 $this->db->where("mmto.`id_paket`",$paket_id);
 		}
 		if ($type_return=="sum") {
 			return $query = $this->db->get('tb_siswa s')->num_rows();
 		}else{
 			$per_page = $post["per_page"];
 			$page = $post["page"];
		 return $query = $this->db->get('tb_siswa s',$per_page,$page)->result();    
 		}
 	}

 	//get data to
 	public function get_tryout_by_cabang($post){
 		$cabang_id=$post["cabang"];
 		$this->db->distinct("tryo.`id_tryout`");
		$this->db->select("tryo.`id_tryout`,tryo.`nm_tryout`");
		$this->db->from("`tb_tryout` tryo");
		$this->db->join("`tb_hakakses-to` hto","hto.`id_tryout`=tryo.`id_tryout`");
		$this->db->join("`tb_siswa` s","s.`id` = hto.`id_siswa`");
		$this->db->join("`tb_cabang` c","s.`cabangID` = c.id");
		$this->db->where("s.`noIndukNeutron` is NOT NULL", NULL, FALSE);
		$this->db->where("c.`id`",$cabang_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_pakekt_by_to($id_tryout){
		$this->db->select("paket.id_paket,paket.nm_paket");
		$this->db->from("tb_paket paket");
		$this->db->join("`tb_mm-tryoutpaket` mmto","paket.`id_paket` = mmto.`id_paket`");
 		$this->db->join("`tb_tryout` tryo","tryo.`id_tryout` = mmto.`id_tryout` ");
 		$this->db->where("tryo.`id_tryout`",$id_tryout);
		$query = $this->db->get();
		return $query->result();
	}

 	//get data to 
 	public function get_cabang_by_siswa_to(){
 		$this->db->distinct("c.`id`");
		$this->db->select("c.`namaCabang`,c.`id` as `id_cabang`");
		$this->db->from("`tb_tryout` tryo");
		$this->db->join("`tb_hakakses-to` hto","hto.`id_tryout`=tryo.`id_tryout`");
		$this->db->join("`tb_siswa` s","s.`id` = hto.`id_siswa`");
		$this->db->join("`tb_cabang` c","s.`cabangID` = c.id");
		$this->db->where("s.`noIndukNeutron` is NOT NULL", NULL, FALSE);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_paket_to($id_tryout)
	{
		$this->db->distinct("p.id_paket");
		$this->db->select("p.id_paket,p.nm_paket");
		$this->db->from("tb_paket p");
		$this->db->join("tb_mm-tryoutpaket mto","mto.id_paket = p.id_paket");
		$this->db->join("tb_tryout tryo","tryo.id_tryout = mto.id_tryout");
		$this->db->where("tryo.id_tryout",$id_tryout);
		$query = $this->db->get();
		return $query->result();
	}
 } 
 ?>