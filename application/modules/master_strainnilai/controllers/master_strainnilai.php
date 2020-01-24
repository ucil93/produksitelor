<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_strainnilai extends CI_Controller {

	function index()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$d['active_dashboard_admin'] = "";
			$d['active_master'] = "active";
				$d['active_mtanggota'] = "";
				$d['active_mtstrain'] = "";
				$d['active_mtstrainnilai'] = "active";
				$d['active_mtlokasi'] = "";
				$d['active_mtkandang'] = "";
			$d['active_transaksi'] = "";
				$d['active_tsperiode'] = "";
				$d['active_tstelor'] = "";
			$d['active_laporan'] = "";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "";
				
			$this->load->model('/app_load_data_table');

			$d['dataSemuaStrainNilai'] = $this->app_load_data_table->getAllData();
			$d['dataSemuaStrain'] = $this->app_load_data_table->getAllDataStrain();

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('master_strainnilai/content', $d);
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
		$code = 'SI_';
		$code .= sprintf("%04s", $id);
		return $code;
	}

	function get_id()
	{
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(right(id_strain_nilai,4)) AS maxid FROM mt_strain_nilai')->row();
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
			$this->form_validation->set_rules('data_tabel_strain', 'Nama Strain', 'required');
			$this->form_validation->set_rules('nama_mt_strain_nilai', 'Nama Strain Nilai', 'required');
			$this->form_validation->set_rules('minggu_mt_strain_nilai', 'Minggu Ke', 'required|numeric');
			$this->form_validation->set_rules('standar_mt_strain_nilai', 'Standar Strain Nilai', 'required|numeric');

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

				$dt['id_strain'] = $this->input->post('data_tabel_strain');
				$dt['nama_strain_nilai'] = $this->input->post('nama_mt_strain_nilai');
				$dt['minggu_strain_nilai'] = $this->input->post('minggu_mt_strain_nilai');
				$dt['standar_strain_nilai'] = $this->input->post('standar_mt_strain_nilai');
				$dt['status_strain_nilai'] = "AKTIF";
				$dt['created_at'] = date("Y-m-d H:i:s");
				$dt['updated_at'] = date("Y-m-d H:i:s");
				$dt['id_strain_nilai'] = $this->kode_inc($kode);
				$this->db->insert("mt_strain_nilai",$dt);
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
			$this->form_validation->set_rules('data_tabel_strain_nilai_edit', 'Nama Strain', 'required');
			$this->form_validation->set_rules('nama_strain_nilai_edit', 'Nama Strain Nilai', 'required');
			$this->form_validation->set_rules('minggu_strain_nilai_edit', 'Minggu Ke', 'required|numeric');
			$this->form_validation->set_rules('standar_strain_nilai_edit', 'Standar Strain Nilai', 'required|numeric');
			$this->form_validation->set_rules('status_strain_nilai_edit', 'Status Strain Nilai', 'required');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   //validation fails
					echo validation_errors();
			}
			else
			{
				$id = $this->input->post('id_strain_nilai_edit');

				$data = array(
					'id_strain' => $this->input->post('data_tabel_strain_nilai_edit'),
					'nama_strain_nilai' => $this->input->post('nama_strain_nilai_edit'),
					'minggu_strain_nilai' => $this->input->post('minggu_strain_nilai_edit'),
					'standar_strain_nilai' => $this->input->post('standar_strain_nilai_edit'),
					'status_strain_nilai' => $this->input->post('status_strain_nilai_edit'),
					'updated_at' => date("Y-m-d H:i:s"),
				);

				$this->db->where('id_strain_nilai', $id);
				$this->db->update('mt_strain_nilai', $data);
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
		$id = $this->input->post('id_strain_nilai_hapus');

		// $cek['id_strain_nilai'] = $id;
		// $cek2 = $this->db->get_where('tr_periode', $cek);

		// if($cek2->num_rows()>0)
		// {
		// 	echo "NO";
		// }
		// else
		// {
			$this->db->where('id_strain_nilai', $id);
	  		$this->db->delete('mt_strain_nilai');
			echo "YES";
		// }
	}
}
