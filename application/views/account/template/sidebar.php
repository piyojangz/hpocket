<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span>
            </h3></div>
        <ul class="nav" id="side-menu" style="margin-top: 60px;">
            <li>
                <a href="<?= base_url("account/dashboard") ?>"><i class="icon-graph  fa-fw" data-icon="v"></i>
                    แดชบอร์ด <span class="fa arrow"></span></a>
            </li>
            <li class="devider"></li>

            <li>
                <a href="javascript:;"><i class="ti-pie-chart fa-fw" data-icon="v"></i> Log (Dev) <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url("log/err") ?>"><i class="fa-fw">E</i><span
                                class="hide-menu">Error</span></a></li>
                    <li><a href="<?= base_url("log/feedback") ?>"><i class="fa-fw">F</i><span
                                class="hide-menu">Feedback</span></a></li>
                </ul>
            </li> 
            
             <li>
                <a href="javascript:;"><i class="ti-pie-chart fa-fw" data-icon="v"></i> Log (Prod) <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url("logprod/err") ?>"><i class="fa-fw">E</i><span
                                class="hide-menu">Error</span></a></li>
                    <li><a href="<?= base_url("logprod/feedback") ?>"><i class="fa-fw">F</i><span
                                class="hide-menu">Feedback</span></a></li>
                </ul>
            </li> 
            
            <li class="devider"></li>

        </ul>
    </div>
</div>