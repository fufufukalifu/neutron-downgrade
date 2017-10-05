<?php 

class Laporanortu_model extends CI_Model{

	//get report all
	function get_report_ortu($data,$records_per_page='',$page=''){
		$this->db->order_by('p.id','desc');
		$this->db->select('p.namaPengguna,
			o.siswaID,
			s.penggunaID,
			c.namaCabang,
			s.namaBelakang,
			s.namaDepan,
			o.namaOrangTua,
			s.tingkatID,
			t.aliasTingkat,
			o.id as id_ortu,
			');

		// $this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s' , 'o.siswaID=s.id');
		$this->db->join('tb_tingkat t' , 's.tingkatID=t.id');
		$this->db->join('tb_cabang c' , 's.cabangID = c.id');
		$this->db->join('tb_pengguna p' , 's.penggunaID = p.id');


		if ($data['cabang']!="all") {
			$this->db->where('c.id', $data['cabang']);
		}

		$tingkat = $data['tingkat'];
		if ($data['tingkat']!="all") {
			$this->db->where("t.aliasTingkat LIKE '%$tingkat%' ");
		}

		$kelas = $data['kelas'];
		if ($data['kelas']!="all") {
			// $this->db->where("t.aliasTingkat LIKE '%$kelas%' ");
			$this->db->where("t.id", $kelas);
		}

		$query = $this->db->get('tb_orang_tua o',$records_per_page,$page);
		return $query->result_array();
	}

	function cari_report_ortu($data,$records_per_page='',$page='',$keySearch=''){
		$this->db->order_by('p.id','desc');
		$this->db->like('o.namaOrangTua',$keySearch);
		$this->db->select('p.namaPengguna,
			o.siswaID,
			s.penggunaID,
			c.namaCabang,
			s.namaBelakang,
			s.namaDepan,
			o.namaOrangTua,
			s.tingkatID,
			t.aliasTingkat,
			o.id as id_ortu,
			');

		// $this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s' , 'o.siswaID=s.id');
		$this->db->join('tb_tingkat t' , 's.tingkatID=t.id');
		$this->db->join('tb_cabang c' , 's.cabangID = c.id');
		$this->db->join('tb_pengguna p' , 's.penggunaID = p.id');


		if ($data['cabang']!="all") {
			$this->db->where('c.id', $data['cabang']);
		}

		$tingkat = $data['tingkat'];
		if ($data['tingkat']!="all") {
			$this->db->where("t.aliasTingkat LIKE '%$tingkat%' ");
		}

		$kelas = $data['kelas'];
		if ($data['kelas']!="all") {
			// $this->db->where("t.aliasTingkat LIKE '%$kelas%' ");
			$this->db->where("t.id", $kelas);
		}

		$query = $this->db->get('tb_orang_tua o',$records_per_page,$page);
		return $query->result_array();
	}

	/*Mengambil semua tingkat*/
	function get_all_tingkat(){
		$this->db->select('*');
		$this->db->from('tb_tingkat');
		$this->db->where('status', 0);

		$query = $this->db->get();
		return $query->result();
	}	

	/*Mengambil semua kelas*/
	function get_kelas($tingkat){
		$this->db->select('id,aliasTingkat,namaTingkat');
		$this->db->from('tb_tingkat');
		// $this->db->where('status', 0);
		$this->db->where("aliasTingkat LIKE '%$tingkat%' ");

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*insert DATA UNTUK LAPORAN*/
	function insert_laporan($data){
		$this->db->insert( 'tb_laporan_ortu', $data );
	}

	//get report all
	function get_report_ortu_all($data){
		$this->db->order_by('l.id','desc');
		$this->db->select('p.namaPengguna,
			o.siswaID,
			s.penggunaID,
			c.namaCabang,
			s.namaBelakang,
			s.namaDepan,
			o.namaOrangTua,
			s.tingkatID,
			t.aliasTingkat,
			o.id as id_ortu,
			l.isi,
			l.jenis
			');

		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');

		$this->db->join('tb_siswa s' , 'o.siswaID=s.id');
		$this->db->join('tb_tingkat t' , 's.tingkatID=t.id');
		$this->db->join('tb_cabang c' , 's.cabangID = c.id');
		$this->db->join('tb_pengguna p' , 's.penggunaID = p.id');

		if ($data['cabang']!="all") {
			$this->db->where('c.id', $data['cabang']);
		}

		$tingkat = $data['tingkat'];
		if ($data['tingkat']!="all") {
			$this->db->where("t.aliasTingkat LIKE '%$tingkat%' ");
		}

		$kelas = $data['kelas'];
		if ($data['kelas']!="all") {
			$this->db->where("t.id", $kelas);
		}

		$jenis = $data['jenis'];
		if ($data['jenis']!="all") {
			$this->db->where('l.jenis', $data['jenis']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	/*Mengambil semua kelas*/
	function get_nc($id){
		$this->db->select('namaCabang');
		$this->db->from('tb_cabang');
		$this->db->where("id", $id);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_id($id)
	{
		$this->db->select( 'id');
		$this->db->from( 'tb_laporan_ortu');


		$this->db->where( 'id' );
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function get_laporan_by_id($id)
	{
		$this->db->select( '*, p.namaPengguna');
		$this->db->from( 'tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->join('tb_pengguna p', 'o.penggunaID=p.id');
		


		$this->db->where( 'UUID', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	// get untuk option cabang
	public function get_cabang()
	{
	    $this->db->select('id, namaCabang');
	    $this->db->from('tb_cabang');
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	function jumlah_report_ortu($data){
		$this->db->order_by('p.id','desc');
		$this->db->select('p.namaPengguna,
			o.siswaID,
			s.penggunaID,
			c.namaCabang,
			s.namaBelakang,
			s.namaDepan,
			o.namaOrangTua,
			s.tingkatID,
			t.aliasTingkat,
			o.id as id_ortu,
			');

		// $this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s' , 'o.siswaID=s.id');
		$this->db->join('tb_tingkat t' , 's.tingkatID=t.id');
		$this->db->join('tb_cabang c' , 's.cabangID = c.id');
		$this->db->join('tb_pengguna p' , 's.penggunaID = p.id');


		if ($data['cabang']!="all") {
			$this->db->where('c.id', $data['cabang']);
		}

		$tingkat = $data['tingkat'];
		if ($data['tingkat']!="all") {
			$this->db->where("t.aliasTingkat LIKE '%$tingkat%' ");
		}

		$kelas = $data['kelas'];
		if ($data['kelas']!="all") {
			// $this->db->where("t.aliasTingkat LIKE '%$kelas%' ");
			$this->db->where("t.id", $kelas);
		}

		$query = $this->db->get('tb_orang_tua o');
		return $query->num_rows();
	}


}
?>