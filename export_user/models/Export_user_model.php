<?php 
/**
 * 
 */
 class Export_user_model extends CI_model
 {
 	
 // insert_batch siswa
 public function ib_siswa($datArr)
 {
  $this->db->insert_batch('tb_pengguna', $datArr);
 }
 public function ib_user($value='')
 {
 	# code...
 }
 } ?>