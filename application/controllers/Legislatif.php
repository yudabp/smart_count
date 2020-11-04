<?php  
	class Legislatif extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata("status") == FALSE || $this->session->userdata("level") != "Admin"){
				redirect("login");
			}
		}

        public function dpd_ri(){
            $data['caleg'] = $this->db->query("SELECT * FROM user JOIN user_filter ON user.id_user=user_filter.id_user JOIN provinsi ON user_filter.id_provinsi=provinsi.id_provinsi WHERE user.area_pemilihan='DPD RI'")->result();
			$this->load->view("legislatif/dpd_ri", $data);
        }
        
        public function dpr_ri(){
            $data['caleg'] = $this->db->query("SELECT * FROM user JOIN user_filter ON user.id_user=user_filter.id_user WHERE user.area_pemilihan='DPR RI'")->result();
            $this->load->view("legislatif/dpr_ri", $data);
        }
        
		public function dprd_kota(){
            $data['caleg'] = $this->db->query("SELECT * FROM user JOIN user_filter ON user.id_user=user_filter.id_user JOIN provinsi ON user_filter.id_provinsi=provinsi.id_provinsi WHERE user.area_pemilihan='DPRD Kab/Kota'")->result();
			$this->load->view("legislatif/dprd_kota", $data);
        }
        
		public function dprd_provinsi(){
            $data['caleg'] = $this->db->query("SELECT * FROM user JOIN user_filter ON user.id_user=user_filter.id_user JOIN provinsi ON user_filter.id_provinsi=provinsi.id_provinsi WHERE user.area_pemilihan='DPRD Provinsi'")->result();
			$this->load->view("legislatif/dprd_provinsi", $data);
		}
	}
?>