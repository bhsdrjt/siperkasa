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
            <div class="col-12 mt-4">
                <h4>Informasi Penguatan Fungsi</h4>
            </div>
            <?php if (isset($dok_penguatanFungsi)) { ?>
                <div class="col-12 mt-4">
                    <h6>Dokumentasi</h6>
                    <hr style="width:100%;border:1px solid black">

                    <!-- <div class="row mx-2">
                        <?php // foreach ($dok_penguatanFungsi as $data) { 
                        ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="<? //= base_url('uploads/penguatan_fungsi/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') 
                                            ?>" class="fancybox" rel="ligthbox">
                                    <img src="<? //= base_url('uploads/penguatan_fungsi/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') 
                                                ?>" class="zoom img-fluid " alt="">
                                </a>
                            </div>
                        <?php // } 
                        ?>
                    </div> -->
                </div>
            <?php } ?>
        </div>

        <div class="row bg-white mx-2 mb-3 pb-3" style="border-radius: 15px;border:1px solid">
            <div class="col-4 mt-4">
                <table class="table table-borderless">
                    <tr>
                        <td>Judul Laporan</td>
                        <td>: <?= isset($penguatan_fungsi->judul_laporan) ?  str_replace("div>", "span>", $penguatan_fungsi->judul_laporan) : 'Belum ada judul laporan' ?></td>
                    </tr>
                    <tr>
                        <td>Mitra</td>
                        <td>: <?= isset($penguatan_fungsi->nama_mitra) ?  $penguatan_fungsi->nama_mitra : '' ?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: <?= isset($penguatan_fungsi->lokasi) ?  $penguatan_fungsi->lokasi : '' ?></td>
                    </tr>
                    <tr>
                        <td>RKT</td>
                        <td>: <?= isset($penguatan_fungsi->nama_rkt) ?  $penguatan_fungsi->nama_rkt : '' ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>: <?= isset($penguatan_fungsi) ? tgl_indo($penguatan_fungsi->tgl_awal) . " / " . tgl_indo($penguatan_fungsi->tgl_akhir) : '' ?></td>
                    </tr>
                    <tr>
                        <td>No. PKS</td>
                        <td>: <?= isset($penguatan_fungsi->no_pks) ?  $penguatan_fungsi->no_pks : '' ?></td>
                    </tr>
                    <tr>
                        <td>Nama PKS</td>
                        <td>: <?= isset($penguatan_fungsi->surat_pks) ?  $penguatan_fungsi->surat_pks : '' ?></td>
                    </tr>
                    <tr>
                        <td>Ruang Lingkup</td>
                        <td>: <?= isset($penguatan_fungsi->ruang_lingkup) ?  str_replace("div>", "span>", $penguatan_fungsi->ruang_lingkup) : 'Belum ada judul' ?></td>
                    </tr>
                </table>
            </div>


            <div class="col-8 mt-4">
                <div class="col-12 mx-auto" style="height: 70vh" id="map"></div>

                <div class="col-12 mt-3">
                    <h4>Dokumen Pendukung</h4>
                    <table class="table text-left" style="width:50%">
                        <tr>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_pks) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_pks) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file PKS</span>' ?>
                                <br /><b>File PKS</b>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_rpp) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rpp) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file RPP</span>' ?>
                                <br /><b>File RPP</b>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_rkl_1) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rkl_1) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 1</span>' ?>
                                <br /><b>File RKL 1</b>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_rkl_2) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi/file/' . $penguatan_fungsi->file_rkl_2) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 2</span>' ?>
                                <br /><b>File RKL 2</b>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-12">
                    <h4>File Laporan</h4>
                    <table class="table text-left" style="width:fit-content">
                        <tr>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_laporan) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi_skw/file/' . $penguatan_fungsi->file_laporan) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file PKS</span>' ?>
                                <br /><b>File Laporan</b>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($penguatan_fungsi->file_spt) ? "<i class='fa fa-file-pdf-o fa-4x'></i><br/><a href=" . base_url('uploads/penguatan_fungsi_skw/file/' . $penguatan_fungsi->file_spt) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file RPP</span>' ?>
                                <br /><b>File SPT</b>
                            </td>
                        </tr>
                    </table>
                </div>
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

        <script type="text/javascript">
            // Make basemap
            const map = new L.Map('map', {
                center: new L.LatLng(58.4, 43.0),
                zoom: 11
            });
            const osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

            map.addLayer(osm);

            // Load kml file
            // fetch('assets/example1.kml')
            <?php if (!empty($penguatanFungsi->file_lokasi)) {
                $lokasi = base_url('uploads/penguatan_fungsi/file/' . $penguatanFungsi->file_lokasi);
            } else {
                $lokasi = base_url('');
            } ?>
            fetch('<?= $lokasi ?>')
                .then(res => res.text())
                .then(kmltext => {
                    // Create new kml overlay
                    const parser = new DOMParser();
                    const kml = parser.parseFromString(kmltext, 'text/xml');
                    const track = new L.KML(kml);
                    map.addLayer(track);

                    // Adjust map to show the kml
                    const bounds = track.getBounds();
                    map.fitBounds(bounds);
                });
        </script>

        <?= $this->endSection() ?>