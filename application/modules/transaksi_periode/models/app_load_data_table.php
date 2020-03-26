<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllData()
    {
        $get  = $this->db->query("Select * from tr_periode 
            inner join mt_kandang on tr_periode.id_kandang = mt_kandang.id_kandang 
            inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain 
            inner join mt_anggota on tr_periode.id_anggota = mt_anggota.id_anggota
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi");
        return $get->result();
    }

    public function getAllDataLokasi()
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }
    
    public function getAllDataByAnggota($id_anggota)
    {
        $get  = $this->db->query("Select * from tr_periode 
            inner join mt_kandang on tr_periode.id_kandang = mt_kandang.id_kandang 
            inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain 
            inner join mt_anggota on tr_periode.id_anggota = mt_anggota.id_anggota
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi
            where tr_periode.id_anggota = '".$id_anggota."'");
        return $get->result();
    }

    public function getAllDataLokasiByAnggota($id_anggota)
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF' and id_anggota = '".$id_anggota."'");
        return $get->result();
	}

    function dataKandang($id_lokasi)
    {
        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->where('status_kandang', 'AKTIF');
        $this->db->order_by('id_kandang', 'ASC');
        $query = $this->db->get('mt_kandang');
        $output = '<option value="" disabled selected>--Pilih--</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id_kandang.'">'.$row->nama_kandang.'</option>';
        }
        return $output;
    }

    public function getAllDataStrain()
	{
		$get  = $this->db->query("Select * From mt_strain where status_strain='AKTIF'");
        return $get->result();
	}

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From tr_periode where id_periode = '".$id."'");
        return $get->result();
    }
}
