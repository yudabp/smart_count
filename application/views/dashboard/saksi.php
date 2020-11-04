<!doctype html>
<html class="no-js " lang="en">
<head>
<?php
    $this->load->view("template_config/head");
?>
</head>
<body class="theme-purple">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../assets/images/logo.png" width="48" height="48" alt="Oreo"></div>
        <p>Mohon Tunggu Sebentar</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<style type="text/css">
.btn-file{
    margin-top: 5px;
}
.form-group-prepend{
    margin-top: 20px;
    margin-bottom: 63px;
}
    .form-control{
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
.form-group-prepend{
    margin-bottom: 15px !important;
    /*padding-top: 200px !important;*/
}
.form-group{
    /*margin-top: 200px !important;*/
    margin-bottom: 50px !important;
}
/*.input-group-btn .btn{
    padding-bottom: 11px !important;*/
}
.text{
    margin-top: 0px;
}
#hasil_suara{
    padding-top: 7px;
    padding-bottom: 7px;
    font-size: 15px;
}
#button{
    padding-top: 10px;
    padding-bottom: 10px;
    color: #ffffff;
    font-size: 15px;
    margin-top: -2px;  
}
h5{
    margin-bottom: 30px;
    font-size: 12px;
}
h3{
    font-size: 20px;
    margin-bottom: 5px;
}

</style>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" width="30" alt="Oreo"><span class="m-l-10">Smart Count - 2019</span></a>
            </div>
        </li>
    </ul>
</nav>
<?php  
    $this->load->view("template_config/sidebar");
?>
<!-- Right Sidebar -->
<!-- Main Content -->
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-sm-12">
            <center>
                <h2>Hasil Perhitungan Suara
                <div>
                <small>Pemilihan Umum 2019</small>
                </div>
                </h2>
            </center>
            </div>            
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <form action="suara_adding" enctype="multipart/form-data" method="post">
                            <div class="text-center">
                                <!-- <h3>Hartono Ekowadi, SH</h3>
                                <h5>DPRD Kota Medan Dapil V</h5> -->
                            </div>
                            <div class="form-group-prepend">   
                                <input type="number" class="form-control" placeholder="Hasil Suara Calon Legislatif" id="suara_pribadi" name="suara_pribadi" value="<?php echo $suara_pribadi; ?>"/>
                            </div>
                            <div class="form-group-prepend">   
                                <input type="number" class="form-control" placeholder="Hasil Suara Partai" id="suara_partai" name="suara_partai" value="<?php echo $suara_pribadi; ?>"/>
                            </div>
                            <div class="form-group">
                                            <!--Masukkan Foto Saksi <div> --><!-- <small>Max. 512 Kb</small></div> -->
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-default btn-file">
                                                            Browse <input type="file" id="imgInp">
                                                        </span>
                                                    </span>
                                                        <input type="text" class="form-control" readonly placeholder="Masukkan Foto">
                                                </div>
                                                        <!--<img id='img-upload'/>-->
                                <button type="submit" class="btn btn-primary btn-block" id="button">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>          
        </div>
    </div>
</div>
                            
<?php
    $this->load->view("template_config/js");
?>
<script type="text/javascript">
    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });

        $("#imgInp").change(function(){
            readURL(this);
        });     

        $("form").submit(function (e) { 
            e.preventDefault();
            
            var form_data = $(this).serialize();
            var suara_pribadi = $("#suara_pribadi").val();
            var suara_partai = $("#suara_partai").val();

            if(suara_pribadi == "" && suara_partai == ""){
                swal({
                    title : "Oops!",
                    text : "Harus ada salah satu data yang diinput",
                    type : "error"
                });
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>suara_control",
                    data: form_data,
                    dataType: "JSON",
                    success: function (data) {
                        if(data.checking == "Yes"){
                            swal({
                                title : "Berhasil!",
                                text : "Data suara telah dimasukkan. Halaman ini akan segera dimuat ulang",
                                type : "success",
                                timer : 2000,
                                showConfirmButton : false
                            }, function(){
                                location.reload();
                            });
                        }
                        else if(data.checking == "No"){
                            swal({
                                title : "Oops!",
                                text : "Gagal memasukkan suara",
                                type : "error"
                            });
                        }
                    },
                    error : function(jqHXR, errorThrown, textStatus){
                        swal({
                            title : "Oops!",
                            text : "Periksa koneksi internet anda",
                            type : "error"
                        })
                    }
                });
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();    
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }    
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>