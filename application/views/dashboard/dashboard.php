<!doctype html>
<html class="no-js " lang="en">
<head>
<?php $this->load->view("template_config/head"); ?>
</head>
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
                <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" width="30" alt="KPU"><span class="m-l-10">Quick Count</span></a>
            </div>
        </li>
    </ul>
</nav>

<?php  
    $this->load->view("template_config/sidebar");
?>



<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <h2>Admin Page
                <div>
                <small>Pemilihan Umum 2019</small>
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
                <div class="card">
                    <div class="header">
                        <h2><strong>Daftar</strong> </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="listTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Caleg</th>
                                        <th>Area Pemilihan</th>
                                        <th>No. Telp</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th style="width:10%;">User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    //Background color : 
                                    //1. DPRD Kab/Kota : #00a651
                                    //2. DPR RI : #fff200
                                    //3. DPD RI : #ed1c24
                                    //4. DPRD Pronvisi : #0072bc
                                    $i = 1;
                                    foreach($caleg as $row){
                                        $id_user = base64_encode(base64_encode($row->id_user));
                                        $area = $row->area_pemilihan;
                                        if($area == "DPRD Kab/Kota"){
                                            $color = "#000";
                                            $bgcolor = "#00a651";
                                        }
                                        else if($area == "DPR RI"){
                                            $color = "#000";
                                            $bgcolor = "#fff200";
                                        }
                                        else if($area == "DPD RI"){
                                            $color = "#fff";
                                            $bgcolor = "#ed1c24";
                                        }
                                        else if($area == "DPRD Provinsi"){
                                            $color = "#fff";
                                            $bgcolor = "#0072bc";
                                        }
                                        ?>
                                            <tr style="background-color:<?php echo $bgcolor; ?>; color : <?php echo $color; ?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row->nama ?></td>
                                                <td><?php echo $row->area_pemilihan ?></td>
                                                <td><?php echo $row->no_telp; ?></td>
                                                <td><?php echo $row->tgl_daftar ?></td>
                                                <td>
                                                    <div class="switchToggle">
                                                        <input type="checkbox" name="active_<?php echo $id_user; ?>" id="active_<?php echo $id_user; ?>" onchange="active('<?php echo $id_user; ?>')" <?php if($row->data_activation == "Active"){ echo "checked"; } ?>>
                                                        <label for="active_<?php echo $id_user; ?>">Toggle</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>generate?for=<?php echo $id_user; ?>" class="btn btn-success">Generate User</a>
                                                    <button class="btn btn-danger btn-sm" onclick="hapus_caleg('<?php echo $id_user; ?>');"><span class="material-icons">delete</span></button>
                                                </td>
                                            </tr>
                                        <?php
                                        $i++;
                                    }
                                ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples --> 
        
    </div>
</section>


<?php $this->load->view("template_config/js"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#listTable").DataTable();
    });

    function active(id_user){
        //Checking Status
        var isi = jQuery("#active_"+id_user).is(":checked") ? "Active" : "No";        
        
        //Ajax Request
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>active_user",
            data: {id_user : id_user, isi : isi},
            dataType: "JSON",
            success: function (response) {
                if(response.status == "Yes"){
                    $("#active_"+id_user).attr("checked", "checked");
                }
                else if(response.status == "No"){
                    swal({
                        title : "Oops!",
                        text : "Gagal mengaktifkan user",
                        type : "error",
                    });
                    $("#active_"+id_user).removeAttr("checked");
                }
            },
            error : function(jqHXR, textStatus, errorThrown){
                swal({
                    title : "Oops!",
                    text : "Periksa koneksi internet anda",
                    type : "error",
                });
            }
        });
    }

    function hapus_caleg(id_user){
        swal({
            title: "Apakah anda yakin?",
            text: "Semua data tentang caleg akan dihapus termasuk hasil perhitungan dan user saksi",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function () {
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>caleg_deleting",
                    data: {
                        id_user : id_user,
                    },
                    dataType: "JSON",
                    success : function(data){
                        if(data.checking == "Yes"){
                            swal({
                                title : "Berhasil!",
                                text : "Data caleg berhasil dihapus",
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
                                text : "Gagal untuk menghapus caleg",
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
</script>
</body>
</html>