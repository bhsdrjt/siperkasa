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

        .title {
            color: white;
        }

        .submenu {
            font-size: 10px;
            font-weight: bold;
        }
    </style>

    <?php
    // Mengambil instance dari router
    $router = service('router');

    // Mengambil nama kelas (controller)
    $menu = $router->controllerName();

    // Mengambil nama metode (method)
    $submenu = $router->methodName();

    ?>

    <div class="sidebar-menu menu2" style="background-color: #87CEEB;">
        <div class="sidebar-menu-inner">
            <header class="logo-env">
                <!-- logo -->
                <div class="logo">
                    <div class="col-md-12">
                        <h4 class="text-white" style="font-size: 30px;">
                            SIPERKASA<br>
                            <span class="bksda">BKSDA KALIMANTAN SELATAN</span>
                        </h4>
                    </div>
                </div>
                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i style="color: aliceblue;" class="entypo-menu"></i>
                    </a>
                </div>
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i style="color: aliceblue;" class="entypo-menu"></i>
                    </a>
                </div>
            </header>
            <ul id="main-menu" class="main-menu">
                <!-- Untuk admin -->
                <?php if (session('level') == 'Admin') { ?>
                    <li class="<?= (isset($submenu) && $submenu == 'index') ? "active " : ""; ?> ">
                        <a href="<?= base_url('dashboard') ?>" class="topbar">
                            <i class="fa fa-dashboard"></i>
                            <span >Dashboard </span>
                        </a>
                    </li>

                    <li class="<?= ($submenu == 'user' || $submenu == 'mitra') ? 'opened root-level' : '' ?>">
                        <a class="topbar">
                            <i class="fa fa-database"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="submenu">
                            <li class="<?= ($submenu == 'user') ? 'active' : ''; ?>"><a href="<?= base_url('data_master/user') ?>">User</a></li>
                            <li class="<?= ($submenu == 'mitra') ? 'active' : ''; ?>"><a href="<?= base_url('data_master/mitra') ?>">Mitra</a></li>
                        </ul>

                    </li>
                    <li class="<?= (  $menu =='\App\Controllers\Kerja_sama' && ($submenu == 'penguatan_fungsi' || $submenu == 'pembangunan_strategis')) ? 'opened root-level' : '' ?>">
                        <a class="topbar"><i class="fa fa-file-text"></i><span>Kerja Sama</span></a>
                        <ul class="submenu">
                            <li class="<?= ($menu =='\App\Controllers\Kerja_sama' && $submenu == 'penguatan_fungsi') ? 'active' : ''; ?>">
                                <a href="<?= base_url('kerja_sama/penguatan_fungsi') ?>">Penguatan Fungsi</a>
                            </li>
                            <li class="<?= ($menu =='\App\Controllers\Kerja_sama' && $submenu == 'pembangunan_strategis') ? 'active' : ''; ?>">
                                <a href="<?= base_url('kerja_sama/pembangunan_strategis') ?>">Pembangunan Strategis</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= ($menu =='\App\Controllers\Galeri' && ($submenu == 'penguatan_fungsi' || $submenu == 'pembangunan_strategis')) ? 'opened root-level' : '' ?>">
                        <a class="topbar"><i class="fa fa-picture-o"></i><span>Galeri</span></a>
                        <ul class="submenu">
                            <li class="<?= $menu =='\App\Controllers\Galeri' &&  $submenu == 'penguatan_fungsi'? 'active':'';?>">
                                <a href="<?= base_url('galeri/penguatan_fungsi/dashboard') ?>">Penguatan Fungsi </a>
                            </li>
                            <li <?= $menu =='\App\Controllers\Galeri' &&  $submenu == 'pembangunan_strategis'? 'active':'';?>>
                                <a href="<?= base_url('galeri/pembangunan_strategis/dashboard') ?>">Pembangunan Strategis </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Untuk petugas pelaksana -->
                <?php } else { ?>
                    <li class="<?= $submenu == 'dashbard_skw' ? 'active':'';?>">
                        <a href="<?= base_url('dashboard/skw') ?>">
                            <i class="ti-dashboard"></i>
                            <span>Dashboard </span>
                        </a>
                    </li>
                    <li class="<?= $submenu == 'penguatan_fungsi_skw' || $submenu == 'pembangunan_strategis_skw'  ? 'opened root-level' : '' ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-file-text" class="topbar"></i>
                            <span>Kerja Sama</span>
                        </a>
                        <ul class="submenu">
                            <li class="<?= $submenu == 'penguatan_fungsi_skw' ? 'active':'';?>">
                                <a href="<?= base_url('kerja_sama/penguatan_fungsi_skw') ?>">Penguatan Fungsi</a>
                            </li>
                            <li class="<?= $submenu == 'pembangunan_strategis_skw' ? 'active':'';?>">
                                <a href="<?= base_url('kerja_sama/pembangunan_strategis_skw') ?>">Pembangunan Strategis</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- header area start -->
