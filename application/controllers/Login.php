<?php  
	class Login extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata("status") == TRUE){
				redirect("dashboard");
			}
		}

		public function index(){	
			$this->load->view("first_page/login");
			// echo $this->encrypt->decode("rGzgNxgqa+ylIWPWT+Xw0ZSxCdSRVuHZ8I3us1rn02oZam0AcwUfTX0269NABp3vbBgEeddTG+vkq71YvfmSXg==");
		}

		public function action(){
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$pengguna = $this->input->post("pengguna");

			if($pengguna == "Admin" || $pengguna == "Caleg"){
				$check_data = $this->db->get_where("user", ['username' => $username, 'level' => $pengguna]);
			}
			else if($pengguna == "Saksi"){
				$check_data = $this->db->get_where("saksi", ['username' => $username]);
			}
			else{
				redirect("login");
			}

			//Check jika ada data
			if($check_data->num_rows() > 0){
				$data = $check_data->row_array();
				//Check jika password yang dimasukan sama
				if($password == $this->encrypt->decode($data['password'])){
					if($pengguna == "Admin"){
						$checking = "Yes";
						$msg = "Anda akan diarahkan ke halaman login dalam beberapa detik";
						$type = "success";
						$this->session->set_userdata(array(
							"id_user" => $data['id_user'],
							"level" => $data['level'],
							"status" => TRUE
						));
					}
					else if($pengguna == "Caleg"){
						$id_user = $data['id_user'];
						$check_confirmation = $this->db->get_where("user_filter", ['id_user' => $id_user])->row_array();
						if($check_confirmation['data_activation'] == "Active"){
							$checking = "Yes";
							$msg = "Anda akan diarahkan ke halaman login dalam beberapa detik";
							$type = "success";
							$this->session->set_userdata(array(
								"id_user" => $data['id_user'],
								"level" => $data['level'],
								"status" => TRUE
							));
						}
						else if($check_confirmation['data_activation'] == "No"){
							$checking = "No";
							$msg = "Anda belum memilki akses untuk login";
							$type = "error";
						}
					}
					else if($pengguna == "Saksi"){
						$id_user = $data['id_saksi'];
						$id_caleg = $data['id_caleg'];
						
						$check_confirmation = $this->db->get_where("user_filter", ['id_user' => $id_caleg])->row_array();
						if($check_confirmation['data_activation'] == "Active"){
							$checking = "Yes";
							$msg = "Anda akan diarahkan ke halaman login dalam beberapa detik";
							$type = "success";
							$this->session->set_userdata(array(
								"id_user" => $id_user,
								"level" => "Saksi",
								"status" => TRUE
							));
						}
						else if($check_confirmation['data_activation'] == "No"){
							$checking = "No";
							$msg = "Anda belum memilki akses untuk login";
							$type = "error";
						}
					}
					else{
						$checking = "No";
						$msh = "Username atau password salah!";
						$type = "error";
					}
				}
				else{
					$checking = "No";
					$msg = "Username atau password salah!";
					$type = "error";
				}
			}else{
				$checking = "No";
				$msg = "Username atau password salah!";					
				$type = "error";
			}

			$data = array(
				"checking" => $checking,
				"msg" => $msg,
				"type" => $type
			);
			echo json_encode($data);
		}

		public function admin(){
			$this->load->view("first_page/login_admin");
		}
	}
?>	