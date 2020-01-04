<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard_admin extends CI_Controller {

	function index()
	{
		if($this->session->userdata("logged_in")!="")
		{
			if($this->session->userdata("grup_anggota") == "ADMIN")
			{
				$d['active_dashboard_admin'] = "active";
				$d['active_master'] = "";
					$d['active_mtanggota'] = "";
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
					$d['active_lpbulanan'] = "";
					$d['active_lpgrafik'] = "";
			}
			else
			{
				$d['active_dashboard_admin'] = "active";
				$d['active_transaksi'] = "";
					$d['active_tsperiode'] = "";
					$d['active_tstelor'] = "";
				$d['active_laporan'] = "";
					$d['active_lpharian'] = "";
					$d['active_lpmingguan'] = "";
					$d['active_lpbulanan'] = "";
					$d['active_lpgrafik'] = "";
			}
			
			$this->load->model('/app_load_data_table');

			$d['username']	= $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('dashboard_admin/bg_home', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	public function ubahpass()
	{
		if($this->session->userdata("logged_in")!="")
		{
			$this->load->library('form_validation');

					//set validation rules
			$this->form_validation->set_rules('passwordlama', 'Password Lama', 'required');
			$this->form_validation->set_rules('passwordbaru', 'Password Baru', 'required');
			$this->form_validation->set_rules('passwordbaru2', 'Konfirmasi Password Baru', 'required');

			//run validation check
			if ($this->form_validation->run() == FALSE)
			{   //validation fails
				echo validation_errors();
			}
			else
			{
				$pass_lama = $this->input->post('passwordlama');
				$pass_baru = $this->input->post('passwordbaru');
				$ulangi_pass_baru = $this->input->post('passwordbaru2');

				// $user = $this->session->userdata("nama_anggota");
				$id = $this->session->userdata("id_anggota");

				$login['id_anggota'] = $id;
				$login['password_anggota'] = md5($pass_lama.'AppProduksi');
				$cek = $this->db->get_where('mt_anggota', $login);

				if($pass_baru == $ulangi_pass_baru)
				{
					if($cek->num_rows()>0)
					{
						$data = array(
							'password_anggota' => md5($pass_baru.'AppProduksi'),
							'updated_at' => date("Y-m-d H:i:s"),
						);

						$this->db->where('id_anggota', $id);
						$this->db->update('mt_anggota', $data);
						echo "YES";
					}
					else
					{
						echo "NO1";
					}
				}
				else
				{
					echo "NO2";
				}
			}		
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
  	}
}
