<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
  <div class="container">
    <div class="row">
      <!-- Primary table start -->
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header bg-warning text-white">
            <div class="row">
              <div class="col-7">
                <h4>Kerja Sama Penguatan Fungsi Edit</h4>
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

            <?= form_open('kerja_sama/penguatan_fungsi/process/edit', 'enctype="multipart/form-data"') ?>
            <input type="hidden" name="id" value="<?= isset($surat) ? $surat->id : 0 ?>">
            <div class="row">
              <div class="form-group col-12">
                <label for="judul" class="col-form-label"><b>Judul</b></label>
                <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul" value="<?= isset($surat) ? $surat->judul : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="tgl_awal" class="col-form-label"><b>Tgl PKS Awal</b></label>
                <input class="form-control" type="date" name="tgl_awal" id="tgl_awal" value="<?= isset($surat) && isset($surat->tgl_awal) ? $surat->tgl_awal : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="tgl_akhir" class="col-form-label"><b>Tgl PKS Akhir</b></label>
                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir" value="<?= isset($surat) && isset($surat->tgl_akhir) ? $surat->tgl_akhir : '' ?>">
              </div>
              <div class="col-4"></div>

              <div class="form-group col-4">
                <label for="surat_pks" class="col-form-label"><b>Surat Persetujuan PKS</b></label>
                <input class="form-control" type="text" name="surat_pks" id="surat_pks" placeholder="Surat Persetujuan PKS" value="<?= isset($surat) ? $surat->surat_pks : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="file_surat_pks" class="col-form-label"><b> File Surat Persetujuan PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <?php if (!empty($surat->file_surat_pks)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_surat_pks) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_surat_pks" id="file_surat_pks" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="no_surat_pks" class="col-form-label"><b>No. Persetujuan PKS</b></label>
                <input class="form-control" type="text" name="no_surat_pks" id="no_surat_pks" placeholder="No Persetujuan PKS" value="<?= isset($surat) ? $surat->no_pks : '' ?>">
              </div>
              <div class="form-group col-12">
                <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
                <input class="form-control" type="text" name="ruang_lingkup" id="ruang_lingkup" placeholder="Ruang Lingkup" value="<?= isset($surat) ? $surat->ruang_lingkup : '' ?>">
              </div>

              <div class="form-group col-12">
                <h5>Dokumen Pendukung</h5>
              </div>

              <div class="form-group col-4">
                <label for="file_pks" class="col-form-label"><b>Dokumen PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <?php if (!empty($surat->file_pks)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_pks) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_pks" id="file_pks" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_pks" class="col-form-label"><b>Komitmen PKS</b></label>
                <input class="form-control" type="text" name="komitmen_pks" id="komitmen_pks" placeholder="Komitmen PKS" value="<?= isset($surat) ? $surat->komitmen_pks : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_pks" class="col-form-label"><b>Realisasi PKS</b></label>
                <input class="form-control" type="text" name="realisasi_pks" id="realisasi_pks" placeholder="Realisasi PKS" value="<?= isset($surat) ? $surat->realisasi_pks : '' ?>">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RPP</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <?php if (!empty($surat->file_rpp)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_rpp) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rpp" id="file_rpp" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rpp" class="col-form-label"><b>Komitmen RPP</b></label>
                <input class="form-control" type="text" name="komitmen_rpp" id="komitmen_rpp" placeholder="Komitmen RPP" value="<?= isset($surat) ? $surat->komitmen_rpp : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rpp" class="col-form-label"><b>Realisasi RPP</b></label>
                <input class="form-control" type="text" name="realisasi_rpp" id="realisasi_rpp" placeholder="Realisasi RPP" value="<?= isset($surat) ? $surat->realisasi_rpp : '' ?>">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 1</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <?php if (!empty($surat->file_rkl_1)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_rkl_1) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rkl_1" id="file_rkl_1" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rkl_1" class="col-form-label"><b>Komitmen RKL 1</b></label>
                <input class="form-control" type="text" name="komitmen_rkl_1" id="komitmen_rkl_1" placeholder="Komitmen RKL 1" value="<?= isset($surat) ? $surat->komitmen_rkl_1 : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rkl_1" class="col-form-label"><b>Realisasi RKL 1</b></label>
                <input class="form-control" type="text" name="realisasi_rkl_1" id="realisasi_rkl_1" placeholder="Realisasi RKL 1" value="<?= isset($surat) ? $surat->realisasi_rkl_1 : '' ?>">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 2</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <?php if (!empty($surat->file_rkl_2)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_rkl_2) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rkl_2" id="file_rkl_2" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rkl_2" class="col-form-label"><b>Komitmen RKL 2</b></label>
                <input class="form-control" type="text" name="komitmen_rkl_2" id="komitmen_rkl_2" placeholder="Komitmen RKL 2" value="<?= isset($surat) ? $surat->komitmen_rkl_2 : '' ?>">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rkl_2" class="col-form-label"><b>Realisasi RKL 2</b></label>
                <input class="form-control" type="text" name="realisasi_rkl_2" id="realisasi_rkl_2" placeholder="Realisasi RKL 2" value="<?= isset($surat) ? $surat->realisasi_rkl_2 : '' ?>">
              </div>

              <div class="form-group mt-3 col-12">
                <b style="font-size: large;">Dokumen RKT</b>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <button type="button" class="btn btn-xs btn-info" id="addDokumenRKT"><i class="fa fa-plus"></i> Add</button>

                <table class="table table-borderless mt-2 dokumenRKT" style="width: 100%;">
                  <thead>
                    <th>No</th>
                    <th>File Upload RKT <sup style="color: darkblue;">(pdf)</sup></th>
                    <th>Komitmen RKT</th>
                    <th>Realisasi RKT</th>
                  </thead>
                  <tbody>
                    <?php if (isset($fileRKT)) {
                      $no = 1;
                      $index = 0;
                      foreach ($fileRKT as $rkt) { ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td>
                            <div class="form-group">
                              <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt<?= $index ?>" placeholder="Nama RKT" value="<?= $rkt->nama_rkt ?>">
                            </div>
                          </td>
                          <td style="padding-left: 0px;">
                            <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $rkt->file_rkt) ?>" class="btn btn-link" target="_blank"><?= $rkt->file_rkt ?></a>

                            <!-- <div class="input-group mb-3">
                              <input type="file" class="form-control" name="file_rkt[]" id="file_rkt0" value="">
                            </div> -->
                          </td>
                          <td>
                            <div class="form-group">
                              <input class="form-control" type="text" name="komitmen_rkt[]" id="komitmen_rkt<?= $index ?>" placeholder="Komitmen RKT" value="<?= $rkt->komitmen_rkt ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input class="form-control" type="text" name="realisasi_rkt[]" id="realisasi_rkt<?= $index ?>" placeholder="Realisasi RKT" value="<?= $rkt->realisasi_rkt ?>" readonly>
                            </div>
                          </td>
                          <td></td>
                        </tr>
                    <?php $index++;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>

              <div class="form-group col-4">
                <label for="file_lokasi" class="col-form-label"><b>File Lokasi</b> <sup style="color: darkblue;">(.KML)</sup></label>
                <?php if (!empty($surat->file_lokasi)) { ?>
                  <a href="<?= base_url('uploads/penguatan_fungsi/file/' . $surat->file_lokasi) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
                <?php } ?>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_lokasi" id="file_lokasi" accept=".kml" value="">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="lokasi_kerjasama" class="col-form-label"><b>Lokasi Kerja Sama</b></label>
                <select class="form-control" name="lokasi_kerjasama">
                  <option value="SKW 1" <?= isset($surat->lokasi) && $surat->lokasi == 'SKW 1' ? 'selected' : '' ?>>SKW 1</option>
                  <option value="SKW 2" <?= isset($surat->lokasi) && $surat->lokasi == 'SKW 2' ? 'selected' : '' ?>>SKW 2</option>
                  <option value="SKW 3" <?= isset($surat->lokasi) && $surat->lokasi == 'SKW 3' ? 'selected' : '' ?>>SKW 3</option>
                </select>
              </div>
              <div class="form-group col-4"></div>



              <div class="form-group col-12 text-center">
                <button type="submit" class="btn btn-warning" name="simpan" style="width: 200px;">Update</button>
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
      selector: '#judul,#ruang_lingkup'
    });

    // $("#mitra").select2({
    //   width: '100%'
    // });
    <?php if (isset($fileRKT)) { ?>
      var no = <?= COUNT($fileRKT) + 1 ?>;
    <?php } else { ?>
      var no = 1;
    <?php }
    ?>
    var index = 0;

    $("#addDokumenRKT").click(function(event) {
      var newRow = $("<tr>");
      var cols = "";
      cols += `<td>` + no + `.</td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt` + index + `" placeholder="Nama RKT">
                 </div>
              </td>
              <td style="padding-left: 0px;">
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_rkt[]" id="file_rkt` + index + `" value="">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="komitmen_rkt[]" id="komitmen_rkt` + index + `" placeholder="Komitmen RKT">
                 </div>
              </td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="realisasi_rkt[]" id="realisasi_rkt` + index + `" placeholder="Realisasi RKT">
                </div>
              </td>`;
      cols += `<td>
                  <button type="button" class="btn btn-sm btn-danger" id="delDokumen"><i class="fa fa-trash"></i></button>
              </td>`;
      console.log(cols);
      newRow.append(cols);
      $("table.dokumenRKT").append(newRow);
      index++;
      no++;
    });
    $("table.dokumenRKT").on("click", "#delDokumen", function(event) {
      $(this).closest("tr").remove();
      no--;
    });
  });
</script>

<<?= $this->endSection() ?>