<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_harian extends CI_Controller {

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
				$d['active_lpharian'] = "active";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "";

			$this->load->model('/app_load_data_table');

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			if($this->session->userdata("grup_anggota") === "ANGGOTA") {
				$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasiByAnggota($this->session->userdata("id_anggota"));
			} else {
				$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasi();
			}
			
			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('laporan_harian/content', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function ambil_harian_satu_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataKandangHarianSatu($this->input->post('id_lokasi'));
		}
	}

	function cetak_laporan_harian_satu_kandang()
	{
		$this->load->model('/app_load_data_table');
		
		echo $this->app_load_data_table->dataCetakHarianSatuKandang($this->input->post('id_lokasi'), $this->input->post('data_kandang'));
	}

	function ambil_harian_banyak_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataKandangHarianBanyak($this->input->post('id_lokasi'));
		}
	}

	function cetak_laporan_harian_banyak_kandang()
	{
		$this->load->model('/app_load_data_table');
		
		echo $this->app_load_data_table->dataCetakHarianBanyakKandang($this->input->post('id_lokasi'), $this->input->post('data_kandang'), $this->input->post('tanggal_mulai'), $this->input->post('tanggal_selesai'));
	}
}
