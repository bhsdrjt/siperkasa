<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
  <div class="container">
    <div class="row">
      <!-- Primary table start -->
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <div class="row">
              <div class="col-7">
                <h4>Kerja Sama Penguatan Fungsi SKW</h4>
              </div>
              <div class="col-5">
                <span class="float-right">
                </span>
              </div>
            </div>
          </div>
          <div class="card-body">

            <?php if (session()->getFlashdata('error')) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  ' . session()->getFlashdata('error') . '
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span class="fa fa-times"></span>
                   </button>
               </div>';
            } ?>

            <?= form_open('kerja_sama/penguatan_fungsi_skw/process/add', 'enctype="multipart/form-data"') ?>
            <div class="row">
              <div class="form-group col-4">
                <label for="mitra" class="col-form-label"><b>Perusahaan/Mitra</b></label>
                <select class="form-control" name="mitra" id="mitra" required>
                  <option value="">-Pilih-</option>
                  <?php if (isset($mitra)) {
                    foreach ($mitra as $mit) { ?>
                      <option value="<?= $mit->id_mitra ?>"><?= $mit->nama_mitra ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="form-group col-4">
                <label for="rkt" class="col-form-label"><b>RKT</b></label>
                <select class="form-control" name="rkt" id="rkt" required>
                  <option value="">-Pilih-</option>
                  <?php if (isset($rkt)) {
                    foreach ($rkt as $data) { ?>
                      <option value="<?= $data->id ?>"><?= $data->nama_rkt ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="form-group col-12">
                <label for="judul" class="col-form-label"><b>Judul Laporan</b></label>
                <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul">
              </div>


              <div class="form-group col-4">
                <label for="file_laporan" class="col-form-label"><b>Laporan Kerja Sama</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_laporan" id="file_laporan" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="file_spt" class="col-form-label"><b>File SPT</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_spt" id="file_spt" value="">
                </div>
              </div>

              <div class="form-group mt-3 col-12">
                <b style="font-size: large;">Dokumentasi</b>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <button type="button" class="btn btn-xs btn-info" id="addDokumentasi"><i class="fa fa-plus"></i> Add</button>

                <table class="table table-borderless mt-2 dokumentasi" style="width: 100%;">
                  <thead>
                    <th>No</th>
                    <th>File Dokumentasi <sup style="color: darkblue;">(image[jpg,png,jpeg])</sup></th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td style="padding-left: 0px;">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" name="file_dokumentasi[]" id="file_dokumentasi0" value="">
                        </div>
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="form-group col-12 text-center">
                <button type="submit" class="btn btn-primary" name="simpan" style="width: 200px;">Simpan</button>
              </div>
            </div>
            <?= form_close() ?>


          </div>
        </div>
      </div>
      <!-- Primary table end -->
    </div>
  </div>
</div>
<!-- main content area end -->

<?= $this->include('footer') ?>

<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: '#judul'
    });

    $("#mitra,#rkt").select2({
      width: '100%'
    });

    var index = 1;
    var no = 2;
    $("#addDokumentasi").click(function(event) {
      var newRow = $("<tr>");
      var cols = "";
      cols += `<td>` + no + `.</td>
              <td style="padding-left: 0px;">
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_dokumentasi[]" id="file_dokumentasi` + index + `" value="">
                </div>
              </td>`;
      cols += `<td>
                  <button type="button" class="btn btn-sm btn-danger" id="delDokumentasi"><i class="fa fa-trash"></i></button>
              </td>`;
      console.log(cols);
      newRow.append(cols);
      $("table.dokumentasi").append(newRow);
      index++;
      no++;
    });
    $("table.dokumentasi").on("click", "#delDokumentasi", function(event) {
      $(this).closest("tr").remove();
      no--;
    });
  });
</script>

<<?= $this->endSection() ?>