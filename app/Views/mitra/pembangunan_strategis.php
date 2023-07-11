<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
  <div class="container">
    <div class="row">
      <div class="col-12 text-left mt-4">
        <a href="<?= base_url('mitra/galeri/penguatan_fungsi') ?>" class="btn btn-lg btn-primary" style="font-size:large">Penguatan Fungsi</a>
        <a href="<?= base_url('mitra/galeri/pembangunan_strategis') ?>" class="btn btn-lg btn-warning" style="font-size:large">Pembangunan Strategis</a>
      </div>

      <div class="col-6 mt-4">
        <h4>Kerja Sama Pembangunan Strategis</h4>
      </div>
      <div class="col-6 mt-4">
        <?= form_open('mitra/galeri/pembangunan_strategis/filter') ?>
        <div class="form-row align-items-center">
          <div class="col-4 my-1">
            <input type="date" class="form-control" name="startDate" value="<?= isset($startDate) ? $startDate : '' ?>">
          </div>
          <div class="col-1 text-center">
            <!-- <hr style="border: 1px solid black;"> -->
            Sampai
          </div>
          <div class="col-4 my-1">
            <input type="date" class="form-control" name="endDate" value="<?= isset($endDate) ? $endDate : '' ?>">
          </div>
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary">Cari</button>
          </div>
        </div>
        <?= form_close() ?>
      </div>

      <?php if (isset($pembangunan_strategis)) {
        foreach ($pembangunan_strategis as $ps) { ?>
          <div class="col-4 my-4">
            <div class="card">
              <div class="card-body px-1">
                <!-- <h4 class="header-title">Latest News</h4> -->
                <div class="letest-news">
                  <div class="single-post my-1">
                    <div class="col-6"> <?php if (!empty($ps['file_pks'])) { ?>
                        <img data-pdf-thumbnail-file="<?= base_url('uploads/pembangunan_strategis/file/' . $ps['file_pks']) ?>">
                      <?php } else { ?>
                        <img src="<?= base_url('assets/images/no_image.png') ?>" alt="post thumb">
                      <?php } ?>
                    </div>
                    <div class="col-6">
                      <i class="fa fa-calendar"> <?= tgl_indo($ps['tgl_awal']) . " - " . tgl_indo($ps['tgl_akhir']) ?></i><br />
                      <i class="fa fa-building"> <?= $ps['nama_mitra'] ?></i><br />
                      <i class="fa fa-map-marker"> <?= $ps['lokasi'] ?></i>
                      <b><?= $ps['judul_laporan'] ?></b>
                      <a href="<?= base_url('mitra/galeri/pembangunan_strategis/info/' . $ps['id']) ?>" class="badge badge-info">Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php }
      } else {
        echo "<div class='col-12 text-center mt-3 mb-3'><h6>Tidak ada data</h6</div>";
      } ?>
      <?= isset($pager) ? $pager->links('pembangunan_strategis', 'b_pagination') : '' ?>

    </div>
  </div>
  <!-- main content area end -->

  <?= $this->include('footer') ?>

  <script>
    $(document).ready(function() {
      //Modal delete user
      $("body").on("click", "#deleteSurat", function(event) {
        const id = $(this).data('id');
        const judul = $(this).data('judul');

        $('#delete_id').val(id);
        $('#delete_judul').html(judul);
        // Call Modal
        $('#modal-deleteSurat').modal('show');
      });
    });
  </script>

  <?= $this->endSection() ?>