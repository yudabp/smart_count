<?php  
	class Register extends CI_Controller{

		public function __construct(){
			parent::__construct();
		}

		public function index(){
			if($this->session->userdata("status") == FALSE){
				$data['provinsi'] = $this->db->get("provinsi")->result();
				$data['kab_kota'] = $this->db->get('kota')->result();
				$data['dapil'] = $this->db->group_by("dapil")->get("dapil")->result();
				$this->load->view("first_page/register", $data);
			}
		}

		public function provinsi_selector(){
			$provinsi = $this->input->get("isi");
			$ap = $this->input->get("ap");
			if($ap == "dprri" || $ap == "dprprov"){
				$check_data = $this->db->query("SELECT * FROM dapil WHERE id_provinsi='$provinsi' AND area_pemilihan='$ap' GROUP BY dapil");
			}
			else if($ap == "kab_kota"){
				$check_data = $this->db->order_by("kota", 'ASC')->get_where("kota", ['id_provinsi' => $provinsi]);
			}
			if($check_data->num_rows() > 0){
				$data = $check_data->result();
				$checking = "Yes";
			}
			else{
				$checking = "No";
				$data = "";
			}

			$json = array(
				"checking" => $checking,
				"kota" => $data
			);

			echo json_encode($json);
		}

		public function username_checker(){
			$username = $this->input->post("username");

			//Check jika username ada yang sama
			$check_data = $this->db->get_where("user", ['username' => $username]);
			if($check_data->num_rows() > 0){
				$checking = "No";
			}
			else{
				$checking = "Yes";
			}

			$data = array("checking" => $checking);
			echo json_encode($data);
		}

		public function kota_selector(){
			$provinsi = $this->input->get("prov");
			$kota = $this->input->get("isi");
			$ap = $this->input->get("ap");
			$check_data = $this->db->query("SELECT * FROM dapil JOIN dapil_selanjutnya ON dapil.id_dapil=dapil_selanjutnya.id_dapil WHERE id_provinsi='$provinsi' AND id_kota='$kota' AND area_pemilihan='$ap' ORDER BY dapil_selanjutnya.id_dapil ASC");
			if($check_data->num_rows() > 0){
				$data = $check_data->result();
				$checking = "Yes";
			}
			else{
				$checking = "No";
				$data = "";
			}

			$json = array(
				"checking" => $checking,
				"dapil" => $data
			);

			echo json_encode($json);
		}


		//This register action for caleg only
		function action(){
			$nama = $this->input->post("nama_lengkap");
			$calon = $this->input->post("calon_legislatif");

			//Check Calon Legislatif
			if($calon == "dprri" || $calon == "dprprov"){
				$provinsi = $this->input->post("provinsi");
				$dapil = $this->input->post("dapil_selector");
				$kab_kota = "";
				if($calon == "dprri"){ 
					$calon = "DPR RI";
				}
				else if($calon == "dprprov"){ 
					$calon = "DPRD Provinsi";
				}
			}
			else if($calon == "dpdri"){
				$provinsi = $this->input->post("provinsi");
				$dapil = "";
				$kab_kota = "";
				$calon = "DPD RI";
			}
			else if($calon == "kab_kota"){
				$provinsi = $this->input->post("provinsi");
				$dapil = $this->input->post("dapil_selector");
				$kab_kota = $this->input->post("kab_kota");
				$calon = "DPRD Kab/Kota";
			}
			else{
				$provinsi = "";
				$dapil = "";
				$kab_kota = "";
			}

			$notelp = $this->input->post("notlp");
			$email = $this->input->post("email");
			$user = $this->input->post("username");
			$pass = $this->input->post("password");
			$tgl_daftar = date("Y-m-d");

			//Melakukan enkripsi agar tidak mudah diretas
			$pass_encrypt = $this->encrypt->encode($pass);
			$data_user = array(
			//  nama_field => value
				"id_user" => "", //Autoincrement
				"nama" => $nama,
				"email" => $email,
				"no_telp" => $notelp,
				"username" => $user,
				"password" => $pass_encrypt,
				"area_pemilihan" => $calon,
				"tgl_daftar" => $tgl_daftar,
				"level" => "Caleg"
			);
			//Insert dulu pertama 
			$this->db->insert("user", $data_user);

			//Ambil id_user untuk user_filter
			$check_data = $this->db->get_where("user", ["nama" => $nama,"email" => $email, "no_telp" => $notelp, "username" => $user, "level" => "Caleg"]);
			if($check_data->num_rows() > 0){
				$data = $check_data->row_array();
				//Melakukan insert ke user_filter
				$id_user = $data['id_user'];

				$data_user_filer = array(
					"id_filter" => "", //Autoincrement
					"id_user" => $id_user,
					"bagian" => $calon,
					"id_provinsi" => $provinsi,
					"id_kota" => $kab_kota,
					"id_dapil" => $dapil,
					"data_activation" => "No"
				);

				$this->db->insert("user_filter", $data_user_filer);
			}

			$data = array("result" => "success", "nama_caleg" => $nama);
			echo json_encode($data);
		}
	}
?>