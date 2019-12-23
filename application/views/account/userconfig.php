<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>
        .disabled{
            color: #ddd;
        }
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
                                <li><a href="#">ตั้งค่า</a></li>
                                <li class="active">เพิ่มผู้ใช้งาน</li>
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

                            <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i
                                    class="fa fa-plus m-r-5"></i> <span>เพิ่มผู้ใช้งาน</span></button>

                            <hr>
                        </div>
                        
                 

                        <div class="col-md-12">
                            <?php if ($update == 1) : ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> บันทึกเรียบร้อย. </div>
                            <?php endif; ?>
                            <div class="panel">
                                <div class="panel-heading">รายการผู้ใช้งาน</div>
                                <div class="table-responsive">
                                    <table class="table table-hover manage-u-table">
                                        <thead>
                                            <tr>
                                                <th width="70" class="text-center">#</th>
                                                <th>รหัส</th>
                                                <th>ชื่อ</th>
                                                <th width="150">MANAGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $index => $item): ?>
                                                <tr>
                                                    <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                                    <td style="vertical-align: middle;"><?= $item->email ?></td>
                                                    <td style="vertical-align: middle;"><?= $item->name ?></td>

                                                    </td>
                                                    <td>

                                                        <button type="button"
                                                                class="btn btn-info btn-outline btn-circle btn-lg m-r-5"
                                                                onclick="edititem('<?= $item->id ?>');"><i
                                                                class="ti-pencil-alt"></i></button>
                                                        <?php if ($item->id != 1): ?><button type="button"
                                                                    class="btn btn-info btn-outline btn-circle btn-lg m-r-5"
                                                                    onclick="removeitem('<?= $item->id ?>', '<?= $item->token ?>', 'true')"><i
                                                                    class="ti-trash"></i></button>
                                                            <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>


                    <form action="<?= base_url("account/$token/addnewuser") ?>" method="post" onsubmit="return checkpassword()"
                          class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
                        <div class="panel panel-default">
                            <div class="panel-heading">เพิ่ม / แก้ไข</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-info ">
                                                <div class="panel-body">

                                                    <div class="form-body">



                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ชื่อ</label>
                                                            <div class="col-md-9">
                                                                <input type="text" name="name" id="name" required
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">อีเมลล์</label>
                                                            <div class="col-md-9">
                                                                <input type="email" name="email" id="email" required 
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">รหัสผ่าน</label>
                                                            <div class="col-md-9">
                                                                <input type="password" name="password" id="password" required  
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ยืนยันรหัสผ่าน</label>
                                                            <div class="col-md-9">
                                                                <input type="password" name="repassword" id="repassword" required 
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-9 col-md-3">
                                                                            <button type="submit" id="btnsubmit"
                                                                                    class="btn btn-success"><i
                                                                                    class="fa fa-check"></i>
                                                                                บันทึก/แก้ไขข้อมูล
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="id" name="id"/>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>

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
                        function checkpassword() {
                            var pass1 = $("#password").val();
                            var pass2 = $("#repassword").val();
                            if (pass1 != pass2) {
                                alert("password ไม่ตรงกัน");
                                $("#repassword").focus();
                                return false;
                            }
                            return true;

                        }
                        $(document).ready(function () {

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


                            $('.btn-item-modal').click(function () {
                                $("#id").val("");
                                $("#name").val("");
                                $("#email").val("");
                                $("#password").val("");
                                $("#repassword").val("");
                                $("#name").removeAttr("disabled").removeClass("disabled");
                                $("#email").removeAttr("disabled").removeClass("disabled");

                                $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);
                            });


                        });

                        function edititem(id) {
                            $('div.block1').block({
                                message: '<h3>กรุณารอสักครู่...</h3>',
                                css: {
                                    border: '1px solid #fff'
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url('service/getmerchant'); ?>",
                                data: {'id': id},
                                dataType: "json",
                                success: function (data) {
                                    $('div.block1').unblock();
                                    console.log(data.result);
                                    if (data.result != null) {
                                        $("#id").val(data.result.id);
                                        $("#name").val(data.result.name);
                                        $("#email").val(data.result.email);
                                        $("#name").attr("disabled", "disabled").addClass("disabled");
                                        $("#email").attr("disabled", "disabled").addClass("disabled");
                                        $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);
                                    }

                                },
                                error: function (XMLHttpRequest) {
                                    $('div.block1').unblock();
                                }
                            });
                        }

                        function removeitem(id, token, isdelete) {

                            swal({
                                title: "Are you sure?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    swal("Deleted!", "Your data been deleted.", "success");
                                    location.href = '<?= base_url("account/removeuser/") ?>' + id + '/' + token + '/' + isdelete;

                                } else {
                                    swal("Cancelled", "", "error");
                                }
                            });
                        }


    </script>
</html>
