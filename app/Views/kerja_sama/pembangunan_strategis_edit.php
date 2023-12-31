<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<!-- <div class="main-content-inner">
  <div class="container"> -->


<style>
  .center-table {
    width: 100%;
    text-align: center;
    height: 100%;
    /* Atur tinggi wadah tabel */
    overflow-y: auto;
    /* Tampilkan scrollbar vertikal jika kontennya lebih panjang daripada wadahnya */
  }

  .center-table thead {
    background-color: #eeeeee;
  }

  .center-table thead .freeze-column {
    background-color: #eeeeee;
  }

  .baris_totalbawah {
    font-weight: bold;
  }

  .baris_totalbawah .freeze-column {
    font-weight: bold;
  }

  .scrollable-table {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
  }

  .center-table td {
    padding: 5px;
    border: 1px solid #ccc;
    /* Tambahkan garis dengan ketebalan 1px dan warna abu-abu (#ccc) */
  }

  .center-table thead tr td {
    vertical-align: middle;
    font-weight: bold;
    font-size: 15px;
  }

  .disabled-button {
    pointer-events: none;
    opacity: 0.4s;
  }

  select.form-control:not([size]):not([multiple]) {
    height: fit-content;
  }


  .freeze-column {
    position: -webkit-sticky;
    position: sticky;
    left: 0;
    z-index: 1;
    background-color: white;
    /* Tambahkan latar belakang putih untuk menutupi kolom yang di bawah */
  }
</style>
<div class="row">
  <!-- Primary table start -->
  <div class="col-12 mt-3">
    <div class="card">
      <div class="card-header bg-warning text-white">
        <div class="row">
          <div class="col-7">
            <h3 style="color: white;"> <b> Kerja Sama Pembangunan Strategis Edit </b></h3>
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

        <?= form_open('kerja_sama/pembangunan_strategis/process/edit', 'enctype="multipart/form-data"') ?>
        <input type="hidden" name="id" value="<?= isset($surat) ? $surat->id : 0 ?>">
        <div class="row">
          <div class="form-group col-4">
            <label for="judul" class="col-form-label"><b>Mitra</b></label>
            <select class="js-example-basic-single" name="mitra" id="mitra">
              <option value="" disabled selected>Pilih Mitra</option>
            </select>
          </div>

          <div class="form-group col-4">
            <label for="lokasi" class="col-form-label "><b>Lokasi</b></label>
            <input class="form-control " readonly type="text" name="lokasi_kerjasama" id="lokasi_kerjasama" value="<?= $surat->lokasi ?>">
          </div>
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
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_surat_pks) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
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
            <div class="center-table">
              <table class="table" id="tbl_ruanglingkup" name="tbl_ruanglingkup">
                <thead>
                  <tr>
                    <td rowspan=3 class="freeze-column" width="5%">No</td>
                    <td rowspan=3 class="freeze-column" width="15%">Program/Kegiatan</td>
                    <td id="jadwalHeader" colspan=<?= ($jumlahPeriode * 3) ?>>Jadwal Tahun Berjalan</td>
                    <td rowspan=3 width="7%">Jumlah Biaya (Anggaran)</td>
                    <td rowspan=3 width="7%">Jumlah Biaya (Realisasi)</td>
                    <td rowspan=3 width="7%">Jumlah Vol</td>
                  </tr>
                  <tr>
                    <?php foreach ($fileRKT as $rkt) : ?>
                      <td colspan="3"><?= $rkt->periode; ?></td>
                    <?php endforeach; ?>

                    <!-- <td colspan=3>2022-2023</td> -->
                  </tr>
                  <tr>
                    <?php foreach ($fileRKT as $rkt) : ?>
                      <td>Anggaran</td>
                      <td>Realisasi</td>
                      <td>Vol</td>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($ruanglingkup['ruanglingkupData'] as $ruanglingkupItem) : ?>
                    <tr>
                      <td><input type="hidden" value=<?= $ruanglingkupItem->id; ?>></td>
                      <td class="freeze-column" colspan=<?= (($jumlahPeriode * 3) + 4) ?>><?= $ruanglingkupItem->nama; ?></td>
                    </tr>

                    <!-- Loop untuk Kegiatan di bawah Ruang Lingkup -->
                    <?php if (isset($ruanglingkup['kegiatanData'][$ruanglingkupItem->id])) : ?>
                      <?php foreach ($ruanglingkup['kegiatanData'][$ruanglingkupItem->id] as $kegiatanItem) : ?>
                        <tr>
                          <td><input type="hidden" value="<?= $kegiatanItem->id; ?>"></td>
                          <td class="freeze-column" style="padding-left: 50px;"><?= $kegiatanItem->nama; ?></td>
                          <?php if (isset($ruanglingkup['anggaranData'][$kegiatanItem->id])) : ?>
                            <?php foreach ($ruanglingkup['anggaranData'][$kegiatanItem->id] as $anggaranItem) : ?>
                              <?php if ($anggaranItem->jenis == 'anggaran') : ?>
                                <td><input type="text" value="<?= $anggaranItem->anggaran; ?>"></td>
                                <td><input type="text" value="<?= $anggaranItem->realisasi; ?>"></td>
                                <td><input type="text" value="<?= $anggaranItem->vol; ?>"></td>
                              <?php else : ?>
                                <td><?= $anggaranItem->anggaran; ?></td>
                                <td><?= $anggaranItem->realisasi; ?></td>
                                <td><?= $anggaranItem->vol; ?></td>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tr>



                      <?php endforeach; ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>

            </div>
          </div>

          <div class="form-group col-12">
            <h5>Dokumen Pendukung</h5>
          </div>

          <div class="form-group col-4">
            <label for="file_pks" class="col-form-label"><b>Dokumen PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
            <?php if (!empty($surat->file_pks)) { ?>
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_pks) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
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
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_rpp) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
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
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_rkl_1) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
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
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_rkl_2) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
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
                        <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $rkt->file_rkt) ?>" class="btn btn-link" target="_blank"><?= $rkt->file_rkt ?></a>

                        <!-- <div class="input-group mb-3">
                              <input type="file" class="form-control" name="file_rkt[]" id="file_rkt0" value="">
                            </div> -->
                      </td>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="text" name="komitmen_rkt[]" id="komitmen_rkt<?= $index ?>" placeholder="Komitmen RKT" value="<?= $rkt->komitmen_rkt ?>">
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
              <a href="<?= base_url('uploads/pembangunan_strategis/file/' . $surat->file_lokasi) ?>" class="btn btn-link float-right" target="_blank">Lihat</a>
            <?php } ?>
            <div class="input-group mb-3">
              <input type="file" class="form-control" name="file_lokasi" id="file_lokasi" accept=".kml" value="">
            </div>
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
<!-- </div>
</div> -->
<!-- main content area end -->



<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: '#judul,#ruang_lingkup'
    });

    $('#mitra').select2({
      width: '100%',
      templateResult: function(data) {
        if (data.id) {
          var mitraText = '<div class="mitra-text">' + data.text + '</div>';
          var jenisLokasiText = '<div class="jenis-lokasi"> Lokasi : ' + data.additional.jenis_lokasi + '</div>';
          return $('<span>').append(mitraText, jenisLokasiText);
        }
        return data.text;
      },
      ajax: {
        url: '<?php echo base_url("Kerja_sama/getmitra"); ?>',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          var mitraArray = data.map(function(item) {
            return {
              id: item.id_mitra,
              text: item.nama_mitra,
              additional: {
                jenis_lokasi: item.jenis_lokasi
              }
            };
          });

          return {
            results: mitraArray
          };
        },
        cache: true
      }
    })
    $('#mitra').on('change', function() {
      var selectedMitra = $(this).select2('data')[0];
      if (selectedMitra && selectedMitra.additional) {
        $('#lokasi_kerjasama').val(selectedMitra.additional.jenis_lokasi);
      }
    });

    // Set the initial value
    var mitraValue = '<?= $surat->mitra ?>';
    var mitraText = '<?= $surat->nama_mitra ?>';
    var mitraOption = new Option(mitraText, mitraValue, true, true);
    $('#mitra').append(mitraOption).trigger('change');

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