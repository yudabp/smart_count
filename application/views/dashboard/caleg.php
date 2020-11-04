<!doctype html>
<html class="no-js " lang="en">
<?php $this->load->view("template_config/head"); ?>
<body class="theme-purple">
<style type="text/css">
    /*.table-striped tbody tr:nth-of-type(odd){
        background-color: transparent;
    }*/

    #nama{
    color: #261010 !important;
}

</style>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../assets/images/logo.png" width="48" height="48" alt="Oreo"></div>
        <p>Mohon Tunggu Sebentar</p>        
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" width="30" alt="KPU"><span class="m-l-10">Smart Count - 2019</span></a>
            </div>
        </li>
    </ul>
</nav>

<?php  
    $this->load->view("template_config/sidebar");
?>
<!-- Body -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <center>
                <h2>Smart Count
                <small>Perolehan Suara</small>
                </h2>
            </center>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
    </ul>
    <ul class="nav nav-tabs">
    </ul>
    <ul class="nav nav-tabs">
    </ul>
     <!--<div class="user-info">-->
    <div class="container-fluid">
        <div class="row clearfix">
            <?php
                $id_user = $this->session->userdata("id_user");
                foreach($data_suara as $row){
                    //Menampilkan Kab kota
                    if($legislatif == "DPR RI" || $legislatif == "DPRD Provinsi"){
                        $id_kota = $row->id_kota;
                        $data_kota = $this->db->get_where("kota", ['id_kota' => $id_kota])->row_array();
                        $total_suara_pribadi = 0;
                        $total_suara_partai = 0;

                        //Memasukkan data suara
                        $data_suara = $this->db->get_where("suara", ['id_caleg' => $id_user, 'id_kota' => $id_kota])->result();
                        foreach($data_suara as $hasil){
                            $total_suara_partai += $hasil->total_suara_partai;
                            $total_suara_pribadi += $hasil->total_suara_pribadi;
                        }

                        //Data Target
                        $data_target = $this->db->get_where("suara_target", ['id_caleg' => $id_user, 'id_provinsi' => $provinsi, 'id_kota' => $id_kota,])->row_array();

                        $target = $data_target['target'];
                        $control_data = $id_kota;
                        $type = "kabupaten";

                        $filter_data = explode(" ",$data_kota['kota']);
                        $kota = $filter_data[0];
                        if($kota == "KOTA"){
                            $title = $data_kota['kota'];
                        }
                        else{
                            $title = "KAB. ".$data_kota['kota'];
                        }
                    }
                    //Menampilkan Kab Kota
                    else if($legislatif == "DPD RI"){
                        $total_suara_pribadi = 0;
                        $total_suara_partai = 0;

                        //Memasukkan data suara
                        $data_suara = $this->db->get_where("suara", ['id_caleg' => $id_user, 'id_kota' => $row->id_kota])->result();
                        foreach($data_suara as $hasil){
                            $total_suara_partai += $hasil->total_suara_partai;
                            $total_suara_pribadi += $hasil->total_suara_pribadi;
                        }

                        //Data Target
                        $data_target = $this->db->get_where("suara_target", ['id_caleg' => $id_user, 'id_provinsi' => $provinsi, 'id_kota' => $row->id_kota,])->row_array();

                        $target = $data_target['target'];

                        $control_data = $row->id_kota;
                        $type = "kabupaten";
                        
                        $filter_data = explode(" ",$row->kota);
                        $kota = $filter_data[0];
                        if($kota == "KOTA"){
                            $title = $row->kota;
                        }
                        else{
                            $title = "KAB. ".$row->kota;
                        }
                    }

                    //Menampilkan Kecamatan
                    else if($legislatif == "DPRD Kab/Kota"){
                        $id_kecamatan = $row->id_kecamatan;
                        $total_suara_pribadi = 0;
                        $total_suara_partai = 0;

                        //Memasukkan data suara
                        $data_suara = $this->db->get_where("suara", ['id_caleg' => $id_user, 'id_kecamatan' => $id_kecamatan])->result();
                        foreach($data_suara as $hasil){
                            $total_suara_partai += $hasil->total_suara_partai;
                            $total_suara_pribadi += $hasil->total_suara_pribadi;
                        }

                        //Data Target
                        $data_target = $this->db->get_where("suara_target", ['id_caleg' => $id_user, 'id_provinsi' => $provinsi, 'id_kota' => $kota, 'id_kecamatan' => $id_kecamatan])->row_array();

                        $target = $data_target['target'];
                        $control_data = $kota;
                        $type = "kecamatan";
                        $title = "KEC. ".$row->kecamatan;

                        // $presentase = 10;
                    }

                    if($total_suara_pribadi >= $target){
                        $total = 100;
                    }
                    else if(($total_suara_pribadi > 0 && $total_suara_pribadi <= $target) && ($target > 0 && $target >= $total_suara_pribadi)){
                        $total = ($total_suara_pribadi/$target) * 100;
                    }
                    else{
                        $total = 0;
                    }

                    $presentase = number_format($total,2,',','.');
                    $target = number_format($target,0,',','.');
                    $total_suara_pribadi = number_format($total_suara_pribadi,0,',','.');
                    $total_suara_partai = number_format($total_suara_partai,0,',','.');
                    $control = base64_encode(base64_encode($control_data));

                    ?>
                        <div class="col-lg-4">
                            <div class="card">                   
                                <div class="body text-center">
                                    <p class="text-muted m-b-0"><a href="<?php echo base_url()?>view"><?php echo $title; ?></a></p>
                                    <hr></hr>
                                    <input type="text" class="knob" value="<?php echo $presentase; ?>" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#247f16" readonly>
                                    <div class="row clearfix">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <a href="javascript:void(0);">
                                                    <?php
                                                        if($legislatif == "DPR RI" || $legislatif == "DPRD Provinsi" || $legislatif == "DPD RI"){
                                                            ?>
                                                    <div onclick="target_suara('<?php echo $control ?>', '<?php echo $type; ?>');">
                                                            <?php
                                                        }
                                                        else if($legislatif == "DPRD Kab/Kota"){
                                                            ?>
                                                    <div onclick="target_suara('<?php echo $control ?>', '<?php echo $type; ?>', '<?php echo base64_encode(base64_encode($row->id_kecamatan)); ?>');">
                                                            <?php
                                                        }
                                                    ?>
                                                        <small>Target Suara</small>
                                                        <span><p><?php echo $target; ?></p></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <small><a href="<?php echo base_url()?>suara_view">Suara Masuk</a></small>
                                                <small><p><?php echo $total_suara_pribadi; ?></p></small>
                                            </div>
                                        </div>
                                        <!--<div class="row clearfix">-->
                                        <div class="col-lg-12">
                                            <!--<div class="card">-->
                                            <small><center><a href="#">Suara Partai</a></center></small>
                                            <small><p><?php echo $total_suara_partai; ?></p></small>
                                        </div>
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>  
                    <?php
                }
            ?>
        </div>
    </div>
</section>
<?php
    $this->load->view("template_config/js");
?>
<script type="text/javascript">
<?php
    if($legislatif == "DPR RI" || $legislatif == "DPRD Provinsi" || $legislatif == "DPD RI"){
        ?>
    function target_suara(id_control, type){
        <?php
    }
    else if($legislatif == "DPRD Kab/Kota"){
        ?>
    function target_suara(id_control, type, id_kecamatan){
        <?php
    }
?>
        swal({
            title: "Masukkan Target Suara",
            text: "",
            type: "input",
            inputType : "number",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: ""
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("Anda harus memasukkan target suara"); return false
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>suara_targeting",
                    data: { 
                        target : inputValue, 
                        <?php
                            if($legislatif == "DPRD Kab/Kota"){
                                ?>
                        id_kecamatan : id_kecamatan,
                                <?php
                            }
                        ?>
                        id_control : id_control, 
                        type : type
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if(data.checking == "Yes"){
                            swal({
                                title : "Semoga sukses!",
                                text : "Anda memasukkan target suara sebesar : " + inputValue,
                                type : "success"
                            }, function(){
                                location.reload();
                            });
                        }
                        else if(data.checking == "No"){
                            swal({
                                title : "Oops!",
                                text : "Gagal memasukkan target suara",
                                type : "error"
                            });
                        }
                    },
                    error : function(jqHXR, errorThrown, textStatus){
                        swal({
                            title : "Oops!",
                            text : "Periksa koneksi internet anda",
                            type : "error"
                        });
                    }
                });
            }
            // $("#coba span").html(inputValue);
        });
    }

</script>
</body>
</html>