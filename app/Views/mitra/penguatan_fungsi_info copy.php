<?= $this->extend('layout'); ?>

<?= $this->section('content') ?>
<style>
    #demo {
        height: 100%;
        position: relative;
        overflow: hidden;
    }


    .green {
        background-color: #6fb936;
    }

    .thumb {
        margin-bottom: 30px;
    }

    .page-top {
        margin-top: 85px;
    }


    img.zoom {
        width: 100%;
        height: 200px;
        border-radius: 5px;
        object-fit: cover;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        -ms-transition: all .3s ease-in-out;
    }


    .transition {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }

    .modal-header {

        border-bottom: none;
    }

    .modal-title {
        color: #000;
    }

    .modal-footer {
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" media="screen">
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <?php if (isset($dok_penguatanFungsi)) { ?>
                <div class="col-12 mt-4">
                    <h4>Dokumentasi Penguatan Fungsi</h4>
                    <hr style="width:100%;border:1px solid black">

                    <div class="row mx-2">
                        <?php foreach ($dok_penguatanFungsi as $data) { ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="<?= base_url('uploads/penguatan_fungsi/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') ?>" class="fancybox" rel="ligthbox">
                                    <img src="<?= base_url('uploads/penguatan_fungsi/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') ?>" class="zoom img-fluid " alt="">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row bg-white mx-3 mb-3 pb-3" style="border-radius: 15px;border:1px solid">
            <div class="col-5 mt-4 text-center">
                <?= isset($penguatan_fungsi->gambar_cover) ? "<img src=" . base_url('uploads/penguatan_fungsi/cover/' . $penguatan_fungsi->gambar_cover) . " width='410px'>" : 'Belum ada cover' ?>
            </div>
            <div class="col-7 mt-4">
                <i class="fa fa-calendar"> <?= isset($penguatan_fungsi->tgl_upload) ? tgl_indo($penguatan_fungsi->tgl_upload) : 'Tanggal belum dipilih' ?></i>
                <h4><?= isset($penguatan_fungsi->judul) ?  str_replace("p>", "span>", $penguatan_fungsi->judul) : 'Belum ada judul' ?></h4>

                <table class="table mt-3" style="width: 60%;">
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Surat PKS <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->surat_pks) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->surat_pks) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada surat PKS</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Ruang Lingkup PKS <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_ruang_lingkup) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_ruang_lingkup) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada ruang lingkup PKS</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RPP <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_rpp) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rpp) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file RPP</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKL 1 <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_rkl_1) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rkl_1) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 1</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKL 2 <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_rkl_2) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rkl_2) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 2</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKT <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_rkt) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rkt) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKT</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen PKS <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_pks) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_pks) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen PKS</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Laporan Kerja sama <span style="color: grey;"">[pdf]</span></td>
                        <td style=" border: none !important;">
                                <?= isset($penguatan_fungsi->file_laporan_kerjasama) ? "<a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_laporan_kerjasama) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada Laporan Kerja Sama</span>' ?>
                        </td>
                    </tr>
                </table>

                <h6 class=" mb-lg-5">
                    <?= isset($penguatan_fungsi->kawasan_konservasi) ? str_replace("p>", "span>", $penguatan_fungsi->kawasan_konservasi) : 'Belum ada kawasan konservasi' ?>
                </h6>
            </div>
        </div>

        <!-- main content area end -->

        <?= $this->include('footer') ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none"
                });

                $(".zoom").hover(function() {

                    $(this).addClass('transition');
                }, function() {

                    $(this).removeClass('transition');
                });
            });
        </script>

        <?= $this->endSection() ?>