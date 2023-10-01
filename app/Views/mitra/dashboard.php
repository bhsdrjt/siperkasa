<?= $this->extend('mitra/layout'); ?>
<?= $this->section('content') ?>

<!-- <div class="main-content-inner">
  <div class="container"> -->
<div class="row">
    <div class="col-12 mt-4">
        <h4>Dashboard Mitra</h4>

        <table class="text-center table-striped" id="table-dashboard" style="width: 100%;">
            <thead class="text-capitalize bg-secondary">
                <tr>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Mitra</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Judul Laporan</th>
                    <th class="text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($penguatanFungsi)) {
                    foreach ($penguatanFungsi as $pf) { ?>
                        <tr>
                            <td><?= tgl_indo($pf['tgl_awal']) . ' - ' . tgl_indo($pf['tgl_akhir']) ?></td>
                            <td>Penguatan Fungsi</td>
                            <td><?= $pf['nama_mitra'] ?></td>
                            <td><?= $pf['lokasi'] ?></td>
                            <td><?= $pf['judul_laporan'] ?></td>
                            <td>
                                <a href="<?= base_url('mitra/galeri/penguatan_fungsi/info/' . $pf['id']) ?>" class="badge badge-info">Detail</a>
                            </td>
                        </tr>
                <?php }
                } ?>
                <?php if (isset($pembangunanStrategis)) {
                    foreach ($pembangunanStrategis as $ps) { ?>
                        <tr>
                            <td><?= tgl_indo($ps['tgl_awal']) . ' - ' . tgl_indo($ps['tgl_akhir']) ?></td>
                            <td>Pembangunan Strategis</td>
                            <td><?= $ps['nama_mitra'] ?></td>
                            <td><?= $ps['lokasi'] ?></td>
                            <td><?= $ps['judul_laporan'] ?></td>
                            <td>
                                <a href="<?= base_url('mitra/galeri/pembangunan_strategis/info/' . $ps['id']) ?>" class="badge badge-info">Detail</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <div class="col-12 mt-3 mb-3">
        <?= isset($pager) ? $pager->links('pembangunan_strategis', 'b_pagination') : '' ?>
    </div>
</div>
<!-- </div>
</div> -->



<script>
    $(document).ready(function() {

        $('#table-dashboard').DataTable({
            scrollX: true,
            paging: false, // Menghilangkan paging
            searching: false, // Menghilangkan pencarian
            lengthChange: false // Menghilangkan pilihan jumlah data
        });

    });
</script>

<?= $this->endSection() ?>