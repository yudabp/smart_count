<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image"><a href="profile.html"><img src="../assets/images/profile_av.jpg" alt="User"></a></div>
                            <div class="detail">
                                <?php  
                                    $level = $this->session->userdata("level");
                                    if($level == "Admin"){
                                        ?>
                                <h4>Selamat Datang</h4>
                                <small>Di Halaman Admin</small>
                                        <?php
                                    }
                                    else if($level == "Caleg"){
                                        $id_caleg = $this->session->userdata("id_user");

                                        $data_caleg_filter = $this->db->query("SELECT * FROM user WHERE id_user='$id_caleg'")->row_array();

                                        $nama = $data_caleg_filter['nama'];
                                        $legislatif = $data_caleg_filter['area_pemilihan'];
                                        ?>
                                <h4><?php echo $nama; ?></h4>
                                <small>Calon <?php echo $legislatif; ?></small>
                                        <?php
                                    }
                                    else if($level == "Saksi"){
                                        $id_user = $this->session->userdata("id_user");
                                        $data_saksi = $this->db->get_where("saksi", ['id_saksi' => $id_user])->row_array();
                                        $id_caleg = $data_saksi['id_caleg'];
                                        $data_caleg = $this->db->get_where("user", ['id_user' => $id_caleg, 'level' => 'Caleg'])->row_array();
                                        ?>
                                <h4><?php echo $data_caleg['nama']; ?></h4>
                                <small>Saksi <?php echo $data_caleg['area_pemilihan']; ?></small>
                                        <?php
                                    }
                                ?>
                            </div>                            
                        </div>
                    </li>
                    <?php  
                        if($level == "Admin"){
                    ?>
                    <!-- <li class="header">Data</li> -->
                    <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";};?>">
                        <a href="<?php echo base_url(); ?>dashboard"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(1)=="dpr_ri"){echo "active";};?>">
                        <a href="<?php echo base_url(); ?>dpr_ri"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>DPR RI</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(1)=="dpd_ri"){echo "active";};?>">
                        <a href="<?php echo base_url(); ?>dpd_ri">
                            <i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>DPD RI</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(1)=="dprd_provinsi"){echo "active";};?>">
                        <a href="<?php echo base_url(); ?>dprd_provinsi"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>DPRD Provinsi</span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(1)=="dprd_kota"){echo "active";};?>">
                        <a href="<?php echo base_url(); ?>dprd_kota"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>DPRD Kab/Kota</span>
                         </a>
                    </li>
                    <?php  
                        }

                        else if($level == "Caleg"){
                            ?>
                    <li>
                        <a href="<?php echo base_url();?>dashboard"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- <li  style="display: <?php 
                            // if($this->uri->segment(1)=="tps"){
                            //     echo "none;";
                            // }
                        ?>
                    ">
                        <a href="<?php echo base_url();?>tps"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>Daftar TPS</span>
                        </a>
                    </li> -->
                    


                    <!-- <li style="display: <?php
                            if($this->uri->segment(1)=="dashboard"){
                                echo "none;";
                            }
                            else if($this->uri->segment(1)=="tps"){
                                echo "block;";
                            } 
                        ?>
                    ">
                        <a href="<?php echo base_url(); ?>dashboard"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i>
                            <span>Kembali</span>
                        </a>
                    ---------
                    </li> -->
                   <!--  <li>
                        <div class="user-info">
                                <div class="image"><a href="profile.html"><img src="<?php echo base_url('assets/images/eko.jpg') ?>" alt="User"></a></div>
                                    <div class="detail">
                                        <div class="navbar-header"></div>
                                            <h4>Hartono Ekowadi, SH</h4>
                                <small>Caleg DPRD Medan</small>                        
                            </div>
                        </div>
                    </li> -->
                            <?php
                        }

                        else if($level == "Saksi"){
                            ?>
                    <li class="active open"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i><span>Dashboard</span></a>
                        <ul class="ml-menu">
                        </ul>
                    </li>
                            <?php
                        }
                    ?>
                    <li> <a href="<?php echo base_url(); ?>logout"></i><span>Logout</span></a>
                </ul>
            </div>
        </div>
    </div>    
</aside>