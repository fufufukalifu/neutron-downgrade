<?php 
/**
 * 
 */
 class Import_user_model extends CI_model
 {
 	
 // insert_batch siswa
 public function myinsert_batch($datArr,$my_table)
 {
 	  $this->db->insert_batch($my_table, $datArr);
 }

 public function myselect_batch($uuid)
 {
 	$this->db->select('id as penggunaID');
 	$this->db->from("tb_pengguna");
 	foreach ($uuid as $key) {
 		 	// $this->db->where();
 		$this->db->or_where("uuid_user",$key["uuid_user"]);
 	}

 	$query=$this->db->get();
 	return $query->result_array();
 }

 public function select_cabang()
 {
 	$this->db->select("id,namaCabang");
 	$this->db->from("tb_cabang");
 	$query=$this->db->get();
 	return $query->result();
 }

 public function in_file_excel($data)
 {
 	$this->db->insert("tb_bup_import_excel",$data);
 }

 public function del_one_record($config_del)
 {
 	$mytable=$config_del["mytable"];
 	$key_condition=$config_del['key_condition'];
 	$val_condition=$config_del['val_condition'];
	$this->db->where($key_condition, $val_condition);
	$this->db->delete($mytable); 
 }

 public function get_katasandi($penggunaID)
 {
 	$this->db->where("id",$penggunaID);
 	$this->db->select("kataSandi");
 	$this->db->from("tb_pengguna");
 	$query=$this->db->get();
 	return $query->result();
 }

 public function del_import($post)
 {
 	$this->db->where('regTime >=', $post["tanggal_mulai"]);
 	$this->db->where('regTime <=', $post["tanggal_akhir"]);

 	$this->db->where("hakAkses",$post["hakakses"]);

 	$this->db->delete("tb_pengguna");
 }

 public function count_row_pengguna($post)
 {
 	 	$this->db->where('regTime >=', $post["tanggal_mulai"]);
 	$this->db->where('regTime <=', $post["tanggal_akhir"]);
 	$this->db->where("hakAkses",$post["hakakses"]);
 	return $this->db->get("tb_pengguna")->num_rows();

 }

 } ?>