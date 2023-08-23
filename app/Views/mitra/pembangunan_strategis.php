<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- <div class="main-content-inner">
  <div class="container"> -->
    <div class="row">
      <div class="col-6 mt-4">
        <h4>Dashboard Mitra</h4>
      </div>
      <div class="col-6 mt-4">
        <?= form_open('mitra/galeri/pembangunan_strategis/filter') ?>
        <!-- Form Filter -->
        <?= form_close() ?>
      </div>

      <div class="col-12 mt-4">
        <table class="text-center table-striped" id="table-dashboard">
          <thead class="text-capitalize bg-secondary">
            <tr>
              <th style="width: 15%;">Tanggal</th>
              <th style="width: 10%;">Jenis</th>
              <th style="width: 15%;">Mitra</th>
              <th style="width: 20%;">Lokasi</th>
              <th style="width: 25%;">Judul Laporan</th>
              <th style="width: 15%;">Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($combined_data)) {
              foreach ($combined_data as $ps) { ?>
                <tr>
                  <td><?= tgl_indo($ps['tgl_awal']) . " - " . tgl_indo($ps['tgl_akhir']) ?></td>
                  <td><?= $ps['jenis'] ?></td>
                  <td><?= $ps['nama_mitra'] ?></td>
                  <td><?= $ps['lokasi'] ?></td>
                  <td><?= $ps['judul_laporan'] ?></td>
                  <td>
                    <?php if ($ps['jenis'] == "pembangunan strategis") { ?>
                      <a href="<?= base_url('mitra/galeri/pembangunan_strategis/info/' . $ps['id']) ?>" class="badge badge-info">Detail</a>
                    <?php } else { ?>
                      <a href="<?= base_url('mitra/galeri/penguatan_fungsi/info/' . $ps['id']) ?>" class="badge badge-info">Detail</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php }
            } else { ?>
              <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
              </tr>
            <?php } ?>
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