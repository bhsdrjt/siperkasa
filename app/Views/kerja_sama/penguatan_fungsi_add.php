<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<!-- <div class="main-content-inner">
  <div class="container"> -->
    <div class="row">
      <!-- Primary table start -->
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <div class="row">
              <div class="col-7">
              <h3 style="color: white;"> <b> Kerja Sama Penguatan Fungsi </b></h3>
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
              <div class="form-group col-4">
                <label for="judul" class="col-form-label"><b>Mitra</b></label>
                <select class="js-example-basic-single" name="mitra" id="mitra">
                  <option value="" disabled selected>Pilih Mitra</option>
                </select>
              </div>

              <div class="form-group col-4">
                <label for="lokasi" class="col-form-label "><b>Lokasi</b></label>
                <input class="form-control " readonly type="text" name="lokasi_kerjasama" id="lokasi_kerjasama">
              </div>
              <div class="form-group col-12">
                <label for="judul" class="col-form-label"><b>Judul</b></label>
                <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul">
              </div>
              <div class="form-group col-4">
                <label for="tgl_awal" class="col-form-label"><b>Tgl PKS Awal</b></label>
                <input class="form-control" type="date" name="tgl_awal" id="tgl_awal" value="<?= date('Y-m-d') ?>">
              </div>
              <div class="form-group col-4">
                <label for="tgl_akhir" class="col-form-label"><b>Tgl PKS Akhir</b></label>
                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir" value="<?= date('Y-m-d') ?>">
              </div>
              <div class="col-4"></div>

              <div class="form-group col-4">
                <label for="surat_pks" class="col-form-label"><b>Surat Persetujuan PKS</b></label>
                <input class="form-control" type="text" name="surat_pks" id="surat_pks" placeholder="Surat Persetujuan PKS">
              </div>
              <div class="form-group col-4">
                <label for="file_surat_pks" class="col-form-label"><b> File Surat Persetujuan PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_surat_pks" id="file_surat_pks" value="" accept=".pdf">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="no_surat_pks" class="col-form-label"><b>No. Persetujuan PKS</b></label>
                <input class="form-control" type="text" name="no_surat_pks" id="no_surat_pks" placeholder="No Persetujuan PKS">
              </div>
              <div class="form-group col-12">
                <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
                <input class="form-control" type="text" name="ruang_lingkup" id="ruang_lingkup" placeholder="Ruang Lingkup">
              </div>

              <div class="form-group col-12">
                <h5>Dokumen Pendukung</h5>
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen PKS</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_pks" id="file_pks" value="" accept=".pdf">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_pks" class="col-form-label"><b>Komitmen PKS</b></label>
                <input class="form-control" type="text" name="komitmen_pks" id="komitmen_pks" placeholder="Komitmen PKS" oninput="formatCurrency(this)">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_pks" class="col-form-label"><b>Realisasi PKS</b></label>
                <input class="form-control" type="text" name="realisasi_pks" id="realisasi_pks" placeholder="Realisasi PKS" oninput="formatCurrency(this)">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RPP</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rpp" id="file_rpp" value="" accept=".pdf">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rpp" class="col-form-label"><b>Komitmen RPP</b></label>
                <input class="form-control" type="text" name="komitmen_rpp" id="komitmen_rpp" placeholder="Komitmen RPP" oninput="formatCurrency(this)">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rpp" class="col-form-label"><b>Realisasi RPP</b></label>
                <input class="form-control" type="text" name="realisasi_rpp" id="realisasi_rpp" placeholder="Realisasi RPP" oninput="formatCurrency(this)">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 1</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rkl_1" id="file_rkl_1" value="" accept=".pdf">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rkl_1" class="col-form-label"><b>Komitmen RKL 1</b></label>
                <input class="form-control" type="text" name="komitmen_rkl_1" id="komitmen_rkl_1" placeholder="Komitmen RKL 1" oninput="formatCurrency(this)">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rkl_1" class="col-form-label"><b>Realisasi RKL 1</b></label>
                <input class="form-control" type="text" name="realisasi_rkl_1" id="realisasi_rkl_1" placeholder="Realisasi RKL 1" oninput="formatCurrency(this)">
              </div>

              <div class="form-group col-4">
                <label for="cover" class="col-form-label"><b>Dokumen RKL 2</b> <sup style="color: darkblue;">(Pdf)</sup></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="file_rkl_2" id="file_rkl_2" value="" accept=".pdf">
                </div>
              </div>
              <div class="form-group col-4">
                <label for="komitmen_rkl_2" class="col-form-label"><b>Komitmen RKL 2</b></label>
                <input class="form-control" type="text" name="komitmen_rkl_2" id="komitmen_rkl_2" placeholder="Komitmen RKL 2" oninput="formatCurrency(this)">
              </div>
              <div class="form-group col-4">
                <label for="realisasi_rkl_2" class="col-form-label"><b>Realisasi RKL 2</b></label>
                <input class="form-control" type="text" name="realisasi_rkl_2" id="realisasi_rkl_2" placeholder="Realisasi RKL 2" oninput="formatCurrency(this)">
              </div>

              <div class="form-group mt-3 col-12">
                <b style="font-size: large;">Dokumen RKT</b>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <button type="button" class="btn btn-xs btn-info" id="addDokumenRKT"><i class="fa fa-plus"></i> Add</button>

                <table class="table table-borderless mt-2 dokumenRKT" style="width: 100%;">
                  <thead>
                    <th>No</th>
                    <th>Periode RKT</th>
                    <th>File Upload RKT <sup style="color: darkblue;">(pdf)</sup></th>
                    <th>Komitmen RKT</th>
                    <th>Realisasi RKT</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt0" placeholder="Periode RKT">
                        </div>
                      </td>
                      <td style="padding-left: 0px;">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" name="file_rkt[]" id="file_rkt0" value="" accept=".pdf">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="text" name="komitmen_rkt[]" id="komitmen_rkt0" placeholder="Komitmen RKT" oninput="formatCurrency(this)">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="text" name="realisasi_rkt[]" id="realisasi_rkt0" placeholder="Realisasi RKT" oninput="formatCurrency(this)">
                        </div>
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="form-group col-4">
                <label for="file_lokasi" class="col-form-label"><b>File Lokasi</b> <sup style="color: darkblue;">(.KML)</sup></label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" name="file_lokasi" id="file_lokasi" accept=".kml" value="">
                </div>
              </div>
              <div class="form-group col-4"></div>



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
  <!-- </div>
</div> -->
<!-- main content area end -->



<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: '#judul,#ruang_lingkup',
      menubar: false,
      toolbar: 'bold italic',
      statusbar: false,
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
    }).on('change', function() {
      var selectedMitra = $(this).select2('data')[0];
      if (selectedMitra && selectedMitra.additional) {
        $('#lokasi_kerjasama').val(selectedMitra.additional.jenis_lokasi);
      } else {
        $('#lokasi_kerjasama').val('');
      }
    });

    // $("#mitra").select2({
    //   width: '100%'
    // });

    var index = 1;
    var no = 2;
    $("#addDokumenRKT").click(function(event) {
      var newRow = $("<tr>");
      var cols = "";
      cols += `<td>` + no + `.</td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt` + index + `" placeholder="Periode RKT">
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