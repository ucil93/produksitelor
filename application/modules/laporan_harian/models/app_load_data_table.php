<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class app_load_data_table extends CI_Model
{

    public function getAllDataLokasi()
    {
        $get  = $this->db->query("Select * From mt_lokasi where status_lokasi='AKTIF'");
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

        // if ($jumlah_kandang == '0' || $jumlah_kandang == 0) {
        //     $this->db->where('id_lokasi', $id_lokasi);
        //     $this->db->where('status_kandang', 'AKTIF');
        //     $this->db->order_by('id_kandang', 'ASC');
        //     $query = $this->db->get('mt_kandang');

        //     $output = '<option value="" disabled selected>--Pilih--</option>';
        //     foreach ($query->result() as $row) {
        //         $output .= '<option value="' . $row->id_kandang . '">' . $row->nama_kandang . '</option>';
        //     }
        // } else {
        //     $query = $this->db->query("Select distinct tr_periode.tanggal_menetas From mt_kandang 
        //         inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
        //         inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
        //         where status_periode = 'AKTIF' and mt_kandang.id_lokasi = '" . $id_lokasi . "' order by mt_kandang.id_kandang ASC");

        //     $output = '<option value="" disabled selected>--Pilih--</option>';
        //     foreach ($query->result() as $row) {
        //         $date = date_create($row->tanggal_menetas);

        //         $output .= '<option value="' . $row->tanggal_menetas . '">' . date_format($date, "d F Y") . '</option>';
        //     }
        // }

        return $output;
    }

    // public function dataCetak($id_lokasi, $jumlah_kandang, $kandang)
    // {
    //     $output = '';

    //     if ($jumlah_kandang == '0' || $jumlah_kandang == 0) {
    //         //Data Kandang Satu
    //         if ($id_lokasi == '' || $id_lokasi == null) {
    //             $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
    //         } else {
    //             if ($kandang == '' || $kandang == null) {
    //                 $output .= '<div class="alert alert-danger text-center">Data Kandang Harus Dipilih!</div>';
    //             } else {
    //                 //Query Judul
    //                 $getJudul = $this->db->query("Select * From mt_kandang 
    //                     inner join mt_lokasi on mt_kandang.id_lokasi = mt_lokasi.id_lokasi 
    //                     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
    //                     inner join mt_strain on tr_periode.id_strain = mt_strain.id_strain
    //                     where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "'");

    //                 //Query Data Hasil
    //                 // $getTransaksi= $this->db->query("Select * From mt_kandang 
    //                 //     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
    //                 //     inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
    //                 //     where status_periode = 'AKTIF' and mt_kandang.id_kandang = '".$kandang."'");
    //                 $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
    //                     tr_produksi.tanggal_catat as tanggal_catat,
    //                     tr_produksi.ayam_m as ayam_m, tr_produksi.ayam_c as ayam_c,
    //                     tr_produksi.total_ayam as total_ayam, tr_produksi.pakan_kg as pakan_kg, 
    //                     tr_produksi.hasil_pakan_gr as hasil_pakan_gr, 
    //                     tr_produksi.butir_jumlah as butir_jumlah, tr_produksi.butir_kg as butir_kg,
    //                     tr_produksi.hasil_butir_gr as hasil_butir_gr, tr_produksi.hasil_hh as hasil_hh ,
    //                     tr_produksi.hasil_hd_persen as hasil_hd_persen, tr_produksi.hasil_fcr as hasil_fcr, 
    //                     tr_produksi.berat_badan as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
    //                     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
    //                     inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
    //                     where status_periode = 'AKTIF' and mt_kandang.id_kandang = '" . $kandang . "'");
    //                 $output .= '
    //                     <div class="col-md-12">';
    //                 //Tampilan Judul
    //                 foreach ($getJudul->result() as $row) {
    //                     $output .= '
    //                                 <h4 class="block">Populasi : ' . $row->awal_ayam_masuk . '</h4>
    //                                 <h4 class="block">HD 2% : ' . $row->hd_periode . '</h4>
    //                                 <h4 class="block">Strain : ' . $row->nama_strain . '</h4>
    //                                 <h4 class="block">Kandang : ' . $row->nama_kandang . '</h4>
    //                                 <h4 class="block">Asal Pullet : ' . $row->asal_pullet . '</h4>';
    //                 }
    //                 $output .= '
    //                             </div>
    //                             <div class="col-md-12">
    //                                 <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
    //                                     <thead class="btn-success">
    //                                         <tr>
    //                                             <th> Tanggal </th>
    //                                             <th> Mati </th>
    //                                             <th> Afkir </th>
    //                                             <th> Total </th>
    //                                             <th> Pakan (Kg) </th>
    //                                             <th> Pakan (Gr) </th>
    //                                             <th> Butir Telur (Jumlah) </th>
    //                                             <th> Butir Telur (Kg) </th>
    //                                             <th> Gr / Butir </th>
    //                                             <th> % HH </th>
    //                                             <th> % HD </th>
    //                                             <th> FCR </th>
    //                                             <th> BB </th>
    //                                             <th> Keterangan </th>
    //                                         </tr>
    //                                     </thead>
    //                                     <tbody>';
    //                 //Tampilan Data Hasil
    //                 $pakan = 0;
    //                 $mati = 0;
    //                 $afkir = 0;
    //                 $pakan_gr = 0;
    //                 $butir_jumlah = 0;
    //                 $butir_kg = 0;
    //                 $hasil_butir_gr = 0;
    //                 $hasil_hh = 0;
    //                 $hasil_hd_persen = 0;
    //                 $hasil_fcr = 0;
    //                 foreach ($getTransaksi->result() as $rowTransaksi) {

    //                     $dateCatat = date_create($rowTransaksi->tanggal_catat);
    //                     $data_mulai = $rowTransaksi->tanggal_menetas;
    //                     $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
    //                     $years = floor($diff / (365 * 60 * 60 * 24));
    //                     $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    //                     $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    //                     $hasil_mod = $days % 7;
    //                     $minggu_ke = $days / 7;
    //                     $pakan = $pakan + $rowTransaksi->pakan_kg;
    //                     $pakan_gr = $pakan_gr + $rowTransaksi->hasil_pakan_gr;
    //                     $butir_jumlah = $butir_jumlah + $rowTransaksi->butir_jumlah;
    //                     $butir_kg = $butir_kg + $rowTransaksi->butir_kg;
    //                     $hasil_butir_gr = $hasil_butir_gr + $rowTransaksi->hasil_butir_gr;
    //                     $mati = $mati + $rowTransaksi->ayam_m;
    //                     $afkir = $afkir + $rowTransaksi->ayam_c;
    //                     $hasil_hh = $hasil_hh + $rowTransaksi->hasil_hh;
    //                     $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
    //                     $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
    //                     $output .= '
    //                                                 <tr class="odd gradeX">
    //                                                     <td>' . date_format($dateCatat, "d F Y") . '</td>
    //                                                     <td>' . $rowTransaksi->ayam_m . '</td>
    //                                                     <td>' . $rowTransaksi->ayam_c . '</td>
    //                                                     <td>' . $rowTransaksi->total_ayam . '</td>
    //                                                     <td>' . $rowTransaksi->pakan_kg . '</td>
    //                                                     <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
    //                                                     <td>' . $rowTransaksi->butir_jumlah . '</td>
    //                                                     <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
    //                                                     <td>' . round($rowTransaksi->hasil_butir_gr, 2) . '</td>
    //                                                     <td>' . round($rowTransaksi->hasil_hh, 2) . '</td>
    //                                                     <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
    //                                                     <td>' . round($rowTransaksi->hasil_fcr, 2) . '</td>
    //                                                     <td>' . $rowTransaksi->berat_badan . '</td>
    //                                                     <td>' . $rowTransaksi->keterangan . '</td>
    //                                                 </tr>';
    //                     if ($hasil_mod === 0) {
    //                         $output .= '
    //                                                 <tr class="odd gradeX">
    //                                                                   <td style="text-align:center" bgcolor="#808080">
    //                                                                       ' . $minggu_ke . '
    //                                                                   </td>
    //                                                                   <td colspan="2" style="text-align:center;" bgcolor="#808080">
    //                                                                     ' . $mati . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . $pakan . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . round($pakan_gr, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . $butir_jumlah . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . round($butir_kg, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . round($hasil_butir_gr / 7, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                     ' . round($hasil_hh / 7, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . round($hasil_hd_persen / 7, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                       ' . round($hasil_fcr / 7, 2) . '
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                   </td>
    //                                                                   <td bgcolor="#808080">
    //                                                                   </td>
    //                                                               </tr>
    //                                                 ';
    //                         $pakan = 0;
    //                         $mati = 0;
    //                         $afkir = 0;
    //                         $pakan_gr = 0;
    //                         $butir_jumlah = 0;
    //                         $butir_kg = 0;
    //                         $hasil_butir_gr = 0;
    //                         $hasil_hh = 0;
    //                         $hasil_hd_persen = 0;
    //                         $hasil_fcr = 0;
    //                     }

    //                     //Jumlah 7 hari
    //                 }
    //                 $output .= '
    //                                             </tbody>
    //                                         </table>
    //                                     </div>';
    //             }
    //         }
    //     } else {
    //         //Data Kandang Banyak
    //         if ($id_lokasi == '' || $id_lokasi == null) {
    //             $output .= '<div class="alert alert-danger text-center">Data Lokasi Harus Dipilih!</div>';
    //         } else {
    //             if ($kandang == '' || $kandang == null) {
    //                 $output .= '<div class="alert alert-danger text-center">Tanggal Menetas Harus Dipilih!</div>';
    //             } else {
    //                 //Query Judul
    //                 $getJudul = $this->db->query("Select * From mt_kandang 
    //                     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
    //                     where status_periode = 'AKTIF' and tr_periode.tanggal_menetas = '" . $kandang . "'");
    //                 $getTransaksi = $this->db->query("Select tr_periode.tanggal_menetas as tanggal_menetas,
    //                     tr_produksi.tanggal_catat as tanggal_catat,
    //                      AVG(tr_produksi.ayam_m) as ayam_m, AVG(tr_produksi.ayam_c) as ayam_c, AVG(tr_produksi.total_ayam) as total_ayam, AVG(tr_produksi.pakan_kg) as pakan_kg, AVG(tr_produksi.hasil_pakan_gr) as hasil_pakan_gr, AVG(tr_produksi.butir_jumlah) as butir_jumlah, AVG(tr_produksi.butir_kg) as butir_kg, AVG(tr_produksi.hasil_butir_gr) as hasil_butir_gr, AVG(tr_produksi.hasil_hh) as hasil_hh , AVG(tr_produksi.hasil_hd_persen) as hasil_hd_persen, AVG(tr_produksi.hasil_fcr) as hasil_fcr, AVG(tr_produksi.berat_badan) as berat_badan, tr_produksi.keterangan as keterangan From mt_kandang 
    //                     inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
    //                    inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
    //                     where status_periode = 'AKTIF' and tr_periode.tanggal_menetas = '" . $kandang . "' and mt_kandang.id_lokasi ='".$id_lokasi."' GROUP BY tr_produksi.tanggal_catat ");
    //                 //Query Data Hasil

    //                 $output .= '
    //                     <div class="col-md-12">';
    //                 //Tampilan Judul
    //                 foreach ($getJudul->result() as $row) {
    //                     $output .= '
    //                                 <h4 class="block">Kandang : ' . $row->nama_kandang . '</h4>';
    //                 }
    //                 $output .= '
    //                 </div>
    //                 <div class="col-md-12">
    //                     <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
    //                         <thead class="btn-success">
    //                             <tr>
    //                                 <th> Tanggal </th>
    //                                 <th> Mati </th>
    //                                 <th> Afkir </th>
    //                                 <th> Total </th>
    //                                 <th> Pakan (Kg) </th>
    //                                 <th> Pakan (Gr) </th>
    //                                 <th> Butir Telur (Jumlah) </th>
    //                                 <th> Butir Telur (Kg) </th>
    //                                 <th> Gr / Butir </th>
    //                                 <th> % HH </th>
    //                                 <th> % HD </th>
    //                                 <th> FCR </th>
    //                                 <th> BB </th>
    //                                 <th> Keterangan </th>
    //                             </tr>
    //                         </thead>
    //                         <tbody>';
    //     //Tampilan Data Hasil
    //     $pakan = 0;
    //     $mati = 0;
    //     $afkir = 0;
    //     $pakan_gr = 0;
    //     $butir_jumlah = 0;
    //     $butir_kg = 0;
    //     $hasil_butir_gr = 0;
    //     $hasil_hh = 0;
    //     $hasil_hd_persen = 0;
    //     $hasil_fcr = 0;
    //     foreach ($getTransaksi->result() as $rowTransaksi) {

    //         $dateCatat = date_create($rowTransaksi->tanggal_catat);
    //         $data_mulai = $rowTransaksi->tanggal_menetas;
    //         $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
    //         $years = floor($diff / (365 * 60 * 60 * 24));
    //         $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    //         $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    //         $hasil_mod = $days % 7;
    //         $minggu_ke = $days / 7;
    //         $pakan = $pakan + $rowTransaksi->pakan_kg;
    //         $pakan_gr = $pakan_gr + $rowTransaksi->hasil_pakan_gr;
    //         $butir_jumlah = $butir_jumlah + $rowTransaksi->butir_jumlah;
    //         $butir_kg = $butir_kg + $rowTransaksi->butir_kg;
    //         $hasil_butir_gr = $hasil_butir_gr + $rowTransaksi->hasil_butir_gr;
    //         $mati = $mati + $rowTransaksi->ayam_m;
    //         $afkir = $afkir + $rowTransaksi->ayam_c;
    //         $hasil_hh = $hasil_hh + $rowTransaksi->hasil_hh;
    //         $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
    //         $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
    //         $output .= '
    //                                     <tr class="odd gradeX">
    //                                         <td>' . date_format($dateCatat, "d F Y") . '</td>
    //                                         <td>' . $rowTransaksi->ayam_m . '</td>
    //                                         <td>' . $rowTransaksi->ayam_c . '</td>
    //                                         <td>' . $rowTransaksi->total_ayam . '</td>
    //                                         <td>' . $rowTransaksi->pakan_kg . '</td>
    //                                         <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
    //                                         <td>' . $rowTransaksi->butir_jumlah . '</td>
    //                                         <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
    //                                         <td>' . round($rowTransaksi->hasil_butir_gr, 2) . '</td>
    //                                         <td>' . round($rowTransaksi->hasil_hh, 2) . '</td>
    //                                         <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
    //                                         <td>' . round($rowTransaksi->hasil_fcr, 2) . '</td>
    //                                         <td>' . $rowTransaksi->berat_badan . '</td>
    //                                         <td>' . $rowTransaksi->keterangan . '</td>
    //                                     </tr>';
    //         if ($hasil_mod === 0) {
    //             $output .= '
    //                                     <tr class="odd gradeX">
    //                                                       <td style="text-align:center" bgcolor="#808080">
    //                                                           ' . $minggu_ke . '
    //                                                       </td>
    //                                                       <td colspan="2" style="text-align:center;" bgcolor="#808080">
    //                                                         ' . $mati . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . $pakan . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . round($pakan_gr, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . $butir_jumlah . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . round($butir_kg, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . round($hasil_butir_gr / 7, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                         ' . round($hasil_hh / 7, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . round($hasil_hd_persen / 7, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                           ' . round($hasil_fcr / 7, 2) . '
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                       </td>
    //                                                       <td bgcolor="#808080">
    //                                                       </td>
    //                                                   </tr>
    //                                     ';
    //             $pakan = 0;
    //             $mati = 0;
    //             $afkir = 0;
    //             $pakan_gr = 0;
    //             $butir_jumlah = 0;
    //             $butir_kg = 0;
    //             $hasil_butir_gr = 0;
    //             $hasil_hh = 0;
    //             $hasil_hd_persen = 0;
    //             $hasil_fcr = 0;
    //         }

    //         //Jumlah 7 hari
    //     }
    //     $output .= '
    //                                 </tbody>
    //                             </table>
    //                         </div>';
    //             }
    //         }
    //     }

    //     return $output;
    // }

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
                $hasil_butir_gr = 0;
                $hasil_hh = 0;
                $hasil_hd_persen = 0;
                $hasil_fcr = 0;
                foreach ($getTransaksi->result() as $rowTransaksi) {

                    $dateCatat = new DateTime($rowTransaksi->tanggal_catat);
                    $data_mulai = new DateTime($rowTransaksi->tanggal_menetas);
                    // $diff = abs(strtotime($rowTransaksi->tanggal_catat) - strtotime($data_mulai));
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
                    $hasil_hh = $hasil_hh + $rowTransaksi->hasil_hh;
                    $hasil_hd_persen = $hasil_hd_persen + $rowTransaksi->hasil_hd_persen;
                    $hasil_fcr = $hasil_fcr + $rowTransaksi->hasil_fcr;
                    $output .= '
                                                <tr class="odd gradeX">
                                                    <td>' . date_format($dateCatat, "d F Y") . '</td>
                                                    <td>' . $rowTransaksi->ayam_m . '</td>
                                                    <td>' . $rowTransaksi->ayam_c . '</td>
                                                    <td>' . $rowTransaksi->total_ayam . '</td>
                                                    <td>' . $rowTransaksi->pakan_kg . '</td>
                                                    <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
                                                    <td>' . $rowTransaksi->butir_jumlah . '</td>
                                                    <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_butir_gr, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_hh, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_fcr, 2) . '</td>
                                                    <td>' . $rowTransaksi->berat_badan . '</td>
                                                    <td>' . $rowTransaksi->keterangan . '</td>
                                                </tr>';
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
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . $pakan . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . round($pakan_gr, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . $butir_jumlah . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . round($butir_kg, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . round($hasil_butir_gr / 7, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                    ' . round($hasil_hh / 7, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . round($hasil_hd_persen / 7, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                      ' . round($hasil_fcr / 7, 2) . '
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                  </td>
                                                                  <td bgcolor="#808080">
                                                                  </td>
                                                              </tr>
                                                ';
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
                    }

                    //Jumlah 7 hari
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
                                
                                //Tampilan Judul
                                // $output .= '<h4 class="block">Kandang : ' . $namaKandangTampil . '</h4>';
                            };
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
                    where status_periode = 'AKTIF' AND " . $kandang_kuy . " GROUP BY tr_produksi.tanggal_catat");
                            // $cobabro ="Select tr_periode.tanggal_menetas as tanggal_menetas,
                            // tr_produksi.tanggal_catat as tanggal_catat,
                            // tr_produksi.ayam_m as ayam_m, tr_produksi.ayam_c as ayam_c,
                            // tr_produksi.total_ayam as total_ayam, tr_produksi.pakan_kg as pakan_kg, 
                            // tr_produksi.hasil_pakan_gr as hasil_pakan_gr, 
                            // tr_produksi.butir_jumlah as butir_jumlah, tr_produksi.butir_kg as butir_kg,
                            // tr_produksi.hasil_butir_gr as hasil_butir_gr, tr_produksi.hasil_hh as hasil_hh ,
                            // tr_produksi.hasil_hd_persen as hasil_hd_persen, tr_produksi.hasil_fcr as hasil_fcr, 
                            // tr_produksi.berat_badan as berat_badan ,tr_produksi.keterangan as keterangan From mt_kandang 
                            // inner join tr_periode on mt_kandang.id_kandang = tr_periode.id_kandang
                            // inner join tr_produksi on tr_periode.id_periode = tr_produksi.id_periode
                            // where status_periode = 'AKTIF'" . $kandang_kuy . " GROUP BY tr_produksi.tanggal_catat";
                            // echo $cobabro;
                                    
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
                                                <th> % HH </th>
                                                <th> % HD </th>
                                                <th> FCR </th>
                                                <th> BB </th>
                                                <th> Keterangan </th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        //Tampilan Data Hasil
                                        
                foreach ($getTransaksi->result() as $rowTransaksi) {

                    $dateCatat = date_create($rowTransaksi->tanggal_catat);
                    $output .= '
                                                <tr class="odd gradeX">
                                                    <td>' . date_format($dateCatat, "d F Y") . '</td>
                                                    <td>' . $rowTransaksi->ayam_m . '</td>
                                                    <td>' . $rowTransaksi->ayam_c . '</td>
                                                    <td>' . $rowTransaksi->total_ayam . '</td>
                                                    <td>' . $rowTransaksi->pakan_kg . '</td>
                                                    <td>' . round($rowTransaksi->hasil_pakan_gr, 2) . '</td>
                                                    <td>' . $rowTransaksi->butir_jumlah . '</td>
                                                    <td>' . round($rowTransaksi->butir_kg, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_butir_gr, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_hh, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_hd_persen, 2) . '</td>
                                                    <td>' . round($rowTransaksi->hasil_fcr, 2) . '</td>
                                                    <td>' . $rowTransaksi->berat_badan . '</td>
                                                    <td>' . $rowTransaksi->keterangan . '</td>
                                                </tr>';
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
