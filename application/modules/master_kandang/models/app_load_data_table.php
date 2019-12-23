<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllData()
    {
        $get  = $this->db->query("Select * from mt_kandang inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi");
        return $get->result();
    }

    public function getAllDataLokasi()
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
	}

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From mt_kandang where id_kandang = '".$id."'");
        return $get->result();
    }
}
