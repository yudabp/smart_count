<?php  
	class Dashboard extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata("status") == FALSE){
				redirect("login");
			}
		}

		public function index(){
			$level = $this->session->userdata("level");
			if($level == "Admin"){
				$data['caleg'] = $this->db->query("SELECT * FROM user JOIN user_filter ON user.id_user=user_filter.id_user WHERE user.level='Caleg'")->result();
				$this->load->view("dashboard/dashboard", $data);
			}
			else if($level == "Saksi"){
				$this->saksi();
			}
			else if($level == "Caleg"){
				$this->caleg();
			}
			else{
				redirect("login");
			}
		}

		public function active_user(){
			$id = $this->input->post("id_user");
			$id_user = base64_decode(base64_decode($id));
			$isi = $this->input->post("isi");

			$check_data = $this->db->get_where("user_filter", ['id_user' => $id_user])->num_rows();
			if($check_data > 0){
				$status = "Yes";
				$this->db->update("user_filter", ['data_activation' => $isi], ['id_user' => $id_user]);
			}
			else{
				$status = "No";
			}
			
			$data = array("status" => $status);
			echo json_encode($data);
		}

		public function saksi(){
			$id_saksi = $this->session->userdata("id_user");
			
			//Get Data Suara
			$suara = $this->db->get_where("suara", ['id_saksi' => $id_saksi])->row_array();
			$total_suara_pribadi = $suara['total_suara_pribadi'];
			$total_suara_partai = $suara['total_suara_partai'];
			
			$data['suara_pribadi'] = $total_suara_pribadi;
			$data['suara_partai'] = $total_suara_partai;
			$this->load->view("dashboard/saksi", $data);
		}

		public function caleg(){
			$id_caleg = $this->session->userdata("id_user");

			$data_caleg_filter = $this->db->get_where("user_filter", ['id_user' => $id_caleg])->row_array();
			$id_provinsi = $data_caleg_filter['id_provinsi'];
			$bagian_pemilihan = $data_caleg_filter['bagian'];

			if($bagian_pemilihan == "DPR RI" || $bagian_pemilihan == "DPRD Provinsi"){
				$id_dapil = $data_caleg_filter['id_dapil'];

				if($bagian_pemilihan == "DPR RI"){
					$area_pemilihan = "dprri";
				}
				else if($bagian_pemilihan == "DPRD Provinsi"){
					$area_pemilihan = "dprprov";
				}

				$data_dapil = $this->db->get_where("dapil", ['id_dapil' => $id_dapil, 'area_pemilihan' => $area_pemilihan])->row_array();

				$nama_dapil = $data_dapil['dapil'];

				$dapil = $this->db->get_where("dapil", ['dapil' => $nama_dapil, 'area_pemilihan' => $area_pemilihan])->result();

				$data['data_suara'] = $dapil;
			}
			else if($bagian_pemilihan == "DPD RI"){
		
				$data_kota = $this->db->order_by("kota", "ASC")->get_where("kota", ['id_provinsi' => $id_provinsi])->result();

				$data['data_suara'] = $data_kota;
			}
			else if($data_caleg_filter['bagian'] == "DPRD Kab/Kota"){
				$id_dapil_dua = $data_caleg_filter['id_dapil'];

				$data_dapil_dua = $this->db->get_where("dapil_selanjutnya", ['id_dapil_dua' => $id_dapil_dua])->row_array();

				$id_dapil = $data_dapil_dua['id_dapil'];
				$nama_dapil = $data_dapil_dua['dapil_selanjutnya'];

				$dapil = $this->db->get_where("dapil", ['id_dapil' => $id_dapil, 'area_pemilihan' => "kab_kota"])->row_array();

				$id_kota = $dapil['id_kota'];

				$kecamatan = $this->db->get_where("kecamatan", ['id_kota' => $id_kota, 'id_dapil' => $id_dapil])->result();

				$data['data_suara'] = $kecamatan;
				$data['kota'] = $id_kota;

			}
			$data['provinsi'] = $id_provinsi;
			$data['legislatif'] = $data_caleg_filter['bagian'];
			$this->load->view("dashboard/caleg", $data);
		}
		
		public function tps(){
			$this->load->view("dashboard/tps");
		}

		public function view(){
			$this->load->view("dashboard/view");
		}
	}
?>