<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_grafik extends CI_Controller {

	function index()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$d['active_dashboard_admin'] = "";
			$d['active_master'] = "";
				$d['active_mtanggota'] = "";
				$d['active_mtstrain'] = "";
				$d['active_mtstrainnilai'] = "";
				$d['active_mtlokasi'] = "";
				$d['active_mtkandang'] = "";
			$d['active_transaksi'] = "";
				$d['active_tsperiode'] = "";
				$d['active_tstelor'] = "";
			$d['active_laporan'] = "active";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "active";

			$this->load->model('/app_load_data_table');

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasi();

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('laporan_grafik/content', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function ambil_grafik_satu_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataKandangGrafikSatu($this->input->post('id_lokasi'));
		}
	}

	function cetak_laporan_grafik_satu_kandang()
	{
		$this->load->model('/app_load_data_table');
		
		$rows = $this->app_load_data_table->dataCetakGrafikSatuKandang($this->input->post('id_lokasi'), $this->input->post('data_kandang'));

		echo json_encode($rows);
	}

	function ambil_grafik_banyak_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataKandangGrafikBanyak($this->input->post('id_lokasi'));
		}
	}

	function ambil_strain_banyak_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataStrainGrafikBanyak($this->input->post('id_lokasi'), $this->input->post('tanggal_menetas'));
		}
	}

	function cetak_laporan_grafik_banyak_kandang()
	{
		$this->load->model('/app_load_data_table');
		
		$rows = $this->app_load_data_table->dataCetakGrafikBanyakKandang($this->input->post('id_lokasi'), $this->input->post('tgl_menetas'), $this->input->post('id_strain'));

		echo json_encode($rows);
	}
}
