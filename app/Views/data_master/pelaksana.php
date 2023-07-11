<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
  <div class="container">
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
                <h4>Data User Pelaksana</h4>
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
              <table id="table-pelaksana" class="text-center" style="width: 100%;">
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
                  <?php if (isset($pelaksana)) {
                    $no = 1;
                    foreach ($pelaksana as $data) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->username ?></td>
                        <td><?= $data->level ?></td>
                        <td><?= $data->last_login ?></td>
                        <td>
                          <button class="btn btn-xs btn-outline-warning" id="editPelaksana" data-id="<?= $data->id ?>" data-username="<?= $data->username ?>" data-level="<?= $data->level ?>"><i class="fa fa-edit"></i></button>
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
  </div>
</div>
<!-- main content area end -->

<!-- Modal Edit Pelaksana -->
<div class="modal fade" id="modal-editPelaksana" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Pelaksana</h5>
        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
      </div>

      <?= form_open('data_master/pelaksana/edit') ?>
      <input type="hidden" class="form-control" id="edit_id" name="id_pelaksana">

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
            <option value="SKW 1" selected>SKW 1</option>
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
<!-- Modal Edit Pelaksana End -->

<?= $this->include('footer') ?>

<script>
  $(document).ready(function() {
    $('#table-pelaksana').DataTable({
      'scrollX': true,
    });

    //Modal edit pelaksana
    $("body").on("click", "#editPelaksana", function(event) {
      const id = $(this).data('id');
      const username = $(this).data('username');
      const level = $(this).data('level');

      $('#edit_id').val(id);
      $('#edit_username').val(username);
      $('#edit_level').val(level).trigger('change');
      // Call Modal
      $('#modal-editPelaksana').modal('show');
    });
  });
</script>
<?= $this->endSection() ?>