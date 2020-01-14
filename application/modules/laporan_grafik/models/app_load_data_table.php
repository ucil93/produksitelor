<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model {

    public function getAllDataLokasi()
    {
        $get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
        return $get->result();
    }

    function dataKandangGrafikSatu($id_lokasi)
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

    public function dataCetakGrafikSatuKandang($id_lokasi, $kandang)
    {
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
                    $data_em=array();
                    $data_ew=array();
                    foreach ($getTransaksi->result() as $rowTransaksi) {
                        $data_mulai = $rowTransaksi->tanggal_menetas;
                                        $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                        $hasil_mod = $days % 7;
                                        $minggu_ke = $days / 7;
                                        // echo $days;
                                        // echo $hasil_mod;
                                        $date = date_create($rowTransaksi->tanggal_catat);
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
                                        if ($hasil_mod === 0) {
                                            $ew = $hasil_hd_persen / $butir_jumlah * 1000;
                                            $em = $butir_kg / 7 / $rowTransaksi->total_ayam * 1000;
                                            array_push($data_em,$em);
                                            array_push($data_ew,$ew);
                                            array_push($data_em,$em);
                                            array_push($data_ew,$ew);
                                            array_push($data_em,$em);
                                            array_push($data_ew,$ew);
                                            array_push($data_em,$em);
                                            array_push($data_ew,$ew);
                                            array_push($data_em,$em);
                                            array_push($data_ew,$ew);
                                        }
                    }
        $result = array();

        //DATA HITUNGAN KANDANG
        $arr1 = array(
            'name' => "EW",
            'data' => $data_ew,
            'color' => "blue"
        );

        $arr2 = array(
            'name' => "EM",
            'data' => $data_em,
            'color' => "green"
        );

        $arr3 = array(
            'name' => "Berlin",
            'data' => [-.9, .6, 3.5, 8.4, 13.5, 17, 18.6, 17.9, 14.3, 9, 3.9, 1],
            'color' => "#FF0000"
        );

        $arr4 = array(
            'name' => "London",
            'data' => [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17, 16.6, 14.2, 10.3, 6.6, 4.8],
            'color' => "#FF0000"
        );

        array_push($result,$arr1);
        array_push($result,$arr2);
        array_push($result,$arr3);
        array_push($result,$arr4);

        //DATA MASTER
        $arr1 = array(
            'name' => "Tokyo1",
            'data' => [9, 8.9, 11.5, 16.5, 20.2, 23.5, 27.2, 28.5, 25.3, 20.3, 15.9, 11.6],
            'color' => "#000000"
        );

        $arr2 = array(
            'name' => "New York1",
            'data' => [2.2, 2.8, 7.7, 13.3, 19, 24, 26.8, 26.1, 22.1, 16.1, 10.6, 4.5],
            'color' => "#000000"
        );

        $arr3 = array(
            'name' => "Berlin1",
            'data' => [2.9, 2.6, 5.5, 10.4, 15.5, 19, 20.6, 19.9, 16.3, 11, 5.9, 3],
            'color' => "#000000"
        );

        $arr4 = array(
            'name' => "London1",
            'data' => [5.9, 6.2, 7.7, 10.5, 13.9, 17.2, 19, 18.6, 16.2, 12.3, 8.6, 6.8],
            'color' => "#000000"
        );

        array_push($result,$arr1);
        array_push($result,$arr2);
        array_push($result,$arr3);
        array_push($result,$arr4);

        return $result;
    }

    function dataKandangGrafikBanyak($id_lokasi)
    {
        $output = '';

        $query = $this->db->query("Select distinct tr_periode.tanggal_menetas From mt_kandang 
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
            inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
            where status_periode = 'AKTIF' and mt_kandang.id_lokasi = '" . $id_lokasi . "' order by mt_kandang.id_kandang ASC");

        $output = '<option value="" disabled selected>--Pilih--</option>';
        foreach ($query->result() as $row) {
            $date = date_create($row->tanggal_menetas);

            $output .= '<option value="' . $row->tanggal_menetas . '">' . date_format($date, "d F Y") . '</option>';
        }

        return $output;

        // $query = $this->db->query("Select * From mt_kandang 
        //             inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
        //             inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
        //             where status_periode = 'AKTIF' and mt_lokasi.id_lokasi = '" . $id_lokasi . "'");

        // foreach ($query->result() as $row) {
        //     $output .= '<label class="mt-checkbox">
        //                     <input type="checkbox" id="checkbox_harian_banyak_kandang" name="checkbox_harian_banyak_kandang[]" value="' . $row->id_kandang . '"> ' . $row->nama_kandang . '
        //                     <span></span>
        //                 </label>';
        // }

        // return $output;
    }

    function dataStrainGrafikBanyak($id_lokasi, $tgl_menetas)
    {
        $output = '';

        $query = $this->db->query("Select distinct mt_strain.id_strain, mt_strain.nama_strain From mt_strain 
            inner join tr_periode on mt_strain.id_strain = tr_periode.id_strain 
            inner join mt_kandang on tr_periode.id_kandang = mt_kandang.id_kandang
            inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi
            where status_periode = 'AKTIF' and mt_kandang.id_lokasi = '" . $id_lokasi . "' and tr_periode.tanggal_menetas = '" . $tgl_menetas . "' order by mt_kandang.id_kandang ASC");

        $output = '<option value="" disabled selected>--Pilih--</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id_strain . '">' . $row->nama_strain . '</option>';
        }

        return $output;
    }

    public function dataCetakGrafikBanyakKandang($id_lokasi, $tanggal_menetas, $id_strain)
    {
        $result = array();

        //DATA HITUNGAN KANDANG
        $arr1 = array(
            'name' => "Tokyo",
            'data' => [7, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
            'color' => "#FF0000"
        );

        $arr2 = array(
            'name' => "New York",
            'data' => [-.2, .8, 5.7, 11.3, 17, 22, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5],
            'color' => "#FF0000"
        );

        $arr3 = array(
            'name' => "Berlin",
            'data' => [-.9, .6, 3.5, 8.4, 13.5, 17, 18.6, 17.9, 14.3, 9, 3.9, 1],
            'color' => "#FF0000"
        );

        $arr4 = array(
            'name' => "London",
            'data' => [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17, 16.6, 14.2, 10.3, 6.6, 4.8],
            'color' => "#FF0000"
        );

        array_push($result,$arr1);
        array_push($result,$arr2);
        array_push($result,$arr3);
        array_push($result,$arr4);

        //DATA MASTER
        $arr1 = array(
            'name' => "Tokyo2",
            'data' => [9, 8.9, 11.5, 16.5, 20.2, 23.5, 27.2, 28.5, 25.3, 20.3, 15.9, 11.6],
            'color' => "#000000"
        );

        $arr2 = array(
            'name' => "New York2",
            'data' => [2.2, 2.8, 7.7, 13.3, 19, 24, 26.8, 26.1, 22.1, 16.1, 10.6, 4.5],
            'color' => "#000000"
        );

        $arr3 = array(
            'name' => "Berlin2",
            'data' => [2.9, 2.6, 5.5, 10.4, 15.5, 19, 20.6, 19.9, 16.3, 11, 5.9, 3],
            'color' => "#000000"
        );

        $arr4 = array(
            'name' => "London2",
            'data' => [5.9, 6.2, 7.7, 10.5, 13.9, 17.2, 19, 18.6, 16.2, 12.3, 8.6, 6.8],
            'color' => "#000000"
        );

        array_push($result,$arr1);
        array_push($result,$arr2);
        array_push($result,$arr3);
        array_push($result,$arr4);

        return $result;
    }
}
