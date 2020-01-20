<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model
{

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

        $nama_strain = '';
        $jenis_strain = '';
        // $get_straing = $this->db->query("SELECT mt_strain.id_strain,mt_strain.nama_strain as nama_strain FROM mt_strain,tr_periode WHERE tr_periode.id_kandang='" . $kandang . "' AND tr_periode.id_strain=mt_strain.id_strain");
        $get_straing = $this->db->query("Select mt_strain.id_strain as id_strain,mt_strain.nama_strain as nama_strain FROM mt_strain,tr_periode
             where tr_periode.id_strain=mt_strain.id_strain and tr_periode.id_kandang = '" . $kandang . "'");

        foreach ($get_straing->result() as $rowStrain) {
            $nama_strain = $rowStrain->nama_strain;
        }



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
        $keterangan = '';
        $data_em = array();
        $data_ew = array();
        $data_lay = array();
        $data_berat = array();
        $data_food = array();
        $data_egg_weight = array();
        $data_livability = array();
        $data_immortality = array();
        $livability_data = 0;
        $mortality = 0;
        foreach ($getTransaksi->result() as $rowTransaksi) {
            $dateCatat = new DateTime($rowTransaksi->tanggal_catat);
            $data_mulai = new DateTime($rowTransaksi->tanggal_menetas);
            // $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
            $days = $dateCatat->diff($data_mulai);
            $hasil_mod = $days->days % 7;
            $minggu_ke = $days->days / 7;
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
                if ($minggu_ke >= 18) {
                    $ew = $hasil_hd_persen / $butir_jumlah * 1000;
                    $em = $butir_kg / 7 / $rowTransaksi->total_ayam * 1000;
                    $lay = $hasil_hd_persen;
                    $egg_weight = $butir_jumlah;
                    if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
                        $livability_data = ($rowTransaksi->total_ayam / ($rowTransaksi->total_ayam + $total_mati_afkir)) * 100;
                    } else if ($nama_strain === "HY-LINE BROWN") {
                        if ($total_mati_afkir == 0) {
                            $mortality = 0;
                        } else {
                            $mortality = ($total_mati_afkir / ($rowTransaksi->total_ayam + $total_mati_afkir)) * 100;
                        }
                    }
                    // $livability_data = ;
                    // $mortality=;
                    $feed_intake = $pakan;
                    $body_weight = $berat;
                    array_push($data_em, $em);
                    array_push($data_ew, $ew);
                    array_push($data_berat, $body_weight);
                    array_push($data_food, $feed_intake);
                    array_push($data_lay, $lay);
                    array_push($data_egg_weight, $egg_weight);
                    if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
                        array_push($data_livability, $livability_data);
                    } else if ($nama_strain === "HY-LINE BROWN") {
                        array_push($data_immortality, $mortality);
                    }
                }
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
            }
        }
        $result = array();

        //DATA HITUNGAN KANDANG
        $arr1 = array(
            'name' => "% LAY",
            'data' => $data_lay,
            'color' => "blue"
        );
        $arr2 = array(
            'name' => "Egg Weight",
            'data' => $data_egg_weight,
            'color' => "#FF0000"
        );
        $arr3 = array(
            'name' => "Feed Intake",
            'data' => $data_food,
            'color' => "#FF0000"
        );
        $arr4 = array();
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
            $arr4 = array(
                'name' => "Livability",
                'data' => $data_livability,
                'color' => "#FF0000"
            );
        } else if ($nama_strain === "HY-LINE BROWN") {
            $arr4 = array(
                'name' => "Mortality",
                'data' => $data_immortality,
                'color' => "#FF0000"
            );
        }
        $arr5 = array(
            'name' => "Egg Mass",
            'data' => $data_em,
            'color' => "#FF0000"
        );

        $arr6 = array(
            'name' => "Body Weight",
            'data' => $data_berat,
            'color' => "#FF0000"
        );
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN" || $nama_strain === "HY-LINE BROWN") {
            array_push($result, $arr1);
            array_push($result, $arr2);
            array_push($result, $arr3);
            array_push($result, $arr4);
            array_push($result, $arr5);
            array_push($result, $arr6);
        } else {
            array_push($result, $arr1);
            array_push($result, $arr2);
        }
        $persen_lay = array();
        $egg_weight = array();
        $feed_intake = array();
        $livability = array();
        $egg_mass = array();
        $body_weight = array();
        $mortality = array();
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN" || $nama_strain === "HY-LINE BROWN") {
            //%LAY
            $get_persen_lay = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='% LAY' "
            );
            foreach ($get_persen_lay->result() as $persen_lay_v) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($persen_lay, intval($persen_lay_v->standar_strain_nilai));
            }
            //Egg Weight
            $get_egg_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='EGG WEIGHT' "
            );
            foreach ($get_egg_weight->result() as $egg_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_weight, intval($egg_weight_ok->standar_strain_nilai));
            }
            //Feed Intake

            $get_feed_intake = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='FEED INTAKE' "
            );
            foreach ($get_feed_intake->result() as $feed_intage_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($feed_intake, intval($feed_intage_ok->standar_strain_nilai));
            }
            //Livability or Mortality
            if ($nama_strain === "HY-LINE BROWN") {
                //Mortality
                $get_mortality = $this->db->query(
                    "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
               AND mt_strain_nilai.nama_strain_nilai='MORTALITY' "
                );
                foreach ($get_mortality->result() as $mortality_ok) {
                    // echo $persen_lay_v->standar_strain_nilai;
                    array_push($mortality, intval($mortality_ok->standar_strain_nilai));
                }
            } else {
                $get_livability = $this->db->query(
                    "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                   AND mt_strain_nilai.nama_strain_nilai='LIVABILITY' "
                );
                foreach ($get_livability->result() as $livability_ok) {
                    // echo $persen_lay_v->standar_strain_nilai;
                    array_push($livability, intval($livability_ok->standar_strain_nilai));
                }
            }
            //Egg Mass
            $get_egg_mass = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='EGG MASS' "
            );
            foreach ($get_egg_mass->result() as $egg_mass_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_mass, intval($egg_mass_ok->standar_strain_nilai));
            }
            //Body Weight
            $get_body_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='BODY WEIGHT' "
            );
            foreach ($get_body_weight->result() as $body_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($body_weight, intval($body_weight_ok->standar_strain_nilai));
            }
        } else {
            $get_persen_lay = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='% LAY' "
            );
            foreach ($get_persen_lay->result() as $persen_lay_v) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($persen_lay, intval($persen_lay_v->standar_strain_nilai));
            }
            //Egg Weight
            $get_egg_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,tr_periode WHERE tr_periode.id_strain = mt_strain_nilai.id_strain AND tr_periode.id_kandang= '" . $kandang . "'
                AND mt_strain_nilai.nama_strain_nilai='EGG WEIGHT' "
            );
            foreach ($get_egg_weight->result() as $egg_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_weight, intval($egg_weight_ok->standar_strain_nilai));
            }
        }

        //DATA MASTER
        $arr1 = array(
            'name' => "%Lay",
            'data' => $persen_lay,
            'color' => "#000000"
        );

        $arr2 = array(
            'name' => "Egg Weight",
            'data' => $egg_weight,
            'color' => "#000000"
        );
        if ($nama_strain != "LOHMANN BROWN") {
            $arr3 = array(
                'name' => "Feed Intake",
                'data' => $feed_intake,
                'color' => "#000000"
            );
        }
        if ($nama_strain != "LOHMANN BROWN") {
            if ($nama_strain === "HY-LINE BROWN") {
                $arr4 = array(
                    'name' => "Mortality",
                    'data' => $mortality,
                    'color' => "#000000"
                );
            } else {
                $arr4 = array(
                    'name' => "Livability",
                    'data' => $livability,
                    'color' => "#000000"
                );
            }
        }

        if ($nama_strain != "LOHMANN BROWN") {
            $arr5 = array(
                'name' => "Egg Mass",
                'data' => $egg_mass,
                'color' => "#000000"
            );
        }

        if ($nama_strain != "LOHMANN BROWN") {
            $arr6 = array(
                'name' => "Body Weight",
                'data' => $body_weight,
                'color' => "#000000"
            );
        }




        array_push($result, $arr1);
        array_push($result, $arr2);
        if ($nama_strain != "LOHMANN BROWN") {
            array_push($result, $arr3);
            array_push($result, $arr4);
            array_push($result, $arr5);
            array_push($result, $arr6);
        }


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
        $nama_strain = '';
        $jenis_strain = '';
        // $get_straing = $this->db->query("SELECT mt_strain.id_strain,mt_strain.nama_strain as nama_strain FROM mt_strain,tr_periode WHERE tr_periode.id_kandang='" . $kandang . "' AND tr_periode.id_strain=mt_strain.id_strain");
        $get_straing = $this->db->query("Select * FROM mt_strain
             where id_strain = '" . $id_strain . "'");

        foreach ($get_straing->result() as $rowStrain) {
            $nama_strain = $rowStrain->nama_strain;
        }
        $result = array();
        $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
        tr_produksi.tanggal_catat as tanggal_catat,
        AVG(tr_produksi.ayam_m) as ayam_m, AVG(tr_produksi.ayam_c) as ayam_c,
        AVG(tr_produksi.total_ayam) as total_ayam, AVG(tr_produksi.pakan_kg) as pakan_kg, 
        AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, 
        AVG(tr_produksi.butir_jumlah) as butir_jumlah, AVG(tr_produksi.butir_kg) as butir_kg,
        AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr, AVG(tr_produksi.hasil_hh) as hasil_hh ,
        AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, 
        AVG(tr_produksi.berat_badan) as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
        inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
        inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
        where status_periode = 'AKTIF' AND tr_periode.tanggal_menetas='" . $tanggal_menetas . "' AND tr_periode.id_strain='" . $id_strain . "' GROUP BY tr_produksi.tanggal_catat");
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
        $keterangan = '';
        $data_em = array();
        $data_ew = array();
        $data_lay = array();
        $data_berat = array();
        $data_food = array();
        $data_egg_weight = array();
        $data_livability = array();
        $data_immortality = array();
        $livability_data = 0;
        $mortality = 0;
        foreach ($getTransaksi->result() as $rowTransaksi) {
            $dateCatat = new DateTime($rowTransaksi->tanggal_catat);
            $data_mulai = new DateTime($rowTransaksi->tanggal_menetas);
            // $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
            $days = $dateCatat->diff($data_mulai);
            $hasil_mod = $days->days % 7;
            $minggu_ke = $days->days / 7;
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
                if ($minggu_ke >= 18) {
                    $ew = $hasil_hd_persen / $butir_jumlah * 1000;
                    $em = $butir_kg / 7 / $rowTransaksi->total_ayam * 1000;
                    $lay = $hasil_hd_persen;
                    $egg_weight = $butir_jumlah;
                    if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
                        $livability_data = ($rowTransaksi->total_ayam / ($rowTransaksi->total_ayam + $total_mati_afkir)) * 100;
                    } else if ($nama_strain === "HY-LINE BROWN") {
                        if ($total_mati_afkir == 0) {
                            $mortality = 0;
                        } else {
                            $mortality = ($total_mati_afkir / ($rowTransaksi->total_ayam + $total_mati_afkir)) * 100;
                        }
                    }
                    // $livability_data = ;
                    // $mortality=;
                    $feed_intake = $pakan;
                    $body_weight = $berat;
                    array_push($data_em, $em);
                    array_push($data_ew, $ew);
                    array_push($data_berat, $body_weight);
                    array_push($data_food, $feed_intake);
                    array_push($data_lay, $lay);
                    array_push($data_egg_weight, $egg_weight);
                    if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
                        array_push($data_livability, $livability_data);
                    } else if ($nama_strain === "HY-LINE BROWN") {
                        array_push($data_immortality, $mortality);
                    }
                }
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
            }
        }
        //DATA HITUNGAN KANDANG
        $arr1 = array(
            'name' => "% LAY",
            'data' => $data_lay,
            'color' => "#FF0000"
        );

        $arr2 = array(
            'name' => "Egg Weight",
            'data' => $data_egg_weight,
            'color' => "#FF0000"
        );
        $arr3 = array(
            'name' => "Feed Intake",
            'data' => $data_food,
            'color' => "#FF0000"
        );
        $arr4 = array();
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN") {
            $arr4 = array(
                'name' => "Livability",
                'data' => $data_livability,
                'color' => "#FF0000"
            );
        } else if ($nama_strain === "HY-LINE BROWN") {
            $arr4 = array(
                'name' => "Mortality",
                'data' => $data_immortality,
                'color' => "#FF0000"
            );
        }
        $arr5 = array(
            'name' => "Egg Mass",
            'data' => $data_em,
            'color' => "#FF0000"
        );

        $arr6 = array(
            'name' => "Body Weight",
            'data' => $data_berat,
            'color' => "#FF0000"
        );
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN" || $nama_strain === "HY-LINE BROWN") {
            array_push($result, $arr1);
            array_push($result, $arr2);
            array_push($result, $arr3);
            array_push($result, $arr4);
            array_push($result, $arr5);
            array_push($result, $arr6);
        } else {
            array_push($result, $arr1);
            array_push($result, $arr2);
        }
        //DATA MASTER

        //DATA MASTER
        $persen_lay = array();
        $egg_weight = array();
        $feed_intake = array();
        $livability = array();
        $egg_mass = array();
        $body_weight = array();
        $mortality = array();
        if ($nama_strain === "ISA BROWN" || $nama_strain === "HISEX BROWN" || $nama_strain === "HY-LINE BROWN") {
            $get_persen_lay = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                AND mt_strain_nilai.nama_strain_nilai='% LAY' "
            );
            foreach ($get_persen_lay->result() as $persen_lay_v) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($persen_lay, intval($persen_lay_v->standar_strain_nilai));
            }
            //Egg Weight
            $get_egg_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                            AND mt_strain_nilai.nama_strain_nilai='EGG WEIGHT' "
            );
            foreach ($get_egg_weight->result() as $egg_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_weight, intval($egg_weight_ok->standar_strain_nilai));
            }
            //Feed Intake

            $get_feed_intake = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                            AND mt_strain_nilai.nama_strain_nilai='FEED INTAKE' "
            );
            foreach ($get_feed_intake->result() as $feed_intage_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($feed_intake, intval($feed_intage_ok->standar_strain_nilai));
            }
            //Livability or Mortality
            if ($nama_strain === "HY-LINE BROWN") {
                //Mortality
                $get_mortality = $this->db->query(
                    "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
               AND mt_strain_nilai.nama_strain_nilai='MORTALITY' "
                );
                foreach ($get_mortality->result() as $mortality_ok) {
                    // echo $persen_lay_v->standar_strain_nilai;
                    array_push($mortality, intval($mortality_ok->standar_strain_nilai));
                }
            } else {
                $get_livability = $this->db->query(
                    "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                   AND mt_strain_nilai.nama_strain_nilai='LIVABILITY' "
                );
                foreach ($get_livability->result() as $livability_ok) {
                    // echo $persen_lay_v->standar_strain_nilai;
                    array_push($livability, intval($livability_ok->standar_strain_nilai));
                }
            }
            $get_egg_mass = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $id_strain . "'
                AND mt_strain_nilai.nama_strain_nilai='EGG MASS' "
            );
            foreach ($get_egg_mass->result() as $egg_mass_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_mass, intval($egg_mass_ok->standar_strain_nilai));
            }
            //Body Weight
            $get_body_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $id_strain . "'
                AND mt_strain_nilai.nama_strain_nilai='BODY WEIGHT' "
            );
            foreach ($get_body_weight->result() as $body_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($body_weight, intval($body_weight_ok->standar_strain_nilai));
            }
        } else {
            $get_persen_lay = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                AND mt_strain_nilai.nama_strain_nilai='% LAY' "
            );
            foreach ($get_persen_lay->result() as $persen_lay_v) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($persen_lay, intval($persen_lay_v->standar_strain_nilai));
            }
            //Egg Weight
            $get_egg_weight = $this->db->query(
                "Select mt_strain_nilai.nama_strain_nilai,mt_strain_nilai.minggu_strain_nilai,mt_strain_nilai.standar_strain_nilai as standar_strain_nilai FROM mt_strain_nilai,mt_strain WHERE mt_strain.id_strain = mt_strain_nilai.id_strain AND mt_strain.nama_strain= '" . $nama_strain . "'
                AND mt_strain_nilai.nama_strain_nilai='EGG WEIGHT' "
            );
            foreach ($get_egg_weight->result() as $egg_weight_ok) {
                // echo $persen_lay_v->standar_strain_nilai;
                array_push($egg_weight, intval($egg_weight_ok->standar_strain_nilai));
            }
        }
        $arr1 = array(
            'name' => "% Lay(Standard Strain)",
            'data' => $persen_lay,
            'color' => "#000000"
        );
        $arr2 = array(
            'name' => "Egg Weight(Standard Strain)",
            'data' => $egg_weight,
            'color' => "#000000"
        );
        if ($nama_strain != "LOHMANN BROWN") {
            $arr3 = array(
                'name' => "Feed Intake(Standard Strain)",
                'data' => $feed_intake,
                'color' => "#000000"
            );
        }
        if ($nama_strain != "LOHMANN BROWN") {
            if ($nama_strain === "HY-LINE BROWN") {
                $arr4 = array(
                    'name' => "Mortality(Standard Strain)",
                    'data' => $mortality,
                    'color' => "#000000"
                );
            } else {
                $arr4 = array(
                    'name' => "Livability(Standart Strain)",
                    'data' => $livability,
                    'color' => "#000000"
                );
            }
        }
        if ($nama_strain != "LOHMANN BROWN") {
            $arr5 = array(
                'name' => "Egg Mass(Standard Strain)",
                'data' => $egg_mass,
                'color' => "#000000"
            );
        }

        if ($nama_strain != "LOHMANN BROWN") {
            $arr6 = array(
                'name' => "Body Weight(Standard Strain)",
                'data' => $body_weight,
                'color' => "#000000"
            );
        }
        array_push($result, $arr1);
        array_push($result, $arr2);
        // array_push($result,$arr3);
        // array_push($result,$arr4);
        if ($nama_strain != "LOHMANN BROWN") {
            array_push($result, $arr3);
            array_push($result, $arr4);
            array_push($result, $arr5);
            array_push($result, $arr6);
        }
        return $result;
    }
}
