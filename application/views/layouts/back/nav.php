<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div id="breadcrumb">
            <?php
            if (!isset($breadcrumb)) {
                echo "";
            } else {
                echo $breadcrumb;
            }
            ?>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center mr-1">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
                    </a>
                    <?php if (checkNotif()=='') { ?>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 notif" style="z-index: 999;width: 50vw;" aria-labelledby="dropdownMenuButton">
                            <?php echo checkNotif(); ?>
                        </ul>
                    <?php }else { ?>
                        
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 notif" style="z-index: 999;width: 50vw;" aria-labelledby="dropdownMenuButton">
                            <?php echo checkNotif(); ?> 
                        </ul>
                        <span class=" top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                        <!-- <div class=" position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </div> -->
                    <?php } ?>
                    
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="<?php echo base_url('authentication/logout') ?>" class="nav-link text-body font-weight-bold px-0">
                        <span class="d-sm-inline d-none mr-1">Sign Out</span>
                        <i class="fa fa-solid fa-arrow-right-to-bracket me-md-1"></i>
                    </a>
                </li>
                <li class="nav-item px-3 d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>