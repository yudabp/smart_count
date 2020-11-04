<?php
    class User extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if($this->session->userdata("status") == FALSE || $this->session->userdata("level") != "Admin"){
                redirect("login");
            }
        }

        public function generate(){
            $id = $this->input->get("for");
            $id_user = base64_decode(base64_decode($id));
            $check_user = $this->db->get_where("user", ['id_user' => $id_user, 'level' => "Caleg"])->num_rows();
            if($check_user > 0){
                $data['provinsi'] = $this->db->get("provinsi")->result();
                $this->load->view("generate/generate", $data);
            }
            else{
                redirect("login");
            }
        }

        //Generate User for Saksi
        public function generate_user(){
            $id = $this->input->post('id');
            $id_user = base64_decode(base64_decode($id));
            $username_format = $this->input->post("username_format");
            $provinsi = $this->input->post('provinsi');
            $kota = $this->input->post('kota');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');

            $check_user = $this->db->get_where("user", ['id_user' => $id_user, 'level' => "Caleg"]);
            if($check_user->num_rows() > 0){
                $data_user = $check_user->row_array();
                $no_telp = $data_user['no_telp'];

                //Checking Data TPS Kelurahan
                $check_kelurahan = $this->db->get_where("tps", ['id_kelurahan' => $kelurahan]);
                if($check_kelurahan->num_rows() > 0){
                    $checking = "Yes";

                    //Melakukan perulangan untuk generate user
                    $i = 1;
                    foreach($check_kelurahan->result() as $row){
                        $id_tps = $row->id_tps;
                        $username = $username_format.$i;

                        //Checking username
                        $check_username = $this->db->get_where("saksi", ['username' => $username])->num_rows();
                        if($check_username > 0){
                            $checking = "No";
                            continue;
                        }
                        else{
                            $password = $this->encrypt->encode($no_telp);

                            $data = array(
                                "id_saksi" => "", //Autoincrement untuk mencegah terjadi nya tabrakan data
                                "id_provinsi" => $provinsi,
                                "id_kab_kota" => $kota,
                                "id_kecamatan" => $kecamatan,
                                "id_kelurahan" => $kelurahan,
                                "id_caleg" => $id_user,
                                "id_tps" => $id_tps,
                                "username" => $username,
                                "password" => $password
                            );

                            $this->db->insert("saksi", $data);

                            $checking = "Yes";
                        }
                        $i++;
                    }
                }
                else{
                    $checking = "No";
                }
            }
            else{
                $checking = "No";
            }

            $data = array("checking" => $checking);

            echo json_encode($data);
        }

        //Delete User for caleg
        public function delete_caleg(){
            $id = $this->input->post('id_user');
            $id_user = base64_decode(base64_decode($id));

            //Deleting
            $check_user = $this->db->get_where("user", ['id_user' => $id_user])->num_rows();
            if($check_user > 0){
                $checking = "Yes";
                
                //User Caleg
                $this->db->delete("user", ['id_user' => $id_user, 'level' => 'Caleg']);
                $this->db->delete("user_filter", ['id_user' => $id_user]);

                //Saksi nya si Caleg
                $this->db->delete("saksi", ['id_caleg' => $id_user]);

                //Suara si Caleg
                $this->db->delete("suara", ['id_caleg' => $id_user]);
                $this->db->delete("suara_target", ['id_caleg' => $id_user]);
            }
            else{
                $checking = "No";
            }
            
            $data = array("checking" => $checking);
            echo json_encode($data);
        }

        //Delete User for saksi
        public function delete_user(){
            $id = $this->input->post('id');
            $id_user = base64_decode(base64_decode($id));
            $provinsi = $this->input->post('provinsi');
            $kota = $this->input->post('kota');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');

            //Set Where
            $where = array(
                "id_provinsi" => $provinsi,
                "id_kab_kota" => $kota,
                "id_kecamatan" => $kecamatan,
                "id_kelurahan" => $kelurahan,
                "id_caleg" => $id_user
            );

            $check_data = $this->db->get_where("saksi", $where);
            if($check_data->num_rows() > 0){
                $checking = "Yes";
                //Melakukan Deleting Suara
                foreach($check_data->result() as $row){
                    $id_saksi = $row->id_saksi;

                    $this->db->delete("suara", ['id_saksi' => $id_saksi]);
                }
                
                //Melakukan Deleting
                $this->db->delete("saksi", $where);
            }
            else{
                $checking = "No";
            }

            $data = array("checking" => $checking);
            echo json_encode($data);
        }

        //Kabupaten Kota Selection
        public function provinsi_selector(){
			$provinsi = $this->input->get("isi");
			$check_data = $this->db->order_by("kota", 'ASC')->get_where("kota", ['id_provinsi' => $provinsi]);
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
        
        //Kecamatan Selection
        public function kota_selector(){
			$kota = $this->input->get("isi");
			$check_data = $this->db->order_by("kecamatan", 'ASC')->get_where("kecamatan", ['id_kota' => $kota]);
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
				"kecamatan" => $data
			);

			echo json_encode($json);
        }
        
        //Kelurahan Selection
        public function kecamatan_selector(){
			$kecamatan = $this->input->get("isi");
			$check_data = $this->db->order_by("kelurahan", 'ASC')->get_where("kelurahan", ['id_kecamatan' => $kecamatan]);
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
				"kelurahan" => $data
			);

			echo json_encode($json);
        }
        
        //Check Data Saksi
        public function saksi_checking(){
            $id = $this->input->post('id');
            $id_user = base64_decode(base64_decode($id));
            $provinsi = $this->input->post('provinsi');
            $kota = $this->input->post('kota');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');

            //Set Where
            $where = array(
                "id_provinsi" => $provinsi,
                "id_kab_kota" => $kota,
                "id_kecamatan" => $kecamatan,
                "id_kelurahan" => $kelurahan,
                "id_caleg" => $id_user
            );

            $check_data = $this->db->get_where("saksi", $where);
            if($check_data->num_rows() > 0){
                $checking = "Yes";
                $status = 2;
                $saksi = $check_data->result();
            }
            else{
                $checking = "No";
                $status = 1;
                $saksi = "";
            }

            $data = array(
                "checking" => $checking,
                "status" => $status,
                "saksi" => $saksi
            );

            echo json_encode($data);
        }
    }
?>