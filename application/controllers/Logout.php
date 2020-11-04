<?php
    class Logout extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if($this->session->userdata("status") == FALSE){
                redirect("login");
            }
        }
        
        public function index(){
            session_destroy();
    		$this->session->sess_destroy();
    		redirect("login");
        }
        
        
    }
?>