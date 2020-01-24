<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_anggota extends CI_Controller {

	function index()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$d['active_dashboard_admin'] = "";
			$d['active_master'] = "active";
				$d['active_mtanggota'] = "active";
				$d['active_mtstrain'] = "";
				$d['active_mtstrainnilai'] = "";
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

			$d['dataSemuaAnggota'] = $this->app_load_data_table->getAllData();

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('master_anggota/content', $d);
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
		$code = 'U_';
		$code .= sprintf("%04s", $id);
		return $code;
	}

	function get_id()
	{
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(right(id_anggota,4)) AS maxid FROM mt_anggota')->row();
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
			$this->form_validation->set_rules('nama_anggota', 'Nama Anggota', 'required');
			$this->form_validation->set_rules('password_anggota', 'Password Anggota', 'required');
			$this->form_validation->set_rules('grup_anggota', 'Grup Anggota', 'required');

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

				$dt['nama_anggota'] = $this->input->post('nama_anggota');
				$dt['password_anggota'] = md5($this->input->post("password_anggota").'AppProduksi');
				$dt['status_anggota'] = "AKTIF";
				$dt['grup_anggota'] = $this->input->post('grup_anggota');
				$dt['created_at'] = date("Y-m-d H:i:s");
				$dt['updated_at'] = date("Y-m-d H:i:s");
				$dt['id_anggota'] = $this->kode_inc($kode);
				$this->db->insert("mt_anggota",$dt);
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
			$this->form_validation->set_rules('nama_anggota_edit', 'Nama Anggota', 'required');
			$this->form_validation->set_rules('status_anggota_edit', 'Status Anggota', 'required');
			$this->form_validation->set_rules('grup_anggota_edit', 'Grup ANggota', 'required');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   //validation fails
					echo validation_errors();
			}
			else
			{
				$id = $this->input->post('id_anggota_edit');

				$data = array(
					'nama_anggota' => $this->input->post('nama_anggota_edit'),
					'status_anggota' => $this->input->post('status_anggota_edit'),
					'grup_anggota' => $this->input->post('grup_anggota_edit'),
					'updated_at' => date("Y-m-d H:i:s"),
				);

				$this->db->where('id_anggota', $id);
				$this->db->update('mt_anggota', $data);
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
		$id = $this->input->post('id_anggota_hapus');

		$this->db->where('id_anggota', $id);
		$this->db->delete('mt_anggota');
		echo "YES";
	}

	public function reset()
	{
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata("logged_in")!="")
		{
			$id = $this->input->post('id_anggota_reset');

			$data = array(
				'password_anggota' => md5('123456'.'AppProduksi'),
				'updated_at' => date("Y-m-d H:i:s"),
			);

			$this->db->where('id_anggota', $id);
			$this->db->update('mt_anggota', $data);
			echo "YES";
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}
}
