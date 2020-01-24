<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transaksi_telor extends CI_Controller {

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
				$d['active_tsperiode'] = "";
				$d['active_tstelor'] = "active";
			$d['active_laporan'] = "";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "";

			$this->load->model('/app_load_data_table');

			$d['dataSemuaLokasi'] = $this->app_load_data_table->getAllDataLokasi();

			$d['username'] = $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('transaksi_telor/content', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}

	function telor($id_param)
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
				$d['active_tsperiode'] = "";
				$d['active_tstelor'] = "active";
			$d['active_laporan'] = "";
				$d['active_lpharian'] = "";
				$d['active_lpmingguan'] = "";
				$d['active_lpgrafik'] = "";

			$this->load->model('/app_load_data_table');

			$d['username'] = $this->session->userdata("nama_anggota");
			$d['grup_anggota']	= $this->session->userdata("grup_anggota");

			$d['data_lokasi'] = $this->app_load_data_table->getNamaLokasi($id_param);

			$d['dataSemuaKandang'] = $this->app_load_data_table->getDataKandang($id_param);

			$this->load->view('dashboard_admin/bg_header', $d);
			$this->load->view('dashboard_admin/bg_navigation', $d);
			$this->load->view('transaksi_telor/form_telor', $d);
			$this->load->view('dashboard_admin/bg_footer', $d);
		}
		else
		{
			$this->session->sess_destroy();
			redirect("login");
		}
	}

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

	// function kode_inc($id)
	// {
	// 	$code = 'PI_';
	// 	$code .= sprintf("%07s", $id);
	// 	return $code;
	// }

	// function get_id()
	// {
	// 	$maxid = 0;
	// 	$row = $this->db->query('SELECT MAX(right(id_produksi,7)) AS maxid FROM tr_produksi')->row();
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
			$id_periode = $this->input->post('id_periode');

			// $kode = $this->get_id();
			// $kode = $kode + 1;

			// $kode_ayam = $this->get_id_ayam();
			// $kode_ayam = $kode_ayam + 1;

			$hasil_akhir = array();

			$status_simpan = true;

			if($this->input->post('tanggal_catat') == "" || $this->input->post('tanggal_catat') == null) {
				$hasil_akhir = array('hasil' => "TANGGAL_CATAT");
				$status_simpan = false;
			} else {
				if($this->input->post('suhu_pagi') == "" || $this->input->post('suhu_pagi') == null) {
					$hasil_akhir = array('hasil' => "SUHU_PAGI");
					$status_simpan = false;
				} else {
					if($this->input->post('suhu_siang') == "" || $this->input->post('suhu_siang') == null) {
						$hasil_akhir = array('hasil' => "SUHU_SIANG");
						$status_simpan = false;
					} else {
						if($this->input->post('suhu_sore') == "" || $this->input->post('suhu_sore') == null) {
							$hasil_akhir = array('hasil' => "SUHU_SORE");
							$status_simpan = false;
						} else {
							if($this->input->post('suhu_malam') == "" || $this->input->post('suhu_malam') == null) {
								$hasil_akhir = array('hasil' => "SUHU_MALAM");
								$status_simpan = false;
							} else {
								for($i=0; $i<count($id_periode); $i++)
								{
									//cek data_m
									if($this->input->post('data_m')[$i] == "" || $this->input->post('data_m')[$i] == null || $this->input->post('data_m')[$i] == "null") {
										$hasil_akhir[$i] = array('hasil' => "NO_DATA_M_KOSONG");
										$status_simpan = false;
									} else {
										if(is_numeric($this->input->post('data_m')[$i])) {
											//cek data_c
											if($this->input->post('data_c')[$i] == "" || $this->input->post('data_c')[$i] == null || $this->input->post('data_c')[$i] == "null") {
												$hasil_akhir[$i] = array('hasil' => "NO_DATA_C_KOSONG");
												$status_simpan = false;
											} else {
												if(is_numeric($this->input->post('data_c')[$i])) {
													//cek data_pakan
													if($this->input->post('data_pakan')[$i] == "" || $this->input->post('data_pakan')[$i] == null || $this->input->post('data_pakan')[$i] == "null") {
														$hasil_akhir[$i] = array('hasil' => "NO_DATA_PAKAN_KOSONG");
														$status_simpan = false;
													} else {
														if(is_numeric($this->input->post('data_pakan')[$i])) {
															//cek data_butir_jumlah
															if($this->input->post('data_butir_jumlah')[$i] == "" || $this->input->post('data_butir_jumlah')[$i] == null || $this->input->post('data_butir_jumlah')[$i] == "null") {
																$hasil_akhir[$i] = array('hasil' => "NO_DATA_BUTIR_JUMLAH_KOSONG");
																$status_simpan = false;
															} else {
																if(is_numeric($this->input->post('data_butir_jumlah')[$i])) {
																	//cek data_rusak_jumlah
																	if($this->input->post('data_rusak_jumlah')[$i] == "" || $this->input->post('data_rusak_jumlah')[$i] == null || $this->input->post('data_rusak_jumlah')[$i] == "null") {
																		$hasil_akhir[$i] = array('hasil' => "NO_DATA_RUSAK_JUMLAH_KOSONG");
																		$status_simpan = false;
																	} else {
																		if(is_numeric($this->input->post('data_rusak_jumlah')[$i])) {
																			//cek data_butir_kg
																			if($this->input->post('data_butir_kg')[$i] == "" || $this->input->post('data_butir_kg')[$i] == null || $this->input->post('data_butir_kg')[$i] == "null") {
																				$hasil_akhir[$i] = array('hasil' => "NO_DATA_BUTIR_KG_KOSONG");
																				$status_simpan = false;
																			} else {
																				if(is_numeric($this->input->post('data_butir_kg')[$i])) {
																					//cek data_rusak_kg
																					if($this->input->post('data_rusak_kg')[$i] == "" || $this->input->post('data_rusak_kg')[$i] == null || $this->input->post('data_rusak_kg')[$i] == "null") {
																						$hasil_akhir[$i] = array('hasil' => "NO_DATA_RUSAK_KG_KOSONG");
																						$status_simpan = false;
																					} else {
																						if(is_numeric($this->input->post('data_rusak_kg')[$i])) {
																							//cek jumlah ayam
																							if(intval($this->input->post('jumlah_ayam')[$i]) <= (intval($this->input->post('data_m')[$i]) + intval($this->input->post('data_c')[$i]))) {
																								$hasil_akhir[$i] = array('hasil' => "NO_JUMLAH_AYAM");
																								$status_simpan = false;
																							} else {
																								$hasil_akhir[$i] = array('hasil' => "YES");
																							}
																							// //cek data_berat_badan
																							// if($this->input->post('data_berat_badan')[$i] == "" || $this->input->post('data_berat_badan')[$i] == null || $this->input->post('data_berat_badan')[$i] == "null") {
																							// 	$hasil_akhir[$i] = array('hasil' => "NO_DATA_BERAT_BADAN_KOSONG");
																							// 	$status_simpan = false;
																							// } else {
																							// 	if(is_numeric($this->input->post('data_berat_badan')[$i])) {
																							// 		//cek jumlah ayam
																									
																							// 	} else {
																							// 		$hasil_akhir[$i] = array('hasil' => "NO_DATA_BERAT_BADAN_NUMBER");
																							// 		$status_simpan = false;
																							// 	}
																							// }
																						} else {
																							$hasil_akhir[$i] = array('hasil' => "NO_DATA_RUSAK_KG_NUMBER");
																							$status_simpan = false;
																						}
																					}	
																				} else {
																					$hasil_akhir[$i] = array('hasil' => "NO_DATA_BUTIR_KG_NUMBER");
																					$status_simpan = false;
																				}
																			}
																		} else {
																			$hasil_akhir[$i] = array('hasil' => "NO_DATA_RUSAK_JUMLAH_NUMBER");
																			$status_simpan = false;
																		}
																	}
																} else {
																	$hasil_akhir[$i] = array('hasil' => "NO_DATA_BUTIR_JUMLAH_NUMBER");
																	$status_simpan = false;
																}
															}
														} else {
															$hasil_akhir[$i] = array('hasil' => "NO_DATA_PAKAN_NUMBER");
															$status_simpan = false;
														}
													}
												} else {
													$hasil_akhir[$i] = array('hasil' => "NO_DATA_C_NUMBER");
													$status_simpan = false;
												}
											}
										} else {
											$hasil_akhir[$i] = array('hasil' => "NO_DATA_M_NUMBER");
											$status_simpan = false;
										}
									}
								};
							}
						}
					}
				}
			}

			if($status_simpan == true) {
				for($i=0; $i<count($id_periode); $i++)
				{
					// $dt['id_produksi'] = $this->kode_inc($kode);
					$dt['id_periode'] = $this->input->post('id_periode')[$i];
					$dt['id_anggota'] = $this->session->userdata("id_anggota");
					$dt['ayam_m'] = $this->input->post("data_m")[$i];
					$dt['ayam_c'] = $this->input->post("data_c")[$i];
					$dt['total_ayam'] = intval($this->input->post('jumlah_ayam')[$i]) - (intval($this->input->post('data_m')[$i]) + intval($this->input->post('data_c')[$i]));
					$dt['tanggal_catat'] = $this->input->post('tanggal_catat');
					$dt['created_at'] = date("Y-m-d H:i:s");
					$dt['updated_at'] = date("Y-m-d H:i:s");
					$dt['suhu_pagi'] = $this->input->post('suhu_pagi');
					$dt['suhu_siang'] = $this->input->post('suhu_siang');
					$dt['suhu_sore'] = $this->input->post('suhu_sore');
					$dt['suhu_malam'] = $this->input->post('suhu_malam');
					$dt['butir_jumlah'] = $this->input->post('data_butir_jumlah')[$i];
					$dt['rusak_jumlah'] = $this->input->post('data_rusak_jumlah')[$i];
					$dt['butir_kg'] = $this->input->post('data_butir_kg')[$i];
					$dt['rusak_kg'] = $this->input->post('data_rusak_kg')[$i];
					$dt['pakan_kg'] = $this->input->post('data_pakan')[$i];
					$dt['berat_badan'] = $this->input->post('data_berat_badan')[$i];
					$dt['keterangan'] = $this->input->post('data_ket')[$i];
					
					
					$dt['hasil_pakan_gr'] = ($this->input->post('data_pakan')[$i]/(intval($this->input->post('jumlah_ayam')[$i]) - (intval($this->input->post('data_m')[$i]) + intval($this->input->post('data_c')[$i]))))*1000;

					if($this->input->post('data_butir_kg')[$i] == 0 || $this->input->post('data_butir_kg')[$i] == '0') {
						if($this->input->post('data_butir_jumlah')[$i] == 0 || $this->input->post('data_butir_jumlah')[$i] == '0') {
							$dt['hasil_butir_gr'] = 0;
						} else {
							$dt['hasil_butir_gr'] = 0;
						}
					} else {
						if($this->input->post('data_butir_jumlah')[$i] == 0 || $this->input->post('data_butir_jumlah')[$i] == '0') {
							$dt['hasil_butir_gr'] = 0;
						} else {
							$dt['hasil_butir_gr'] = ($this->input->post('data_butir_kg')[$i]/$this->input->post('data_butir_jumlah')[$i])*1000;
						}
					}

					if($this->input->post('data_rusak_jumlah')[$i] == 0 || $this->input->post('data_rusak_jumlah')[$i] == '0') {
						if($this->input->post('data_rusak_kg')[$i] == 0 || $this->input->post('data_rusak_kg')[$i] == '0') {
							$dt['hasil_rusak_gr'] = 0;
						} else {
							$dt['hasil_rusak_gr'] = 0;
						}
					} else {
						if($this->input->post('data_rusak_kg')[$i] == 0 || $this->input->post('data_rusak_kg')[$i] == '0') {
							$dt['hasil_rusak_gr'] = 0;
						} else {
							$dt['hasil_rusak_gr'] = ($this->input->post('data_rusak_kg')[$i]/$this->input->post('data_rusak_jumlah')[$i])*1000;
						}
					}

					if($this->input->post('data_butir_jumlah')[$i] == 0 || $this->input->post('data_butir_jumlah')[$i] == '0') {
						$dt['hasil_hd_persen'] = 0;
					} else {
						$dt['hasil_hd_persen'] = ($this->input->post('data_butir_jumlah')[$i]/(intval($this->input->post('jumlah_ayam')[$i]) - (intval($this->input->post('data_m')[$i]) + intval($this->input->post('data_c')[$i]))))*100;
					}

					if($this->input->post('data_butir_kg')[$i] == 0 || $this->input->post('data_butir_kg')[$i] == '0') {
						$dt['hasil_fcr'] = 0;
					} else {
						$$dt['hasil_fcr'] = $this->input->post('data_pakan')[$i]/$this->input->post('data_butir_kg')[$i];
					}

					if($this->input->post('data_rusak_jumlah')[$i] == 0 || $this->input->post('data_rusak_jumlah')[$i] == '0') {
						if($this->input->post('data_butir_jumlah')[$i] == 0 || $this->input->post('data_butir_jumlah')[$i] == '0') {
							$dt['hasil_rusak_persen'] = 0;
						} else {
							$dt['hasil_rusak_persen'] = 0;
						}
					} else {
						if($this->input->post('data_butir_jumlah')[$i] == 0 || $this->input->post('data_butir_jumlah')[$i] == '0') {
							$dt['hasil_rusak_persen'] = 0;
						} else {
							$dt['hasil_rusak_persen'] = ($this->input->post('data_rusak_jumlah')[$i]/$this->input->post('data_butir_jumlah')[$i])*100;
						}
					}

					// $dt['hasil_rusak_persen'] = ($this->input->post('data_rusak_jumlah')[$i]/$this->input->post('data_butir_jumlah')[$i])*100;
					// $dt['hasil_hh'] = ($this->input->post('data_butir_jumlah')[$i]/$this->input->post('hd_periode')[$i])*100;

					$this->db->insert("tr_produksi",$dt);

					// $kode = $kode + 1;

					$data_periode = array(
						'jumlah_seluruh_ayam' => intval($this->input->post('jumlah_ayam')[$i]) - (intval($this->input->post('data_m')[$i]) + intval($this->input->post('data_c')[$i])),
						'updated_at' => date("Y-m-d H:i:s"),
					);

					$this->db->where('id_periode', $this->input->post('id_periode')[$i]);
					$this->db->update('tr_periode', $data_periode);
				}
			}

			echo json_encode($hasil_akhir);

			// echo "YES";
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('login/login');
		}
	}
}
