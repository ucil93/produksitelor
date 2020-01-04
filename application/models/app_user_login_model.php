<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_user_login_model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk manajemen user login
	 **/

	public function cekUserLogin($data)
	{
		$login['nama_anggota'] = $data['username'];
		$login['password_anggota'] = md5($data['password'].'AppProduksi');
		$cek = $this->db->get_where('mt_anggota', $login);

		if($cek->num_rows() > 0)
		{
			foreach($cek->result() as $qad)
			{
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id_anggota'] = $qad->id_anggota;
				$sess_data['nama_anggota'] = $qad->nama_anggota;
				$sess_data['status_anggota'] = $qad->status_anggota;
				$sess_data['grup_anggota'] = $qad->grup_anggota;

				$this->session->set_userdata($sess_data);
			}

			if ($this->session->userdata('status_anggota') == "AKTIF")
			{
				// if ($this->session->userdata('grup_anggota') == "ADMIN")
				// {
				redirect("dashboard_admin");
				// }
				// elseif($this->session->userdata('grup_anggota') == "ANGGOTA") 
				// {
				// 	redirect("dashboard_anggota");
				// }
			}
			else
			{
				$data = new stdClass();
				$data->error = 'Nama pengguna tidak aktif';
	
				$this->session->sess_destroy();
	
				$this->load->view('login/login', $data);
			}
		}
		else
		{
			$data = new stdClass();
			$data->error = 'Nama pengguna atau password salah';

			$this->session->sess_destroy();

			$this->load->view('login/login', $data);
		}

		// if ($data['username'] != "")
		// {
		// 	$user_login = $data['username'];
		// 	$pass_login = $data['password'];

		// 	if($user_login == "admin")
		// 	{
		// 		redirect("dashboard_admin");
		// 	}
		// 	elseif($user_login == "anggota") 
		// 	{
		// 		redirect("dashboard_anggota");
		// 	}
		// 	else
		// 	{
		// 		$data = new stdClass();
		// 		$data->error = 'Nama pengguna atau password salah';

		// 		$this->session->sess_destroy();

		// 		$this->load->view('login/login', $data);
		// 	}
		// }
		// else
		// {
		// 	$data = new stdClass();
		// 	$data->error = 'Nama pengguna harus diisi';

		// 	$this->session->sess_destroy();

		// 	$this->load->view('login/login', $data);
		// }

	}
}

/* End of file app_user_login_model.php */
/* Location: ./application/models/app_user_login_model.php */
