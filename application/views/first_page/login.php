<!doctype html>
<html class="no-js " lang="en">
<head>
<?php  
    $this->load->view("template_config/head");
?>
<style type="text/css">
/*.page-header{
    background: #646867 !important;*/
}
    h6{
        margin-top: 1px !important;
        color: #000000 !important;
    }
    #select_section button{
        color: #fff !important;
        border-color: #ffffff !important;
        /*margin-top: 5px !important;*/
        margin-bottom: 10px !important;
        margin-left: auto !important;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
        padding-left: 20px !important;
        padding-right: 24px !important;
    }
</style>
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Oreo</a>
                <a class="navbar-brand" href="index.html"><img src="../assets/images/kpu.png" width="30" alt="KPU"><span class="m-l-10">KPU</span></a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        
    </div>
</nav> -->
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(<?php echo base_url(); ?>assets/images/login6.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="post" action="login" enctype="multipart/form-data">
                    <div class="header">
                        <div class="logo-container">
                            <img src="../assets/images/logo.png" alt="">
                        </div>
                        <h5>Log in</h5>
                    </div>
                    <div class="content">                                                
                        <div class="input-group input-lg">
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group input-lg">
                            <input type="password" placeholder="Password" class="form-control" name="password" id="password" />
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12" id="select_section">
                                    <select class="form-control show-tick" data-placeholder="Select" id="login_as" title="Sebagai" name="pengguna">
                                        <option value="Caleg">Caleg</option>
                                        <option value="Saksi">Saksi</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="footer text">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">MASUK</button>
                        <!-- <a href="<?php echo base_url()?>dprd" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">MASUK</a> -->
                        <h5><a href="#" class="link">Lupa Password - </a><a href="<?php echo base_url(); ?>register" class="link">Register</a>
                        </h5>
                    </div>
                    <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>Designed by <a href="http://www.n56ht.com/" target="_blank">InSight MarkComm</a></span>
            </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <!-- <nav>
                <ul>
                    <li><a href="http://thememakker.com/contact/" target="_blank">Contact Us</a></li>
                    <li><a href="http://thememakker.com/about/" target="_blank">About Us</a></li>
                    <li><a href="javascript:void(0);">FAQ</a></li>
                </ul>
            </nav> -->
            <!-- <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>Designed by <a href="http://www.n56ht.com/" target="_blank">InsgMarkComm.</a></span>
            </div> -->
        </div>
    </footer>
</div>

<?php  
    $this->load->view("template_config/js");
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".navbar-toggler").on('click',function() {
            $("html").toggleClass("nav-open");
        });

        $('.form-control').on("focus", function() {
            $(this).parent('.input-group').addClass("input-group-focus");
        }).on("blur", function() {
            $(this).parent(".input-group").removeClass("input-group-focus");
        });

        $("form").submit(function(e){
            e.preventDefault();

            var action = $(this).attr("action");
            var form_data = $(this).serialize();
            if(action == "login"){
                login_action(form_data);
            }
        });
    });

    function login_action(form_data){
        var username = $("#username").val();
        var password = $("#password").val();
        if(username == "" || password == ""){
            swal({
                title : "Oops!",
                text : "Harap mengisi username dan password",
                type : "info",
            });
        }
        else{
            $.ajax({
                url : "<?php echo base_url(); ?>login_action",
                type : "POST",
                dataType : "JSON",
                data : form_data,
                success : function(data){
                    if(data.checking == "Yes"){
                        swal({
                            title : "Berhasil!",
                            text : data.msg,
                            type : data.type,
                            timer : 2000,
                            showConfirmButton : false
                        }, function(){
                            location.reload();
                        });
                    }
                    else if(data.checking == "No"){
                        swal({
                            title : "Gagal!",
                            text : data.msg,
                            type : data.type
                        });
                        $("#username").val("");
                        $("#password").val("");
                        $("#pengguna").val("").selectpicker("refresh");
                    }
                },
                error : function(jqXHR, textStatus, errorThrown){
                    swal({
                        title : "Oops!",
                        text : "Gagal melakukan login, periksa koneksi internet anda",
                        type : "error",
                    });
                }
            })
        }
    }
</script>
</body>
</html>