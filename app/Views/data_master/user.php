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
              <div class="col-12 mb-3">
                <a class="btn btn-lg btn-primary text-white" style="font-size:medium;" href="<?= base_url('data_master/user') ?>">User Admin</a>
                <a class="btn btn-lg btn-warning" style="font-size:medium;" href="<?= base_url('data_master/pelaksana') ?>">User Pelaksana</a>
              </div>
              <div class="col-7">
                <h4>Data User Admin</h4>
              </div>
              <div class="col-5">
                <span class="float-right">
                  <button class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#modal-tambahUser"><i class="fa fa-plus"></i> Tambah</button>
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
              <table id="table-user" class="text-center" style="width: 100%;">
                <thead class="text-capitalize bg-secondary">
                  <tr class="text-white">
                    <th>No</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Last Login</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($user)) {
                    $no = 1;
                    foreach ($user as $data) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->username ?></td>
                        <td><?= $data->level ?></td>
                        <td><?= $data->last_login ?></td>
                        <td>
                          <button class="btn btn-xs btn-outline-warning" id="editUser" data-id="<?= $data->id ?>" data-username="<?= $data->username ?>" data-level="<?= $data->level ?>"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-xs btn-outline-danger" id="deleteUser" data-id="<?= $data->id ?>" data-username="<?= $data->username ?>"><i class="fa fa-trash"></i></button>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="modal-tambahUser" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/user/create') ?>
      <div class="modal-body">
        <div class="mb-3">
          <label for="username" class="form-label">Username<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" name="username" placeholder="Masukkan username" autofocus required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<sup style="color:red">*</sup></label>
          <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
        </div>
        <div class="mb-3">
          <label for="level" class="form-label">Level<sup style="color:red">*</sup></label>
          <select class="custom-select" name="level" required>
            <option value="Admin" selected>Admin</option>
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
<!-- Modal Tambah User End -->

<!-- Modal Edit User -->
<div class="modal fade" id="modal-editUser" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/user/edit') ?>
      <input type="hidden" class="form-control" id="edit_id" name="id_user">

      <div class="modal-body">
        <div class="mb-3">
          <label for="username" class="form-label">Username<sup style="color:red">*</sup></label>
          <input type="text" class="form-control" id="edit_username" name="username" placeholder="Masukkan username" autofocus required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<sup style="color:red">* (Abaikan jika tidak ingin ganti password)</sup></label>
          <input type="password" class="form-control" id="edit_password" name="password" placeholder="Masukkan password">
        </div>
        <div class="mb-3">
          <label for="level" class="form-label">Level<sup style="color:red">*</sup></label>
          <select class="custom-select" name="level" id="edit_level" required>
            <option value="Admin" selected>Admin</option>
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
<!-- Modal Edit User End -->

<!-- Modal Delete User -->
<div class="modal fade" id="modal-deleteUser" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus User</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/user/delete') ?>
      <input type="hidden" class="form-control" id="delete_id" name="id_user">

      <div class="modal-body">
        <span>Ingin menghapus user <b id="delete_username"></b> ?</span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>

    </div>
  </div>
</div>
<!-- Modal Delete User End -->



<script>
  $(document).ready(function() {
    $('#table-user').DataTable({
      'scrollX': true,
    });

    //Modal edit user
    $("body").on("click", "#editUser", function(event) {
      const id = $(this).data('id');
      const username = $(this).data('username');
      // const level = $(this).data('level');

      $('#edit_id').val(id);
      $('#edit_username').val(username);
      // $('#edit_level').val(level).trigger('change');
      // Call Modal
      $('#modal-editUser').modal('show');
    });

    //Modal delete user
    $("body").on("click", "#deleteUser", function(event) {
      const id = $(this).data('id');
      const username = $(this).data('username');

      $('#delete_id').val(id);
      $('#delete_username').html(username);
      // Call Modal
      $('#modal-deleteUser').modal('show');
    });
  });
</script>
<?= $this->endSection() ?>