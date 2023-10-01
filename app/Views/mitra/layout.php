<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Include your header content here -->
    <?= $this->include('header') ?>
</head>



<style>
    .user-profile {
        background: linear-gradient(to right, #87CEEB 0%, #8ecdf7 100%);
    }

    .user-profile img.avatar {
        height: 40px;
        width: 40px;
    }

    .mainheader-area {
        height: 50px;
        display: flex;
        align-items: center;
    }

    .user-profile {
        padding: 9.5px 38px;
    }

    .text-white {
        color: white;
        text-align: center;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        /* Tambahkan bayangan pada teks */
    }

    .bksda {
        font-size: 11px;
        display: block;
    }

    /* Animasi untuk span .bksda */
    .bksda {
        animation: moveText 2s infinite alternate;
    }

    @keyframes moveText {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-5px);
        }
    }




    @media (min-width: 1200px) and (max-width: 1364px) {
        .sbar_collapsed .sidebar-menu {
            left: 0%;
        }
    }


    .sbar_collapsed .sidebar-menu {
        left: 0px;
    }
</style>

<body class="page-body" style="font-size:12px;color:#666666">
    <div class="page-container" style="padding-left: 0px !important;">
        <!-- Include your navbar content here -->
        <?= $this->include('mitra/navbar') ?>

        <div class="main-content ">
            <div class="row hidden-print">
                <!-- Profile Info and Notifications -->
                <div class="col-md-12 clearfix text-right align-items-center">
                    <!-- <div class="d-md-inline-block d-block mr-md-4">
                        <ul class="notification-area">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div> -->
                    <div class="clearfix d-md-inline-block d-block">
                        <div class="user-profile ">
                            <!-- <img class="avatar user-thumb" src="<?= base_url() ?>/assets/images/author/user.png" alt="avatar"> -->
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= session('username') ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url('auth_mitra/logout') ?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</body>
<?= $this->include('footer') ?>



</html>