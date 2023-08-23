<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<!-- <div class="main-content-inner">
  <div class="container"> -->
    <div class="row">
      <!-- Primary table start -->
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-7">
                <h4>Data Mitra</h4>
              </div>
              <div class="col-5">
                <span class="float-right">
                  <button class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#modal-tambahMitra"><i class="fa fa-plus"></i> Tambah</button>
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
              <table id="table-mitra" class="text-center" style="width: 100%;">
                <thead class="text-capitalize bg-secondary">
                  <tr class="text-white">
                    <th>No</th>
                    <th>Nama Mitra</th>
                    <th>Username</th>
                    <th>Lokasi</th>
                    <th>Last Login</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($mitra)) {
                    $no = 1;
                    foreach ($mitra as $data) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->nama_mitra ?></td>
                        <td><?= $data->username ?></td>
                        <td><?= $data->jenis_lokasi ?></td>
                        <td><?= $data->last_login ?></td>
                        <td>
                          <button class="btn btn-xs btn-outline-warning" id="editMitra" data-id="<?= $data->id_mitra ?>" data-namamitra="<?= $data->nama_mitra ?>" data-username="<?= $data->username ?>"><i class=" fa fa-edit"></i></button>
                          <button class="btn btn-xs btn-outline-danger" id="deleteMitra" data-id="<?= $data->id_mitra ?>" data-namamitra="<?= $data->nama_mitra ?>"><i class="fa fa-trash"></i></button>
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
  <!-- </div>
</div> -->
<!-- main content area end -->

<!-- Modal Tambah Mitra -->
<div class="modal fade" id="modal-tambahMitra" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Mitra</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/mitra/create') ?>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nama_mitra" class="form-label">Nama Mitra<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" name="nama_mitra" placeholder="Masukkan nama mitra" autofocus required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<sup style="color:red">*</sup></label>
          <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
        </div>
        <div class="mb-3">
          <label for="skw" class="form-label">SKW<sup style="color:red">*</sup></label>
          <select class="form-control" name="jenis_lokasi" id="jenis_lokasi"  required>
            <option value="" disabled selected>Pilih Lokasi</option>
            <option value="SKW 1">SKW 1</option>
            <option value="SKW 2">SKW 2</option>
            <option value="SKW 3">SKW 3</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>

    </div>
  </div>
</div>
<!-- Modal Tambah Mitra End -->

<!-- Modal Edit Mitra -->
<div class="modal fade" id="modal-editMitra" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Mitra</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/mitra/edit') ?>
      <input type="hidden" class="form-control" id="edit_id" name="id_mitra">

      <div class="modal-body">
        <div class="mb-3">
          <label for="nama_mitra" class="form-label">Nama Mitra<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" id="edit_nama_mitra" name="nama_mitra" placeholder="Masukkan nama mitra" autofocus required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" id="edit_username" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<sup style="color:red">* (Abaikan jika tidak ingin ganti password)</sup></label>
          <input type="password" class="form-control" id="edit_password" name="password" placeholder="Masukkan password">
        </div>
        <div class="mb-3">
          <label for="skw" class="form-label">SKW<sup style="color:red">*</sup></label>
          <select class="form-control" name="jenis_lokasi" id="edit_jenis_lokasi"  required>
            <option value="" disabled selected>Pilih Lokasi</option>
            <option value="SKW 1">SKW 1</option>
            <option value="SKW 2">SKW 2</option>
            <option value="SKW 3">SKW 3</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Edit</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>

    </div>
  </div>
</div>
<!-- Modal Edit Mitra End -->

<!-- Modal Delete Mitra -->
<div class="modal fade" id="modal-deleteMitra" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Mitra</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/mitra/delete') ?>
      <input type="hidden" class="form-control" id="delete_id" name="id_mitra">

      <div class="modal-body">
        <span>Ingin menghapus mitra <b id="delete_nama_mitra"></b> ?</span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>

    </div>
  </div>
</div>
<!-- Modal Delete Mitra End -->



<script>
  $(document).ready(function() {
    $('#table-mitra').DataTable({
      'scrollX': true,
    });

    //Modal edit mitra
    $("body").on("click", "#editMitra", function(event) {
      const id = $(this).data('id');
      const namamitra = $(this).data('namamitra');
      const username = $(this).data('username');

      $('#edit_id').val(id);
      $('#edit_nama_mitra').val(namamitra);
      $('#edit_username').val(username);
      // Call Modal
      $('#modal-editMitra').modal('show');
    });

    //Modal delete mitra
    $("body").on("click", "#deleteMitra", function(event) {
      const id = $(this).data('id');
      const namamitra = $(this).data('namamitra');

      $('#delete_id').val(id);
      $('#delete_nama_mitra').html(namamitra);
      // Call Modal
      $('#modal-deleteMitra').modal('show');
    });
  });
</script>
<?= $this->endSection() ?>