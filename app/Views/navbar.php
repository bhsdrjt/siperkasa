    <style>
        .topbar {
            font-size: 16px !important;
            font-family: Open Sans;
            font-weight: bold;
        }

        .header-area {
            height: 50px;
            display: flex;
            align-items: center;
        }
        .footer-area {
            height: 50px;
        }
    </style>

    <!-- header area start -->
    <div class="header-area header-bottom">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 d-none d-lg-block">
                    <div class="horizontal-menu">
                        <nav>
                            <ul id="nav_menu">
                                <!-- Untuk admin -->
                                <?php if (session('level') == 'Admin') { ?>
                                    <li class="<?= isset($title) && $title == 'Dashboard' ? 'active' : '' ?>"><a href="<?= base_url('dashboard') ?>" class="topbar"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                    <li class="<?= isset($title) && $title == 'Data Master' ? 'active' : '' ?>">
                                        <a href="javascript:void(0)" class="topbar"><i class="fa fa-database"></i><span>Data Master</span></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url('data_master/user') ?>">User</a></li>
                                            <li><a href="<?= base_url('data_master/mitra') ?>">Mitra</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?= isset($title) && $title == 'Kerja Sama' ? 'active' : '' ?>">
                                        <a href="javascript:void(0)" class="topbar"><i class="fa fa-file-text"></i><span>Kerja Sama</span></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url('kerja_sama/penguatan_fungsi') ?>">Penguatan Fungsi</a></li>
                                            <li><a href="<?= base_url('kerja_sama/pembangunan_strategis') ?>">Pembangunan Strategis</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?= isset($title) && $title == 'Galeri' ? 'active' : '' ?>">
                                        <a href="javascript:void(0)" class="topbar"><i class="fa fa-picture-o"></i><span>Galeri</span></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url('galeri/penguatan_fungsi/dashboard') ?>">Penguatan Fungsi</a></li>
                                            <li><a href="<?= base_url('galeri/pembangunan_strategis/dashboard') ?>">Pembangunan Strategis</a></li>
                                        </ul>
                                    </li>
                                    <!-- Untuk petugas pelaksana -->
                                <?php } else { ?>
                                    <li class="<?= isset($title) && $title == 'Dashboard' ? 'active' : '' ?>"><a href="<?= base_url('dashboard/skw') ?>"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                    <li class="<?= isset($title) && $title == 'Kerja Sama' ? 'active' : '' ?>">
                                        <a href="javascript:void(0)"><i class="fa fa-file-text" class="topbar"></i><span>Kerja Sama</span></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url('kerja_sama/penguatan_fungsi_skw') ?>">Penguatan Fungsi</a></li>
                                            <li><a href="<?= base_url('kerja_sama/pembangunan_strategis_skw') ?>">Pembangunan Strategis</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- nav and search button -->
                <!-- <div class="col-lg-3 clearfix">
                <div class="search-box">
                    <form action="#">
                        <input type="text" name="search" placeholder="Search..." required>
                        <i class="ti-search"></i>
                    </form>
                </div>
            </div> -->
                <!-- mobile_menu -->
                <div class="col-12 d-block d-lg-none">
                    <div id="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- header area end -->