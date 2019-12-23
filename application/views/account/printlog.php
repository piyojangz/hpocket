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
                            <h4 class="page-title">Log</h4></div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Log</a></li> 
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
                                <div class="white-box">
                                    <div class="table-responsive">
                                        <table class="table product-overview" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>sku</th> 
                                                    <th>ชื่อสินค้า</th> 
                                                    <th>จำนวนแถว</th> 
                                                    <th>assembly_addr1</th>
                                                    <th>assembly_addr2</th>
                                                    <th>assembly_addr3</th>
                                                    <th>assembly_country</th>
                                                    <th>size</th> 
                                                    <th>howto</th>
                                                    <th>guide</th>
                                                    <th>manudate</th>
                                                    <th>createdate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $index => $item): ?>
                                                    <tr>
                                                        <td><?= $offset + $index + 1 ?></td> 
                                                        <td><?= $item->sku ?></td>
                                                        <td><?= $item->name ?></td>
                                                        <td><?= $item->amount ?></td>
                                                        <td><?= $item->assembly_addr1 ?></td>
                                                        <td><?= $item->assembly_addr2 ?></td>
                                                        <td><?= $item->assembly_addr3 ?></td>
                                                        <td><?= $item->assembly_country ?></td>
                                                        <td><?= $item->size ?></td>
                                                        <td><?= $item->howto ?></td>
                                                        <td><?= $item->guide ?></td>
                                                        <td><?= $item->manudate ?></td>
                                                        <td><?= $item->createdate ?></td> 
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="13"><?= $this->pagination->create_links(); ?></td>
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
                                                            <label class="control-label col-md-3">จำนวนแถว (1 แถวมี 3 ดวง) <font style="color: red;">*</font></label>
                                                            <div class="col-md-9">
                                                                <input type="number" name="row" id="row" class="form-control"
                                                                       maxlength="5" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ชื่อสินค้า</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" id="name" name="name" ></textarea> 
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">จัดจำหน่ายโดย</label>
                                                            <div class="col-md-9">
                                                                <div class="form-group"> 
                                                                    <select class="form-control" name="assembly_addr" id="assembly_addr"  >
                                                                        <option   value="0">=== กรุณาเลือก ===</option>
                                                                        <?php foreach ($suppliers as $val): ?>
                                                                            <option value="<?= $val->id ?>"><?= $val->name ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>

                                                                </div>
<!--                                                                <textarea class="form-control" id="assembly_addr" name="assembly_addr" ></textarea> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ประเทศผู้ผลิต</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" id="assembly_country" name="assembly_country" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ขนาด</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" id="size" name="size" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">วิธีใช้</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" id="howto" name="howto" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ข้อแนะนำ</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" id="guide" name="guide" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">วันที่ผลิต</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" id="manudate" name="manudate" />
                                                            </div>
                                                        </div>

                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-9 col-md-3">
                                                                            <button type="submit" id="btnsubmit" name="btnsubmit"
                                                                                    class="btn btn-success"><i
                                                                                    class="fa fa-check"></i> ส่งพิมพ์
                                                                            </button>

                                                                            <!--<input type="checkbox" id="test" name="test" /><label for="test" >TSC test lib</label>-->
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
        function  openprint(sku, id) {
            $("#sku").html(sku);
            $("#hdsku").val(sku);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getitem'); ?>",
                data: {'id': id},
                dataType: "json",
                success: function (data) {

                    $("#name").text(data.result.name);
                    $("#assembly_addr").val(data.result.supplier_id);
                    $("#assembly_country").val(data.result.assembly_country);
                    $("#size").val(data.result.size);
                    $("#howto").val(data.result.howto);
                    $("#guide").val(data.result.guide);
                    $("#manudate").val(data.result.manudate);
                },
                error: function (XMLHttpRequest) {
                    $('div.block1').unblock();
                }
            });



            $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);


        }
        $(document).ready(function () {
            $("#form-submit").on("submit", function (e) {
                e.preventDefault();
                var sku = $("#hdsku").val();
                var row = $("#row").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/addprintlog'); ?>",
                    data: $("#form-submit").serialize(),
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        if (data.istsc == 1) {

                            var w = 400;
                            var h = 400;
                            var left = (screen.width / 2) - (w / 2);
                            var top = (screen.height / 2) - (h / 2);
                            window.open('<?= base_url("account/$token/printingscblabelwithtsc") ?>?printid=' + data.printid + '&sku=' + sku + '&row=' + row + '', '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                        } else {
                            window.open('<?= base_url("account/$token/printingscblabel") ?>?printid=' + data.printid + '&sku=' + sku + '&row=' + row + '', '_blank', false);
                        }

                    },
                    error: function (XMLHttpRequest) {

                    }
                });

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
