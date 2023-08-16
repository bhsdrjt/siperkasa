<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<style>
    .center-table {
        width: 100%;
        text-align: center;
        height: 300px;
        /* Atur tinggi wadah tabel */
        overflow-y: auto;
        /* Tampilkan scrollbar vertikal jika kontennya lebih panjang daripada wadahnya */
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
    }
</style>

<!-- page title area end -->

<div class="row">
    <!-- Primary table start -->
    <div class="col-12 ">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-3">
                        <h3 style="color: white;"> <b> Kerja Sama Pembangunan Strategis </b></h3>
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

                <?= form_open('kerja_sama/pembangunan_strategis/process/add', 'enctype="multipart/form-data"') ?>
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
                        <input type="hidden" name="table_data" id="table_data">
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
                        <label for="file_surat_pks" class="col-form-label"><b> File Surat Persetujuan PKS</b>
                            <sup style="color: darkblue;">(Pdf)</sup></label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="file_surat_pks" id="file_surat_pks" value="" accept=".pdf">
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="no_surat_pks" class="col-form-label"><b>No. Persetujuan PKS</b></label>
                        <input class="form-control" type="text" name="no_surat_pks" id="no_surat_pks" placeholder="No Persetujuan PKS">
                    </div>
                    <div class="form-group col-12 d-flex align-items-center">
                        <?php $tahun_sekarang = date('Y'); ?>
                        <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
                        <a class="btn btn-primary ml-2 text-white" id="btnTambahKolom">Tambah Periode RKT</a>
                    </div>

                    <div class="form-group col-8 d-flex align-items-center">
                        <input class="form-control" type="text" name="ruang_lingkup" id="ruang_lingkup" placeholder="Ruang Lingkup">
                        <a class="btn btn-primary ml-2 text-white" id="btnRuangLingkup">Tambah Ruang Lingkup</a>
                    </div>

                    <div class="form-group col-8 d-flex align-items-center">
                        <select class="form-control" name="select_lingkup" id="select_lingkup">

                        </select>
                        <input class="form-control" type="text" name="program" id="program" placeholder="Program">
                        <input class="form-control" type="text" name="anggaran" id="anggaran" placeholder="Anggaran">
                        <input class="form-control" type="text" name="realisasi" id="realisasi" placeholder="Realisasi">
                        <a class="btn btn-primary ml-2 text-white" id="btnProgram">Tambah Program</a>
                    </div>

                    <div class="center-table">
                        <table class="table" id="tbl_ruanglingkup" name="tbl_ruanglingkup">
                            <thead>
                                <tr>
                                    <td rowspan=3 width="4%">No</td>
                                    <td rowspan=3 width="10%">Program/Kegiatan</td>
                                    <td id="jadwalHeader" colspan=2>Jadwal Tahun Berjalan</td>
                                    <td rowspan=3 width="10%">Jumlah Biaya (Anggaran)</td>
                                    <td rowspan=3 width="10%">Jumlah Biaya (Realisasi)</td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <?= (date('Y') - 1) . '-' . date('Y'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Anggaran</td>
                                    <td>Realisasi</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                                <th>Periode</th>
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
                        <button type="submit" class="btn btn-primary" name="simpan" id="btnSimpan" style="width: 200px;">Simpan</button>
                    </div>
                </div>
                <?= form_close() ?>


            </div>
        </div>
    </div>
    <!-- Primary table end -->
</div>
<!-- main content area end -->


<script type="text/javascript">
    // Ambil elemen tombol dan elemen tabel
    var btnTambahRuangLingkup = document.getElementById("btnRuangLingkup");
    var table = document.querySelector("#tbl_ruanglingkup");
    var tableBody = table.querySelector("tbody");
    var currentProgramIndex = 0;
    var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var ruangLingkupData = []; // Array untuk menyimpan data ruang lingkup

    var selectLingkup = document.getElementById("select_lingkup");
    var btnTambahProgram = document.getElementById("btnProgram");

    btnTambahRuangLingkup.addEventListener("click", function() {
        var ruangLingkupInput = document.getElementById("ruang_lingkup");
        var newKegiatan = ruangLingkupInput.value;

        if (!newKegiatan) {
            alert("Harap masukkan ruang lingkup kegiatan.");
            return;
        }

        var newRow = document.createElement("tr");

        var programCell = document.createElement("td");
        programCell.textContent = alphabet[currentProgramIndex];

        var kegiatanCell = document.createElement("td");
        kegiatanCell.textContent = newKegiatan;

        var numCols = table.rows[0].cells.length; // Menghitung jumlah kolom pada baris pertama
        console.log(numCols)
        var additionalTd = document.createElement("td");
        additionalTd.textContent = "";
        additionalTd.setAttribute("colspan", numCols.toString()); // Atur atribut colspan

        newRow.appendChild(programCell);
        newRow.appendChild(kegiatanCell);
        newRow.appendChild(additionalTd);

        tableBody.appendChild(newRow);

        // Simpan data ruang lingkup dalam array
        ruangLingkupData.push({
            program: alphabet[currentProgramIndex],
            kegiatan: newKegiatan
        });

        currentProgramIndex++;

        ruangLingkupInput.value = "";

        // Perbarui opsi dalam select_lingkup setelah menambahkan data baru
        populateSelectOptions();

        updateTotalRow();
    });

    // ...

    // Setelah Anda menambahkan data ke ruangLingkupData, Anda dapat mengisi pilihan dalam select_lingkup
    function populateSelectOptions() {
        selectLingkup.innerHTML = ""; // Kosongkan opsi saat ini

        for (var i = 0; i < ruangLingkupData.length; i++) {
            var option = document.createElement("option");
            option.value = ruangLingkupData[i].kegiatan; // Gunakan kegiatan sebagai nilai
            option.textContent = ruangLingkupData[i].kegiatan; // Gunakan kegiatan sebagai teks
            selectLingkup.appendChild(option);
        }
    }
    var programCounter = 1; // Menyimpan nomor urut program
    var totalAnggaran = 0;
    var totalRealisasi = 0;

    btnTambahProgram.addEventListener("click", function() {
        var programInput = document.getElementById("program");
        var anggaranInput = document.getElementById("anggaran");
        var realisasiInput = document.getElementById("realisasi");
        var newProgram = programInput.value;
        var newAnggaran = parseFloat(anggaranInput.value); // Convert to a floating-point number
        var newRealisasi = parseFloat(realisasiInput.value); // Convert to a floating-point number

        totalAnggaran += newAnggaran;
        totalRealisasi += newRealisasi;
        console.log(totalAnggaran);
        console.log(totalRealisasi);

        if (!newProgram) {
            alert("Harap masukkan nama program.");
            return;
        }

        if (isNaN(newAnggaran)) {
            alert("Anggaran harus berupa angka.");
            return;
        }

        if (isNaN(newRealisasi)) {
            alert("Realisasi harus berupa angka.");
            return;
        }

        programInput.value = "";
        anggaranInput.value = "";
        realisasiInput.value = "";

        // Tambahkan baris baru sesuai pilihan ruang lingkup
        var selectedKegiatan = selectLingkup.value;

        var newRow = document.createElement("tr");

        var programCell = document.createElement("td");
        programCell.textContent = ''; // Menggunakan nomor urut program
        // programCounter++; // Tingkatkan nomor urut

        var kegiatanCell = document.createElement("td");
        kegiatanCell.textContent = newProgram;

        var anggaranCell = document.createElement("td");
        anggaranCell.textContent = newAnggaran;

        var realisasiCell = document.createElement("td");
        realisasiCell.textContent = newRealisasi;

        var jlhAnggaranCell = document.createElement("td");
        jlhAnggaranCell.textContent = newAnggaran;

        var jlhRealisasiCell = document.createElement("td");
        jlhRealisasiCell.textContent = newRealisasi;


        // var numCols = table.rows[0].cells.length;
        // var additionalTd = document.createElement("td");
        // additionalTd.textContent = "Data Tambahan";
        // additionalTd.setAttribute("colspan", numCols.toString());

        newRow.appendChild(programCell);
        newRow.appendChild(kegiatanCell);
        newRow.appendChild(anggaranCell);
        newRow.appendChild(realisasiCell);
        newRow.appendChild(jlhAnggaranCell);
        newRow.appendChild(jlhRealisasiCell);

        // Cari indeks baris yang sesuai dengan ruang lingkup yang dipilih
        var insertRowIndex = -1;
        for (var i = 0; i < tableBody.rows.length; i++) {
            var kegiatanCellText = tableBody.rows[i].cells[1].textContent;
            if (kegiatanCellText === selectedKegiatan) {
                insertRowIndex = i + 1; // Baris setelah ruang lingkup yang dipilih
                break;
            }
        }

        // Sisipkan baris baru di bawah baris yang sesuai
        if (insertRowIndex !== -1) {
            if (insertRowIndex < tableBody.rows.length) {
                tableBody.insertBefore(newRow, tableBody.rows[insertRowIndex]);
            } else {
                // Jika baris terakhir ruang lingkup, tambahkan di akhir tabel
                tableBody.appendChild(newRow);
            }
        } else {
            // Jika tidak ada baris yang sesuai, cek baris lain dengan ruang lingkup yang lebih besar
            var insertAfterIndex = -1;
            for (var i = 0; i < tableBody.rows.length; i++) {
                var kegiatanCellText = tableBody.rows[i].cells[1].textContent;
                if (kegiatanCellText > selectedKegiatan) {
                    insertAfterIndex = i - 1;
                    break;
                }
            }

            if (insertAfterIndex !== -1) {
                tableBody.insertBefore(newRow, tableBody.rows[insertAfterIndex].nextSibling);
            } else {
                // Jika tidak ada baris dengan ruang lingkup yang lebih besar, tambahkan di akhir tabel
                tableBody.appendChild(newRow);
            }
        }
        updateTotalRow();

    });

    // function updateTotalRow() {
    //     var totalRow = document.getElementById("total-row");

    //     // Check if the total row exists, if not, create it
    //     if (!totalRow) {
    //         totalRow = document.createElement("tr");
    //         totalRow.id = "total-row";

    //         var totalLabelCell = document.createElement("td");
    //         totalLabelCell.textContent = "Total";
    //         totalLabelCell.colSpan = 2;

    //         var totalAnggaranCell = document.createElement("td");
    //         totalAnggaranCell.textContent = totalAnggaran;

    //         var totalRealisasiCell = document.createElement("td");
    //         totalRealisasiCell.textContent = totalRealisasi;

    //         var jlhTotalAnggaranCell = document.createElement("td");
    //         jlhTotalAnggaranCell.textContent = totalAnggaran;

    //         var jlhTotalRealisasiCell = document.createElement("td");
    //         jlhTotalRealisasiCell.textContent = totalRealisasi;

    //         totalRow.appendChild(totalLabelCell);
    //         totalRow.appendChild(totalAnggaranCell);
    //         totalRow.appendChild(totalRealisasiCell);
    //         totalRow.appendChild(jlhTotalAnggaranCell);
    //         totalRow.appendChild(jlhTotalRealisasiCell);

    //         // Append the total row to the table body
    //         tableBody.appendChild(totalRow);
    //     } else {
    //         var totalAnggaranCell = totalRow.querySelector("td:nth-child(2)"); // Select the second cell in the row
    //         var totalRealisasiCell = totalRow.querySelector("td:nth-child(3)"); // Select the third cell in the row
    //         var jlhTotalAnggaranCell = totalRow.querySelector("td:nth-child(4)"); // Select the third cell in the row
    //         var jlhTotalRealisasiCell = totalRow.querySelector("td:nth-child(5)"); // Select the third cell in the row

    //         if (totalAnggaranCell && totalRealisasiCell && jlhTotalAnggaranCell && jlhTotalRealisasiCell) {
    //             totalAnggaranCell.textContent = totalAnggaran;
    //             totalRealisasiCell.textContent = totalRealisasi; 
    //             jlhTotalAnggaranCell.textContent = totalAnggaran; 
    //             jlhTotalRealisasiCell.textContent = totalRealisasi; 
    //             // Update the total realisasi cell
    //         } else {
    //             console.error("Total cells not found.");
    //         }
    //     }
    // }

    function updateTotalRow() {
        var totalRow = document.getElementById("total-row");

        // If the total row exists, remove it
        if (totalRow) {
            tableBody.removeChild(totalRow);
        }

        // Create a new total row
        totalRow = document.createElement("tr");
        totalRow.id = "total-row";

        var totalLabelCell = document.createElement("td");
        totalLabelCell.textContent = "Total";
        totalLabelCell.colSpan = 2;

        var totalAnggaranCell = document.createElement("td");
        totalAnggaranCell.textContent = totalAnggaran;

        var totalRealisasiCell = document.createElement("td");
        totalRealisasiCell.textContent = totalRealisasi;

        var jlhTotalAnggaranCell = document.createElement("td");
        jlhTotalAnggaranCell.textContent = totalAnggaran;

        var jlhTotalRealisasiCell = document.createElement("td");
        jlhTotalRealisasiCell.textContent = totalRealisasi;

        totalRow.appendChild(totalLabelCell);
        totalRow.appendChild(totalAnggaranCell);
        totalRow.appendChild(totalRealisasiCell);
        totalRow.appendChild(jlhTotalAnggaranCell);
        totalRow.appendChild(jlhTotalRealisasiCell);

        // Append the new total row to the table body
        tableBody.appendChild(totalRow);
    }




    $(document).ready(function() {
        tinymce.init({
            selector: '#judul',
            menubar: false,
            toolbar: 'bold italic',
            statusbar: false,
        });

        // Permintaan AJAX untuk mendapatkan data
        $.ajax({
            url: '<?php echo base_url("Kerja_sama/getmitra"); ?>',
            dataType: 'json',
            delay: 250,
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
                    data: mitraArray
                });
            },
            cache: true
        });

        // Menggunakan event 'change' pada Select2
        $('#mitra').on('change', function() {
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
                  <input type="file" class="form-control" name="file_rkt[]" id="file_rkt` + index + `" value="" accept=".pdf">
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

        $("#btnSimpan").click(function() {
            // Collect table data
            console.log("Button clicked"); // Log that the button was clicked
            var tableData = [];
            var rows = document.querySelectorAll("#tbl_ruanglingkup tbody tr");
            rows.forEach(function(row) {
                var rowData = [];
                row.querySelectorAll("td").forEach(function(cell) {
                    rowData.push(cell.textContent);
                });
                tableData.push(rowData);
            });

            // Set table data in a hidden input
            $("#table_data").val(JSON.stringify(tableData));

            console.log("Table data:", tableData); // Log the collected table data
            console.log("Serialized data:", JSON.stringify(tableData));


            // Submit the form
            $("form").submit();
        });
    });
</script>


<script>
    // function addNewRow() {
    //     // Get the table element
    //     const table = document.getElementById('tbl_ruanglingkup');

    //     // Get the number of existing rows in the table
    //     const numRows = table.rows.length;

    //     // Create a new row and add cells to it
    //     const newRow = table.insertRow(numRows);
    //     for (let i = 0; i < table.rows[3].cells.length; i++) {
    //         const newCell = newRow.insertCell();
    //         newCell.contentEditable = true; // Set the contenteditable attribute
    //         newCell.textContent = 'New'; // You can set an initial value for the new cell
    //     }
    // }

    // document.getElementById('btnTambahRow').addEventListener('click', function() {
    //     addNewRow();
    // });
    let iter = 0;
    document.getElementById('btnTambahKolom').addEventListener('click', function() {
        // console.log('test')
        // Get the table element
        const table = document.getElementById('tbl_ruanglingkup');

        // Get the current colspan of the "Jadwal Tahun Berjalan" header cell
        const currentColspan = table.rows[0].cells[2].colSpan;

        //     console.log(table.rows[0].cells[2]);
        //     console.log(table.rows[0].cells[2].colSpan);
        // console.log(currentColspan);
        // Increase the colspan by 1
        table.rows[0].cells[2].colSpan = currentColspan + 2;
        // let iter = 0;

        // console.log(table.rows.length);

        for (let i = 1; i < table.rows.length; i++) {

            // console.log(table.rows[i].cells.length);
            // console.log(currentColspan + 2);
            // Check if the new data cell already exists
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            if (table.rows[i].cells.length === currentColspan + 6) {
                console.log('test')
                // If the new data cell already exists, update its content
                if (i === 1) {
                    // Increment iter only when adding the new header cell
                    // iter++;
                    // table.rows[i].cells[currentColspan + 2].textContent = currentYear + iter - 1 + '-' + (
                    //     currentYear + iter);
                } else {
                    console.log(i);
                    const newBudgetCell = document.createElement('td');
                    newBudgetCell.textContent = 'Anggaran 1';
                    newBudgetCell.contentEditable = true; // Set the contenteditable attribute
                    table.rows[i].insertBefore(newBudgetCell, table.rows[i].cells[currentColspan + 2]);

                    const newRealisasiCell = document.createElement('td');
                    newRealisasiCell.textContent = 'Realisasi 1';
                    newRealisasiCell.contentEditable = true; // Set the contenteditable attribute
                    table.rows[i].insertBefore(newRealisasiCell, table.rows[i].cells[currentColspan + 3]);

                    // const newVolCell = document.createElement('td');
                    // newVolCell.textContent = 'Vol 1';
                    // newVolCell.contentEditable = true; // Set the contenteditable attribute
                    // table.rows[i].appendChild(newVolCell);

                    // const newSatCell = document.createElement('td');
                    // newSatCell.textContent = 'Sat 1';
                    // newSatCell.contentEditable = true; // Set the contenteditable attribute
                    // table.rows[i].appendChild(newSatCell);

                }
            } else {
                console.log('test2')
                // If the new data cell does not exist, create and add it
                const newDataCell = document.createElement('td');

                if (i === 1) {
                    //     // Increment iter only when adding the new header cell
                    iter++;
                    newDataCell.setAttribute('colspan', '2');
                    newDataCell.textContent = currentYear + (iter - 1) + '-' + (currentYear + iter);
                    table.rows[i].appendChild(newDataCell);
                } else if (i === 2) {
                    const newBudgetCell = document.createElement('td');
                    newBudgetCell.textContent = 'Anggaran';
                    newBudgetCell.contentEditable = true; // Set the contenteditable attribute
                    table.rows[i].appendChild(newBudgetCell);

                    const newRealisasiCell = document.createElement('td');
                    newRealisasiCell.textContent = 'Realisasi';
                    newRealisasiCell.contentEditable = true; // Set the contenteditable attribute
                    table.rows[i].appendChild(newRealisasiCell);

                    // const newVolCell = document.createElement('td');
                    // newVolCell.textContent = 'Vol';
                    // newVolCell.contentEditable = true; // Set the contenteditable attribute
                    // table.rows[i].appendChild(newVolCell);

                    // const newSatCell = document.createElement('td');
                    // newSatCell.textContent = 'Sat';
                    // newSatCell.contentEditable = true; // Set the contenteditable attribute
                    // table.rows[i].appendChild(newSatCell);


                }



            }
        }
    });

    document.getElementById("btnTambahRuangLingkup").addEventListener("click", function() {
        var ruangLingkupContainer = document.getElementById("ruangLingkupContainer");
        ruangLingkupContainer.style.display = "block";
    });
</script>

<<?= $this->endSection() ?>