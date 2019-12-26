<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getDataJudul()
    {
        $get  = $this->db->query("Select * From mt_kandang 
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
            inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
            inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
            where status_periode = 'AKTIF'");
        return $get->result();
    }

    public function getDataTransaksi()
    {
        $get  = $this->db->query("Select * From mt_kandang 
            inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
            inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
            where status_periode = 'AKTIF'");
        return $get->result();
    }
}
