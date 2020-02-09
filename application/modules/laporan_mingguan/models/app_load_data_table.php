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
                $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                    tr_produksi.tanggal_catat as tanggal_catat,
                    tr_produksi.ayam_m as ayam_m, tr_produksi.ayam_c as ayam_c,
                    tr_produksi.total_ayam as total_ayam, tr_produksi.pakan_kg as pakan_kg, 
                    tr_produksi.hasil_pakan_gr as hasil_pakan_gr, 
                    tr_produksi.butir_jumlah as butir_jumlah, tr_produksi.butir_kg as butir_kg,
                    tr_produksi.hasil_butir_gr as hasil_butir_gr,
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
                                        <th> Berat Badan </th>
                                        <th> Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    //Tampilan Hasil
                                    $pakan = 0;
                                    $mati = 0;
                                    $afkir = 0;
                                    $pakan_gr = 0;
                                    $butir_jumlah = 0;
                                    $butir_kg = 0;
                                    $hasil_butir_gr = 0;
                                    $hasil_hd_persen = 0;
                                    $hasil_fcr = 0;
                                    $berat = 0;
                                    $keterangan = '';
                                    $berat_badan = '';
                                    $total_data = 0;
                                    $hasil_em = 0;
                                    $hasil_ew = 0;
                                    $jumlah_data = 0;
                                    $total_ayam_akhir = 0;
                                    $total_mati_afkir_akhir = 0;
                                    $butir_kg_akhir = 0;
                                    $butir_jumlah_akhir = 0;
                                    $pakan_kg_akhir = 0;
                                    $hd_akhir = 0;
                                    $fcr_akhir = 0;
                                    $ew_akhir = 0;
                                    $em_akhir = 0;
                                    foreach ($getTransaksi->result() as $rowTransaksi) {
                                        $bulan = array(
                                            1 =>   'Januari',
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
                                        $date = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

                                        $dateCatat = new DateTime($rowTransaksi->tanggal_catat);
                                        $data_mulai = new DateTime($rowTransaksi->tanggal_menetas);
                                        $days = $dateCatat->diff($data_mulai);
                                        $hasil_mod = $days->days % 7;
                                        $minggu_ke = $days->days / 7;
                                        $pakan = $pakan + $rowTransaksi->pakan_kg;
                                        $pakan_gr = $pakan_gr + $rowTransaksi->hasil_pakan_gr;
                                        $butir_jumlah = $butir_jumlah + $rowTransaksi->butir_jumlah;
                                        $butir_kg = $butir_kg + $rowTransaksi->butir_kg;
                                        $hasil_butir_gr = $hasil_butir_gr + $rowTransaksi->hasil_butir_gr;
                                        $mati = $mati + $rowTransaksi->ayam_m;
                                        $afkir = $afkir + $rowTransaksi->ayam_c;
                                        $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
                                        $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
                                        $total_mati_afkir = $mati + $afkir;
                                        $berat = $berat + $rowTransaksi->berat_badan;
                                        if ($rowTransaksi->keterangan != '') 
                                        {
                                            $keterangan = $keterangan . " " . $rowTransaksi->keterangan . ",";
                                        }
                                        if($rowTransaksi->berat_badan !=0 )
                                        {
                                            $berat_badan = $berat_badan . " " . $rowTransaksi->berat_badan . ",";
                                        }
                                        $total_data = $total_data + 1;
                                        if ($hasil_mod === 0) {
                                            $jumlah_data = $jumlah_data +1;
                                            $total_mati_afkir_akhir = $total_mati_afkir_akhir+$total_mati_afkir;
                                            $total_ayam_akhir = $rowTransaksi->total_ayam;
                                            $butir_kg_akhir = $butir_kg_akhir + $butir_kg;
                                            $butir_jumlah_akhir = $butir_jumlah_akhir + $butir_jumlah;
                                            $pakan_kg_akhir = $pakan_kg_akhir + $pakan;
                                            $hd_akhir = $hd_akhir + ($hasil_hd_persen/$total_data);
                                            $fcr_akhir = $fcr_akhir + ($hasil_fcr/$total_data);
                                            if($butir_jumlah===0) {
                                                if($butir_kg===0) {
                                                    $hasil_ew = 0;
                                                }
                                                else {
                                                    $hasil_ew = 0;
                                                }
                                            }
                                            else {
                                                if($butir_kg===0) {
                                                    $hasil_ew = 0;
                                                }
                                                else {
                                                    $hasil_ew = round((($butir_kg / $butir_jumlah) * 1000),2);
                                                }
                                            }
                                            $ew_akhir = $ew_akhir+$hasil_ew;
                                            if($butir_kg===0) {
                                                $hasil_em = 0;
                                            }
                                            else {
                                                $hasil_em = ((($butir_kg/7)/$rowTransaksi->total_ayam)*1000);
                                                $hasil_em = round($hasil_em,2);
                                            }
                                            $em_akhir = $em_akhir+$hasil_em;
                                            $output .= ' 
                                                <tr class="odd gradeX">
                                                    <td class="text-center"> ' . $minggu_ke . '</td>
                                                    <td class="text-center">' . $date . ' </td>
                                                    <td class="text-center" style="width:10px">' . $total_mati_afkir . '</td>
                                                    <td class="text-center" style="width:60px">' . $rowTransaksi->total_ayam . '</td>
                                                    <td class="text-center"> ' . $butir_jumlah . '</td>
                                                    <td class="text-center"> ' . round($butir_kg, 2) . '</td>
                                                    <td class="text-center"> ' . round($pakan, 2) . '</td>
                                                    <td class="text-center">' . round($hasil_hd_persen / $total_data, 2) . '</td>
                                                    <td class="text-center">' . round($hasil_fcr/$total_data, 2) . '</td>
                                                    <td class="text-center"> ' . $hasil_ew . ' </td>
                                                    <td class="text-center">' . $hasil_em . '</td>
                                                    <td class="text-center"> ' . $berat_badan . '</td>
                                                    <td>' . $keterangan . '</td>
                                                </tr>';
                                            $mati = 0;
                                            $afkir = 0;
                                            $pakan = 0;
                                            $pakan_gr = 0;
                                            $butir_jumlah = 0;
                                            $butir_kg = 0;
                                            $hasil_butir_gr = 0;
                                            $hasil_hd_persen = 0;
                                            $hasil_fcr = 0;
                                            $berat = 0;
                                            $keterangan = '';
                                            $berat_badan = '';
                                            $total_data = 0;
                                            $hasil_em=0;
                                        }
                                    }
                                    if($ew_akhir===0) {
                                        $ew_akhir = 0;
                                    }
                                    else {
                                        $ew_akhir = round($ew_akhir/$jumlah_data, 2) ;
                                    }
                                    if($em_akhir===0) {
                                        $em_akhir=0;
                                    }
                                    else {
                                        $em_akhir=round($em_akhir/$jumlah_data,2);
                                    }
                                    if($butir_jumlah_akhir===0) {
                                        $butir_jumlah_akhir = 0;
                                    }
                                    else {
                                        $butir_jumlah_akhir = round($butir_jumlah_akhir/$jumlah_data, 2) ;
                                    }
                                    if($butir_kg_akhir===0) {
                                        $butir_kg_akhir = 0;
                                    }
                                    else {
                                        $butir_kg_akhir = round($butir_kg_akhir/$jumlah_data,2);
                                    }

                $output .= '
                    <tr class="odd gradeX">
                        <td class="text-center" colspan="2" bgcolor="#808080"> Jumlah ' . $jumlah_data . ' Data </td>
                        <td class="text-center" style="width:10px" bgcolor="#808080">' . $total_mati_afkir_akhir . '</td>
                        <td class="text-center" style="width:60px" bgcolor="#808080">' . intval($total_ayam_akhir) . '</td>
                        <td class="text-center" bgcolor="#808080"> ' . $butir_jumlah_akhir. '</td>
                        <td class="text-center" bgcolor="#808080"> ' . $butir_kg_akhir . '</td>
                        <td class="text-center" bgcolor="#808080"> ' . round($pakan_kg_akhir/$jumlah_data, 2) . '</td>
                        <td class="text-center" bgcolor="#808080">' . round($hd_akhir / $jumlah_data, 2) . '</td>
                        <td class="text-center" bgcolor="#808080">' . round($fcr_akhir / $jumlah_data, 2) . '</td>
                        <td class="text-center" bgcolor="#808080"> ' . $ew_akhir. ' </td>
                        <td class="text-center" bgcolor="#808080">' . $em_akhir . '</td>
                        <td></td>
                        <td></td>
                    </tr>
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
                                $kandang_kuy = '';
                                for ($i = 0; $i < count($kandang); $i++)
                                {
                                    $penghubung = 'OR';
                                    if ($i == 0)
                                    {
                                        $penghubung = '';
                                    }
                                    $kandang_kuy = "(" . $kandang_kuy . ' ' . $penghubung . ' ' . "mt_kandang.id_kandang= '" . $kandang[$i] . "'" . ")";
                                    $query_tanggal = "(" . "tr_produksi.tanggal_catat BETWEEN '" . $tanggal_mulai . "'" . " AND '" . $tanggal_selesai . "'" . ")";
                                };

                                //Query Judul
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

                                //Query Transaksi
                                $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                                    tr_produksi.tanggal_catat as tanggal_catat,
                                    SUM(tr_produksi.ayam_m) as ayam_m, SUM(tr_produksi.ayam_c) as ayam_c,
                                    SUM(tr_produksi.total_ayam) as total_ayam, SUM(tr_produksi.pakan_kg) as pakan_kg, 
                                    AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, 
                                    SUM(tr_produksi.butir_jumlah) as butir_jumlah, SUM(tr_produksi.butir_kg) as butir_kg,
                                    AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr,
                                    AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, 
                                    AVG(tr_produksi.berat_badan) as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
                                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                                    inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                                    where status_periode = 'AKTIF' AND " . $kandang_kuy . " AND " . $query_tanggal . " GROUP BY tr_produksi.tanggal_catat");

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
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            // $total_data=0;
                                            //Tampilan Data Hasil
                                            foreach ($getTransaksi->result() as $rowTransaksi) {
                                                $bulan = array(
                                                    1 =>   'Januari',
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
                                                $date = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
                                                $dateCatat = date_create($rowTransaksi->tanggal_catat);
                                                $total_mati_afkir = $rowTransaksi->ayam_m + $rowTransaksi->ayam_c;
                                                $em=0;
                                                $ew = 0;
                                                if($rowTransaksi->butir_kg===0 || $rowTransaksi->butir_kg==='0') {
                                                    if($rowTransaksi->butir_jumlah===0 || $rowTransaksi->butir_jumlah==='0') {
                                                        $em = 0;
                                                    }
                                                    else {
                                                        $em = 0;
                                                    }
                                                }
                                                else {
                                                    if($rowTransaksi->butir_jumlah===0 || $rowTransaksi->butir_jumlah==='0') {
                                                        $em = 0;
                                                    }
                                                    else {
                                                        $em = round(($rowTransaksi->butir_kg / $rowTransaksi->butir_jumlah / $rowTransaksi->total_ayam) * 1000, 2);
                                                    }
                                                }
                                                if($rowTransaksi->butir_jumlah===0 || $rowTransaksi->butir_jumlah==='0') {
                                                    if($rowTransaksi->butir_kg===0 || $rowTransaksi->butir_kg==='0') {
                                                        $ew = 0;
                                                    }
                                                    else {
                                                        $ew = 0;
                                                    }
                                                }
                                                else {
                                                    if($rowTransaksi->butir_kg===0 || $rowTransaksi->butir_kg==='0') {
                                                        $ew = 0;
                                                    }
                                                    else {
                                                        $ew = round(($rowTransaksi->butir_kg / $rowTransaksi->butir_jumlah) * 1000, 2);
                                                    }
                                                }
                                                // $em = $rowTransaksi->butir_kg===0 ? 0 : round((($rowTransaksi->butir_kg / 7) / $rowTransaksi->total_ayam) * 1000, 2);
                                                // $total_data = $total_data + 1;
                                                $output .= '
                                                    <tr class="odd gradeX">
                                                        <td class="text-center">' . $date . '</td>
                                                        <td class="text-center">' . intval($total_mati_afkir) . '</td>
                                                        <td class="text-center">' . intval($rowTransaksi->total_ayam) . '</td>
                                                        <td class="text-center">' . intval($rowTransaksi->butir_jumlah) . '</td>
                                                        <td class="text-center">' . round($rowTransaksi->butir_kg, 2) . '</td>
                                                        <td class="text-center">' . round($rowTransaksi->pakan_kg, 2) . '</td>
                                                        <td class="text-center">' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                                        <td class="text-center">' . round($rowTransaksi->hasil_fcr, 2) . '</td>
                                                        <td class="text-center">' . $ew . ' </td>
                                                        <td class="text-center">' . $em . '</td>
                                                        
                                                    </tr>';
                                                    // $total_data = 0;
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