<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transaksi_periode extends CI_Controller {

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
			$d['active_transaksi'] = "active";
				$d['active_tsperiode'] = "active";
				$d['active_tstelor'] = "";
			$d['active_laporan'] = "";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpbulanan'] = "";
				$d['active_lpgrafik'] = "";

			$this->load->model('/app_load_data_table');

			$d['dataSemuaPeriode'] = $this->app_load_data_table->getAllData();
			// $d['dataSemuaKandang'] = $this->app_load_data_table->getAllDataKandang();
			$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasi();
			$d['dataSemuaStrain'] = $this->app_load_data_table->getAllDataStrain();

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('transaksi_periode/content', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function ambil_kandang()
	{
		if($this->input->post('id_lokasi'))
		{
			$this->load->model('/app_load_data_table');

			echo $this->app_load_data_table->dataKandang($this->input->post('id_lokasi'));
		}
	}

	function kode_inc($id)
	{
		$code = 'PR_';
		$code .= sprintf("%04s", $id);
		return $code;
	}

	function get_id()
	{
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(right(id_periode,4)) AS maxid FROM tr_periode')->row();
		if ($row) {
				$maxid = $row->maxid;
		}
		return $maxid;
	}

	// function kode_inc_ayam($id)
	// {
	// 	$code = 'AM_';
	// 	$code .= sprintf("%07s", $id);
	// 	return $code;
	// }

	// function get_id_ayam()
	// {
	// 	$maxid = 0;
	// 	$row = $this->db->query('SELECT MAX(right(id_ayam,7)) AS maxid FROM tr_ayam')->row();
	// 	if ($row) {
	// 			$maxid = $row->maxid;
	// 	}
	// 	return $maxid;
	// }

	// function kode_inc_telor($id)
	// {
	// 	$code = 'TR_';
	// 	$code .= sprintf("%07s", $id);
	// 	return $code;
	// }

	// function get_id_telor()
	// {
	// 	$maxid = 0;
	// 	$row = $this->db->query('SELECT MAX(right(id_telor,7)) AS maxid FROM tr_telor')->row();
	// 	if ($row) {
	// 			$maxid = $row->maxid;
	// 	}
	// 	return $maxid;
	// }

	public function simpan()
	{
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata("logged_in")!="")
		{
			$this->load->library('form_validation');

			//set validation rules
			$this->form_validation->set_rules('data_tabel_lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('data_kandang', 'Kandang', 'required');
			$this->form_validation->set_rules('data_tabel_strain', 'Strain', 'required');
			$this->form_validation->set_rules('nama_periode', 'Nama Periode', 'required');
			$this->form_validation->set_rules('ayam_masuk', 'Jumlah Ayam Masuk', 'required|numeric');
			$this->form_validation->set_rules('tanggal_masuk_kandang', 'Tanggal Masuk Kandang', 'required');
			$this->form_validation->set_rules('tanggal_menetas', 'Tanggal Menetas', 'required');
			$this->form_validation->set_rules('umur_masuk', 'Umur Masuk', 'required|numeric');
			$this->form_validation->set_rules('asal_pullet', 'Asal Pullet', 'required');
			$this->form_validation->set_rules('hd_periode', 'HD', 'required|numeric');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   
				//validation fails
				echo validation_errors();
			}
			else
			{
				$id_kandang = $this->input->post('data_kandang');

				$cek['id_kandang'] = $id_kandang;
				$cek['status_periode'] = 'AKTIF';
				$cek2 = $this->db->get_where('tr_periode', $cek);

				if($cek2->num_rows()>0)
				{
					echo "NO1";
				}
				else
				{
					$where['id_kandang'] = $this->input->post('data_kandang');
					$pas = $this->db->get_where("mt_kandang",$where)->row();

					if($pas->kapasitas_ayam < $this->input->post('ayam_masuk'))
					{
						echo "NO2";
					}
					else
					{
						$kode = $this->get_id();
						$kode = $kode + 1;

						$dt['id_kandang'] = $this->input->post('data_kandang');
						$dt['id_anggota'] = $this->session->userdata("id_anggota");
						$dt['nama_periode'] = $this->input->post('nama_periode');
						$dt['id_strain'] = $this->input->post('data_tabel_strain');
						$dt['tanggal_masuk_kandang'] = $this->input->post('tanggal_masuk_kandang');
						$dt['tanggal_menetas'] = $this->input->post('tanggal_menetas');
						$dt['awal_ayam_masuk'] = $this->input->post('ayam_masuk');
						$dt['jumlah_seluruh_ayam'] = $this->input->post('ayam_masuk');
						$dt['umur_masuk'] = $this->input->post('umur_masuk');
						$dt['asal_pullet'] = $this->input->post('asal_pullet');
						$dt['hd_periode'] = $this->input->post('hd_periode');
						$dt['status_periode'] = "AKTIF";
						$dt['created_at'] = date("Y-m-d H:i:s");
						$dt['updated_at'] = date("Y-m-d H:i:s");
						$dt['id_periode'] = $this->kode_inc($kode);

						$this->db->insert("tr_periode",$dt);

						// $id_periode = $this->kode_inc($kode);

						// $kode_ayam = $this->get_id_ayam();
						// $kode_ayam = $kode_ayam + 1;

						// $da['id_periode'] = $id_periode;
						// $da['id_anggota'] = $this->session->userdata("id_anggota");
						// $da['awal_ayam_masuk'] = $this->input->post('ayam_masuk');
						// $da['tanggal_catat'] = date("Y-m-d");
						// $da['created_at'] = date("Y-m-d H:i:s");
						// $da['updated_at'] = date("Y-m-d H:i:s");
						// $da['id_ayam'] = $this->kode_inc_ayam($kode_ayam);

						// $this->db->insert("tr_ayam",$da);

						// $kode_telor = $this->get_id_telor();
						// $kode_telor = $kode_telor + 1;

						// $dtr['id_periode'] = $id_periode;
						// $dtr['id_anggota'] = $this->session->userdata("id_anggota");
						// $dtr['butir_jumlah'] = 0;
						// $dtr['rusak_jumlah'] = 0;
						// $dtr['suhu_pagi'] = 0;
						// $dtr['keterangan'] = "";
						// $dtr['created_at'] = date("Y-m-d H:i:s");
						// $dtr['updated_at'] = date("Y-m-d H:i:s");
						// $dtr['tanggal_catat'] = date("Y-m-d");
						// $dtr['suhu_siang'] = 0;
						// $dtr['suhu_sore'] = 0;
						// $dtr['suhu_malam'] = 0;
						// $dtr['pakan_kg'] = 0;
						// $dtr['butir_kg'] = 0;
						// $dtr['rusak_kg'] = 0;
						// $dtr['berat_badan'] = 0;
						// $dtr['hasil_pakan_gr'] = 0;
						// $dtr['hasil_butir_gr'] = 0;
						// $dtr['hasil_rusak_gr'] = 0;
						// $dtr['hasil_hd_persen'] = 0;
						// $dtr['hasil_fcr'] = 0;
						// $dtr['hasil_rusak_persen'] = 0;
						// $dtr['hasil_hh'] = 0;
						// $dtr['id_telor'] = $this->kode_inc_telor($kode_telor);

						// $this->db->insert("tr_telor",$dtr);

						echo "YES";
					}
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function getDataById()
	{
		$id = $_GET['id'];;
		$this->load->model('/app_load_data_table');
		$data = $this->app_load_data_table->getDataById($id);

		print json_encode($data);
	}

	public function simpan_edit()
	{
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata("logged_in")!="")
		{
			$this->load->library('form_validation');

			//set validation rules
			$this->form_validation->set_rules('nama_periode_edit', 'Nama Periode', 'required');
			$this->form_validation->set_rules('hd_periode_edit', 'HD', 'required|numeric');
			$this->form_validation->set_rules('status_periode_edit', 'Status Periode', 'required');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   //validation fails
					echo validation_errors();
			}
			else
			{
				$id = $this->input->post('id_periode_edit');

				$data = array(
					'nama_periode' => $this->input->post('nama_periode_edit'),
					'hd_periode' => $this->input->post('hd_periode_edit'),
					'status_periode' => $this->input->post('status_periode_edit'),
					'updated_at' => date("Y-m-d H:i:s"),
				);

				$this->db->where('id_periode', $id);
				$this->db->update('tr_periode', $data);
				echo "YES";
			}
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}
}
