<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>


        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 0px solid #ccc;
            margin-top: 7px;
            width: 150px;
            height: 150px;
        }

        .cropit-image-input {
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
                            <h4 class="page-title">ตั้งค่า</h4></div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li class="active"><a href="#">ตั้งค่า</a></li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->
                    <!-- .row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($update == 1) : ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> บันทึกเรียบร้อย. </div>
                            <?php endif; ?>
                            <div class="white-box p-l-20 p-r-20">
                                <h3 class="box-title m-b-0">ตั้งค่า Prefix</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <form class="form-horizontal" method="post"
                                              action="<?= base_url("account/$token/updatesetting") ?>" id="form-submit"> 


                                            <div class="form-group">

                                                <div class="col-md-12">
                                                    <input type="number" name="prefix"  class="form-control form-control-line" maxlength="7"
                                                           value="<?= $prefix->prefix ?>"></div>
                                            </div>



                                            <button class="btn btn-block btn-outline btn-rounded btn-primary">บันทึก</button>
                                        </form>
                                    </div>
                                </div>
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


    <script>
        $(document).ready(function () {
            $('.select-image-btn').click(function () {
                $('.cropit-image-input').click();
            });
            $('.image-editor').cropit({
                //exportZoom: 1.25,
                imageBackground: true,
                imageBackgroundBorderWidth: 30,
    //                imageState: {
    //                    src: '<?= $merchant->image ?>',
    //                },
            });

            $('.cropit-preview-image').attr("src", '<?= $merchant->image ?>');
            $('.rotate-cw').click(function () {
                $('.image-editor').cropit('rotateCW');
            });
            $('.rotate-ccw').click(function () {
                $('.image-editor').cropit('rotateCCW');
            });
            $('#form-submit').submit(function () {
                var imageData = $('.image-editor').cropit('export');

                if (imageData != null) {
                    $("#imageData").val(imageData.split(",")[1]);
                }

                return true;
            });


    //        $('#name').bind('input', function () {
    //            $(this).val(function (_, v) {
    //                return v.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
    //            });
    //        });


        });
    </script>


</html>
