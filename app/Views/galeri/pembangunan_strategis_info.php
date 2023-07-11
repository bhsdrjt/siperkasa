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
        color: #add8e6;
    }

    .modal-footer {
        display: none;
    }

    .main-content-inner {
        background-color: #f0f8ff;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" media="screen">
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <?php if (isset($dok_pembangunanStrategis)) { ?>
                <div class="col-12 mt-4">
                    <h4>Dokumentasi Pembangunan Strategis</h4>
                    <hr style="width:100%;border:1px solid black">

                    <div class="row mx-2">
                        <?php foreach ($dok_pembangunanStrategis as $dps) {
                            foreach ($dps as $data) { ?>
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                    <a href="<?= base_url('uploads/pembangunan_strategis_skw/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') ?>" class="fancybox" rel="ligthbox">
                                        <img src="<?= base_url('uploads/pembangunan_strategis_skw/dokumentasi/' . $data->gambar . '?auto=compress&cs=tinysrgb&h=650&w=940') ?>" class="zoom img-fluid " alt="">
                                    </a>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row bg-white mx-3 mb-3 pb-3" style="border-radius: 15px;border:1px solid">
            <div class="col-5 mt-4 text-center">
                <?php if (isset($pembangunanStrategis->file_surat_pks)) { ?>
                    <img data-pdf-thumbnail-file="<?= base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_surat_pks) ?>" data-pdf-thumbnail-width="400">
                <?php  } else {
                    echo "Belum ada File Surat PKS";
                } ?>
            </div>
            <div class="col-7 mt-4">
                <i class="fa fa-calendar"> <?= isset($pembangunanStrategis) ? tgl_indo($pembangunanStrategis->tgl_awal) . " - " . tgl_indo($pembangunanStrategis->tgl_akhir) : 'Tanggal belum dipilih' ?></i>
                <br />
                <!-- <i class="fa fa-building">
                    <? //= isset($pembangunanStrategis->nama_mitra) ? $pembangunanStrategis->nama_mitra : 'Mitra belum dipilih' 
                    ?>
                </i>
                <br /> -->
                <i class="fa fa-file-text">
                    <?= isset($pembangunanStrategis->no_pks) ? $pembangunanStrategis->no_pks : 'No Surat Persetujuan belum ada' ?> &nbsp; / &nbsp;
                    <?= isset($pembangunanStrategis->surat_pks) ? $pembangunanStrategis->surat_pks : 'Surat Persetujuan belum ada' ?>
                </i>
                <h4><?= isset($pembangunanStrategis->judul) ?  str_replace("p>", "span>", $pembangunanStrategis->judul) : 'Belum ada judul' ?></h4>
                <br />
                <b>Ruang Lingkup : <?= isset($pembangunanStrategis->ruang_lingkup) ?  str_replace("div>", "span>", $pembangunanStrategis->ruang_lingkup) : 'Belum ada ruang lingkup' ?></b>

                <br />
                <i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Surat Persetujuan PKS <span style="color: grey;">[pdf]</span>
                <?= isset($pembangunanStrategis->file_surat_pks) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_surat_pks) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada surat PKS</span>' ?>

                <table class="table mt-3" style="width: 100%;">
                    <thead>
                        <th>Dokumen</th>
                        <th>Opsi</th>
                        <th>Komitmen</th>
                        <th>Realisasi</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Surat PKS <span style="color: grey;">[pdf]</span></td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->file_pks) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_pks) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file PKS</span>' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->komitmen_pks) ? $pembangunanStrategis->komitmen_pks : '' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->realisasi_pks) ? $pembangunanStrategis->realisasi_pks : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RPP <span style="color: grey;">[pdf]</span></td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->file_rpp) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rpp) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada file RPP</span>' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->komitmen_rpp) ? $pembangunanStrategis->komitmen_rpp : '' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->realisasi_rpp) ? $pembangunanStrategis->realisasi_rpp : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKL 1 <span style="color: grey;">[pdf]</span></td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->file_rkl_1) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rkl_1) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 1</span>' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->komitmen_rkl_1) ? $pembangunanStrategis->komitmen_rkl_1 : '' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->realisasi_rkl_1) ? $pembangunanStrategis->realisasi_rkl_1 : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKL 2 <span style="color: grey;">[pdf]</span></td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->file_rkl_2) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_rkl_2) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKL 2</span>' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->komitmen_rkl_2) ? $pembangunanStrategis->komitmen_rkl_2 : '' ?>
                            </td>
                            <td style="border: none !important;">
                                <?= isset($pembangunanStrategis->realisasi_rkl_2) ? $pembangunanStrategis->realisasi_rkl_2 : '' ?>
                            </td>
                        </tr>

                        <?php if (isset($fileRKT)) {
                            foreach ($fileRKT as $rkt) { ?>
                                <tr>
                                    <td style="border: none !important;"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp; Dokumen RKT <span style="color: grey;">[pdf]</span></td>
                                    <td style="border: none !important;">
                                        <?= !empty($rkt->file_rkt) ? "<a href=" . base_url('uploads/pembangunan_strategis/file/' . $rkt->file_rkt) . " class='badge badge-primary' target='_blank'>Download</a>" : '<span class="badge badge-secondary">Belum ada dokumen RKT</span>' ?>
                                    </td>
                                    <td style="border: none !important;">
                                        <?= isset($rkt->komitmen_rkt) ? $rkt->komitmen_rkt : '' ?>
                                    </td>
                                    <td style="border: none !important;">
                                        <?= isset($rkt->realisasi_rkt) ? $rkt->realisasi_rkt : '' ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mx-3 mb-3 pb-3 text-center">
            <div class="col-2">
                <button class="btn btn-block btn-warning">
                    <h5>Lokasi</h5>
                    <i class="fa fa-map-marker"> <?= isset($pembangunanStrategis->lokasi) ? $pembangunanStrategis->lokasi : 'Lokasi belum dipilih' ?></i>
                </button>
            </div>
            <div class="col-10 mx-auto" style="height: 80vh" id="map"></div>
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
            <?php if (!empty($pembangunanStrategis->file_lokasi)) {
                $lokasi = base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_lokasi);
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