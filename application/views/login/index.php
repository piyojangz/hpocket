<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/account/plugins/images/favicon.png") ?>">
    <title>NTL APP MONITORING | เข้าสู่ระบบ</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url("res/account/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css") ?>"
          rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/toast-master/css/jquery.toast.css") ?>"
          rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/morrisjs/morris.css") ?>" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.css") ?>"
          rel="stylesheet">
    <link href="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css") ?>"
          rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/calendar/dist/fullcalendar.css") ?>"
          rel="stylesheet"/>
    <!-- animation CSS -->
    <link href="<?= base_url("res/account/css/animate.css") ?>" rel="stylesheet">
    <!--alerts CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.css") ?>" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet"
          href="<?= base_url("res/account/plugins/bower_components/dropify/dist/css/dropify.min.css") ?>">
    <!-- Popup CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css") ?>"
          rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url("res/account/css/colors/default.css") ?>" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register" style="overflow-y: scroll;">
    <div class="lg-info-panel">
        <div class="inner-panel">
           
            <div class="lg-content">
                <h2>NTL APP MONITORING</h2>  
            </div>
        </div>
    </div>
    <div class="new-login-box">
        <div class="white-box">
            <?php if (!$login): ?>
                <div class="alert alert-success" id="passwordnotmath">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    ชื่อผู้ใช้ / รหัสผ่านผิดพลาด
                </div>
            <?php endif; ?>
            <?php if ($register): ?>
                <div class="alert alert-success" id="passwordnotmath">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    สมัครสมาชิกเรียบร้อย
                </div>
            <?php endif; ?>
            <h3 class="box-title m-b-0" style="font-weight: bold;">เข้าสู่ระบบจัดการ</h3>
            <form class="form-horizontal new-lg-form" id="loginform" action="" method="post"
                  enctype="multipart/form-data">
                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label style="font-weight: bold;">อีเมลล์</label>
                        <input class="form-control" type="text" name="email" required placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label style="font-weight: bold;">รหัสผ่าน</label>
                        <input class="form-control" type="password" name="password" required placeholder="Password">
                    </div>
                </div> 
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block  text-uppercase waves-effect waves-light"
                                type="submit">เข้าสู่ระบบ
                        </button>
                    </div>
                </div> 
              
            </form>
           
        </div>
    </div>


</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url("res/account/plugins/bower_components/jquery/dist/jquery.min.js") ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url("res/account/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js") ?>"></script>
<!--slimscroll JavaScript -->
<script src="<?= base_url("res/account/js/jquery.slimscroll.js") ?>"></script>
<!--Wave Effects -->
<script src="<?= base_url("res/account/js/waves.js") ?>"></script>
<!--Counter js -->
<script src="<?= base_url("res/account/plugins/bower_components/waypoints/lib/jquery.waypoints.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/counterup/jquery.counterup.min.js") ?>"></script>
<!-- chartist chart -->
<script src="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js") ?>"></script>
<!-- Sparkline chart JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js") ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= base_url("res/account/js/custom.min.js") ?>"></script>
<script src="<?= base_url("res/account/js/dashboard1.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
<!--Style Switcher -->
<script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
 

<script src="https://www.gstatic.com/firebasejs/5.2.0/firebase.js"></script> 
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCswwrgGyX7wtpYzsjQAiS9_nOCEgIjU7E",
    authDomain: "ntl-mobile.firebaseapp.com",
    databaseURL: "https://ntl-mobile.firebaseio.com",
    projectId: "ntl-mobile",
    storageBucket: "ntl-mobile.appspot.com",
    messagingSenderId: "852248149969"
  };
  firebase.initializeApp(config);

  
</script>


<script> 
</script>

</body>
</html>
