<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {
    public function getAllDataLokasi()
	{
		$get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }

    function dataKandang($id_lokasi, $jumlah_kandang)
    {
        $output = '';

        if($jumlah_kandang == '0' || $jumlah_kandang == 0) {
            $this->db->where('id_lokasi', $id_lokasi);
            $this->db->where('status_kandang', 'AKTIF');
            $this->db->order_by('id_kandang', 'ASC');
            $query = $this->db->get('mt_kandang');

            $output = '<option value="" disabled selected>--Pilih--</option>';
            foreach($query->result() as $row)
            {
                $output .= '<option value="'.$row->id_kandang.'">'.$row->nama_kandang.'</option>';
            }
        } else {
            $query = $this->db->query("Select distinct tr_periode.tanggal_menetas From mt_kandang 
                inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                where status_periode = 'AKTIF' and mt_kandang.id_lokasi = '".$id_lokasi."' order by mt_kandang.id_kandang ASC");

            $output = '<option value="" disabled selected>--Pilih--</option>';
            foreach($query->result() as $row)
            {
                $date = date_create($row->tanggal_menetas);

                $output .= '<option value="'.$row->tanggal_menetas.'">'.date_format($date, "d F Y").'</option>';
            }
        }

        return $output;
    }

    public function dataCetak($id_lokasi, $jumlah_kandang, $kandang)
    {
        $output = '';

        if($jumlah_kandang == '0' || $jumlah_kandang == 0) {
            //Data Kandang Satu
            if($id_lokasi == '' || $id_lokasi == null) {
                $output.='<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
            } else {
                if($kandang == '' || $kandang == null) {
                    $output.='<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
                } else {
                    //Query Judul
                    $getJudul= $this->db->query("Select * From mt_kandang 
                        inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                        inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                        inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
                        where status_periode = 'AKTIF' and mt_kandang.id_kandang = '".$kandang."'");

                    //Query Data Hasil
                    
    
                    $output.='
                        <div class="col-md-12">';
                            //Tampilan Judul
                            foreach($getJudul->result() as $row){
                                $output .='
                                    <h4 class="block">Populasi : '.$row->awal_ayam_masuk.'</h4>
                                    <h4 class="block">HD 2% : '.$row->hd_periode.'</h4>
                                    <h4 class="block">Strain : '.$row->nama_strain.'</h4>
                                    <h4 class="block">Kandang : '.$row->nama_kandang.'</h4>
                                    <h4 class="block">Asal Pullet : '.$row->asal_pullet.'</h4>';
                            }
                            $output .='
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                        <thead class="btn-success">
                                            <tr>
                                                <th> Umur (Minggu) </th>
                                                <th> Tanggal </th>
                                                <th> Mati/Afkir </th>
                                                <th> Total </th>
                                                <th> Butir (Jumlah) </th>
                                                <th> Butir (Kg) </th>
                                                <th> Pakan (Kg) </th>
                                                <th> % HD </th>
                                                <th> EW </th>
                                                <th> EM </th>
                                                <th> Average Berat Badan </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            //Tampilan Data Hasil
                                            <tr>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
                }
            }
        } else {
            //Data Kandang Banyak
            if($id_lokasi == '' || $id_lokasi == null) {
                $output.='<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
            } else {
                if($kandang == '' || $kandang == null) {
                    $output.='<div class="alert alert-danger text-center">Tanggal Menetas Harus Dipilih!</div>';
                } else {
                    //Query Judul
                    $getJudul= $this->db->query("Select * From mt_kandang 
                        inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                        where status_periode = 'AKTIF' and tr_periode.tanggal_menetas = '".$kandang."'");
                    
                    //Query Data Hasil

                    $output.='
                        <div class="col-md-12">';
                            //Tampilan Judul
                            foreach($getJudul->result() as $row){
                                $output .='
                                    <h4 class="block">Kandang : '.$row->nama_kandang.'</h4>';
                            }
                            $output .='
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                        <thead class="btn-success">
                                            <tr>
                                                <th> Umur (Minggu) </th>
                                                <th> Tanggal </th>
                                                <th> Mati/Afkir </th>
                                                <th> Total </th>
                                                <th> Butir (Jumlah) </th>
                                                <th> Butir (Kg) </th>
                                                <th> Pakan (Kg) </th>
                                                <th> % HD </th>
                                                <th> EW </th>
                                                <th> EM </th>
                                                <th> Average Berat Badan </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            //Tampilan Data Hasil
                                            <tr>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
                }
            }
        }

        return $output;
    }
}
