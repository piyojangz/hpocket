<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="<?= base_url("account/dashboard") ?>">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon--><img src="<?= base_url("res/account/plugins/images/admin-logo.png") ?>"
                                                      style="width: 50px;" alt="home" class="dark-logo"/>
                    <!--This is light logo icon--><img
                        src="<?= base_url("res/account/plugins/images/admin-logo.png") ?>" alt="home"
                        class="light-logo" style="width:38px;"/>
                </b>
                <!-- Logo text image you can use text also --><span class="hidden-xs" style="color: #2196f3;
                                                                    font-weight: 500;
                                                                    font-size: 1em;">
                    <!--This is dark logo text-->NTL MGM <small style="font-size: 1em;
                                                                font-weight: 400;
                                                                color: #2196f3;">Admin</small><!--This is light logo text-->
                </span> </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a>
            </li> 

        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!--            <li>
                            <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                                <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                        </li>-->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?= base_url("res/account/plugins/images/admin-logo.png") ?>"
                                                                                             alt="user-img" width="36"
                                                                                             class="img-circle"><b
                                                                                             class="hidden-xs"><?= $user->name ?></b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box"> 
                            <div class="u-text">
                                <h4><?= $user->name ?></h4>
                                <p class="text-muted"><?= $user->email ?></p> 
                            </div>
                        </div>
                    </li>
                    <!--                    <li role="separator" class="divider"></li>-->
                    <!--                    <li><a href="<?= base_url("account/info") ?>"><i class="ti-user"></i> ข้อมูลร้านค้า</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url("account/setting") ?>"><i class="ti-settings"></i> ตั้งค่า</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url("logout") ?>"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>