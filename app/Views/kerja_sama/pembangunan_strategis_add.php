<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

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
    .baris_totalbawah .freeze-column  {
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
<?php $tahun_sekarang = date('Y'); ?>
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
                        <h4>Kerja Sama Pembangunan Strategis</h4>
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
                            <input style="height: fit-content;" type="file" class="form-control" name="file_surat_pks" id="file_surat_pks" value="" accept=".pdf">
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="no_surat_pks" class="col-form-label"><b>No. Persetujuan PKS</b></label>
                        <input class="form-control" type="text" name="no_surat_pks" id="no_surat_pks" placeholder="No Persetujuan PKS">
                    </div>
                    <div class="form-group col-12 d-flex align-items-center">

                        <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
                        <a class="btn btn-primary ml-2" id="btnTambahKolom">Tambah Periode RKT</a>
                    </div>

                    <div class="form-group col-8 d-flex align-items-center">
                        <input class="form-control" type="text" name="ruang_lingkup" id="ruang_lingkup" placeholder="Ruang Lingkup">
                        <a class="btn btn-primary ml-2" id="btnRuangLingkup">Tambah Ruang Lingkup</a>
                    </div>

                    <div class="form-group col-12 d-flex align-items-center" id="input_program">
                        <select class="form-control" name="select_lingkup" id="select_lingkup">
                        </select>
                        <input class="form-control" type="text" name="program" id="program" placeholder="Program">
                        <!-- <input class="form-control" type="text" name="anggaran" id="anggaran" placeholder="Anggaran">
                        <input class="form-control" type="text" name="realisasi" id="realisasi" placeholder="Realisasi"> -->
                        <a class="btn btn-primary ml-2" id="btnProgram">Tambah Program</a>
                    </div>

                    <div class="center-table">
                        <table class="table" id="tbl_ruanglingkup" name="tbl_ruanglingkup">
                            <thead>
                                <tr>
                                    <td rowspan=3 class="freeze-column" width="5%">No</td>
                                    <td rowspan=3 class="freeze-column" width="15%">Program/Kegiatan</td>
                                    <td id="jadwalHeader" colspan=3>Jadwal Tahun Berjalan</td>
                                    <td rowspan=3 width="7%">Jumlah Biaya (Anggaran)</td>
                                    <td rowspan=3 width="7%">Jumlah Biaya (Realisasi)</td>
                                    <td rowspan=3 width="7%">Jumlah Vol</td>
                                </tr>
                                <tr>
                                    <!-- Default colspan is 2 -->
                                    <td colspan=3><?php echo ($tahun_sekarang - 1) . '-' . $tahun_sekarang ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Anggaran</td>
                                    <td>Realisasi</td>
                                    <td>Vol</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="baris_totalbawah">
                                    <td colSpan='2' class="freeze-column">Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                        <!-- <button type="button" class="btn btn-xs btn-info" id="addDokumenRKT"><i class="fa fa-plus"></i> Add</button> -->

                        <table class="table table-borderless mt-2 dokumenRKT" style="width: 100%;">
                            <thead>
                                <th>No</th>
                                <th>Periode</th>
                                <th>Nama RKT</th>
                                <th>File Upload RKT <sup style="color: darkblue;">(pdf)</sup></th>
                                <th>Komitmen RKT</th>
                                <th>Realisasi RKT</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="periode[]" id="periode0" value="<?php echo ($tahun_sekarang - 1) . '-' . $tahun_sekarang ?>" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt0" placeholder="Periode RKT">
                                        </div>
                                    </td>
                                    <td style="padding-left: 0px;">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="file_rkt[]" id="file_rkt0" value="" accept=".pdf" style="height: fit-content;">
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
                            <input type="file" style="height: fit-content;" class="form-control" name="file_lokasi" id="file_lokasi" accept=".kml" value="">
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
<!-- </div>
</div> -->
<!-- main content area end -->


<script type="text/javascript">
    // Ambil elemen tombol dan elemen tabel
    var btnTambahKolom = document.getElementById("btnTambahKolom");
    var btnTambahRuangLingkup = document.getElementById("btnRuangLingkup");
    var table = document.querySelector("#tbl_ruanglingkup");
    var tableBody = table.querySelector("tbody");
    var currentProgramIndex = 0;
    var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var ruangLingkupData = []; // Array untuk menyimpan data ruang lingkup

    var selectLingkup = document.getElementById("select_lingkup");
    var btnTambahProgram = document.getElementById("btnProgram");

    const inputProgramDiv = document.getElementById('input_program');
    let addedYears = 1; // Variable to keep track of added years

    btnTambahKolom.addEventListener("click", function() {
        const table = document.getElementById('tbl_ruanglingkup');
        const currentColspan = table.rows[0].cells[2].colSpan;

        // if (addedYears < 2) { // Check if less than 2 years have been added
        console.log(table.rows[0].cells[2]);
        table.rows[0].cells[2].colSpan = currentColspan + 3;

        for (let i = 1; i < table.rows.length; i++) {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() + addedYears - 1; // Incremented by addedYears
            const newDataCell = document.createElement('td');
            let iter = 1;

            var period = currentYear + (iter - 1) + '-' + (currentYear + iter)

            if (i === 1) {

                iter++;
                newDataCell.setAttribute('colspan', '3');
                newDataCell.textContent = period;
                table.rows[i].appendChild(newDataCell);
            } else if (i === 2) {
                const newBudgetCell = document.createElement('td');
                newBudgetCell.textContent = 'Anggaran';
                table.rows[i].appendChild(newBudgetCell);

                const newRealisasiCell = document.createElement('td');
                newRealisasiCell.textContent = 'Realisasi';
                table.rows[i].appendChild(newRealisasiCell);


                const newVolCell = document.createElement('td');
                newVolCell.textContent = 'Vol';
                table.rows[i].appendChild(newVolCell);
                TambahRkt(period)
            } else {
                const newBudgetCell2 = document.createElement('td');
                newBudgetCell2.classList.add("totalbawah");
                table.rows[i].appendChild(newBudgetCell2);

                const newRealisasiCell2 = document.createElement('td');
                newRealisasiCell2.classList.add("totalbawah");
                table.rows[i].appendChild(newRealisasiCell2);

                const newVolCell2 = document.createElement('td');
                newVolCell2.classList.add("totalbawah");
                table.rows[i].appendChild(newVolCell2);
            }
        }

        addedYears++;
    });



    btnTambahRuangLingkup.addEventListener("click", function() {
        var ruangLingkupInput = document.getElementById("ruang_lingkup");

        var table = document.querySelector("#tbl_ruanglingkup");
        var newKegiatan = ruangLingkupInput.value;

        if (!newKegiatan) {
            alert("Harap masukkan ruang lingkup kegiatan.");
            return;
        }

        btnTambahKolom.removeEventListener("click", handleClick);
        btnTambahKolom.classList.add("disabled-button");
        btnTambahKolom.disabled = true; // Disable the "Tambah Kolom" button
        btnTambahKolom.style.opacity = 0.5; // Dim the appearance
        function handleClick(event) {
            alert("Tidak bisa menambahkan tahun karena sudah menambah ruang lingkup");
        }

        // Temukan baris "Total Bawah"
        var totalBawahRow = document.querySelector(".baris_totalbawah").closest("tr");

        // Buat baris baru
        var newRow = document.createElement("tr");

        var programCell = document.createElement("td");
        programCell.textContent = alphabet[currentProgramIndex];

        var kegiatanCell = document.createElement("td");
        kegiatanCell.textContent = '\t' + newKegiatan;
        kegiatanCell.className = 'freeze-column';
        kegiatanCell.style.textAlign = 'left';
        kegiatanCell.style.paddingLeft = '10px';

        var numCols = table.rows[2].cells.length + 3;
        var additionalTd = document.createElement("td");
        additionalTd.textContent = "";
        additionalTd.setAttribute("colspan", numCols.toString());

        newRow.appendChild(programCell);
        newRow.appendChild(kegiatanCell);
        newRow.appendChild(additionalTd);

        // Sisipkan baris baru di atas "Total Bawah"
        tableBody.insertBefore(newRow, totalBawahRow);

        // Simpan data ruang lingkup dalam array
        ruangLingkupData.push({
            program: alphabet[currentProgramIndex],
            kegiatan: newKegiatan
        });

        currentProgramIndex++;

        ruangLingkupInput.value = "";

        // Perbarui opsi dalam select_lingkup setelah menambahkan data baru
        populateSelectOptions();

        // updateTotalRow();
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
    var totalAnggaran1 = 0;
    var totalRealisasi1 = 0;
    var totalAnggaran2 = 0;
    var totalRealisasi2 = 0;

    btnTambahProgram.addEventListener("click", function() {
        var programInput = document.getElementById("program");
        var newProgram = programInput.value;

        var jlhAnggaran = 0;
        var jlhRealisasi = 0;
        var jlhVol = 0;

        if (!newProgram) {
            alert("Harap masukkan nama program.");
            return;
        }

        // Tambahkan baris baru sesuai pilihan ruang lingkup
        var selectedKegiatan = selectLingkup.value;

        var newRow = document.createElement("tr");

        var programCell = document.createElement("td");
        programCell.textContent = '';
        var kegiatanCell = document.createElement("td");
        kegiatanCell.textContent = newProgram;
        kegiatanCell.className = 'freeze-column';

        newRow.appendChild(programCell);
        newRow.appendChild(kegiatanCell);
        for (var i = 0; i < addedYears; i++) {
            var anggaranCell = document.createElement("td");
            newRow.appendChild(anggaranCell);
            var inputanggaran = document.createElement("input");
            inputanggaran.classList.add("anggaran");
            inputanggaran.classList.add("nilai");
            inputanggaran.type = "text"; // Atur tipe input sesuai kebutuhan, misalnya "text" atau "number"
            // inputanggaran.setAttribute("onchange", "updateAnggaran(this)");
            inputanggaran.onchange = function() {
                updateAnggaran(this)
                updateTotal(this)
            }
            anggaranCell.appendChild(inputanggaran);

            var realisasiCell = document.createElement("td");
            newRow.appendChild(realisasiCell);
            var inputrealisasi = document.createElement("input");
            inputrealisasi.classList.add("realisasi"); // Atur tipe input sesuai kebutuhan, misalnya "text" atau "number"
            inputrealisasi.classList.add("nilai"); // Atur tipe input sesuai kebutuhan, misalnya "text" atau "number"
            inputrealisasi.type = "text"; // Atur tipe input sesuai kebutuhan, misalnya "text" atau "number"
            // inputrealisasi.setAttribute("onchange", "updateRealisasi(this)");
            inputrealisasi.onchange = function() {
                updateRealisasi(this)
                updateTotal(this)
            }
            realisasiCell.appendChild(inputrealisasi);

            var volCell = document.createElement("td");
            newRow.appendChild(volCell);
            var inputvol = document.createElement("input");
            inputvol.classList.add('vol');
            inputvol.classList.add('nilai');
            inputvol.type = "text"; // Atur tipe input sesuai kebutuhan, misalnya "text" atau "number"
            // inputvol.setAttribute("onchange", "updateVol(this)");
            inputvol.onchange = function() {
                updateVol(this)
                updateTotal(this)
            }
            volCell.appendChild(inputvol);
        }

        var jlhAnggaranCell = document.createElement("td");
        jlhAnggaranCell.textContent = jlhAnggaran;
        jlhAnggaranCell.classList.add('total_anggaran');

        var jlhRealisasiCell = document.createElement("td");
        jlhRealisasiCell.textContent = jlhRealisasi;
        jlhRealisasiCell.classList.add('total_realisasi');

        var jlhVolCell = document.createElement("td");
        jlhVolCell.textContent = jlhVol;
        jlhVolCell.classList.add('total_vol');

        newRow.appendChild(jlhAnggaranCell);
        newRow.appendChild(jlhRealisasiCell);
        newRow.appendChild(jlhVolCell);
        // alert(selectedKegiatan)
        // Cari indeks baris yang sesuai dengan ruang lingkup yang dipilih
        var insertRowIndex = -1;
        for (var i = 0; i < tableBody.rows.length; i++) {
            var kegiatanCellText = tableBody.rows[i].cells[1].textContent.trim();

            if (kegiatanCellText === selectedKegiatan) {
                insertRowIndex = i + 1; // Baris setelah ruang lingkup yang dipilih
                break;
            }
        }
        console.log(insertRowIndex)
        // Temukan baris "Total Bawah"
        var totalBawahRow = document.querySelector(".baris_totalbawah").closest("tr");

        // Sisipkan baris program yang baru di antara baris "Total Bawah" dan baris yang sesuai dengan ruang lingkup yang dipilih
        if (insertRowIndex !== -1) {
            tableBody.insertBefore(newRow, tableBody.rows[insertRowIndex]);
        } else {
            tableBody.insertBefore(newRow, totalBawahRow);
        }
        // updateTotalRow();?
    });


    function updateAnggaran(inputElement) {
        var row = inputElement.closest('tr'); // Temukan elemen 'tr' terdekat yang mengandung elemen input
        var anggaranElements = row.getElementsByClassName('anggaran'); // Dapatkan semua elemen dengan class 'vol' dalam satu baris (tr)

        // Inisialisasi totalVol sebagai 0
        var totalAnggaran = 0;

        // Iterasi melalui elemen-elemen dengan class 'vol' dan tambahkan nilainya ke totalAnggaran
        for (var i = 0; i < anggaranElements.length; i++) {
            var realiasiValue = parseFloat(anggaranElements[i].value) || 0; // Konversi nilai ke floating-point atau 0 jika tidak valid
            totalAnggaran += realiasiValue;
        }

        var totalAnggaranElement = row.querySelector('.total_anggaran'); // Menggunakan querySelector untuk mencari elemen dengan class 'total_vol'

        if (totalAnggaranElement) {
            totalAnggaranElement.textContent = totalAnggaran;
        }
    }

    function updateRealisasi(inputElement) {
        var row = inputElement.closest('tr'); // Temukan elemen 'tr' terdekat yang mengandung elemen input
        var realisasiElements = row.getElementsByClassName('realisasi'); // Dapatkan semua elemen dengan class 'vol' dalam satu baris (tr)

        // Inisialisasi totalVol sebagai 0
        var totalRealisasi = 0;

        // Iterasi melalui elemen-elemen dengan class 'vol' dan tambahkan nilainya ke totalRealisasi
        for (var i = 0; i < realisasiElements.length; i++) {
            var realiasiValue = parseFloat(realisasiElements[i].value) || 0; // Konversi nilai ke floating-point atau 0 jika tidak valid
            totalRealisasi += realiasiValue;
        }

        var totalRealisasiElement = row.querySelector('.total_realisasi'); // Menggunakan querySelector untuk mencari elemen dengan class 'total_vol'

        if (totalRealisasiElement) {
            totalRealisasiElement.textContent = totalRealisasi;
        }
    }


    function updateVol(inputElement) {
        var row = inputElement.closest('tr'); // Temukan elemen 'tr' terdekat yang mengandung elemen input
        var volElements = row.getElementsByClassName('vol'); // Dapatkan semua elemen dengan class 'vol' dalam satu baris (tr)

        // Inisialisasi totalVol sebagai 0
        var totalVol = 0;

        // Iterasi melalui elemen-elemen dengan class 'vol' dan tambahkan nilainya ke totalVol
        for (var i = 0; i < volElements.length; i++) {
            var volValue = parseFloat(volElements[i].value) || 0; // Konversi nilai ke floating-point atau 0 jika tidak valid
            totalVol += volValue;
        }

        var totalVolElement = row.querySelector('.total_vol'); // Menggunakan querySelector untuk mencari elemen dengan class 'total_vol'

        if (totalVolElement) {
            totalVolElement.textContent = totalVol;
        }
    }

    function updateTotal(inputElement) {
        // Temukan elemen td yang mengandung elemen input (inputElement)
        var tdElement = inputElement.parentElement;

        // Temukan indeks kolom dari elemen td tersebut dalam baris
        var columnIndex = Array.from(tdElement.parentElement.children).indexOf(tdElement);

        // alert(columnIndex)

        // Dapatkan elemen 'totalbawah' dalam kolom yang sesuai dengan columnIndex
        var totalBawahElement = document.querySelector('#tbl_ruanglingkup tbody tr.baris_totalbawah td:nth-child(' + (columnIndex) + ')');

        // Dapatkan semua elemen input dengan class name 'nilai' dalam kolom yang sama
        var nilaiElements = document.querySelectorAll('#tbl_ruanglingkup tbody tr td:nth-child(' + (columnIndex + 1) + ') input.nilai');

        // Loop melalui nilaiElements dan mengumpulkan nilai-nilainya
        // var nilaiValues = [];
        var jumlahTotalBawah = 0
        nilaiElements.forEach(function(input) {
            // nilaiValues.push(input.value);
            var nilai = (parseInt(input.value)) ? parseInt(input.value) : 0;
            jumlahTotalBawah += nilai;
        });
        totalBawahElement.textContent = jumlahTotalBawah
    }


    var index = 1;
    var no = 2;


    // $("#addDokumenRKT").click(function(event) {
    function TambahRkt(period) {
        var newRow = $("<tr>");
        var cols = "";
        cols += `<td>` + no + `.</td>
              <td>
                <div class="form-group">
                  <input class="form-control disable-action" type="text" name="periode[]" id="periode` + index + `" placeholder="Periode RKT" value = "` + period + `" readonly>
                 </div>
              </td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_rkt[]" id="nama_rkt` + index + `" placeholder="Nama RKT">
                 </div>
              </td>
              <td style="padding-left: 0px;">
                <div class="input-group mb-3">
                  <input type="file" style="height: fit-content;" class="form-control" name="file_rkt[]" id="file_rkt` + index + `" value="" accept=".pdf">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="komitmen_rkt[]" id="komitmen_rkt` + index + `" placeholder="Komitmen RKT" oninput="formatCurrency(this)">
                 </div>
              </td>
              <td>
                <div class="form-group">
                  <input class="form-control" type="text" name="realisasi_rkt[]" id="realisasi_rkt` + index + `" placeholder="Realisasi RKT" oninput="formatCurrency(this)">
                </div>
              </td>`;
        newRow.append(cols);
        $("table.dokumenRKT").append(newRow);
        index++;
        no++;
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

        // Menggunakan event 'change' pada Select2
        $('#mitra').on('change', function() {
            var selectedMitra = $(this).select2('data')[0];
            if (selectedMitra && selectedMitra.additional) {
                $('#lokasi_kerjasama').val(selectedMitra.additional.jenis_lokasi);
            } else {
                $('#lokasi_kerjasama').val('');
            }
        });


        // });


        $("table.dokumenRKT").on("click", "#delDokumen", function(event) {
            $(this).closest("tr").remove();
            no--;
        });

        $("#btnSimpan").click(function() {
            // Collect table data
            // console.log("Button clicked"); // Log that the button was clicked
            var tableData = [];
            var rows = document.querySelectorAll("#tbl_ruanglingkup tbody tr");
            rows.forEach(function(row) {
                var rowData = [];
                row.querySelectorAll("td").forEach(function(cell) {
                    var inputElement = cell.querySelector('input');
                    if (inputElement) {
                        rowData.push((inputElement.value == '') ? 0 : inputElement.value);
                    } else {
                        rowData.push(cell.textContent);
                    }
                });
                tableData.push(rowData);
            });


            // Set table data in a hidden input
            $("#table_data").val(JSON.stringify(tableData));

            console.log("Table data:", tableData); // Log the collected table data
            console.log("Serialized data:", JSON.stringify(tableData));

            // return false


            // Submit the form
            $("form").submit();
        });
    });



    document.getElementById("btnTambahRuangLingkup").addEventListener("click", function() {
        var ruangLingkupContainer = document.getElementById("ruangLingkupContainer");
        ruangLingkupContainer.style.display = "block";
    });
</script>

<<?= $this->endSection() ?>