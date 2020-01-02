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
                    $getTransaksi= $this->db->query("Select * From mt_kandang 
                        inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                        inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                        where status_periode = 'AKTIF' and mt_kandang.id_kandang = '".$kandang."'");
    
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
                                                <th> Tanggal </th>
                                                <th> Mati </th>
                                                <th> Afkir </th>
                                                <th> Total </th>
                                                <th> Pakan (Kg) </th>
                                                <th> Pakan (Gr) </th>
                                                <th> Butir Telur (Jumlah) </th>
                                                <th> Butir Telur (Kg) </th>
                                                <th> Gr / Butir </th>
                                                <th> % HH </th>
                                                <th> % HD </th>
                                                <th> FCR </th>
                                                <th> BB </th>
                                                <th> Keterangan </th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            //Tampilan Data Hasil
                                            foreach($getTransaksi->result() as $rowTransaksi){
    
                                                $dateCatat = date_create($rowTransaksi->tanggal_catat);
    
                                                $output .='
                                                    <tr class="odd gradeX">
                                                        <td>'.date_format($dateCatat, "d F Y").'</td>
                                                        <td>'.$rowTransaksi->ayam_m.'</td>
                                                        <td>'.$rowTransaksi->ayam_c.'</td>
                                                        <td>'.$rowTransaksi->total_ayam.'</td>
                                                        <td>'.$rowTransaksi->pakan_kg.'</td>
                                                        <td>'.round($rowTransaksi->hasil_pakan_gr,2).'</td>
                                                        <td>'.$rowTransaksi->butir_jumlah.'</td>
                                                        <td>'.round($rowTransaksi->butir_kg,2).'</td>
                                                        <td>'.round($rowTransaksi->hasil_butir_gr,2).'</td>
                                                        <td>'.round($rowTransaksi->hasil_hh,2).'</td>
                                                        <td>'.round($rowTransaksi->hasil_hd_persen,2).'</td>
                                                        <td>'.round($rowTransaksi->hasil_fcr,2).'</td>
                                                        <td>'.$rowTransaksi->berat_badan.'</td>
                                                        <td>'.$rowTransaksi->keterangan.'</td>
                                                    </tr>';

                                                    //Jumlah 7 hari
                                            }
                                            $output .='
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
                                                <th> Tanggal </th>
                                                <th> Mati </th>
                                                <th> Afkir </th>
                                                <th> Total </th>
                                                <th> Pakan (Kg) </th>
                                                <th> Pakan (Gr) </th>
                                                <th> Butir Telur (Jumlah) </th>
                                                <th> Butir Telur (Kg) </th>
                                                <th> Gr / Butir </th>
                                                <th> % HH </th>
                                                <th> % HD </th>
                                                <th> FCR </th>
                                                <th> BB </th>
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
