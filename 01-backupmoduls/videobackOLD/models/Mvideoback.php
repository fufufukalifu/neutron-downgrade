<?php 

/**
* 
*/
class Mvideoback extends CI_Model
{
	
	public function insertVideo($data_video)
	{		
		$this->db->insert('tb_video', $data_video);
		redirect(site_url('videoback/managervideo'));
	}

	// untuk mengambil get value tingkatan seperti sd, smo dll u/
	public function scTingkat()
	{
		$this->db->where('status','1');
		$this->db->select('id,aliasTingkat')->from('tb_tingkat');
		$query = $this->db->get();
		return $query->result_array();
	}

	//mengambil value pelajaran berdasarkan id tingkatan
	public function scPelajaran($tingkatID)
	{
		$this->db->where('tingkatID', $tingkatID);
		$this->db->where('status','1');
		$this->db->select('id, keterangan')->from('tb_tingkat-pelajaran');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get value bab pelajaran berdasarkan id tingkat pelajaran
	public function scBab($tpelajaranID)
	{
		$this->db->where('tingkatPelajaranID', $tpelajaranID);
		$this->db->where('status','1');
		$this->db->select('id, keterangan, judulBab')->from('tb_bab');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get value subbab berdasarkan bab
	public function scSubbab($babID)
	{
		$this->db->where('babID', $babID);
		$this->db->where('status','1');
		$this->db->select('id, judulSubBab')->from('tb_subbab');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get ID Guru
	public function getIDguru($penggunaID)
	{
		$this->db->where('penggunaID',$penggunaID);
		$this->db->select('id')->from('tb_guru');
		$query = $this->db->get();
		return $query->result_array();
	}

	//query haspus video
	public function del_video($videoID)
	{
		$this->db->where('id',$videoID);
		$this->db->delete('tb_video');
	}

	public function get_video_by_UUID($UUID)
	{	
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->where('UUID',$UUID);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function ch_video($data)
	{	
		$this->db->set($data['video']);
		$this->db->where('UUID',$data['UUID']);
		$this->db->update('tb_video');
		redirect(site_url('videoback/managervideo'));
	}

        public function scTingkatvideo()
	{
		$this->db->select('id,aliasTingkat');
                $this->db->from('tb_tingkat');
                // $this->db->where('status',1);
                $this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_video_by_sub()
	{
				$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->where('UUID',$UUID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_nama_sub($subbab)
	{
		$this->db->select('judulSubBab');
		$this->db->from('tb_subbab');
		$this->db->where('id',$subbab);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_bab($bab)
	{
		$this->db->select('judulBab');
		$this->db->from('tb_bab');
		$this->db->where('id',$bab);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_mapel($mapel)
	{
		$this->db->select('keterangan');
		$this->db->from('tb_tingkat-pelajaran');
		$this->db->where('id',$mapel);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_tingkat($tingkat)
	{
		$this->db->select('aliasTingkat');
		$this->db->from('tb_tingkat');
		$this->db->where('id',$tingkat);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_info_video($subBabID)
    {
        $this->db->select('tkt.id as id_tingkat ,aliasTingkat,tp.id as id_mp,tp.keterangan as mp,bab.id as id_bab, judulBab, subbab.id as id_subbab ,judulSubBab,');
         $this->db->from('tb_tingkat tkt' );
         $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->where('subbab.id',$subBabID);
        $query = $this->db->get();
        return $query->result_array()[0];
    }
}
?>