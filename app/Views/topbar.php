<style>
.user-profile {
    background: linear-gradient(to right, #87CEEB 0%, #8ecdf7 100%);
}

.user-profile img.avatar {
    height: 40px;
    width: 40px;
}

.mainheader-area {
    height: 60px;
    display: flex;
    align-items: center;
}

.user-profile {
    padding: 9.5px 38px;
}

.text-white {
    color: white;
    text-align: center;
    font-size: 32px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Tambahkan bayangan pada teks */
}

.bksda {
    font-size: 12px;
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

</style>
<!-- main header area start -->
<div class="mainheader-area" style="background-color: #122222 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <h4 class="text-white">
                    SIPERKASA<br>
                    <span class="bksda">BKSDA KALIMANTAN SELATAN</span>
                </h4>
            </div>


            <!-- profile info & task notification -->
            <div class="col-md-9 clearfix text-right align-items-center">
                <div class="d-md-inline-block d-block mr-md-4">
                    <ul class="notification-area">
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                    </ul>
                </div>
                <div class="clearfix d-md-inline-block d-block">
                    <div class="user-profile ">
                        <img class="avatar user-thumb" src="<?= base_url() ?>/assets/images/author/user.png"
                            alt="avatar">
                        <?php if (session('level') == 'mitra') { ?>
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= session('username') ?> <i
                                class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('auth_mitra/logout') ?>">Log Out</a>
                        </div>
                        <?php } else { ?>
                        <?php if (session('level') == 'Admin') { ?>
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Admin <i
                                class="fa fa-angle-down"></i></h4>
                        <?php } else { ?>
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">P. <?= session('level') ?> <i
                                class="fa fa-angle-down"></i></h4>
                        <?php } ?>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Log Out</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- main header area end -->