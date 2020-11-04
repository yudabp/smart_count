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

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" width="30" alt="KPU"><span class="m-l-10">Quick Count</span></a>
            </div>
        </li>
    </ul>
</nav>

<!-- Left Sidebar -->
<?php  
    $this->load->view("template_config/sidebar");
?>



<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <h2>Generate User
                <div>
                <small></small>
                    </h2>
                </center>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            Hal yang anda harus perhatikan adalah tidak boleh memakai format username yang sama bahkan satu karakter pun dan system akan memastikan tidak ada format username yang sama
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <select class="form-control show-tick select2" data-placeholder="Select" id="provinsi" title="Provinsi" name="provinsi">
                                           <?php
                                                foreach($provinsi as $row){
                                                    ?>
                                                        <option value="<?php echo $row->id_provinsi; ?>"><?php echo $row->provinsi; ?></option>
                                                    <?php
                                                }
                                           ?>
                                        </select>            
                                    <!-- </div>
                                    <div class="col-sm-4">     -->
                                        <select class="form-control show-tick select2" data-placeholder="Select" id="kota" title="Kabupaten/Kota" name="kota">
                                        </select>            
                                    <!-- </div>
                                    <div class="col-sm-4"> -->
                                        <select class="form-control show-tick select2" data-placeholder="Select" id="kecamatan" title="Kecamatan" name="kecamatan">
                                        </select>            
                                    <!-- </div>
                                    <div class="col-sm-4"> -->
                                        <select class="form-control show-tick select2" data-placeholder="Select" id="kelurahan" title="Kelurahan" name="kelurahan">
                                        </select>         
                                    <!-- </div> -->
                                    <input type="hidden" name="status_checking" id="status_checking" value="0">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary" id="check_user">Check User</button>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                               <div class="input-group">
                                    <input class="form-control form-control-sm" type="text" placeholder="Format Username" name="username_format" id="username_format">
                                </div>  

                                <div class="text-right">
                                    <button type="button" class="btn btn-success" id="btnGenerate">Generate User</button>
                                </div>
                            </div>
                        </div>
                        <div id="hapusSection"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Generate User</strong> </h2>
                            </div>
                            <div class="body">
                                <div class="alert alert-info">
                                    Format username yang anda masukan akan digenerate sampai batas jumlah tps yang ada dikelurahan tersebut dan password akan disesuaikan dengan nomor telp si caleg. Contoh format : usr, maka akan digenerate usr1, usr2, usr3, dst
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="listTable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listBodyTable">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# Basic Examples --> 
        
    </div>
</section>


<?php
$this->load->view("template_config/js");
?>
<script>
    $(document).ready(function(){

        $("#provinsi").on("change", function(e){
            var isi = $(this).find(":selected").val();
            $("#status_checking").val("0");
            $.ajax({
                url : "<?php echo base_url(); ?>generate_provinsi",
                type : "GET",
                dataType : "JSON",
                data : {isi : isi},
                success : function(data){
                    if(data.checking == "Yes"){
                        var i;
                        var select = "";
                        for(i = 0; i < data.kota.length; i++){
                            select += '<option value="'+data.kota[i].id_kota+'">'+data.kota[i].kota+'</option>';
                        }

                        $("#kota").html(select);
                        $("#kecamatan").html("").val("");
                        $("#kelurahan").html("").val("");
                        $("#kota").selectpicker("refresh");
                        $("#kecamatan").selectpicker("refresh");
                        $("#kelurahan").selectpicker("refresh");
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Oops!",
                            text : "Tidak ada data kabupaten/kota untuk provinsi tersebut",
                            type : "error"
                        });
                        $("#kota").html("").val("");
                        $("#kecamatan").html("").val("");
                        $("#kelurahan").html("").val("");
                        $("#kota").selectpicker("refresh");
                        $("#kecamatan").selectpicker("refresh");
                        $("#kelurahan").selectpicker("refresh");
                    }
                },
                error : function(jqHXR, errorThrown, textStatus){
                    swal({
                        title : "Oops!",
                        text : "Periksa koneksi internet anda",
                        type : "error"
                    });
                    $("#kota").html(select);
                    $("#kota").selectpicker("refresh");
                }
            });
        });

        $("#kota").on("change", function(e){
            var isi = $(this).find(":selected").val();
            $("#status_checking").val("0");
            $.ajax({
                url : "<?php echo base_url(); ?>generate_kota",
                type : "GET",
                dataType : "JSON",
                data : {isi : isi},
                success : function(data){
                    if(data.checking == "Yes"){
                        var i;
                        var select = "";
                        for(i = 0; i < data.kecamatan.length; i++){
                            select += '<option value="'+data.kecamatan[i].id_kecamatan+'">'+data.kecamatan[i].kecamatan+'</option>';
                        }

                        $("#kecamatan").html(select);
                        $("#kelurahan").html("").val("");
                        $("#kecamatan").selectpicker("refresh");
                        $("#kelurahan").selectpicker("refresh");
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Oops!",
                            text : "Tidak ada data kecamatan untuk kabupaten/kota tersebut",
                            type : "error"
                        });
                        $("#kecamatan").html("").val("");
                        $("#kelurahan").html("").val("");
                        $("#kecamatan").selectpicker("refresh");
                        $("#kelurahan").selectpicker("refresh");
                    }
                },
                error : function(jqHXR, errorThrown, textStatus){
                    swal({
                        title : "Oops!",
                        text : "Periksa koneksi internet anda",
                        type : "error"
                    });
                    $("#kecamatan").html("").val("");
                    $("#kelurahan").html("").val("");
                    $("#kecamatan").selectpicker("refresh");
                    $("#kelurahan").selectpicker("refresh");
                }
            });
        });

        $("#kecamatan").on("change", function(e){
            var isi = $(this).find(":selected").val();
            $("#status_checking").val("0");
            $.ajax({
                url : "<?php echo base_url(); ?>generate_kecamatan",
                type : "GET",
                dataType : "JSON",
                data : {isi : isi},
                success : function(data){
                    if(data.checking == "Yes"){
                        var i;
                        var select = "";
                        for(i = 0; i < data.kelurahan.length; i++){
                            select += '<option value="'+data.kelurahan[i].id_kelurahan+'">'+data.kelurahan[i].kelurahan+'</option>';
                        }

                        $("#kelurahan").html(select).val("");
                        $("#kelurahan").selectpicker("refresh");
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Oops!",
                            text : "Tidak ada data kelurahan untuk kecamatan tersebut",
                            type : "error"
                        });
                        $("#kelurahan").html("").val("");
                        $("#kelurahan").selectpicker("refresh");
                    }
                },
                error : function(jqHXR, errorThrown, textStatus){
                    swal({
                        title : "Oops!",
                        text : "Periksa koneksi internet anda",
                        type : "error"
                    });
                    $("#kelurahan").html("").val("");
                    $("#kelurahan").selectpicker("refresh");
                }
            });
        });

        $("#check_user").click(function(e){
            e.preventDefault();

            var provinsi = $("#provinsi").find(":selected").val();
            var kota = $("#kota").find(":selected").val();
            var kecamatan = $("#kecamatan").find(":selected").val();
            var kelurahan = $("#kelurahan").find(":selected").val();

            if(provinsi == "" || kota == "" || kecamatan == "" || kelurahan == ""){
                swal({
                    title : "Oops!",
                    text : "Harap mengisi semua data",
                    type : "error"
                });
                $("#status_checking").val("0");
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>saksi_checking",
                    data: {
                        id : "<?php echo $this->input->get("for"); ?>",
                        provinsi : provinsi,
                        kota : kota,
                        kecamatan : kecamatan,
                        kelurahan : kelurahan
                    },
                    dataType: "JSON",
                    success : function(data){
                        table = $("#listTable").DataTable();
                        table.destroy();

                        var buttons_delete = '<button type="button" class="btn btn-danger btn-block" onclick="hapus_user();">Hapus Semua User</button>'

                        if(data.checking == "Yes"){
                            var i, j = 1;
                            var saksi = "";
                            for(i = 0; i < data.saksi.length; i++){
                                saksi += "<tr><td>"+j+"</td><td>"+data.saksi[i].username+"</td></tr>";

                                j++;
                            }
                            $("#hapusSection").html(buttons_delete);
                            $("#listBodyTable").html(saksi);
                        }
                        else if(data.checking == "No"){
                           swal({
                               title : "Selamat!",
                               text : "Tidak ada user saksi untuk kelurahan ini. Selamat anda bisa megenerate user untuk kelurahan ini",
                               type : "info"
                           });
                           $("#hapusSection").html("");
                           $("#listBodyTable").html("");
                        }

                        table = $('#listTable').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });
                        $("#status_checking").val(data.status);
                    },
                    error : function(jqHXR, errorThrown, textStatus){
                        swal({
                            title : "Oops!",
                            text : "Periksa koneksi internet anda",
                            type : "error"
                        });
                        $("#listBodyTable").html("");
                    }
                });
            }
        });

        $("#btnGenerate").click(function (e) { 
            e.preventDefault();
            var username_format = $("#username_format").val(); 
            var status_checking = $("#status_checking").val();
            var provinsi = $("#provinsi").find(":selected").val();
            var kota = $("#kota").find(":selected").val();
            var kecamatan = $("#kecamatan").find(":selected").val();
            var kelurahan = $("#kelurahan").find(":selected").val();

            if(status_checking == 0){
                swal({
                    title : "Oops!",
                    text : "Harap mengecheck user saksi terlebih dahulu",
                    type : "error"
                });
            }
            else if(status_checking == 2){
                swal({
                    title : "Oops!",
                    text : "Tidak bisa megenerate user saksi karena sudah ada user. Generate User hanya bisa digunakan apabila tidak terdapat user saksi pada kelurahan tersebut",
                    type : "error"
                });
            }
            else if(status_checking == 1){
                if(provinsi === "" || kota === "" || kecamatan === "" || kelurahan === ""){
                    swal({
                        title : "Oops!",
                        text : "Harap mengecheck user saksi terlebih dahulu",
                        type : "error"
                    });
                    $("#status_checking").val("0");
                }
                else{
                    if(username_format == ""){
                        swal({
                            title : "Oops!",
                            text : "Harap mengisi format username",
                            type : "error"
                        });
                    }
                    else{
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>generate_user",
                            data: {
                                username_format : username_format,
                                id : "<?php echo $this->input->get("for"); ?>",
                                provinsi : provinsi,
                                kota : kota,
                                kecamatan : kecamatan,
                                kelurahan : kelurahan
                            },
                            dataType: "JSON",
                            success: function (data) {
                                if(data.checking == "Yes"){
                                    swal({
                                        title : "Berhasil!",
                                        text : "User untuk saksi telah digenerate. Halaman ini akan segera dimuat ulang",
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
                                        text : "Gagal megenerate user untuk saksi",
                                        type : "error"
                                    });
                                    $("#status_checking").val("1");
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
                }
            }
            else{
                swal({
                    title : "Oops!",
                    text : "Gagal melakukan generate user",
                    type : "error"
                });
            }
        });
    })

    function hapus_user(){        
            var provinsi = $("#provinsi").find(":selected").val();
            var kota = $("#kota").find(":selected").val();
            var kecamatan = $("#kecamatan").find(":selected").val();
            var kelurahan = $("#kelurahan").find(":selected").val();
            var status_checking = $("#status_checking").val();

            if(provinsi == "" || kota == "" || kecamatan == "" || kelurahan == "" || status_checking == 0){
                swal({
                    title : "Oops!",
                    text : "Harap melakukan check user terlebih dahulu",
                    type : "error"
                });
                $("#status_checking").val("0");
            }
            else{
                swal({
                    title: "Apakah anda yakin?",
                    text: "Semua data user saksi untuk kelurahan tersebut yang terdelete tidak dapat dikembalikan",
                    type: "warning",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    closeOnConfirm: false
                }, function () {
                    // if(!isConfirm) return;
                    setTimeout(function() {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>saksi_user_deleting",
                            data: {
                                id : "<?php echo $this->input->get("for"); ?>",
                                provinsi : provinsi,
                                kota : kota,
                                kecamatan : kecamatan,
                                kelurahan : kelurahan
                            },
                            dataType: "JSON",
                            success : function(data){
                                if(data.checking == "Yes"){
                                    swal({
                                        title : "Berhasil!",
                                        text : "User saksi untuk kelurahan tersebut telah dihapus. Halaman ini akan segera dimuat ulang",
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
                                    text : "Gagal untuk menghapus user saksi",
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
                    }, 1000);
                });
            }
        }
</script>
</body>
</html>
