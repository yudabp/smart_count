<?php
    class Suara extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if($this->session->userdata("status") == FALSE || $this->session->userdata("level") == "Admin"){
                redirect("login");
            }
        }

        public function suara_view(){
            if($this->session->userdata('level') != "Caleg"){
                redirect("level");
            }

            $id_caleg = $this->session->userdata("id_user");

            $data_user_filter = $this->db->get_where("user_filter", ['id_user' => $id_caleg])->row_array();

            $bagian = $data_user_filter['bagian'];
            $id_provinsi = $data_user_filter['id_provinsi'];

            if($bagian == "DPR RI" || $bagian == "DPRD Provinsi"){
                $id_dapil = $data_user_filter['id_dapil'];
                $data_dapil = $this->db->get_where("dapil", ['id_dapil' => $id_dapil])->row_array();

                $nama_dapil = $data_dapil['dapil'];
                $dapil = $this->db->get_where("dapil", ['dapil' => $nama_dapil])->result();

                $data['id_dapil'] = $id_dapil;
                $data['kota'] = $dapil;
            }
            else if($bagian == "DPD RI"){
		
				$data_kota = $this->db->get_where("kota", ['id_provinsi' => $id_provinsi])->result();

				$data['kota'] = $data_kota;
            }
            else if($bagian == "DPRD Kab/Kota"){
                $id_dapil_dua = $data_user_filter['id_dapil'];

				$data_dapil_dua = $this->db->get_where("dapil_selanjutnya", ['id_dapil_dua' => $id_dapil_dua])->row_array();

				$id_dapil = $data_dapil_dua['id_dapil'];

                $dapil = $this->db->get_where("dapil", ['id_dapil' => $id_dapil, 'area_pemilihan' => "kab_kota"])->row_array();


				$id_kota = $dapil['id_kota'];
                $data_kota = $this->db->get_where("kota", ['id_kota' => $id_kota])->row_array();

                $data['id_dapil'] = $id_dapil;
                $data['id_kota'] = $id_kota;
                $data['nama_kota'] = $data_kota['kota'];
            }
            
            $data_provinsi = $this->db->get_where("provinsi", ['id_provinsi' => $id_provinsi])->row_array();

            $data['nama_provinsi'] = $data_provinsi['provinsi'];    
            $data['id_provinsi'] = base64_encode(base64_encode($id_provinsi));

            $total_suara = 0;

            $data_suara = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_provinsi' => $id_provinsi])->result();
            foreach($data_suara as $row){
                $total_suara += $row->total_suara_pribadi;
            }


            $data['suara_provinsi'] = number_format($total_suara,0,',','.');
            $data['id_caleg'] = $id_caleg;
            $data['legislatif'] = $bagian;
            
            $this->load->view("suara/view", $data);
        }

        public function suara_adding(){
            $id_saksi = $this->session->userdata("id_user");
            
            $data_saksi = $this->db->get_where("saksi", ['id_saksi' => $id_saksi])->row_array();

            $id_provinsi = $data_saksi['id_provinsi'];
            $id_kota = $data_saksi['id_kab_kota'];
            $id_kecamatan = $data_saksi['id_kecamatan'];
            $id_kelurahan = $data_saksi['id_kelurahan'];
            $id_caleg = $data_saksi['id_caleg'];
            $id_tps = $data_saksi['id_tps'];

            $total_suara_pribadi = $this->input->post("suara_pribadi");
            $total_suara_partai = $this->input->post("suara_partai");

            if($total_suara_pribadi == "" && $total_suara_partai == ""){
                redirect("login");
            }

            //Untuk sementara, fungsi upload foto dinonaktifkan
            $bukti = "";

            //Check data terlebih dahulu
            $check_data = $this->db->get_where("suara", ['id_saksi' => $id_saksi])->num_rows();
            //Jika sudah ada, maka melakukan update
            if($check_data == 1){
                $checking = "Yes";
                //Set Where
                $where = array(
                    "id_caleg" => $id_caleg,
                    "id_provinsi" => $id_provinsi,
                    "id_kota" => $id_kota,
                    "id_kecamatan" => $id_kecamatan,
                    "id_kelurahan" => $id_kelurahan,
                    "id_tps" => $id_tps,
                    "id_saksi" => $id_saksi
                );
                //Set Data
                $data = array(
                    "total_suara_pribadi" => $total_suara_pribadi,
                    "total_suara_partai" => $total_suara_partai,
                    "bukti" => $bukti
                );

                $this->db->update("suara", $data, $where);
            }
            //Jika belum ada maka melakukan insert
            else if($check_data == 0){
                $checking = "Yes";
                //Set Data
                $data = array(
                    'id_suara' => "", //Autoincrement
                    "id_caleg" => $id_caleg,
                    "id_provinsi" => $id_provinsi,
                    "id_kota" => $id_kota,
                    "id_kecamatan" => $id_kecamatan,
                    "id_kelurahan" => $id_kelurahan,
                    "id_tps" => $id_tps,
                    "id_saksi" => $id_saksi,
                    "total_suara_pribadi" => $total_suara_pribadi,
                    "total_suara_partai" => $total_suara_partai,
                    "bukti" => $bukti
                );

                $this->db->insert("suara", $data);
            }
            else{
                $checking = "No";
            }

            $data = array("checking" => $checking);

            echo json_encode($data);
        }

        public function target_adding(){
            $id_caleg = $this->session->userdata("id_user");
            $target = $this->input->post("target");
            $id_control = $this->input->post("id_control");
            $id_kota = base64_decode(base64_decode($id_control));
            $type = $this->input->post("type");

            $data_caleg = $this->db->get_where("user_filter", ['id_user' => $id_caleg])->row_array();
            $id_provinsi = $data_caleg['id_provinsi'];

            if($type == "kecamatan"){
                $kecamatan = $this->input->post("id_kecamatan");
                $id_kecamatan = base64_decode(base64_decode($kecamatan));
            }
            else{
                $id_kecamatan = "";
            }

            //Check data for target
            $where = array(
                "id_caleg" => $id_caleg,
                "id_provinsi" => $id_provinsi,
                "id_kota" => $id_kota,
                "id_kecamatan" => $id_kecamatan
            );

            $check_data = $this->db->get_where("suara_target", $where);
            //Jika sudah ada, maka melakukan updating
            if($check_data->num_rows() == 1){
                $checking = "Yes";
                $data_target = $check_data->row_array();
                $id_target = $data_target['id_target'];

                $data = array(
                    "target" => $target
                );

                $this->db->update("suara_target", $data, ['id_target' => $id_target]);
            }
            //Jika belum, maka melakukan inserting
            else if($check_data->num_rows() == 0){
                $checking = "Yes";
                $data = array(
                    "id_target" => "", //Autoincrement
                    "id_caleg" => $id_caleg,
                    "id_provinsi" => $id_provinsi,
                    "id_kota" => $id_kota,
                    "id_kecamatan" => $id_kecamatan,
                    "target" => $target
                );

                $this->db->insert("suara_target", $data);
            }
            else{
                $checking = "No";
            }

            $data = array("checking" => $checking);

            echo json_encode($data);
        }
    }
?>