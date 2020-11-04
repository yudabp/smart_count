<?php
    class Generate_user extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        //For DPR RI
        function dprd_kab_kota($id_user, $level){
            //Data Contoh
            //id_dapil = 7613765;
            //id_provinsi = 2;
            //id_kota = 3357764;
            if($level == "Caleg"){
                //Get Data User Filter
                $check_filter = $this->db->get_where("user_filter", ['id_user' => $id_user, 'bagian' => "DPRD Kab/Kota", 'data_activation' => 'Active']);
                if($check_filter->num_rows() > 0){
                    $user_filter = $check_filter->row_array();

                    $id_provinsi = $user_filter['id_provinsi'];
                    $id_dapil = $user_filter['id_dapil'];

                    //Get Data Dapil
                    $check_dapil = $this->db->get_where("dapil", ['id_provinsi' => $id_provinsi, 'id_dapil' => $id_dapil, 'area_pemilihan' => 'kab_kota']);
                    if($check_dapil->num_rows() > 0){
                        $dapil = $check_dapil->row_array();

                        $id_kota = $dapil['id_kota'];
                        $dapil_name = $dapil['dapil'];

                        //Get Data Kota
                        $check_kota = $this->db->get_where("kota", ['id_provinsi' => $id_provinsi, 'id_kota' => $id_kota]);
                        if($check_kota->num_rows() > 0){
                            $kota = $check_kota->row_array();
                            $kota_name = $kota['kota'];
                        }
                        else{
                            $kota_name = "";
                            $result = "error";
                        }

                        //Get Data Kecamatan
                        $check_kecamatan = $this->db->get_where("kecamatan", ['id_dapil' => $id_dapil]);
                        if($check_kecamatan->num_rows() > 0){
                            
                            //Melakukan perulangan untuk kecamatan
                            foreach($check_kecamatan->result() as $kecamatan){
                                $id_kecamatan = $kecamatan->id_kecamatan;

                                //Get Data Kelurahan
                                $check_kelurahan = $this->db->get_where("kelurahan", ['id_kecamatan' => $id_kecamatan]);
                                if($check_kelurahan->num_rows() > 0){
                                    
                                    //Melakukan perulangan untuk kelurahan
                                    foreach($check_kelurahan->result() as $kelurahan){
                                        $id_kelurahan = $kelurahan->id_kelurahan;

                                        //Get Data TPS
                                        $check_tps = $this->db->get_where("tps", ['id_kelurahan' => $id_kelurahan]);
                                        if($check_tps->num_rows() > 0){
                                            
                                            //Melakukan perulangan untuk tps
                                            foreach($check_tps->result() as $tps){
                                                $id_tps = $tps->id_tps;
                                            }
                                        }
                                        else{
                                            continue;
                                        }
                                    }
                                }
                                else{
                                    continue;
                                }
                            }
                        }
                        else{
                            $result = "error";
                        }
                    }
                    else{
                        $result = "error";
                    }
                }
                else{
                    $result = "error";
                }
            }
            else{
                $result = "error";
            }

            //Kembalikan hasil untuk AJAX 
            return $result;
        }
    }
?>