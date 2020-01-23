<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model
{
    public function getAllDataLokasi()
    {
        $get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }

    function dataKandangMingguanSatu($id_lokasi)
    {
        $output = '';

        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->where('status_kandang', 'AKTIF');
        $this->db->order_by('id_kandang', 'ASC');
        $query = $this->db->get('mt_kandang');

        $output = '<option value="" disabled selected>--Pilih--</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id_kandang . '">' . $row->nama_kandang . '</option>';
        }

        return $output;
    }

    public function dataCetakMingguanSatuKandang($id_lokasi, $kandang)
    {
        $output = '';

        //Data Kandang Satu
        if ($id_lokasi == '' || $id_lokasi == null) {
            $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
        } else {
            if ($kandang == '' || $kandang == null) {
                $output .= '<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
            } else {
                //Query Judul
                $getJudul = $this->db->query("Select * From mt_kandang 
                    inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
                    where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "'");

                //Query Data Hasil
                // $getTransaksi= $this->db->query("Select * From mt_kandang 
                //     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                //     inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                //     where status_periode = 'AKTIF' and mt_kandang.id_kandang = '".$kandang."'");
                $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                    tr_produksi.tanggal_catat as tanggal_catat,
                    tr_produksi.ayam_m as ayam_m, tr_produksi.ayam_c as ayam_c,
                    tr_produksi.total_ayam as total_ayam, tr_produksi.pakan_kg as pakan_kg, 
                    tr_produksi.hasil_pakan_gr as hasil_pakan_gr, 
                    tr_produksi.butir_jumlah as butir_jumlah, tr_produksi.butir_kg as butir_kg,
                    tr_produksi.hasil_butir_gr as hasil_butir_gr, tr_produksi.hasil_hh as hasil_hh ,
                    tr_produksi.hasil_hd_persen as hasil_hd_persen, tr_produksi.hasil_fcr as hasil_fcr, 
                    tr_produksi.berat_badan as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                    where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "'");

                $output .= '
                    <div class="col-md-12">';
                    //Tampilan Judul
                    foreach ($getJudul->result() as $row) {
                        $output .= '
                        <table class="table table-borderless" id="sample_3">
                            <td class="block">Populasi : ' . $row->awal_ayam_masuk . '</td>
                            <td class="block">HD 2% : ' . $row->hd_periode . '</td>
                            <td class="block">Strain : ' . $row->nama_strain . '</td>
                            <td class="block">Kandang : ' . $row->nama_kandang . '</td>
                            <td class="block">Asal Pullet : ' . $row->asal_pullet . '</td>
                            </table>';
                    }
                $output .= '
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover order-column" id="tabel_laporan">
                                    <thead class="btn-success">
                                        <tr>
                                            <th>Umur (Minggu) </th>
                                            <th> Tanggal </th>
                                            <th style="width:10px"> Mati </th>
                                            <th style="width:60px"> Total </th>
                                            <th> Butir (Jumlah) </th>
                                            <th> Butir (Kg) </th>
                                            <th> Pakan (Kg) </th>
                                            <th> % HD </th>
                                            <th>FCR</th>
                                            <th> EW </th>
                                            <th> EM </th>
                                            <th> Average Berat Badan </th>
                                            <th> Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    $pakan = 0;
                                    $mati = 0;
                                    $afkir = 0;
                                    $pakan_gr = 0;
                                    $butir_jumlah = 0;
                                    $butir_kg = 0;
                                    $hasil_butir_gr = 0;
                                    $hasil_hh = 0;
                                    $hasil_hd_persen = 0;
                                    $hasil_fcr = 0;
                                    $berat = 0;
                                    $keterangan='';
                                    foreach ($getTransaksi->result() as $rowTransaksi) {
                                        $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
            );
            $tanggal = date('Y-m-d', strtotime($rowTransaksi->tanggal_catat));
    $split = explode('-', $tanggal);
    $date = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                
                                        $dateCatat = new DateTime($rowTransaksi->tanggal_catat);
                                        $data_mulai = new DateTime($rowTransaksi->tanggal_menetas);
                                        // $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
                                        $days = $dateCatat->diff($data_mulai);
                                        $hasil_mod = $days->days % 7;
                                        $minggu_ke = $days->days / 7;
                                        // echo $days;
                                        // echo $hasil_mod;
                                        // $date = date_create($rowTransaksi->tanggal_catat);
                                        $pakan = $pakan + $rowTransaksi->pakan_kg;
                                        $pakan_gr = $pakan_gr + $rowTransaksi->hasil_pakan_gr;
                                        $butir_jumlah = $butir_jumlah + $rowTransaksi->butir_jumlah;
                                        $butir_kg = $butir_kg + $rowTransaksi->butir_kg;
                                        $hasil_butir_gr = $hasil_butir_gr + $rowTransaksi->hasil_butir_gr;
                                        $mati = $mati + $rowTransaksi->ayam_m;
                                        $afkir = $afkir + $rowTransaksi->ayam_c;
                                        $hasil_hh = $hasil_hh + $rowTransaksi->hasil_hh;
                                        $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
                                        $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
                                        $total_mati_afkir = $mati + $afkir;
                                        $berat = $berat + $rowTransaksi->berat_badan;
                                        if($rowTransaksi->keterangan!='') {
                                            $keterangan = $keterangan." ".$rowTransaksi->keterangan.",";
                                        }
                                        if ($hasil_mod === 0) {
                                            $output .= ' <tr class="odd gradeX">
                                    <td class="text-center"> ' . $minggu_ke . '</td>
                                    <td class="text-center">' . $date . ' </td>
                                    <td class="text-center" style="width:10px">' . $total_mati_afkir . '</td>
                                    <td class="text-center" style="width:60px">' . round($rowTransaksi->total_ayam, 1) . '</td>
                                    <td class="text-center"> ' . $butir_jumlah . '</td>
                                    <td class="text-center"> ' . $butir_kg . '</td>
                                    <td class="text-center"> ' . $pakan . '</td>
                                    <td class="text-center">' . round($hasil_hd_persen / 7, 2) . '</td>
                                    <td class="text-center">'.round($hasil_fcr,2).'</td>
                                    <td class="text-center"> ' . round($hasil_hd_persen / $butir_jumlah * 1000, 2) . ' </td>
                                    <td class="text-center">' . round($butir_kg / 7 / $rowTransaksi->total_ayam * 1000, 2) . '</td>
                                    <td class="text-center"> ' . round($berat / 7, 2) . '</td>
                                    <td>'.$keterangan.'</td>
                                    </tr>
                                    ';
                                    $mati = 0;
                                            $afkir = 0;
                                            $pakan_gr = 0;
                                            $butir_jumlah = 0;
                                            $butir_kg = 0;
                                            $hasil_butir_gr = 0;
                                            $hasil_hh = 0;
                                            $hasil_hd_persen = 0;
                                            $hasil_fcr = 0;
                                            $berat = 0;
                                            $keterangan='';
                                            
                                        }
                                        
                                    }
                $output .= '
                                            </tbody>
                                        </table>
                                    </div>';
            }
        }

        return $output;
    }

    function dataKandangMingguanBanyak($id_lokasi)
    {
        $output = '';

        // $this->db->where('id_lokasi', $id_lokasi);
        // $this->db->where('status_kandang', 'AKTIF');
        // $this->db->order_by('id_kandang', 'ASC');
        // $query = $this->db->get('mt_kandang');

        $query = $this->db->query("Select * From mt_kandang 
                    inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    where status_periode = 'AKTIF' and mt_lokasi.id_lokasi = '" . $id_lokasi . "'");

        foreach ($query->result() as $row) {
            $output .= '<label class="mt-checkbox">
                            <input type="checkbox" id="checkbox_mingguan_banyak_kandang" name="checkbox_mingguan_banyak_kandang[]" value="' . $row->id_kandang . '"> ' . $row->nama_kandang . '
                            <span></span>
                        </label>';
        }

        return $output;
    }

    public function dataCetakMingguanBanyakKandang($id_lokasi, $kandang, $tanggal_mulai, $tanggal_selesai)
    {
        $output = '';

        if ($id_lokasi == '' || $id_lokasi == null) {
            $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
        } else {
            if ($kandang == '' || $kandang == null) {
                $output .= '<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
            } else {
                if ($tanggal_mulai == '' || $tanggal_mulai == null) {
                    $output .= '<div class="alert alert-danger text-center">Tanggal Mulai Harus Dipilih!</div>';
                } else {
                    if ($tanggal_selesai == '' || $tanggal_selesai == null) {
                        $output .= '<div class="alert alert-danger text-center">Tanggal Selesai Harus Dipilih!</div>';
                    } else {
                   
                        $output .= '
                            <div class="col-md-12">';
                            //judul
                            $kandang_kuy='';
                            for($i=0; $i<count($kandang); $i++)
                            {
                                //Query Judul
                                $getJudul = $this->db->query("Select * From mt_kandang 
                                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                                    where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang[$i] . "'");

                                foreach ($getJudul->result_array() as $row) {
                                    $namaKandangTampil = $row['nama_kandang'];
                                }
                                $penghubung = 'OR';
                                if($i==0)
                                {
                                    $penghubung='';
                                }
                                $kandang_kuy = "(".$kandang_kuy. ' ' .$penghubung.' '."mt_kandang.id_kandang= '".$kandang[$i]."'".")";
                                $query_tanggal = "("."tr_produksi.tanggal_catat BETWEEN '".$tanggal_mulai."'"." AND '".$tanggal_selesai."'".")" ;
                                //Tampilan Judul
                               };
                            $getJudul = $this->db->query("Select * From mt_kandang 
                    inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
                    where status_periode = 'AKTIF' AND " . $kandang_kuy . " GROUP BY mt_kandang.id_kandang");
                    
$output .= '
<div class="col-md-12">';
//Tampilan Judul
foreach ($getJudul->result() as $row) {
    $output .= '
    <table class="table table-borderless" id="sample_3">
        <td class="block">Populasi : ' . $row->awal_ayam_masuk . '</td>
        <td class="block">HD 2% : ' . $row->hd_periode . '</td>
        <td class="block">Strain : ' . $row->nama_strain . '</td>
        <td class="block">Kandang : ' . $row->nama_kandang . '</td>
        <td class="block">Asal Pullet : ' . $row->asal_pullet . '</td>
        </table>';
}
                            $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                    tr_produksi.tanggal_catat as tanggal_catat,
                    SUM(tr_produksi.ayam_m) as ayam_m, SUM(tr_produksi.ayam_c) as ayam_c,
                    SUM(tr_produksi.total_ayam) as total_ayam, SUM(tr_produksi.pakan_kg) as pakan_kg, 
                    AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, 
                    SUM(tr_produksi.butir_jumlah) as butir_jumlah, SUM(tr_produksi.butir_kg) as butir_kg,
                    AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr, AVG(tr_produksi.hasil_hh) as hasil_hh ,
                    AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, 
                    AVG(tr_produksi.berat_badan) as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                    where status_periode = 'AKTIF' AND " . $kandang_kuy . " AND " .$query_tanggal. " GROUP BY tr_produksi.tanggal_catat");
                            
                        $output .= '
                            </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover order-column" id="tabel_laporan">
                                        <thead class="btn-success">
                                            <tr>
                                                <th> Tanggal </th>
                                                <th> Mati/Afkir </th>
                                                <th> Total </th>
                                                <th> Butir (Jumlah) </th>
                                                <th> Butir (Kg) </th>
                                                <th> Pakan (Kg) </th>
                                                <th> % HD </th>
                                                <th>FCR</th>
                                                <th> EW </th>
                                                <th> EM </th>
                                                <th> Average Berat Badan </th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        //Tampilan Data Hasil
                                        foreach ($getTransaksi->result() as $rowTransaksi) {
                                            $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
            );
            $tanggal = date('Y-m-d', strtotime($rowTransaksi->tanggal_catat));
    $split = explode('-', $tanggal);
    $date = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                                            $dateCatat = date_create($rowTransaksi->tanggal_catat);
                                            $total_mati_afkir = $rowTransaksi->ayam_m + $rowTransaksi->ayam_c;
                                            $output .= '
                                                                        <tr class="odd gradeX">
                                                                            <td class="text-center">' . $date . '</td>
                                                                            <td class="text-center">' . intval($total_mati_afkir) . '</td>
                                                                            <td class="text-center">' . intval($rowTransaksi->total_ayam) . '</td>
                                                                            
                                                                            <td class="text-center">' . intval($rowTransaksi->butir_jumlah) . '</td>
                                                                            <td class="text-center">' . intval($rowTransaksi->butir_kg) . '</td>
                                                                            <td class="text-center">' . intval($rowTransaksi->pakan_kg) . '</td>
                                                                            <td class="text-center">' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                                                            <td class="text-center">'.round($rowTransaksi->hasil_fcr).'</td>
                                                                            <td class="text-center"> ' . round($rowTransaksi->hasil_hd_persen / $rowTransaksi->butir_jumlah * 1000, 2) . ' </td>
                                                                            <td class="text-center">' . round($rowTransaksi->butir_kg / 7 / $rowTransaksi->total_ayam * 1000, 2) . '</td>
                                                                            <td class="text-center">' . round($rowTransaksi->berat_badan,2). '</td>
                                                                        </tr>';
                                        }
                        $output .= '
                                        </tbody>
                                    </table>
                                </div>';
                    }
                }
            }
        }

        return $output;
    }
}
