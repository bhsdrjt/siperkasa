<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
  <div class="container">
    <div class="row">
      <!-- Primary table start -->
      <div class="col-4 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5>Kerja Sama <?= $jenis == 'penguatanFungsi' ? 'Penguatan Fungsi' : 'Pembangunan Strategis' ?></h5>
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

            <?= form_open('kerja_sama/update_rkt/process', 'enctype="multipart/form-data"') ?>
            <input type="hidden" name="id_rkt" value="<?= isset($id_rkt) ? $id_rkt : 0 ?>">
            <input type="hidden" name="jenis" value="<?= isset($jenis) ? $jenis : '' ?>">
            <input type="hidden" name="id_pks" value="<?= isset($id_pks) ? $id_pks : 0 ?>">
            <div class="row">
              <div class="col-12">
                <table class="table" style="width: 100%;">
                  <tr>
                    <td style="width: 20%;">Judul</td>
                    <td>: <?php if (isset($kerja_sama)) {
                            $strJudul = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $kerja_sama->judul);
                          }
                          echo $strJudul; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Tgl PKS Awal</td>
                    <td>: <?= isset($kerja_sama) && isset($kerja_sama->tgl_awal) ? $kerja_sama->tgl_awal : '' ?></td>
                  </tr>
                  <tr>
                    <td>Tgl PKS Akhir</td>
                    <td>: <?= isset($kerja_sama) && isset($kerja_sama->tgl_akhir) ? $kerja_sama->tgl_akhir : '' ?></td>
                  </tr>
                  <tr>
                    <td>Surat Persetujuan PKS</td>
                    <td>: <?= isset($kerja_sama) ? $kerja_sama->surat_pks : '' ?></td>
                  </tr>
                  <tr>
                    <td>No. Persetujuan PKS</td>
                    <td>: <?= isset($kerja_sama) ? $kerja_sama->no_pks : '' ?></td>
                  </tr>
                  <tr>
                    <td>Ruang Lingkup</td>
                    <td>: <?= isset($kerja_sama) ? $kerja_sama->ruang_lingkup : '' ?></td>
                  </tr>
                </table>

                <!-- <hr style="border: 0.5px solid black;"> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-8 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5>RKT <?= isset($rkt) ? $rkt->nama_rkt : '' ?></h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-4">
                <label for="file_pks" class="col-form-label"><b>Mitra</b></label>
                <select class="form-control" name="mitra" id="mitra" required>
                  <option>-Pilih-</option>
                  <?php if (isset($mitra)) {
                    foreach ($mitra as $key) { ?>
                      <option value="<?= $key->id_mitra ?>"><?= $key->nama_mitra ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="form-group col-12">
                <label for="judul" class="col-form-label"><b>Judul Laporan</b></label>
                <input class="form-control" type="text" name="judul_laporan" id="judul_laporan" placeholder="Judul Laporan">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Cover</b> <sup style="color: darkblue;">(image[jpg/png/jpeg])</sup></label>
                <input type="file" class="form-control" name="cover" id="cover" value="">
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Laporan Kerja Sama</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="laporan_kerjasama" id="laporan_kerjasama" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>File SPT</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
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
                    <th>File Dokumentasi <sup style="color: darkblue;">(image[jpg/png/jpeg])</sup></th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <div class="form-group">
                          <input type="file" class="form-control" name="dokumentasi[]" id="dokumentasi0" value="">
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
          </div>
          <?= form_close() ?>


        </div>
      </div>
      <!-- Primary table end -->
    </div>
  </div>
</div>
<!-- main content area end -->



<script type="text/javascript">
  $(document).ready(function() {
    $("#mitra").select2({
      width: '100%'
    });

    tinymce.init({
      selector: '#judul_laporan'
    });


    var no = 2;
    var index = 1;

    $("#addDokumentasi").click(function(event) {
      var newRow = $("<tr>");
      var cols = "";
      cols += `<td>` + no + `.</td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="dokumentasi[]" id="dokumentasi` + index + `" value="">
                 </div>
              </td>`
      cols += `<td>
                  <button type="button" class="btn btn-sm btn-danger" id="delDokumen"><i class="fa fa-trash"></i></button>
              </td>`;
      console.log(cols);
      newRow.append(cols);
      $("table.dokumentasi").append(newRow);
      index++;
      no++;
    });
    $("table.dokumentasi").on("click", "#delDokumen", function(event) {
      $(this).closest("tr").remove();
      no--;
    });
  });
</script>

<<?= $this->endSection() ?>