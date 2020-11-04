
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>.:: UI ADMIN ::.</title>
<link rel="icon" href="../assets/images/logo.png" type="logo">
<!-- Favicon-->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<!-- Custom Css -->
<link  rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<style>
.onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
    margin-top: -5px;
    margin-bottom: -5px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 25px; padding: 0; line-height: 25px;
    font-size: 8px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "OFF";
    padding-left: 0px;
    background-color: #EEEEEE; color: #999999;
}
.onoffswitch-inner:after {
    content: "ON";
    padding-right: 30px;
    background-color: #54d345; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 59px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}

.btn, .navbar .navbar-nav>a.btn {
    margin-top: 0px;
    margin-bottom:  0px;
    margin-left: 0px;
    margin-right: 0px;
}
</style>
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
        <div class="m-t-30"><img class="zmdi-hc-spin" src="../assets/images/logo.svg" width="48" height="48" alt="Oreo"></div>
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
                <a class="navbar-brand" href="index.html"><img src="../assets/images/logo.png" width="30" alt=""><span class="m-l-10">Quick Count</span></a>
            </div>
        </li>
    </ul>
</nav>

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
                                <h4>Selamat Datang</h4>
                                <small>Di Halaman Admin</small>                        
                            </div>                            
                        </div>
                    </li>
                    <!-- <li class="header">Data</li> -->
                    <li><a href="index-6.html"> <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i><span>Dashboard</span></a></li>
                    <li><a href="../light/index-6.html"> <i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i><span>ALL</span></a></li>
                    <li   class="active open"> <a href="../light/dpr-ri.html"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i><span>DPR RI</span></a>
                    </li>
                    <li><a href="dpd-ri.html"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i><span>DPD RI</span></a>
                    </li>
                    <li><a href="../light/dprd-p.html"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i><span>DPRD Provinsi</span> </a>
                    </li>
                    <li><a href="../light/dprd-k.html"><i class="zmdi zmdi-long-arrow-right zmdi-hc-fw"></i><span>DPRD Kab/Kota</span> </a>
                    </li>
                    <li> <a href="sc.schlrr.com"></i><span>Logout</span></a>
                </ul>
            </div>
        </div>
    </div>    
</aside>



<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <h2>Daftar
                <div>
                <small>DPR RI</small>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Caleg</th>
                                        <th>Area Pemilihan</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <!--  <tr bgcolor="#00a651">
                                        <td>1</td>
                                        <td><a href="javascript:void(0);" id="nama">Hartono Ekowadi, SH</a></td>
                                        <td>DPRD Kota Medan</td>
                                        <td>7/2/2019</td>
                                        <td>
                                            <center><input type="checkbox" checked data-toggle="toggle" data-style="ios"></center>
                                        </td>
                                        <td><a href="javascript:void(0);" style="font-style: italic;" id="nama"><small>Generate User?</small></a></td>
                                    </tr> -->
                                    <tr>
                                        <td>1</td>
                                        <td><a href="javascript:void(0);" id="nama">Dr. Haris Effendi</a></td>
                                        <td>DPR RI</td>
                                        <td>1/1/2019</td>
                                        <td>
                                        <center>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                                                    <label class="onoffswitch-label" for="myonoffswitch">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                            </div>
                                        </center>
                                        </td>
                                        <td><a href="javascript:void(0);" style="font-style: italic;" id="nama"><small>Generate User?</small></a></td>
                                    </tr>
                                    <!-- <tr bgcolor="#ed1c24">
                                        <td>1</td>
                                        <td><a href="javascript:void(0);" id="nama">Salim Selamet, SE</a></td>
                                        <td>DPD RI</td>
                                        <td>13/1/2019</td>
                                        <td>
                                            <center><input type="checkbox" checked data-toggle="toggle" data-style="ios"></center>
                                        </td>
                                        <td><a href="javascript:void(0);" style="font-style: italic;" id="nama"><small>Generate User?</small></a></td>
                                    </tr> -->
                                    <!-- <tr bgcolor="#0072bc">
                                        <td>4</td>
                                        <td><a href="javascript:void(0);" id="nama">Muhammad Ali Saja</a></td>
                                        <td>DPRD Provinsi</td>
                                        <td>29/12/2018</td>
                                        <td>
                                            <center><input type="checkbox" checked data-toggle="toggle" data-style="ios"></center>
                                        </td>
                                        <td><a href="javascript:void(0);" style="font-style: italic;" id="nama"><small>Generate User?</small></a></td>
                                    </tr> -->
                                    <!-- <tr bgcolor="#00a651">
                                        <td>5</td>
                                        <td><a href="javascript:void(0);" id="nama">Denice David</a></td>
                                        <td>DPRD Kota Medan</td>
                                        <td>4/3/2019</td>
                                        <td>
                                            <center><input type="checkbox" checked data-toggle="toggle" data-style="ios"></center>
                                        </td>
                                        <td><a href="javascript:void(0);" style="font-style: italic;" id="nama"><small>Generate User?</small></a></td>
                                    </tr>  -->  
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


<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- Jquery DataTable Plugin Js --> 
<script src="https://thememakker.com/templates/oreo/html/light/assets/bundles/datatablescripts.bundle.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="https://thememakker.com/templates/oreo/html/light/assets/js/pages/tables/jquery-datatable.js"></script>
</body>
</html>