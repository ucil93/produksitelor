<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {
    
    public function getAllDataLokasi()
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }
    
    public function getDataKandang($id)
    {
        $get  = $this->db->query("Select * From mt_kandang 
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
            inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
            where mt_kandang.id_lokasi = '".$id."' and status_periode = 'AKTIF'");
        return $get->result();
    }

    public function getNamaLokasi($id)
    {
        $this->db->select('nama_lokasi');
        $this->db->from('mt_lokasi');
        $this->db->where('id_lokasi', $id);
        $query = $this->db->get();
        $get = $query->row()->nama_lokasi;
		
        return $get;
    }

    public function getDataProduksi($id)
    {
        $get  = $this->db->query("Select * From tr_produksi 
            inner join tr_periode on tr_produksi.id_periode = tr_periode.id_periode
            where tr_periode.id_kandang = '".$id."' and tr_periode.status_periode = 'AKTIF' order by tr_produksi.tanggal_catat asc");
        return $get->result();
    }

    public function getNamaKandang($id)
    {
        $this->db->select('nama_kandang');
        $this->db->from('mt_kandang');
        $this->db->where('id_kandang', $id);
        $query = $this->db->get();
        $get = $query->row()->nama_kandang;
		
        return $get;
    }

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From tr_produksi where id_produksi = '".$id."'");
        return $get->result();
    }
}
