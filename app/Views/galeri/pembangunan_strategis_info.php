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

.main-table {
    font-size: 10px;
    font-weight: bold;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
    media="screen">
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <?php if (isset($dok_pembangunanStrategis)) { ?>
            <div class="col-12 mt-4">
                <h4>Data Kerja Sama</h4>
                <hr style="width:100%;border:1px solid black">
            </div>
            <?php } ?>
        </div>

        <div class="row bg-white" style="border-radius: 15px;border:1px solid">
            <div>
                <table class="main-table">
                    <tr height="50px">
                        <td width="15%">No Persetujuan</td>
                        <td width="85%"><?= isset($pembangunanStrategis->no_pks) ? $pembangunanStrategis->no_pks : '' ?>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">No PKS</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Tgl PKS</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Judul</td>
                        <td width="85%"><?= isset($pembangunanStrategis->judul) ? $pembangunanStrategis->judul : '' ?>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Unit Pengelola</td>
                        <td width="85%">BKSDA Kalimantan Selatan
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Nama Mitra</td>
                        <td width="85%">
                            <?= isset($pembangunanStrategis->nama_mitra) ? $pembangunanStrategis->nama_mitra : '' ?>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Karegori Mitra</td>
                        <td width="85%">BUMN
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Jenis Kerja Sama</td>
                        <td width="85%">Pembanguna Strategis
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Provinsi</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Fungsi Kawasan</td>
                        <td width="85%">CA
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Nama Kawasan</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Kawasan Lainnya</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Dokumen RPP</td>
                        <td width="85%"><?= isset($pembangunanStrategis->file_rpp) ? 'Ada' : 'Tidak Ada' ?>
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Tgl Berakhir</td>
                        <td width="85%">
                            <?php
                            if (isset($pembangunanStrategis->tgl_akhir)) {
                                $tanggal_akhir = $pembangunanStrategis->tgl_akhir;
                                $formatted_date = date("d/m/Y", strtotime($tanggal_akhir));
                                echo $formatted_date;
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                    </tr>

                    <tr height="50px">
                        <td width="15%">Jangka Waktu</td>
                        <td width="85%">
                            <?php
                                if (isset($pembangunanStrategis->tgl_awal) && isset($pembangunanStrategis->tgl_akhir)) {
                                    $tgl_awal = $pembangunanStrategis->tgl_awal;
                                    $tgl_akhir = $pembangunanStrategis->tgl_akhir;

                                    $date1 = new DateTime($tgl_awal);
                                    $date2 = new DateTime($tgl_akhir);
                                    $interval = $date1->diff($date2);

                                    echo $interval->y . ' tahun ';
                                } else {
                                    echo '';
                                }
                                ?>
                        </td>
                    </tr>

                    <tr height="50px">
                        <td width="15%">Luas (Ha)</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Panjang (Km)</td>
                        <td width="85%">
                        </td>
                    </tr>
                    <tr height="50px">
                        <td width="15%">Keterangan</td>
                        <td width="85%">
                        </td>
                    </tr>
                </table>
            </div>
            <div style="padding-left: 60px; padding-top:60px">
                <table>
                    <tr>
                        <td style="text-align: center;">
                            <?php if (isset($pembangunanStrategis->file_surat_pks)) { ?>
                            <img data-pdf-thumbnail-file="<?= base_url('uploads/pembangunan_strategis/file/' . $pembangunanStrategis->file_surat_pks) ?>"
                                data-pdf-thumbnail-width="240">
                            <?php  } else {
                                    echo "Belum ada File Surat PKS";
                                } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- main content area end -->


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