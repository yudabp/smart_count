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
                    <h2>Quick Count
                <div>
                <small>Hasil Suara</small>
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
                                        <th>
                                            <?php
                                                if(isset($_GET['request'])){
                                                    $request = $this->input->get("request");
                                                    if($request == "kabupaten_kota"){
                                                        echo "Kabupaten/Kota";
                                                    }
                                                    else if($request == "kecamatan"){
                                                        echo "Kecamatan";
                                                    }
                                                    else if($request == "kelurahan"){
                                                        echo "Kelurahan";
                                                    }
                                                    else if($request == "tps"){
                                                        echo "TPS";
                                                    }
                                                }
                                                else{
                                                    echo "Provinsi";
                                                }
                                            ?>
                                        </th>
                                        <th>Total Suara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($_GET['request'])){

                                        //DPR RI dan DPRD Provinsi Controller
                                        if($legislatif == "DPR RI" || $legislatif == "DPRD Provinsi"){
                                            if($request == "kabupaten_kota"){
                                                foreach($kota as $d_kota){
                                                    $id_kota = $d_kota->id_kota;

                                                    $data_kota = $this->db->get_where("kota", ['id_kota' => $id_kota])->row_array();
                                                    $nama_kota = $data_kota['kota'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kecamatan&kab_kota=<?php echo base64_encode(base64_encode($id_kota)); ?>"><?php echo $nama_kota; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "kecamatan" && isset($_GET['kab_kota'])){
                                                $id_kota = base64_decode(base64_decode($this->input->get("kab_kota")));

                                                $kecamatan = $this->db->get_where("kecamatan", ['id_kota' => $id_kota])->result();

                                                foreach($kecamatan as $data){
                                                    $id_kecamatan = $data->id_kecamatan;
                                                    
                                                    $data_kecamatan= $this->db->get_where("kecamatan", ['id_kecamatan' => $id_kecamatan])->row_array();

                                                    $nama_kecamatan = $data_kecamatan['kecamatan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota, 'id_kecamatan' => $id_kecamatan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kelurahan&kec=<?php echo base64_encode(base64_encode($id_kecamatan)); ?>"><?php echo $nama_kecamatan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "kelurahan" && isset($_GET['kec'])){
                                                $id_kecamatan = base64_decode(base64_decode($this->input->get("kec")));

                                                $kelurahan = $this->db->get_where("kelurahan", ['id_kecamatan' => $id_kecamatan])->result();

                                                foreach($kelurahan as $data){
                                                    $id_kelurahan = $data->id_kelurahan;
                                                    
                                                    $data_kelurahan = $this->db->get_where("kelurahan", ['id_kelurahan' => $id_kelurahan])->row_array();

                                                    $nama_kelurahan = $data_kelurahan['kelurahan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kecamatan' => $id_kecamatan, 'id_kelurahan' => $id_kelurahan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=tps&kel=<?php echo base64_encode(base64_encode($id_kelurahan)); ?>"><?php echo $nama_kelurahan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "tps" && isset($_GET['kel'])){
                                                $id_kelurahan = base64_decode(base64_decode($this->input->get("kel")));

                                                $tps = $this->db->get_where("tps", ['id_kelurahan' => $id_kelurahan])->result();

                                                foreach($tps as $data){
                                                    $id_tps = $data->id_tps;
                                                    
                                                    $data_tps = $this->db->get_where("tps", ['id_tps' => $id_tps])->row_array();

                                                    $nama_tps = $data_tps['tps'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kelurahan' => $id_kelurahan, 'id_tps' => $id_tps])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $nama_tps; ?></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                        //DPD RI Controller
                                        else if($legislatif == "DPD RI"){
                                            if($request == "kabupaten_kota"){
                                                foreach($kota as $row){
                                                    $id_kota = $row->id_kota;
                                                    $nama = $row->kota;
        
                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota])->result();
        
                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kecamatan&kab_kota=<?php echo base64_encode(base64_encode($id_kota)); ?>"><?php echo $nama; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "kecamatan" && isset($_GET['kab_kota'])){
                                                $id_kota = base64_decode(base64_decode($this->input->get("kab_kota")));

                                                $kecamatan = $this->db->get_where("kecamatan", ['id_kota' => $id_kota])->result();

                                                foreach($kecamatan as $data){
                                                    $id_kecamatan = $data->id_kecamatan;
                                                    
                                                    $data_kecamatan= $this->db->get_where("kecamatan", ['id_kecamatan' => $id_kecamatan])->row_array();

                                                    $nama_kecamatan = $data_kecamatan['kecamatan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota, 'id_kecamatan' => $id_kecamatan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kelurahan&kec=<?php echo base64_encode(base64_encode($id_kecamatan)); ?>"><?php echo $nama_kecamatan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "kelurahan" && isset($_GET['kec'])){
                                                $id_kecamatan = base64_decode(base64_decode($this->input->get("kec")));

                                                $kelurahan = $this->db->get_where("kelurahan", ['id_kecamatan' => $id_kecamatan])->result();

                                                foreach($kelurahan as $data){
                                                    $id_kelurahan = $data->id_kelurahan;
                                                    
                                                    $data_kelurahan = $this->db->get_where("kelurahan", ['id_kelurahan' => $id_kelurahan])->row_array();

                                                    $nama_kelurahan = $data_kelurahan['kelurahan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kecamatan' => $id_kecamatan, 'id_kelurahan' => $id_kelurahan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=tps&kel=<?php echo base64_encode(base64_encode($id_kelurahan)); ?>"><?php echo $nama_kelurahan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "tps" && isset($_GET['kel'])){
                                                $id_kelurahan = base64_decode(base64_decode($this->input->get("kel")));

                                                $tps = $this->db->get_where("tps", ['id_kelurahan' => $id_kelurahan])->result();

                                                foreach($tps as $data){
                                                    $id_tps = $data->id_tps;
                                                    
                                                    $data_tps = $this->db->get_where("tps", ['id_tps' => $id_tps])->row_array();

                                                    $nama_tps = $data_tps['tps'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kelurahan' => $id_kelurahan, 'id_tps' => $id_tps])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $nama_tps; ?></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                        //DPRD Kab/Kota Controller
                                        else if($legislatif == "DPRD Kab/Kota"){
                                            if($request == "kabupaten_kota"){

                                                $total_suara = 0;
                                                $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota])->result();
        
                                                foreach($suara_data as $hasil){
                                                    $total_suara += $hasil->total_suara_pribadi;
                                                }
                                                ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kecamatan&kab_kota=<?php echo base64_encode(base64_encode($id_kota)); ?>"><?php echo $nama_kota; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                            else if($request == "kecamatan" && isset($_GET['kab_kota'])){
                                                $id_kota = base64_decode(base64_decode($this->input->get("kab_kota")));

                                                $kecamatan = $this->db->get_where("kecamatan", ['id_kota' => $id_kota, 'id_dapil' => $id_dapil])->result();

                                                foreach($kecamatan as $data){
                                                    $id_kecamatan = $data->id_kecamatan;
                                                    
                                                    $data_kecamatan= $this->db->get_where("kecamatan", ['id_kecamatan' => $id_kecamatan])->row_array();

                                                    $nama_kecamatan = $data_kecamatan['kecamatan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kota' => $id_kota, 'id_kecamatan' => $id_kecamatan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=kelurahan&kec=<?php echo base64_encode(base64_encode($id_kecamatan)); ?>"><?php echo $nama_kecamatan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "kelurahan" && isset($_GET['kec'])){
                                                $id_kecamatan = base64_decode(base64_decode($this->input->get("kec")));

                                                $kelurahan = $this->db->get_where("kelurahan", ['id_kecamatan' => $id_kecamatan])->result();

                                                foreach($kelurahan as $data){
                                                    $id_kelurahan = $data->id_kelurahan;
                                                    
                                                    $data_kelurahan = $this->db->get_where("kelurahan", ['id_kelurahan' => $id_kelurahan])->row_array();

                                                    $nama_kelurahan = $data_kelurahan['kelurahan'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kecamatan' => $id_kecamatan, 'id_kelurahan' => $id_kelurahan])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><a href="<?php echo base_url(); ?>suara_view?request=tps&kel=<?php echo base64_encode(base64_encode($id_kelurahan)); ?>"><?php echo $nama_kelurahan; ?></a></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else if($request == "tps" && isset($_GET['kel'])){
                                                $id_kelurahan = base64_decode(base64_decode($this->input->get("kel")));

                                                $tps = $this->db->get_where("tps", ['id_kelurahan' => $id_kelurahan])->result();

                                                foreach($tps as $data){
                                                    $id_tps = $data->id_tps;
                                                    
                                                    $data_tps = $this->db->get_where("tps", ['id_tps' => $id_tps])->row_array();

                                                    $nama_tps = $data_tps['tps'];

                                                    $total_suara = 0;
                                                    $suara_data = $this->db->get_where("suara", ['id_caleg' => $id_caleg, 'id_kelurahan' => $id_kelurahan, 'id_tps' => $id_tps])->result();

                                                    foreach($suara_data as $hasil){
                                                        $total_suara += $hasil->total_suara_pribadi;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $nama_tps; ?></td>
                                                        <td><?php echo $total_suara; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url(); ?>suara_view?request=kabupaten_kota">
                                                <?php echo $nama_provinsi; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $suara_provinsi; ?>
                                            </td>
                                        </tr>  
                                        <?php
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
<script>
    $(document).ready(function(){
        $('#listTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    })
</script>
</body>
</html>