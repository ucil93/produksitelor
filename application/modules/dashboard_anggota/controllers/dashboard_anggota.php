<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard_anggota extends CI_Controller {

	function index()
	{
		// if($this->session->userdata("logged_in")!="")
		// {
			$this->load->model('/app_load_data_table');

			$d['username']	= "Anggota";

			$this->load->view('dashboard_anggota/bg_header', $d);
			$this->load->view('dashboard_anggota/bg_navigation', $d);
			$this->load->view('dashboard_anggota/bg_home', $d);
			$this->load->view('dashboard_anggota/bg_footer', $d);
		// }
		// else
		// {
		// 	$this->session->sess_destroy();
		// 	$this->load->view('login/login');
		// }
	}
}
