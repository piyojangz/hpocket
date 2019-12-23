<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>
        .cropit-preview-edit{
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 300px;
            height: 300px;
        }
        .cropit-preview-edit img{
            width: 100%;
        }
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 300px;
            height: 300px;
        }
        .cropit-image-input{
            visibility: hidden;
        }
        .cropit-preview-image-container {
            cursor: move;
        }
        .cropit-preview-background {
            opacity: .2;
            cursor: auto;
        }
        .image-size-label {
            margin-top: 10px;
        }
        input, .export {
            /* Use relative position to prevent from being covered by image background */
            position: relative;
            z-index: 10;
            display: block;
        }
        button {
            margin-top: 10px;
        }
    </style>
    <body class="fix-header">
        <!-- ============================================================== -->
        <!-- Preloader -->
        <!-- ============================================================== -->
        <?php $this->load->view('account/template/preloader'); ?> 
        <!-- ============================================================== -->
        <!-- Wrapper -->
        <!-- ============================================================== -->
        <div id="wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <?php $this->load->view('account/template/nav'); ?>  
            <!-- End Top Navigation -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <?php $this->load->view('account/template/sidebar'); ?> 
            <!-- ============================================================== -->
            <!-- End Left Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Log</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li ><a href="#" >Log</a></li> 
                                <li class="active">Error</li> 
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->


                    <div class="row el-element-overlay m-b-40 block1"> 

                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">รายการ Error</div>
                                <pre><?= print_r($err) ?></pre>
                            </div>
                        </div>

                    </div> 






                </div> 

                <!-- /.container-fluid -->

                <?php $this->load->view('account/template/footer'); ?> 
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
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
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url("res/account/js/custom.min.js") ?>"></script> 
        <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
        <!--Style Switcher -->
        <script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
        <!-- Sweet-Alert  -->
        <script src="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.min.js") ?>"></script> 

        <script src="<?= base_url("res/account/plugins/bower_components/dropify/dist/js/dropify.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/cropit/jquery.cropit.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>

        <!-- Magnific popup JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script> 
    </body> 
</html>
