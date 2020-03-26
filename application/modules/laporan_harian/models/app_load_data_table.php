<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model
{

    public function getAllDataLokasi()
    {
        $get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }

    public function getAllDataLokasiByAnggota($id_anggota)
    {
        $get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF' and id_anggota = '".$id_anggota."'");
        return $get->result();
    }

    function dataKandangHarianSatu($id_lokasi)
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

    public function dataCetakHarianSatuKandang($id_lokasi, $kandang)
    {
        $output = '';

        //Data Kandang Satu
        if ($id_lokasi == '' || $id_lokasi == null) {
            $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
        } else {
            if ($kandang == '' || $kandang == null) {
                $output .= '<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
            } else {
                //Query HD
                $query_hd = $this->db->query("Select hd_periode from tr_periode WHERE status_periode = 'AKTIF' and id_kandang='".$kandang."' ");
                $hasil_query_hd = $query_hd->row();

                //Query Awal Ayam Masuk
                $query_awal_ayam_masuk = $this->db->query("Select awal_ayam_masuk from tr_periode WHERE status_periode = 'AKTIF' and id_kandang='".$kandang."' ");
                $hasil_query_awal_ayam_masuk = $query_awal_ayam_masuk->row();
                
                //Query Judul
                $getJudul = $this->db->query("Select * From mt_kandang 
                    inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
                    where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "'");

                //Query Transaksi
                $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                    tr_produksi.tanggal_catat as tanggal_catat,
                    tr_produksi.ayam_m as ayam_m, tr_produksi.ayam_c as ayam_c,
                    tr_produksi.total_ayam as total_ayam, tr_produksi.pakan_kg as pakan_kg, 
                    tr_produksi.hasil_pakan_gr as hasil_pakan_gr, 
                    tr_produksi.butir_jumlah as butir_jumlah, tr_produksi.butir_kg as butir_kg,
                    tr_produksi.hasil_butir_gr as hasil_butir_gr,
                    tr_produksi.hasil_hd_persen as hasil_hd_persen, tr_produksi.hasil_fcr as hasil_fcr, 
                    tr_produksi.hasil_rusak_persen as hasil_rusak_persen, tr_produksi.berat_badan as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                    where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "' order by tr_produksi.tanggal_catat asc");

                $output .= '
                    <div class="col-md-12">';
                        //Tampilan Judul
                        foreach ($getJudul->result() as $row) {
                            $output .= '
                            <table class="table table-borderless"  style="border-collapse: collapse; border: none;" id="sample_3">
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
                                        <th> Persen Rusak </th>
                                        <th> BB </th>
                                        <th> Keterangan </th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    //Tampilan Data Hasil
                                    $pakan = 0;
                                    $mati = 0;
                                    $afkir = 0;
                                    $pakan_gr = 0;
                                    $butir_jumlah = 0;
                                    $butir_kg = 0;
                                    $total_butir_jumlah = 0;
                                    $hasil_butir_gr = 0;
                                    $hasil_hh = 0;
                                    $hasil_hd_persen = 0;
                                    $hasil_fcr = 0;
                                    $hasil_rusak_persen = 0;
                                    $hasil_hd_master = $hasil_query_hd->hd_periode;
                                    $hasil_awal_ayam_masuk = $hasil_query_awal_ayam_masuk->awal_ayam_masuk;
                                    $keterangan='';
                                    $berat_badan = '';
                                    $total_data=0;
                                    foreach ($getTransaksi->result() as $rowTransaksi) {
                                        $bulan = array(1 => 'Januari',
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
                                        $days = $dateCatat->diff($data_mulai);
                                        $hasil_mod = $days->days % 7;
                                        $minggu_ke = $days->days / 7;
                                        $pakan = $pakan + $rowTransaksi->pakan_kg;
                                        $pakan_gr = $pakan_gr + $rowTransaksi->hasil_pakan_gr;
                                        $butir_jumlah = $butir_jumlah + $rowTransaksi->butir_jumlah;
                                        $total_butir_jumlah = $total_butir_jumlah + $rowTransaksi->butir_jumlah;
                                        $butir_kg = $butir_kg + $rowTransaksi->butir_kg;
                                        $hasil_butir_gr = $hasil_butir_gr + $rowTransaksi->hasil_butir_gr;
                                        $mati = $mati + $rowTransaksi->ayam_m;
                                        $afkir = $afkir + $rowTransaksi->ayam_c;
                                        // if($hasil_hd_master === 0 || $hasil_hd_master === '0')
                                        // {
                                        //     $hasil_hh = $hasil_hh + 0;
                                        // }
                                        // else
                                        // {
                                        //     $hasil_hh = $hasil_hh + (($rowTransaksi->butir_jumlah/$hasil_hd_master) * 100);
                                        // }

                                        $hasil_hh = $total_butir_jumlah/$hasil_awal_ayam_masuk;
                    
                                        $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
                                        $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
                                        $hasil_rusak_persen = $hasil_rusak_persen + $rowTransaksi->hasil_rusak_persen;
                                        if($rowTransaksi->keterangan != '')
                                        {
                                            $keterangan = $keterangan . " " . $rowTransaksi->keterangan . ",";
                                        }
                                        if($rowTransaksi->berat_badan != 0)
                                        {
                                            $berat_badan = $berat_badan . " " . $rowTransaksi->berat_badan . ",";
                                        }
                    
                $output .= '
                    <tr class="odd gradeX">
                        <td>' . $date. '</td>
                        <td>' . $rowTransaksi->ayam_m . '</td>
                        <td>' . $rowTransaksi->ayam_c . '</td>
                        <td>' . $rowTransaksi->total_ayam . '</td>
                        <td>' . round($rowTransaksi->pakan_kg, 2) . '</td>
                        <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
                        <td>' . $rowTransaksi->butir_jumlah . '</td>
                        <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
                        <td>' . round($rowTransaksi->hasil_butir_gr, 2) . '</td>
                        <td>' . round($hasil_hh, 2) . '</td>
                        <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                        <td>' . round($rowTransaksi->hasil_fcr, 2) . '</td>
                        <td>' . round($rowTransaksi->hasil_rusak_persen, 2) . '</td>
                        <td>' . $rowTransaksi->berat_badan . '</td>
                        <td>' . $rowTransaksi->keterangan . '</td>
                    </tr>';
                    
                    //Jumlah 7 hari
                    $total_data = $total_data + 1;
                    if ($hasil_mod === 0) {
                        $output .= '
                            <tr class="odd gradeX">
                                <td style="text-align:center" bgcolor="#808080">
                                    ' . $minggu_ke . '
                                </td>
                                <td colspan="2" style="text-align:center;" bgcolor="#808080">
                                    ' . $mati . '
                                </td>
                                <td bgcolor="#808080">
                                '.$rowTransaksi->total_ayam.'
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($pakan, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($pakan_gr/$total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . $butir_jumlah . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($butir_kg, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($hasil_butir_gr / $total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($hasil_hh/$total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($hasil_hd_persen / $total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($hasil_fcr / $total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    ' . round($hasil_rusak_persen / $total_data, 2) . '
                                </td>
                                <td bgcolor="#808080">
                                    '.$berat_badan.'
                                </td>
                                <td bgcolor="#808080">
                                    '.$keterangan.'
                                </td>
                            </tr>';
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
                        $hasil_rusak_persen = 0;
                        $keterangan='';
                        $berat_badan='';
                        $total_data = 0;
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

    function dataKandangHarianBanyak($id_lokasi)
    {
        $output = '';

        $query = $this->db->query("Select * From mt_kandang 
                    inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
                    inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                    where status_periode = 'AKTIF' and mt_lokasi.id_lokasi = '" . $id_lokasi . "'");

        foreach ($query->result() as $row) {
            $output .= '<label class="mt-checkbox">
                            <input type="checkbox" id="checkbox_harian_banyak_kandang" name="checkbox_harian_banyak_kandang[]" value="' . $row->id_kandang . '"> ' . $row->nama_kandang . '
                            <span></span>
                        </label>';
        }

        return $output;
    }

    public function dataCetakHarianBanyakKandang($id_lokasi, $kandang, $tanggal_mulai, $tanggal_selesai)
    {
        $output = '';

        if ($id_lokasi == '' || $id_lokasi == null) {
            $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
        } else {
            if ($kandang == '' || $kandang == null) {
                $output .= '<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
            } else {
                $output .= '
                    <div class="col-md-12">';
                        //judul
                        $kandang_kuy='';

                        for($i=0; $i<count($kandang); $i++)
                        {
                            $penghubung = 'OR';
                            if($i==0)
                            {
                                $penghubung='';
                            }
                            $kandang_kuy = "(".$kandang_kuy. ' ' .$penghubung.' '."mt_kandang.id_kandang= '".$kandang[$i]."'".")";
                        };

                        //Query Transaksi
                        $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
                            tr_produksi.tanggal_catat as tanggal_catat,
                            SUM(tr_produksi.ayam_m) as ayam_m, SUM(tr_produksi.ayam_c) as ayam_c,
                            SUM(tr_produksi.total_ayam) as total_ayam, SUM(tr_produksi.pakan_kg) as pakan_kg, 
                            AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, 
                            SUM(tr_produksi.butir_jumlah) as butir_jumlah, SUM(tr_produksi.butir_kg) as butir_kg,
                            AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr,
                            AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, AVG(tr_produksi.hasil_rusak_persen) as hasil_rusak_persen From mt_kandang 
                            inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                            inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                            where status_periode = 'AKTIF' AND " . $kandang_kuy . " GROUP BY tr_produksi.tanggal_catat");

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
                            
                        $output .= '
                            </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover order-column" id="tabel_laporan">
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
                                                <th> % HD </th>
                                                <th> FCR </th>
                                                <th> Rusak Persen </th>
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
                                            
                            if($rowTransaksi->butir_kg === 0 || $rowTransaksi->butir_kg === "0") {
                                $output .= '
                                    <tr class="odd gradeX">
                                        <td>' .$date. '</td>
                                        <td>' . intval($rowTransaksi->ayam_m) . '</td>
                                        <td>' . intval($rowTransaksi->ayam_c) . '</td>
                                        <td>' . intval($rowTransaksi->total_ayam) . '</td>
                                        <td>' . round($rowTransaksi->pakan_kg, 2) . '</td>
                                        <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
                                        <td>' . intval($rowTransaksi->butir_jumlah) . '</td>
                                        <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
                                        <td>0</td>
                                        <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                        <td>0</td>
                                        <td>' . round($rowTransaksi->hasil_rusak_persen, 2) . '</td>
                                    </tr>';
                            } else {
                                $output .= '
                                    <tr class="odd gradeX">
                                        <td>' .$date. '</td>
                                        <td>' . intval($rowTransaksi->ayam_m) . '</td>
                                        <td>' . intval($rowTransaksi->ayam_c) . '</td>
                                        <td>' . intval($rowTransaksi->total_ayam) . '</td>
                                        <td>' . round($rowTransaksi->pakan_kg, 2) . '</td>
                                        <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
                                        <td>' . intval($rowTransaksi->butir_jumlah) . '</td>
                                        <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
                                        <td>' . round(($rowTransaksi->butir_kg/$rowTransaksi->butir_jumlah)*1000, 2) . '</td>
                                        <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                        <td>' . round($rowTransaksi->pakan_kg/$rowTransaksi->butir_kg, 2) . '</td>
                                        <td>' . round($rowTransaksi->hasil_rusak_persen, 2) . '</td>
                                    </tr>';
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
}
