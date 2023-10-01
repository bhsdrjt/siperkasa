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
                    <a href="#" class="sidebar-collapse-icon">
                        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i style="color: aliceblue;" class="entypo-menu"></i>
                    </a>
                </div>
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <!-- add class "with-animation" to support animation -->
                        <i style="color: aliceblue;" class="entypo-menu"></i>
                    </a>
                </div>
            </header>
            <ul id="main-menu" class="main-menu">

                <!-- Untuk mitra -->
                <li class="<?= $submenu == 'dashbard_skw' ? 'active' : ''; ?>">
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
                        <li class="<?= $submenu == 'penguatan_fungsi_skw' ? 'active' : ''; ?>">
                            <a href="<?= base_url('mitra/galeri/penguatan_fungsi') ?>">Penguatan Fungsi</a>
                        </li>
                        <li class="<?= $submenu == 'pembangunan_strategis_skw' ? 'active' : ''; ?>">
                            <a href="<?= base_url('mitra/galeri/pembangunan_strategis') ?>">Pembangunan Strategis</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- header area start -->