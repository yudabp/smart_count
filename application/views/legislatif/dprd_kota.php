<!doctype html>
<html class="no-js " lang="en">
<head>
<?php
    $this->load->view("template_config/head");
?>
</head>
<body class="theme-green">
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

<!-- Left Sidebar -->
<?php  
    $this->load->view("template_config/sidebar");
?>



<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <h2>Daftar Calon Legislatif
                <div>
                <small>DPRD Kab/Kota</small>
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
                        <h2><strong>Daftar Caleg</strong> </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="listTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Caleg</th>
                                        <th>Area Pemilihan</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten/Kota</th>
                                        <th>Dapil</th>
                                        <th>Kecamatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($caleg as $row){

                                            //Get Daerah Dapil
                                            $id_dapil_dua = $row->id_dapil;
                                            $data_dapil_dua = $this->db->get_where("dapil_selanjutnya", ['id_dapil_dua' => $id_dapil_dua])->row_array();
                                            $nama_dapil = $data_dapil_dua['dapil_selanjutnya'];
                                            $id_dapil = $data_dapil_dua['id_dapil'];

                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row->nama; ?></td>
                                                    <td><?php echo $row->area_pemilihan; ?></td>
                                                    <td><?php echo $row->provinsi; ?></td>
                                                    <td>
                                                        <?php
                                                            $data_dapil = $this->db->get_where("dapil", ['id_dapil' => $id_dapil, 'area_pemilihan' => 'kab_kota'])->row_array(); 
                                                            $id_kota = $data_dapil['id_kota'];

                                                            $data_kota = $this->db->get_where("kota", ['id_kota' => $id_kota])->row_array();

                                                            echo $data_kota['kota'];
                                                        ?>
                                                    </td>
                                                    <td><?php echo $nama_dapil; ?></td>
                                                    <td>
                                                        <?php
                                                            //Get Data All Kecamatan
                                                            $kecamatan = $this->db->get_where("kecamatan", ['id_dapil' => $id_dapil, 'id_kota' => $id_kota])->result();
                                                            $data = "";
                                                            foreach($kecamatan as $row){
                                                                $kecamatan = $row->kecamatan;
        
                                                                $data .= $kecamatan.", <br>";
                                                            }
        
                                                            $printed = substr($data, 0, -6);
                                                            echo $printed;
                                                        ?>
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


<?php
    $this->load->view("template_config/js");
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#listTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
</body>
</html>