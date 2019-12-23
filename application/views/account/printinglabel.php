<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/fav/favicon-16x16.png") ?>">

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url("res/account/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css") ?>" rel="stylesheet">
        <!-- toast CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/toast-master/css/jquery.toast.css") ?>" rel="stylesheet">
        <!-- morris CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/morrisjs/morris.css") ?>" rel="stylesheet">
        <!-- chartist CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css") ?>" rel="stylesheet">
        <!-- Calendar CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/calendar/dist/fullcalendar.css") ?>" rel="stylesheet" />
        <!-- animation CSS -->
        <link href="<?= base_url("res/account/css/animate.css") ?>" rel="stylesheet">
        <!--alerts CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.css") ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?= base_url("res/account/plugins/bower_components/dropify/dist/css/dropify.min.css") ?>">
        <!-- Popup CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css") ?>" rel="stylesheet">
        <link href="<?= base_url("res/account/plugins/bower_components/custom-select/custom-select.css") ?>" rel="stylesheet">
        <link href="<?= base_url("res/account/plugins/bower_components/multiselect/css/multi-select.css") ?>" rel="stylesheet">
        <!-- Daterange picker plugins css -->
        <link href="<?= base_url("res/account/plugins/bower_components/timepicker/bootstrap-timepicker.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css") ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
        <!-- summernotes CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/summernote/dist/summernote.css") ?>" rel="stylesheet" />
        <!-- xeditable css -->
        <link href="<?= base_url("res/account/plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css") ?>" rel="stylesheet" />
        <link href="<?= base_url("res/account/plugins/bower_components/switchery/dist/switchery.min.css") ?>" rel="stylesheet" />
        <!-- color CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css") ?>" rel="stylesheet" />
        <link href="<?= base_url("res/account/css/colors/default.css") ?>" id="theme" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <style> 
        .paper{
            width:10.2cm;
        }
        .printlabel{
            position: relative;
            width: 3.4cm;
            height: 4cm;
            float: left;
            display: block;
        }
        canvas{
            position: absolute; 
            height: 40px;
            width: 120px;
        }
        canvas.row1{
            top:60px;
            left: -35px;
        }
        canvas.row2{
            top:60px;
            left:8px;
        }
        canvas.row3{
            top:60px;
            left:50px;
        }
        .rotate{
            transform: rotate(270deg);
            writing-mode: vertical-rl; 
            white-space: nowrap;
            display: inline-block;
            overflow: visible;
        }
        @page {
            margin-top: 0cm;
            margin-bottom: 0cm;
/*            size:16in;
            height:10.2in;*/
            margin: 0;
        }

        @media print {
            html, body {

                margin:0 !important;
                padding:0 !important;
                height:100% !important;
            }
        } 
    </style>
    <body>
        <div class="paper">
            <?php for ($i = 0; $i < $length; $i++): ?>
                <div class="printlabel">
                    <canvas id="ean"  class="rotate row1">
                        Your browser does not support canvas-elements.
                    </canvas>
                    <canvas id="ean"  class="rotate row2">
                        Your browser does not support canvas-elements.
                    </canvas>
                    <canvas id="ean"   class="rotate row3">
                        Your browser does not support canvas-elements.
                    </canvas>
                </div>
            <?php endfor; ?>
            <div style="clear: both"></div>
        </div>
        <script src="<?= base_url("res/account/plugins/bower_components/jquery/dist/jquery.min.js") ?>"></script> 
        <script type="text/javascript" src="<?= base_url("res/dist/jquery-ean13.min.js") ?>"></script>
    </body>
    <script>
        $(document).ready(function () {
            $("canvas[id=ean]").EAN13('<?= $barcode ?>');
            window.print(); 
        });


    </script>
</html>
