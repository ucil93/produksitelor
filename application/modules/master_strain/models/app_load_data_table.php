<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllData()
    {
        $get  = $this->db->query("Select * From mt_strain");
        return $get->result();
    }

    public function getDataById($id)
    {
        $get  = $this->db->query("Select * From mt_strain where id_strain = '".$id."'");
        return $get->result();
    }
}
