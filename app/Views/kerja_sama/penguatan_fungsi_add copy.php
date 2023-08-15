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
                <h4>Kerja Sama Penguatan Fungsi</h4>
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

            <?= form_open('kerja_sama/penguatan_fungsi/process/add', 'enctype="multipart/form-data"') ?>
            <div class="row">
              <div class="form-group col-12">
                <label for="judul" class="col-form-label"><b>Judul</b></label>
                <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul">
              </div>
              <div class="form-group col-4">
                <label for="mitra" class="col-form-label"><b>Mitra</b></label>
                <select class="custom-select" name="mitra" id="mitra" required>
                  <option value="">-Pilih-</option>
                  <?php if (isset($mitra)) {
                    foreach ($mitra as $data) {
                      echo "<option value='" . $data->id_mitra . "'>" . $data->nama_mitra . "</option>";
                    }
                  } ?>
                </select>
              </div>
              <div class="form-group col-4">
                <label for="tgl_awal" class="col-form-label"><b>Tgl PKS Awal</b></label>
                <input class="form-control" type="date" name="tgl_awal" id="tgl_awal" value="<?= date('Y-m-d') ?>">
              </div>
              <div class="form-group col-4">
                <label for="tgl_akhir" class="col-form-label"><b>Tgl PKS Akhir</b></label>
                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir" value="<?= date('Y-m-d') ?>">
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Gambar Cover</b></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="cover" id="cover" value="">
                </div>
              </div>
              <!-- <div class="form-group col-4">
                gambar yg akan tampil
              </div> -->
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Surat Persetujuan PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="surat_pks" id="surat_pks" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Ruang Lingkup PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_ruang_lingkup" id="file_ruang_lingkup" value="">
                </div>
              </div>

              <div class="form-group col-12">
                <h5>Realisasi PKS</h5>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RPP</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_rpp" id="file_rpp" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 1</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_rkl_1" id="file_rkl_1" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 2</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_rkl_2" id="file_rkl_2" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKT</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_rkt" id="file_rkt" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_pks" id="file_pks" value="">
                </div>
              </div>

              <div class="form-group col-12">
                <label for="kawasan_konservasi" class="col-form-label"><b>Kawan Konservasi</b></label>
                <input class="form-control" type="text" name="kawasan_konservasi" id="kawasan_konservasi" placeholder="Kawasan Konservasi">
              </div>

              <div class="form-group col-12">
                <h5>Kegiatan Kerja Sama</h5>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Laporan Kerja Sama</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_laporan_kerjasama" id="file_laporan_kerjasama" value="">
                </div>
              </div>
              <div class="form-group col-8"></div>

              <div class="form-group col-5">
                <label for="cover" class="col-form-label"><b>Dokumentasi Kerja Sama</b> <sup style="color: darkblue;">(jpf/jpeg/png)</sup></label>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <button type="button" class="btn btn-xs btn-info float-right" id="addFoto"><i class="fa fa-plus"> Tambah</i></button>
                <table class="table table-borderless listFoto" style="width: 100%;">
                  <tr>
                    <td style="padding-left: 0px;">
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" name="foto_kerjasama[]" id="foto_kerjasama0" value="">
                      </div>
                    </td>
                    <td></td>
                  </tr>
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



<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: '#judul,#kawasan_konservasi'
    });

    $("#mitra").select2({
      width: '100%'
    });

    var index = 1;
    $("#addFoto").click(function(event) {
      console.error();
      var newRow = $("<tr>");
      var cols = "";
      cols += `<td style="padding-left: 0px;">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" name="foto_kerjasama[]" id="foto_kerjasama` + index + `" value="">
                        </div>
                    </td>`;
      cols += `<td>
                        <button type="button" class="btn btn-sm btn-danger" id="delFoto"><i class="fa fa-trash"></i></button>
                    </td>`;
      console.log(cols);
      newRow.append(cols);
      $("table.listFoto").append(newRow);
      index++;
    });
    $("table.listFoto").on("click", "#delFoto", function(event) {
      $(this).closest("tr").remove();
    });
  });
</script>

<<?= $this->endSection() ?>