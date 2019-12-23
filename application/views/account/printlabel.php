<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>
        .cropit-preview-edit {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 300px;
            height: 300px;
        }

        .cropit-preview-edit img {
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
        @page {
            size: 10cm;
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
            <div id="page-wrapper" class="block1">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">พิมพ์</h4></div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">พิมพ์</a></li>
                                <li class="active">Label</li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->

                    <div class="row el-element-overlay m-b-40 ">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?= base_url("account/$token/printlabel") ?>" method="get"  >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">ค้นหา</div>
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">

                                                <div class="col-xs-10"> 
                                                    <div class="form-group"> 
                                                        <div class="input-group"> <span class="input-group-btn">
                                                                <input   value="<?= $inputsearch ?>" type="text" id="example-input1-group2" name="input-search" class="form-control" placeholder="ค้นหาด้วย SKU , Product"/> 
                                                                <button type="submit" class="btn waves-effect waves-light btn-info" style="margin: 0px;"><i class="fa fa-search"></i></button>
                                                            </span> 
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>




                                <hr>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box">
                                    <div class="table-responsive">
                                        <table class="table product-overview" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>SKU</th>
        <!--                                            <th>Photo</th>-->
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>หมวดหมู่</th>
                                                    <th>Date</th> 
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $index => $item): ?>
                                                    <tr>
                                                        <td><?= $offset + $index + 1 ?></td>
                                                        <td><?= $item->sku ?></td>
            <!--                                                <td><img src="<?= $item->image ?>" alt="iMac" width="80"> </td>-->
                                                        <td><?= $item->name ?></td>
                                                        <td><?= number_format($item->price) ?></td>
                                                        <td><?= $item->catename ?></td>
                                                        <td><?= $item->createdate ?></td> 
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5 printLabel " onclick="openprint('<?= $item->sku ?>')" ><i class="ti-printer"></i></button>  
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"><?= $this->pagination->create_links(); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form    id="form-submit" method="post"
                             class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft"
                             style="max-width: 800px;" id="form-submit">
                        <div class="panel panel-default">
                            <div class="panel-heading">สั่งพิมพ์</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-info ">
                                                <div class="panel-body">

                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">SKU <font style="color: red;">(read only)</font></label>
                                                            <div class="col-md-9">
                                                                <text class="form-control"   id="sku" name="sku" ></text> 
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">จำนวนดวง <font style="color: red;">*</font></label>
                                                            <div class="col-md-9">
                                                                <input type="number" name="row" id="row" class="form-control"
                                                                       maxlength="5" required>
                                                            </div>
                                                        </div>



                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-9 col-md-3">
                                                                            <button type="submit" id="btnsubmit"
                                                                                    class="btn btn-success"><i
                                                                                    class="fa fa-check"></i> ส่งพิมพ์
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="hdsku" name="hdsku"/>

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
            <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js") ?>"></script>
    </body>
    <script>
                                                                function  openprint(sku) {
                                                                    $("#sku").html(sku);
                                                                    $("#hdsku").val(sku);

                                                                    $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);
                                                                }
                                                                $(document).ready(function () {

                                                                    $("#form-submit").on("submit", function (e) {
                                                                        e.preventDefault();
                                                                        var sku = $("#hdsku").val();
                                                                        var row = $("#row").val();
                                                                        window.open('<?= base_url("account/$token/printinglabel") ?>?sku=' + sku + '&row=' + row + '', '_blank', false);
                                                                    });
                                                                    $('.popup-with-form').magnificPopup({
                                                                        type: 'inline',
                                                                        preloader: true,
                                                                        focus: '#name',
                                                                        callbacks: {
                                                                            beforeOpen: function () {
                                                                                if ($(window).width() < 700) {
                                                                                    this.st.focus = false;
                                                                                } else {
                                                                                    this.st.focus = '#name';
                                                                                }
                                                                            }
                                                                        }
                                                                    });

                                                                });




    </script>
</html>
