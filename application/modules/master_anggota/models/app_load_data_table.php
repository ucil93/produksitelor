<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllData()
    {
        $get  = $this->db->query("Select * From mt_anggota");
        return $get->result();
    }

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From mt_anggota where id_anggota = '".$id."'");
        return $get->result();
    }
}
