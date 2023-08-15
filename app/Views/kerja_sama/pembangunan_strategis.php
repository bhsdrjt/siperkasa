<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>


<div class="row">
  <!-- Primary table start -->
  <div class="col-12 mt-3">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-7">
            <h4>Kerja Sama Pembangunan Strategis</h4>
          </div>
          <div class="col-5">
            <span class="float-right">
              <a href="<?= base_url('kerja_sama/pembangunan_strategis/add') ?>" class="btn btn-xs btn-outline-primary"><i class="fa fa-plus"></i> Tambah</a>
            </span>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php if (session()->getFlashdata('success')) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 ' . session()->getFlashdata('success') . '
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span class="fa fa-times"></span>
                  </button>
              </div>';
        } elseif (session()->getFlashdata('error')) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  ' . session()->getFlashdata('error') . '
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span class="fa fa-times"></span>
                   </button>
               </div>';
        } ?>

        <div class="datatable-default">
          <table id="table-kerjasama" class="text-center" style="width: 100%;">
            <thead class="text-capitalize bg-secondary">
              <tr class="text-white">
                <th>Tgl Awal</th>
                <th>Tgl Akhir</th>
                <!-- <th>Mitra</th> -->
                <th>Lokasi</th>
                <th>Nama Mitra</th>
                <th>Judul</th>
                <th>Cover</th>
                <th style="width: 8%"></th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($kerja_sama)) {
                $no = 1;
                foreach ($kerja_sama as $data) { ?>
                  <tr>
                    <td><?= $data->tgl_awal ?></td>
                    <td><?= $data->tgl_akhir ?></td>
                    <!-- <td><? //= isset($data->nama_mitra) ? $data->nama_mitra : '' 
                              ?></td> -->
                    <td><?= $data->lokasi ?></td>
                    <td><?= $data->nama_mitra ?></td>
                    <td><?= $data->judul ?></td>
                    <td><?php if (isset($data->file_pks)) { ?>
                        <img data-pdf-thumbnail-file="<?= base_url('uploads/pembangunan_strategis/file/' . $data->file_pks) ?>" data-pdf-thumbnail-width="100">
                      <?php  }  ?>
                    </td>
                    <td>
                      <a href="<?= base_url('kerja_sama/pembangunan_strategis/edit/' . $data->id) ?>" class="btn btn-xs btn-outline-warning"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-xs btn-outline-danger" id="deleteSurat" data-id="<?= $data->id ?>" data-judul="<?= $data->judul ?>"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Primary table end -->
</div>
<!-- main content area end -->

<!-- Modal Delete Surat -->
<div class="modal fade" id="modal-deleteSurat" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Surat Kerja Sama Pembangunan Strategis</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('kerja_sama/pembangunan_strategis/process/delete') ?>
      <input type="hidden" class="form-control" id="delete_id" name="id">

      <div class="modal-body">
        <span>Ingin menghapus <b id="delete_judul"></b></span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>

    </div>
  </div>
</div>
<!-- Modal Delete Surat End -->



<script>
  $(document).ready(function() {
    $('#table-kerjasama').DataTable({
      'scrollX': true,
    });

    //Modal delete surat
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