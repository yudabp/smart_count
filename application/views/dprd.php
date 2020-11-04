<!doctype html>
<html class="no-js " lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=ibm866">

<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Application Quick Count ::</title>
<!-- Favicon-->
<link rel="icon" href="../assets/images/.png" type="image/x-icon">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://thememakker.com/templates/oreo/html/assets/plugins/sweetalert/sweetalert.css"/>
<!-- Custom Css -->
<link  rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
<body class="theme-purple">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../assets/images/.png" width="48" height="48" alt="kpu"></div>
        <p>Mohon Tunggu.....</p>        
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
                <a class="navbar-brand" href="<?php echo base_url() ?>dprd""><img src="../assets/images/.png" width="30" alt="Oreo"><span class="m-l-10">KPU</span></a>
            </div>
        </li>
        <!--<li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i>-->
            <div class="notify">
                <!--<span class="heartbit"></span>-->
                <!--<span class="point"></span>-->
            </div>
            <!--</a>-->
            <ul class="dropdown-menu pullDown">
                
        <li class="hidden-sm-down">
            <div class="input-group">                
            </div>
        </li>        
    </ul>
</nav>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
    </ul>
    <ul class="nav nav-tabs">
    </ul>
     <div class="user-info">
                            <div class="image"><a href="profile.html"><img src="<?php echo base_url('assets/images/eko.jpg') ?>" alt="User"></a></div>
                            <div class="detail">
                   
                                <h4>Hartono Ekowadi, SH</h4>
                                <small>Caleg DPRD Medan</small>                        
                            </div>
                        </div>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">                    
                    <li> <a href="<?php echo base_url() ?>dprd"><span>DPRD MEDAN</span></a>
    </div>    
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="jquery-knob.html#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="jquery-knob.html#chat"><i class="zmdi zmdi-comments"></i></a></li>
        <!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="jquery-knob.html#activity">Activity</a></li>-->
    </ul>
    <div class="tab-content">
        <div class="tab-pane slideRight active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                </div>
            </div>                
        </div>       
        <div class="tab-pane right_chat stretchLeft" id="chat">
            <div class="slim_scroll">
                <div class="card">
                    <div class="search">                        
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!--</ul>-->
                </div>
                <div class="card">
                </div>
            </div>
        </div>
        <div class="tab-pane slideLeft" id="activity">
            <div class="slim_scroll">
                <div class="card user_activity">
                </div>
                <div class="card">
                   
                </div>
            </div>
        </div>
    </div>
</aside>
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Quick Count
                <small>Welcome to Quick Count Application </small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dprd">Dashboard</a></li>
                    <li class="breadcrumb-item active">Perolehan Suara</li>
                </ul>
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
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="48" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#cb8fe7" readonly>
                        <p class="text-muted m-b-0">Medan Sunggal</p>
                        <p></p>
                        <p></p>
                        <div class="row clearfix js-sweetalert">
                        <div class="col-lg-6">
                        <div class="card">
                        <button class="btn btn-raised btn-primary waves-effect btn-round" data-type="prompt">CLICK ME</button>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url()?>medan/sunggal">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="51" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#0000FF" readonly>
                        <p class="text-muted m-b-0">Medan Selayang</p>
                                                <p></p>
                        <p></p>
                        <div class="row clearfix">
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="#">Target Suara</a></small>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url() ?>medan/selayang">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="54" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#FFFF00" readonly>
                        <p class="text-muted m-b-0">Medan Polonia</p>
                                                <p></p>
                        <p></p>
                        <div class="row clearfix">
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="#">Target Suara</a></small>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url()?>medan/polonia">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="73" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#00FF00" readonly>
                        <p class="text-muted m-b-0">Medan Maimun</p>
                                                <p></p>
                        <p></p>
                        <div class="row clearfix">
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="#">Target Suara</a></small>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url()?>medan/maimun">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="37" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#FF0000" readonly>
                        <p class="text-muted m-b-0">Medan Johor</p>
                                                <p></p>
                        <p></p>
                        <div class="row clearfix">
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="#">Target Suara</a></small>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url()?>medan/johor">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">                   
                    <div class="body text-center">
                        <input type="text" class="knob" value="47" data-width="125" data-height="125" data-thickness="0.25" data-fgColor="#000000" readonly>
                        <p class="text-muted m-b-0">Medan Tuntungan</p>
                                                <p></p>
                        <p></p>
                        <div class="row clearfix">
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="#">Target Suara</a></small>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <small><a href="<?php echo base_url() ?>medan/tuntungan">Suara Masuk</a></small>
                            <small><p>20.000</p></small>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="https://thememakker.com/templates/oreo/html/assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->

<script src="https://thememakker.com/templates/oreo/html/assets/plugins/jquery-knob/jquery.knob.min.js"></script> <!-- Jquery Knob Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="https://thememakker.com/templates/oreo/html/light/assets/js/pages/charts/jquery-knob.js"></script>
<script src="https://thememakker.com/templates/oreo/html/assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
<script>
    function prompt(){
        $("#itulah").modal("show");
    }
</script>
</body>
</html>