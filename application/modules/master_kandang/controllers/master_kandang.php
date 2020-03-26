<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_kandang extends CI_Controller {

	function index()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$d['active_dashboard_admin'] = "";
			$d['active_master'] = "active";
				$d['active_mtanggota'] = "";
				$d['active_mtstrain'] = "";
				$d['active_mtstrainnilai'] = "";
				$d['active_mtlokasi'] = "";
				$d['active_mtkandang'] = "active";
			$d['active_transaksi'] = "";
				$d['active_tsperiode'] = "";
				$d['active_tstelor'] = "";
			$d['active_laporan'] = "";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "";
				
			$this->load->model('/app_load_data_table');

			if($this->session->userdata("grup_anggota") === "ANGGOTA") {
				$d['dataSemuaKandang'] = $this->app_load_data_table->getAllDataByAnggota($this->session->userdata("id_anggota"));
				$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasiByAnggota($this->session->userdata("id_anggota"));
			} else {
				$d['dataSemuaKandang'] = $this->app_load_data_table->getAllData();
				$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasi();
			}

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('master_kandang/content', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function kode_inc($id)
	{
		$code = 'KN_';
		$code .= sprintf("%04s", $id);
		return $code;
	}

	function get_id()
	{
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(right(id_kandang,4)) AS maxid FROM mt_kandang')->row();
		if ($row) {
				$maxid = $row->maxid;
		}
		return $maxid;
	}

	public function simpan()
	{
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata("logged_in")!="")
		{
			$this->load->library('form_validation');

			//set validation rules
			$this->form_validation->set_rules('data_tabel_lokasi', 'Nama Lokasi', 'required');
			$this->form_validation->set_rules('nama_mt_kandang', 'Nama Kandang', 'required');
			$this->form_validation->set_rules('kapasitas_mt_kandang', 'Kapasitas Kandang', 'required|numeric');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   
				//validation fails
				echo validation_errors();
			}
			else
			{
				$kode = $this->get_id();
				$kode = $kode + 1;

				$dt['id_lokasi'] = $this->input->post('data_tabel_lokasi');
				$dt['id_anggota'] = $this->session->userdata("id_anggota");
				$dt['nama_kandang'] = $this->input->post('nama_mt_kandang');
				$dt['kapasitas_ayam'] = $this->input->post('kapasitas_mt_kandang');
				$dt['status_kandang'] = "AKTIF";
				$dt['created_at'] = date("Y-m-d H:i:s");
				$dt['updated_at'] = date("Y-m-d H:i:s");
				$dt['id_kandang'] = $this->kode_inc($kode);
				$this->db->insert("mt_kandang",$dt);
				echo "YES";
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
			$this->form_validation->set_rules('data_tabel_lokasi_edit', 'Nama Lokasi', 'required');
			$this->form_validation->set_rules('nama_kandang_edit', 'Nama Kandang', 'required');
			$this->form_validation->set_rules('kapasitas_kandang_edit', 'Kapasitas Kandang', 'required|numeric');
			$this->form_validation->set_rules('status_kandang_edit', 'Status Kandang', 'required');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   //validation fails
					echo validation_errors();
			}
			else
			{
				$id = $this->input->post('id_kandang_edit');

				$data = array(
					'id_lokasi' => $this->input->post('data_tabel_lokasi_edit'),
					'nama_kandang' => $this->input->post('nama_kandang_edit'),
					'kapasitas_ayam' => $this->input->post('kapasitas_kandang_edit'),
					'status_kandang' => $this->input->post('status_kandang_edit'),
					'updated_at' => date("Y-m-d H:i:s"),
				);

				$this->db->where('id_kandang', $id);
				$this->db->update('mt_kandang', $data);
				echo "YES";
			}
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_kandang_hapus');

		$this->db->where('id_kandang', $id);
		$this->db->delete('mt_kandang');
		echo "YES";
	}
}
