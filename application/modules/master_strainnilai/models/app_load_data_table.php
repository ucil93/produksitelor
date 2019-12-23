<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllData()
    {
        $get  = $this->db->query("Select * from mt_strain_nilai inner join mt_strain on mt_strain_nilai.id_strain = mt_strain.id_strain");
        return $get->result();
    }

    public function getAllDataStrain()
	{
		$get  = $this->db->query("Select * From mt_strain where status_strain='AKTIF'");
        return $get->result();
	}

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From mt_strain_nilai where id_strain_nilai = '".$id."'");
        return $get->result();
    }
}
