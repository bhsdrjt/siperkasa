<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<style>
  select.form-control:not([size]):not([multiple]) {
    height: fit-content;
    /* height: calc(2.25rem + 2px); */
  }
</style>

<!-- page title area end -->
<!-- <div class="main-content-inner">
  <div class="container"> -->
<div class="row">
  <div class="col-12 mt-3">
    <div class="card">
      <div class="card-header bg-dark text-white">
        <div class="row">
          <div class="col-7">
            <h4>Kerja Sama Pembangunan Strategis SKW</h4>
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

        <?= form_open('kerja_sama/pembangunan_strategis_skw/process/add', 'enctype="multipart/form-data"') ?>
        <div class="row">
          <div class="form-group col-4">
            <label for="mitra" class="col-form-label"><b>Perusahaan/Mitra</b></label>
            <select class="form-control" name="mitra" id="mitra" required>
              <option value="" disabled selected> Pilih Mitra</option>
              <!-- Contoh data mitra -->

            </select>
          </div>
          <div class="form-group col-4">
            <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
            <select class="form-control" name="ruang_lingkup" id="ruang_lingkup" required>
              <option value="" disabled selected> Pilih Ruang Lingkup </option>
            </select>
          </div>
          <div class="form-group col-4">
            <label for="kegiatan" class="col-form-label"><b>Kegiatan</b></label>
            <select class="form-control" name="kegiatan" id="kegiatan" required>
              <option value="" disabled selected> Pilih Kegiatan </option>
            </select>
          </div>
          <div class="form-group col-4">
            <label for="rkt" class="col-form-label"><b>Periode</b></label>
            <select class="form-control" name="periode" id="periode" required>
              <option value="" disabled selected> Pilih Periode </option>
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
<!-- </div>
</div> -->
<!-- main content area end -->



<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: '#judul'
    });

    $.ajax({
      url: '<?php echo base_url("Kerja_sama/getmitra/true"); ?>',
      dataType: 'json',
      // delay: 250,
      success: function(data) {
        var mitraArray = data.map(function(item) {
          return {
            id: item.id_mitra,
            text: item.nama_mitra,
            additional: {
              jenis_lokasi: item.jenis_lokasi
            }
          };
        });

        $('#mitra').select2({
          width: '100%',
          data: mitraArray // Menggabungkan opsi "Mitra Dulu" dengan data dari permintaan AJAX
        });
      },
      cache: true
    });

    $('#mitra').on('change', function() {
      // alert('oy')
      var selectedMitra = $(this).select2('data')[0];
      // console.log(selectedMitra.id)
      $.ajax({
        url: '<?php echo base_url("Kerja_sama/getRuangLingkup"); ?>',
        dataType: 'json',
        // delay: 250,
        data: {
          id_mitra: selectedMitra.id
        }, // Perhatikan penulisan objek data dengan tanda kurung kurawal {}
        success: function(data) {
          var RuangLingkup = data.map(function(item) {
            return {
              id: item.id,
              text: item.nama
            };
          });
          $('#ruang_lingkup').select2({
            width: '100%',
            data: RuangLingkup // Menggabungkan opsi "Mitra Dulu" dengan data dari permintaan AJAX
          });
        },
        cache: true
      });
    });


    $('#mitra').on('change', function() {
      // alert('oy')
      var selectedMitra = $(this).select2('data')[0];
      console.log(selectedMitra.id)
      $.ajax({
        url: '<?php echo base_url("Kerja_sama/getrkt"); ?>',
        dataType: 'json',
        // delay: 250,
        data: {
          mitra: selectedMitra.id
        }, // Perhatikan penulisan objek data dengan tanda kurung kurawal {}
        success: function(data) {
          var RuangLingkup = data.map(function(item) {
            return {
              id: item.id,
              text: item.periode
            };
          });
          $('#periode').select2({
            width: '100%',
            data: RuangLingkup // Menggabungkan opsi "Mitra Dulu" dengan data dari permintaan AJAX
          });
        },
        cache: true
      });
    });



    $('#ruang_lingkup').on('change', function() {
      // alert('oy')
      var selectedRuling = $(this).select2('data')[0];
      // console.log(selectedRuling.id)
      $.ajax({
        url: '<?php echo base_url("Kerja_sama/getKegiatan"); ?>',
        dataType: 'json',
        // delay: 250,
        data: {
          id_ruling: selectedRuling.id
        }, // Perhatikan penulisan objek data dengan tanda kurung kurawal {}
        success: function(data) {
          var kegiatan = data.map(function(item) {
            return {
              id: item.id,
              text: item.nama
            };
          });
          $('#kegiatan').select2({
            width: '100%',
            data: kegiatan // Menggabungkan opsi "Mitra Dulu" dengan data dari permintaan AJAX
          });
        },
        cache: true
      });
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