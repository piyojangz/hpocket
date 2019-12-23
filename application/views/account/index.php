<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>

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
                            <h4 class="page-title">แดชบอร์ด</h4></div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li class="active"><a href="#">แดชบอร์ด</a></li>
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
                            <h3 class="box-title m-b-0">Application configuration</h3>
                            <hr/>

                            <div class="col-sm-6">
                                <div class="white-box"> 
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3 class="box-title m-b-0">Development</h3>
                                            <div class="white-box p-l-20 p-r-20">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="form-horizontal" method="post"  id="form-submit">
                                                            <div class="form-group">
                                                                <label class="col-md-12">ข้อความประกาศ</label>
                                                                <div class="col-md-12">
                                                                    <div style=" margin: 0 auto">
                                                                        <input type="text" name="txtAnnounce" class="form-control form-control-line" value="<?= $appdev->Announce ?>" />
                                                                    </div>
                                                                </div> 
                                                            </div> 
                                                            <div class="col-md-6">
                                                                <h3 class="box-title m-b-0" style="color:green">Android</h3>
                                                                <div class="form-group">
                                                                    <label class="col-md-12">URL</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text"  name="txtAndroidUrl" class="form-control form-control-line" value="<?= $appdev->Android->url ?>" />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Version</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text" name="txtAndroidVersion" class="form-control form-control-line" value="<?= $appdev->Android->version ?>"/>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Update details</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto"> 
                                                                            <textarea type="text"  name="txtAndroidUpdatedetail"   class="form-control form-control-line" style="height: 100px"   ><?= $appdev->Android->updatedetail ?></textarea>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h3 class="box-title m-b-0" style="color:green">iOS</h3>
                                                                <div class="form-group">
                                                                    <label class="col-md-12">URL</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text" name="txtIosUrl"  class="form-control form-control-line" value="<?= $appdev->iOS->url ?>"  />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Version</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text"  name="txtIosVersion"  class="form-control form-control-line" value="<?= $appdev->iOS->version ?>" />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Update details</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <textarea type="text"   name="txtIosUpdatedetail"  class="form-control form-control-line" style="height: 100px"  ><?= $appdev->iOS->updatedetail ?></textarea>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                            </div> 
                                                            <button name="btnDev" id="btnDev" class="btn btn-block btn-rounded btn-default ">บันทึก</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-6">
                                <div class="white-box"> 
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3 class="box-title m-b-0">Production</h3>
                                            <div class="white-box p-l-20 p-r-20">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="form-horizontal" method="post"  id="form-submit">
                                                            <div class="form-group">
                                                                <label class="col-md-12">ข้อความประกาศ</label>
                                                                <div class="col-md-12">
                                                                    <div style=" margin: 0 auto">
                                                                        <input type="text" name="txtProdAnnounce"  class="form-control form-control-line" value="<?= $appprod->Announce ?>" />
                                                                    </div>
                                                                </div> 
                                                            </div> 
                                                            <div class="col-md-6">
                                                                <h3 class="box-title m-b-0" style="color:green">Android</h3>
                                                                <div class="form-group">
                                                                    <label class="col-md-12">URL</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text"  name="txtProdAndroidUrl"  class="form-control form-control-line" value="<?= $appprod->Android->url ?>" />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Version</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text"   name="txtProdAndroidVersion"    class="form-control form-control-line" value="<?= $appprod->Android->version ?>"/>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Update details</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <textarea type="text" name="txtProdAndroidUpdatedetail"  class="form-control form-control-line" style="height: 100px"   ><?= $appprod->Android->updatedetail ?></textarea>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h3 class="box-title m-b-0" style="color:green">iOS</h3>
                                                                <div class="form-group">
                                                                    <label class="col-md-12">URL</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text" name="txtProdIosUrl"  class="form-control form-control-line" value="<?= $appprod->iOS->url ?>"  />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Version</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto">
                                                                            <input type="text"  name="txtProdIosVersion" class="form-control form-control-line" value="<?= $appprod->iOS->version ?>" />
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Update details</label>
                                                                    <div class="col-md-12">
                                                                        <div style=" margin: 0 auto"> 
                                                                            <textarea type="text" name="txtProdIosUpdatedetail"  class="form-control form-control-line"  style="height: 100px"   ><?= $appprod->iOS->updatedetail?></textarea>
                                                                        </div>
                                                                    </div> 
                                                                </div> 
                                                            </div> 
                                                            <button name="btnProd" id="btnProd" class="btn btn-block btn-rounded btn-default ">บันทึก</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>



                    </div>




                </div>



                </form>


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


        <script src="<?= base_url("res/account/plugins/bower_components/flot/excanvas.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.pie.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.time.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.stack.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.crosshair.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js") ?>"></script>
        <!-- Magnific popup JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>
        <!-- Plugin JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/moment/moment.js") ?>"></script>
        <!-- Date range Plugin JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/timepicker/bootstrap-timepicker.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>
        <!-- Sweet-Alert  -->
        <script src="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.min.js") ?>"></script>

        <script type="text/javascript"
        src="<?= base_url("res/account/plugins/bower_components/custom-select/custom-select.min.js") ?>"></script>
        <script type="text/javascript"
        src="<?= base_url("res/account/plugins/bower_components/bootstrap-select/bootstrap-select.min.js") ?>"></script>
        <script type="text/javascript"
        src="<?= base_url("res/account/plugins/bower_components/multiselect/js/jquery.multi-select.js") ?>"></script>
        <script type="text/javascript"
        src="<?= base_url("res/account/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js") ?>"></script>

        <script src="<?= base_url("res/account/plugins/bower_components/switchery/dist/switchery.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") ?>"
        type="text/javascript"></script>


    </body>

</html>
