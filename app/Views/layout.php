<!doctype html>
<html class="no-js" lang="en">
<?= $this->include('header') ?>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
    <div class="loader"></div>
  </div> -->
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        <?= $this->include('topbar') ?>
        <?php if (session('level') !== 'mitra') { ?>
            <?= $this->include('navbar') ?>
        <?php } ?>
        <?= $this->renderSection('content') ?>
    </div>
</body>

</html>