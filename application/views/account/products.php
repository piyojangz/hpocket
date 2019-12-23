<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>
        .danger{
            color: #F00;
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
            <div id="page-wrapper" class="block1">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">คลังสินค้า</h4></div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">คลังสินค้า</a></li>
                                <li class="active">สินค้า</li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->

                    <div class="row el-element-overlay m-b-40 ">
                        <div class="col-md-12">

                            <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i
                                    class="fa fa-cart-plus m-r-5"></i> <span>เพิ่มสินค้าใหม่</span></button>



                            <hr>
                        </div>

                    </div>

                    <div class="row">

                        <form action="<?= base_url("account/$token/products") ?>" method="get"  >
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

                    <div class="row">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table product-overview" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>SKU</th>
<!--                                            <th>Photo</th>-->
                                            <th>Product</th>
                                            <th>ราคาขาย</th>
                                            <th>ราคาทุน</th>
                                            <th>หมวดหมู่</th>
                                            <th>นำเข้าและจัดจำหน่าย</th>
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
                                                <td><?= number_format($item->costprice) ?></td>
                                                <td><?= $item->catename ?></td>
                                                <td><?= $item->assembly_addr ?></td>
                                                <td><?= $item->createdate ?></td> 
                                                <td>
                                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="edititem('<?= $item->id ?>');"><i class="ti-pencil-alt"></i></button> 
                                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="removeitem('<?= $item->id ?>', '<?= $token ?>', 'true')"><i class="ti-trash"></i></button> 

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9"><?= $this->pagination->create_links(); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <form action="<?= base_url("account/$token/addnewproduct") ?>" method="post"  onsubmit="return frmvalidate()" 
                      class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft block2"  
                      style="max-width: 800px;" id="form-submit">
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
                                                        <label class="control-label col-md-3">SKU <font style="color: red;">(read only)</font></label>
                                                        <div class="col-md-9">
                                                            <text class="form-control"   id="sku" ><?= $prefix->prefix ?>00<?= $autonum ?><?= $obj->validateEan13($prefix->prefix . "00" . $autonum)["checksum"] ?></text>
                                                            <input type="hidden" name="hdsku" id="hdsku" value="<?= $prefix->prefix ?>00<?= $autonum ?><?= $obj->validateEan13($prefix->prefix . "00" . $autonum)["checksum"] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Product Code <font style="color: red;">*</font></label>
                                                        <div class="col-md-9">
                                                            <input     type="text" name="productcode" id="productcode" class="form-control" placeholder="000" value="<?= $autonum ?>"
                                                                       maxlength="3" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">หมวดหมู่สินค้า <font style="color: red;">*</font></label>
                                                        <div class="col-md-9">
                                                            <select  required id="category" name="category" class="form-control">
                                                                <option value="">ไม่มี</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ชื่อสินค้า <font style="color: red;">*</font></label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="name" id="name" class="form-control"
                                                                   maxlength="35" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">จัดจำหน่ายโดย <font style="color: red;">*</font></label>
                                                        <div class="col-md-9"> 
                                                            <select required class="form-control" name="supplier" id="supplier"   >
                                                                <option   value="">=== กรุณาเลือก ===</option>
                                                                <?php foreach ($suppliers as $val): ?>
                                                                    <option value="<?= $val->id ?>"><?= $val->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ราคาขาย</label>
                                                        <div class="col-md-9">
                                                            <input type="number" name="price" id="price"    placeholder="0"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ราคาทุน</label>
                                                        <div class="col-md-9">
                                                            <input type="number" name="costprice" id="costprice"    placeholder="0"
                                                                   class="form-control">
                                                        </div>
                                                    </div> 
                                                    <!--                                                    <div class="form-group">
                                                                                                            <label class="control-label col-md-3">Unit price</label>
                                                                                                            <div class="col-md-9">
                                                                                                                <input type="number" name="unitprice" id="unitprice"    placeholder="0"
                                                                                                                       class="form-control">
                                                                                                            </div>
                                                                                                        </div>-->
                                                    <!--                                                    <div class="form-group">
                                                                                                            <label class="control-label col-md-3">Quantity</label>
                                                                                                            <div class="col-md-9">
                                                                                                                <input type="number" name="quantity" id="quantity"   placeholder="0" value="0"
                                                                                                                       class="form-control">
                                                                                                            </div>
                                                                                                        </div>-->

                                                    <!--<div class="form-group">
                                                        <label class="control-label col-md-3">นำเข้าและจัดจำหน่ายโดย</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" id="assembly_addr" name="assembly_addr" ></textarea> 
                                                        </div>
                                                    </div>-->
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

                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">SKU's (ต่อท้ายด้วย ,เพื่อเพิ่ม)</label>
                                                        <div class="col-md-9">
                                                            <div class="tags-default">
                                                                <input  id="skus" name="skus"  type="text" value="" data-role="tagsinput" placeholder="add sku" />
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!--                                                    <div class="form-group">
                                                    
                                                                                                            <label class="control-label col-md-3">Photo</label>
                                                                                                            <div class="col-md-9">
                                                                                                                <div class="cropit-preview-edit"><img id="imgedit" src=""/></div>
                                                                                                                <button class="btn-edit-img btn btn-warning waves-effect waves-light"
                                                                                                                        type="button"><span class="btn-label"><i
                                                                                                                            class="fa fa-edit"></i></span>edit
                                                                                                                </button>
                                                    
                                                    
                                                                                                                <div class="image-editor">
                                                                                                                    <input type="hidden" id="imageData" name="imageData"/>
                                                                                                                    <input type="file" class="cropit-image-input"
                                                                                                                           data-max-file-size="2M" accept=".jpg,.png"/>
                                                                                                                    <div class="cropit-preview"></div>
                                                                                                                    <div class="image-size-label">
                                                                                                                        ย่อ / ขยายรูป
                                                                                                                    </div>
                                                                                                                    <input type="range" class="cropit-image-zoom-input"
                                                                                                                           style="width:300px;">
                                                                                                                    <button class="select-image-btn btn btn-info waves-effect waves-light"
                                                                                                                            type="button"><span class="btn-label"><i
                                                                                                                                class="fa fa-image"></i></span>เลือกรูปภาพ
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>-->


                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-offset-9 col-md-3">
                                                                        <button type="submit" id="btnsubmit"
                                                                                class="btn btn-success"><i
                                                                                class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล
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
        <script type="text/javascript" src="<?= base_url("res/dist/jquery-ean13.min.js") ?>"></script>
    </body>
    <script>

                    function frmvalidate() {
                        var pcode = $("#productcode").val();
                        if (pcode.length !== 3) {
                            alert("Product Code must be 3 digits!");
                            $("#productcode").focus();
                            return false;
                        }
// 
                        return true;

                    }
                    $(document).ready(function () {

                        var sku = '<?= $prefix->prefix ?>00<?= $autonum ?>';
                                //category
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('service/getallcate'); ?>",
                                    data: {'merchantid': '<?= $merchant->id ?>'},
                                    dataType: "json",
                                    success: function (data) {
                                        var html = "";
                                        if (data.result != null) {
                                            html += '<option data-code="" value="">=== กรุณาเลือก ===</option>';
                                            $.each(data.result, function (index, value) {
                                                html += '<option data-code="' + value.code + '" value="' + value.id + '">' + value.name + '</option>';
                                            });
                                            $("#category").html(html);
                                        }

                                    },
                                    error: function (XMLHttpRequest) {

                                    }
                                });

                                $('#productcode').on('input', function (e) {
                                    var val = $(this).val();
                                    if (val.length > 2) {
                                        $('form.block2').block({
                                            message: '<h3>กรุณารอสักครู่...</h3>',
                                            css: {
                                                border: '1px solid #fff'
                                            }
                                        });
                                        var sku = $("#hdsku").val();
                                        var prefix = sku.substr(0, 7);
                                        var cate = sku.substr(7, 2);
                                        var productcode = sku.substr(9, 3);

                                        var newsku = prefix + "" + cate + "" + val;


                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url('service/checkskudup'); ?>",
                                            data: {'sku': newsku},
                                            dataType: "json",
                                            success: function (data) {
                                                if (data.result) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?php echo base_url('service/ean13checksum'); ?>",
                                                        data: {'sku': newsku},
                                                        dataType: "json",
                                                        success: function (data) {
                                                            // console.log(data);
                                                            $("#hdsku").val(data.result);
                                                            $("#sku").html(newsku + data.checksum);
                                                            $('form.block2').unblock();
                                                        },
                                                        error: function (XMLHttpRequest) {
                                                            $('form.block2').unblock();
                                                        }
                                                    });
                                                    $("#btnsubmit").prop('disabled', false)
                                                    $("#productcode").removeClass("danger");
                                                } else {
                                                    alert("Productcode is duplicate by SKU");
                                                    $("#productcode").addClass("danger");
                                                    $("#btnsubmit").prop('disabled', true);
                                                    $('form.block2').unblock();
                                                }
                                            },
                                            error: function (XMLHttpRequest) {
                                                $('form.block2').unblock();
                                            }
                                        });



                                    }

                                });

                                $("#category").change(function () {
                                    $('form.block2').block({
                                        message: '<h3>กรุณารอสักครู่...</h3>',
                                        css: {
                                            border: '1px solid #fff'
                                        }
                                    });
                                    var prefix = sku.substr(0, 7);
                                    var cate = $(this).find(':selected').attr('data-code');
                                    var productcode = sku.substr(9, 3);



                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url('service/getseqbycate'); ?>",
                                        data: {'cateid': $(this).val()},
                                        dataType: "json",
                                        success: function (data) {
                                            console.log(data);
                                            $("#productcode").val(data.result);
                                            var newsku = prefix + "" + cate + "" + data.result;
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url('service/ean13checksum'); ?>",
                                                data: {'sku': newsku},
                                                dataType: "json",
                                                success: function (data) {
                                                    // console.log(data);
                                                    $("#hdsku").val(data.result);
                                                    $("#sku").html(newsku + data.checksum);
                                                    $('form.block2').unblock();
                                                },
                                                error: function (XMLHttpRequest) {
                                                    $('form.block2').unblock();
                                                }
                                            });

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


                                $('.select-image-btn').click(function () {
                                    $('.cropit-image-input').click();
                                });
                                $('.image-editor').cropit({
                                    // exportZoom: 1.25,
                                    imageBackground: true,
                                    imageBackgroundBorderWidth: 30,
                                });
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

                                $('.btn-edit-img').click(function () {
                                    $(".image-editor").show();
                                });

                                $('.btn-item-modal').click(function () {


                                    $("#id").val("");
                                    $("#name").val("");
                                    $("#price").val("0");
                                    $("#category").val("");
                                    $(".cropit-preview-edit").hide();
                                    $(".btn-edit-img").hide();
                                    $("#imgedit").hide();
                                    $(".image-editor").show();
                                    $("#supplier").val("");
                                    $("#unitprice").val("");
                                    $("#quantity").val("");
                                    $("#costprice").val("0");
                                    $("#supplier").val("0");


                                    $("#assembly_addr").text("");
                                    $("#assembly_country").val("");
                                    $("#size").val("");
                                    $("#howto").val("");
                                    $("#guide").val("");
                                    $("#manudate").val("");

                                    $('#skus').tagsinput("removeAll");


                                    $("#productcode").prop('disabled', false);
                                    $("#category").prop('disabled', false);
                                    $("#sku").prop('disabled', false);
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
                                    url: "<?php echo base_url('service/getitem'); ?>",
                                    data: {'id': id},
                                    dataType: "json",
                                    success: function (data) {
                                        //console.log(data.result);
                                        $('div.block1').unblock();
                                        if (data.result != null) {
                                            $("#id").val(data.result.id);
                                            $("#name").val(data.result.name);
                                            $("#price").val(data.result.price);
                                            $("#category").val(data.result.cateid);
                                            $("#supplier").val(data.result.supplier);
                                            $("#costprice").val(data.result.costprice);
                                            $("#unitprice").val(data.result.unitprice);
                                            $("#quantity").val(data.result.quantity);
                                            $("#supplier").val(data.result.supplier_id);
                                            $("#customtext").val(data.result.description);
                                            $("#sku").html(data.result.sku);
                                            $("#hdsku").val(data.result.sku);
                                            $("#productcode").val(data.result.productcode);

                                            $("#assembly_addr").text(data.result.assembly_addr);
                                            $("#assembly_country").val(data.result.assembly_country);
                                            $("#size").val(data.result.size);
                                            $("#howto").val(data.result.howto);
                                            $("#guide").val(data.result.guide);
                                            $("#manudate").val(data.result.manudate);

                                            $('#skus').tagsinput("removeAll");
                                            $('#skus').tagsinput('add', data.result.skus);
                                            if (data.result.image != "") {
                                                $("#imgedit").attr("src", data.result.image);
                                                $(".image-editor").hide();
                                                $(".cropit-preview-edit").show();
                                                $(".btn-edit-img").show();
                                                $("#imgedit").show();
                                            } else {
                                                $("#imgedit").attr("src", "");
                                                $(".image-editor").show();
                                                $(".cropit-preview-edit").hide();
                                                $(".btn-edit-img").hide();
                                                $("#imgedit").hide();
                                            }
                                            $("#productcode").prop('disabled', 'disabled');
                                            $("#category").prop('disabled', 'disabled');
                                            $("#sku").prop('disabled', 'disabled');

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
                                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                        location.href = '<?= base_url("account/updateproduct/") ?>' + id + '/' + token + '/' + isdelete;

                                    } else {
                                        swal("Cancelled", "", "error");
                                    }
                                });
                            }



    </script>
</html>
