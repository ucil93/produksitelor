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

    public function dataCetakGrafikBanyakKandang($id_lokasi, $kandang)
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
