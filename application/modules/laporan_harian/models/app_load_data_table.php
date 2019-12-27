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
        // $get  = $this->db->query("Select * From mt_kandang 
        //     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
        //     inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
        //     where status_periode = 'AKTIF'");
        $get = $this->db->query("Select tr_produksi.tanggal_catat, AVG(tr_produksi.ayam_m) as ayam_m, AVG(tr_produksi.ayam_c) as ayam_c, AVG(tr_produksi.total_ayam) as total_ayam, AVG(tr_produksi.pakan_kg) as pakan_kg, AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, AVG(tr_produksi.butir_jumlah) as butir_jumlah, AVG(tr_produksi.butir_kg) as butir_kg, AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr, AVG(tr_produksi.hasil_hh) as hasil_hh , AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, AVG(tr_produksi.berat_badan) as berat_badan From mt_kandang 
        inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
        inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
        where status_periode = 'AKTIF' GROUP BY tr_produksi.tanggal_catat");
        return $get->result();
    }
    public function getAllDataLokasi()
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
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
}
