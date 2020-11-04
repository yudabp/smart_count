<!doctype html>
<html class="no-js " lang="en">
<head>
<?php $this->load->view("template_config/head"); ?>
<style type="text/css">
    button .filter-option, .dropdown-toggle:after{
        color: #fff !important;
    }

    button{
        color: #ffff !important;
        border-color: #ffffff !important;
        /*background-color: #00000 !important;*/
        /*margin-top: 5px !important;*/
        margin-bottom: 10px !important;
        margin-left: auto !important;
        padding-top: 10px !important;
        padding-left: 20px !important;
        padding-right: 23px !important;
    }
    /*.theme-purple .theme-primary{
        background: #ffff !important;
    }*/
    /*.page-header{
        margin-top: 7% !important;
    }*/
    header{
        /*margin-top: 1000px !important;*/
    }

    form-group {
        margin-top: 0px !important;
    }

    nav{
        color: red;
    }

    .page-header{
        /*background: #ffff !important;*/
        width: 100% !important;
        height: 850px !important;
        /*margin-top: 200px !important;*/
    }

    footer{
        margin-top: 200px !important;
    }
    #rgs{
        color: #ffff !important;
    }
   
</style>
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top" style="color: #fff">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Oreo</a>
                <a class="navbar-brand" href="index.html"><img src="../assets/images/kpu.png" width="30" alt="KPU"><span class="m-l-10">KPU</span></a> -->
            <!-- <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button> -->
        </div>
        
    </div>
</nav>
<!-- End Navbar -->
<div class="blok">
<div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo base_url(); ?>assets/images/logo7.jpeg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain" id="abc">
             <form class="form" method="post" action="register" enctype="multipart/form-data">
                <div class="card-plain">
                    <div class="header">
                        <div class="logo-container">
                            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="">
                        </div>
                        <h5>Sign Up</h5>
                        <span></span>
                    </div>
                    <div class="content">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nama Calon Legislatif" name="nama_lengkap" style="background:transparent;" id="nama_lengkap">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-pin-account zmdi-hc-fw"></i>
                                    </span>
                            </div>
                        <!-- </div> -->
                       <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <!-- <div class="form-group"> -->
                                    <select class="form-control show-tick select2" data-placeholder="Select" id="calon_legislatif" title="Calon Legislatif" name="calon_legislatif">
                                        <option value="dprri">DPR RI</option>
                                        <option value="dpdri">DPD RI</option>
                                        <option value="dprprov">DPRD Provinsi</option>
                                        <option value="kab_kota">DPRD Kab/Kota</option>
                                    </select>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="row clearfix" style="display: none;" id="provinsi">
                            <div class="col-lg-12 col-md-12">
                                <!-- <div class="form-group"> -->
                                    <select class="form-control show-tick select2" data-placeholder="Select" id="provinsi" title="Provinsi" name="provinsi">
                                        <?php  
                                            foreach($provinsi as $row){
                                                ?>
                                                    <option value="<?php echo $row->id_provinsi ?>"><?php echo $row->provinsi; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                <!-- </div>     -->
                            </div>
                        </div>
                        <div class="row clearfix" style="display: none;" id="dapil_kota">
                            <div class="col-lg-12 col-md-12">
                                <!-- <div class="form-group"> -->
                                    <select class="form-control show-tick" data-placeholder="Select" id="kab_kota" title="Kabupaten / Kota" name="kab_kota">
                                        <!-- <?php  
                                            foreach($kab_kota as $row){
                                                ?>
                                                    <option value="<?php echo $row->id_kota ?>"><?php echo $row->kota; ?></option>
                                                <?php
                                            }
                                        ?> -->
                                    </select>
                                <!-- </div> -->
                            </div>                                
                        </div>
                          <div class="row clearfix" style="display: none;" id="dapil">
                            <div class="col-lg-12 col-md-12">
                                <!-- <div class="form-group"> -->
                                    <select class="form-control show-tick" data-placeholder="Select" id="dapil_selector" title="Daerah Pemilihan" name="dapil_selector">
                                       <!-- <?php  
                                            foreach($dapil as $row){
                                                ?>
                                                    <option value="<?php echo $row->id_dapil ?>"><?php echo $row->dapil; ?></option>
                                                <?php
                                            }
                                        ?> -->
                                    </select>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div>
                        <div class="form-group">                  
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nomor Telepon" name="notlp" id="notlp">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-phone zmdi-hc-fw"></i>
                                    </span>                          
                            </div>
                        </div>
                        <div class="form-group">                        
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-email zmdi-hc-fw"></i>
                                    </span>                          
                            </div>
                        </div>
                        <div class="form-group">       
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-account-circle"></i>
                                    </span>                      
                            </div>
                            <div class="form-group">             
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-lock"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="checkbox">
                            <input id="terms" type="checkbox">
                            <label for="terms">
                                    I read and agree to the <a href="javascript:void(0);">terms of usage</a>
                            </label>
                    </div> -->
    <!-- <table bgcolor="red" device-width="100%"> -->
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light" name="tekan">REGISTER</button></div>                      
                    </div>
                    <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>Designed by <a href="http://www.n56ht.com/" target="_blank">InSight MarkComm</a></span>
            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>


<?php 
    $this->load->view("template_config/js");
?>
<script type="text/javascript">
    $(document).ready(function(){
        // $(".select2").select2();

        $(".navbar-toggler").on('click',function() {
            $("html").toggleClass("nav-open");
        });
        $("#calon_legislatif").on("change", function(e){
            var dpri = $(this).val();
            if (dpri == "dprri"){
                $("#provinsi").show();
                $("#dapil").show();
                $("#dapil_kota").hide();
            }

            else if(dpri == "dpdri"){
                $("#provinsi").show();
                $("#dapil").hide();
                $("#dapil_kota").hide();
            }

            else if(dpri == "dprprov"){
                $("#provinsi").show();
                $("#dapil").show();
                $("#dapil_kota").hide();
            }
            
            else if (dpri == "kab_kota"){
                $("#provinsi").show();
                $("#dapil_kota").show();
                $("#dapil").show();
            }
            else{
                $("#provinsi").hide();
                $("#dapil").hide();
                $("#dapil-kota").hide();
            }
        });

        $("#username").on("change", function(e){
            var username = $(this).val();
            $.ajax({
                url : "<?php echo base_url(); ?>username_checker",
                type : "POST",
                dataType : "JSON",
                data : {username : username},
                success : function(data){
                    if(data.checking == "Yes"){
                        // swal({
                        //     title : "Selamat!",
                        //     text : "Username bisa dipakai",
                        //     type : "success"
                        // });
                        $("#username").val(username);
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Gagal!",
                            text : "Username sudah dipakai!",
                            type : "error"
                        });
                        $("#username").val("");
                    }
                },
                error : function(jqHXR, errorThrown, textStatus){
                    swal({
                        title : "Oops!",
                        text : "Periksa koneksi internet anda",
                        type : "error"
                    });
                    $("#username").val("");
                }
            })
        });

        $("form").submit(function(e){
            e.preventDefault();

            var action = $(this).attr("action");
            var form_data = $(this).serialize();
            if(action == "register"){
                register_action(form_data);
            }
        });

        $("#provinsi").on("change", function(e){
            var selector = $("#calon_legislatif").find(":selected").val();
            var isi = $(this).find(":selected").val();
            if(selector == "dprri" || selector == "dprprov"){
                $.ajax({
                    url : "<?php echo base_url(); ?>provinsi_selector",
                    type : "GET",
                    dataType : "JSON",
                    data : {isi : isi, ap : selector},
                    success : function(data){
                        if(data.checking == "Yes"){
                            var i;
                            var select = "";
                            for(i = 0; i < data.kota.length; i++){
                                select += '<option value="'+data.kota[i].id_dapil+'">'+data.kota[i].dapil+'</option>';
                            }

                            $("#dapil_selector").html(select);
                            $("#dapil_selector").selectpicker("refresh");
                        }
                        else if(data.checking == "No"){
                            swal({
                                title : "Oops!",
                                text : "Gagal mengambil data kabupaten/kota",
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
            else if(selector == "kab_kota"){
                $.ajax({
                    url : "<?php echo base_url(); ?>provinsi_selector",
                    type : "GET",
                    dataType : "JSON",
                    data : {isi : isi, ap : selector},
                    success : function(data){
                        if(data.checking == "Yes"){
                            var i;
                            var select = "";
                            for(i = 0; i < data.kota.length; i++){
                                select += '<option value="'+data.kota[i].id_kota+'">'+data.kota[i].kota+'</option>';
                            }

                            $("#kab_kota").html(select);
                            $("#kab_kota").selectpicker("refresh");
                        }
                        else if(data.checking == "No"){
                            swal({
                                title : "Oops!",
                                text : "Gagal mengambil data kabupaten/kota",
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
        });

        $("#kab_kota").on("change", function(e){
            var prov = $("#provinsi").find(":selected").val();
            var isi = $(this).find(":selected").val();
            var ap = $("#calon_legislatif").find(":selected").val();
            $.ajax({
                url : "<?php echo base_url(); ?>kota_selector",
                type : "GET",
                dataType : "JSON",
                data : {isi : isi, ap : ap, prov : prov},
                success : function(data){
                    if(data.checking == "Yes"){
                        var i;
                        var select = "";
                        for(i = 0; i < data.dapil.length; i++){
                            select += '<option value="'+data.dapil[i].id_dapil_dua+'">'+data.dapil[i].dapil_selanjutnya+'</option>';
                        }

                        $("#dapil_selector").html(select);
                        $("#dapil_selector").selectpicker("refresh");
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Oops!",
                            text : "Gagal mengambil data daerah pemilihan",
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
        });
    });

    function register_action(form_data){
        var nama = $("#nama_lengkap").val();
        var calon = $("#calon_legislatif").find(":selected").val();
        var provinsi = $("#provinsi").find(":selected").val();
        var notlp = $("#notlp").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var password = $("#password").val();
        if(nama == "" || calon == "" || provinsi == "" || notlp == "" || email == "" || username == "" || password == ""){
            swal({
                title : "Perhatian",
                text : "Harap mengisi semua bagian",
                type : "info"
            });
        }
        else{
            $.ajax({
                url : "<?php echo base_url(); ?>register_action",
                type : "POST",
                dataType : "JSON",
                data : form_data,
                success : function(data){
                    swal({
                        title : "Berhasil mendaftar!",
                        text : "Terima kasih kepada Bpk/Ibu "+data.nama_caleg+"  telah mendaftar di aplikasi Hitung Pintar Pemilu 2019. Perlu diketahui bahwa, aplikasi ini adalah  <span style="text-weight : bold">aplikasi berbayar<span>. Jika Bapak/Ibu menginginkan informasi lebih lanjut, hubungi +62 812 6974 4197. Terima kasih telah menggunakan Hitung Pintar Pemilu 2019.",
                        type : "success",
                        html: true
                    }, function(isConfirm){
                        document.location.href="<?php echo base_url(); ?>login";
                    });
                },
                error : function(jqHXR, errorThrown, textStatus){
                    swal({
                        title : "Gagal!",
                        text : "Periksa koneksi internet anda",
                        type : "error"
                    });
                }
            })
        }
    }
</script>
</body>
</html>