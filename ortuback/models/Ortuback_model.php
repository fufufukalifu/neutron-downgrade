<?php 

class Ortuback_model extends CI_Model{

	/*Mengambil report berdasarkan nilai*/
	function get_report_nilai($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'nilai'");
		$this->db->order_by("l.id", 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan absen*/
	function get_report_absen($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'absen'");
		$this->db->order_by("l.id", 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan umum*/
	function get_report_umum($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'umum'");
		$this->db->order_by("l.id", 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil semua report*/
	function get_report_all($data,$id){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna",$id );
		$this->db->order_by("l.id", 'desc');

		if ($data['jenis']!="all") {
			$this->db->where('l.jenis', $data['jenis']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan nilai*/
	function get_nama($id_ortu){
		$this->db->select('s.id, s.namaDepan, s.namaBelakang, o.namaOrangTua');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s', 'o.siswaID=s.id');
		$this->db->where("o.penggunaID", $id_ortu);

		$query = $this->db->get();
		return $query->result_array();
	}	

	 public function namasiswa($id) {
        $query = "SELECT * FROM `tb_orang_tua` ortu 
				JOIN tb_siswa sis ON ortu.siswaID = sis.id 
				JOIN `tb_pengguna` peng ON peng.id = sis.penggunaID 
				WHERE `peng`.`namaPengguna`= '$id'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_Ortu($ortuID='')
	{
		$this->db->select('*');
		$this->db->from('tb_orang_tua');
		$this->db->where('penggunaID',$ortuID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_count($pengguna='')
	{
		$this->db->select('count(*) as numrows');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.read_status_ortu',0);
		$this->db->where('o.penggunaID',$pengguna);

		$query = $this->db->get();
		return $query->result_array()[0]['numrows'];
	}

	public function get_daftar_pesan($pengguna='')
	{
		$this->db->select('*');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.read_status_ortu',0);
		$this->db->where('o.penggunaID',$pengguna);
		$this->db->limit(3);
		$this->db->order_by('l.id', 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_pesan_by_id($id='')
	{
		$this->db->select('*');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.UUID',$id);

		$query = $this->db->get();
		return $query->result_array();
	}

	// update status read ortu jadi 1
	public function update_read($UUID)
	{
		$this->db->set('read_status_ortu',1);
		$this->db->where('UUID', $UUID);
		$this->db->update('tb_laporan_ortu');
	}

	public function get_siswa_not_ortu($records_per_page,$pageSelek,$keySearch)
	{
		$this->db->where("tua.id is null");
		$this->db->where("p.status",1);
		$this->db->select("s.id as idSiswa,s.namaDepan,s.namaBelakang,p.email,p.namaPengguna, c.namaCabang");
		$this->db->join("tb_pengguna p","p.id=s.penggunaID");
		$this->db->join("tb_cabang c","c.id=s.cabangID");
		$this->db->join("tb_orang_tua tua","tua.siswaID=s.id",'left outer');

		if ($keySearch!='' && $keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);
			// $this->db->where("tua.id is null");
		}

		$query=$this->db->get("tb_siswa s",$records_per_page,$pageSelek);
		return $query->result();

	}

	public function get_ortu_siswa($records_per_page,$pageSelek,$keySearch)
	{
		$this->db->select("s.id as idSiswa,s.namaDepan,s.namaBelakang,penggunaSiswa.email,penggunaSiswa.namaPengguna as np_siswa,penggunaOrtu.namaPengguna as np_ortu,penggunaOrtu.id as id_np_ortu, c.namaCabang,tua.namaOrangTua");
		$this->db->join("tb_pengguna penggunaSiswa","penggunaSiswa.id=s.penggunaID");
		$this->db->join("tb_orang_tua tua","tua.siswaID=s.id");
		$this->db->join("tb_pengguna penggunaOrtu","penggunaOrtu.id=tua.penggunaID");
		$this->db->join("tb_cabang c","c.id=s.cabangID");
		if ($keySearch!='' && $keySearch!=' ') {
			$this->db->like("penggunaOrtu.namaPengguna",$keySearch);
			$this->db->or_like("penggunaSiswa.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);

		} 
		
		$this->db->where("penggunaOrtu.status",1);
		$this->db->order_by("penggunaOrtu.regTime","desc");
		$query=$this->db->get("tb_siswa s",$records_per_page,$pageSelek);
		return $query->result();

	}

	public function jumlah_ortu_siswa($keySearch)
	{
		$this->db->join("tb_pengguna penggunaSiswa","penggunaSiswa.id=s.penggunaID");
		$this->db->join("tb_orang_tua tua","tua.siswaID=s.id");
		$this->db->join("tb_pengguna penggunaOrtu","penggunaOrtu.id=tua.penggunaID");
		$this->db->join("tb_cabang c","c.id=s.cabangID");
				if ($keySearch!='' && $keySearch!=' ') {
			$this->db->like("penggunaOrtu.namaPengguna",$keySearch);
			$this->db->or_like("penggunaSiswa.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);

		} 
		$this->db->where("penggunaOrtu.status",1);
		$query=$this->db->get("tb_siswa s");
		return $query->num_rows();
	}

	public function jumlah_siswa_not_ortu($keySearch='')
	{
		$this->db->join("tb_pengguna p","p.id=s.penggunaID");
		$this->db->join("tb_cabang c","c.id=s.cabangID");
		$this->db->join("tb_orang_tua tua","tua.siswaID=s.id",'left outer');
		if ($keySearch!='' && $keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);

		} 
		$query=$this->db->get("tb_siswa s");
		return $query->num_rows();
	}
	public function get_siswa_batch($id_siswa)
	{
		$this->db->select("s.id as siswaID,s.namaDepan, p.namaPengguna,p.kataSandi");
		$this->db->from("tb_siswa s");
		$this->db->join("tb_pengguna  p","p.id=s.penggunaID");
		$this->db->where("p.status",1);
		for ($i=0; $i <count($id_siswa) ; $i++) { 
			if ($i==0) {
				$this->db->where("s.id",$id_siswa[$i]);
			}else{
				// $this->db->where("s.id",$id_siswa[$i]);
				$this->db->or_where("s.id",$id_siswa[$i]);
			}
			
		}
		$query=$this->db->get();
		return $query->result();
	}

	public function in_pengguna_ortu($pengguna='')
	{
		$this->db->insert_batch('tb_pengguna', $pengguna);
	}

	public function get_penggunaOrtu($id_siswa='')
	{
		$this->db->select("p.id , keterangan as id_siswa,p.namaPengguna");
		$this->db->from("tb_pengguna p");
		$this->db->where("p.status",1);
		for ($i=0; $i <count($id_siswa) ; $i++) { 
			if ($i==0) {
				$this->db->where("p.keterangan",$id_siswa[$i]);
			}else{
				// $this->db->where("s.id",$id_siswa[$i]);
				$this->db->or_where("p.keterangan",$id_siswa[$i]);
			}
			
		}
		$query=$this->db->get();
		return $query->result();
	}

	public function in_data_ortu($ortu='')
	{
		$this->db->insert_batch('tb_orang_tua', $ortu);
	}
	// update katasandi pengguna ortu
	public function up_kataSandi_ortu($id_pengguna,$new_pswd)
	{	
		$this->db->where("id",$id_pengguna);
		$this->db->set("kataSandi",$new_pswd);
		$this->db->update("tb_pengguna");
	}

	public function up_status_ortu($id_pengguna){
		$this->db->where("id",$id_pengguna);
		$this->db->set("status",0);
		$this->db->update("tb_pengguna");
	}
}

?>