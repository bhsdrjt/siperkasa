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

.disabled-button {
    pointer-events: none;
    opacity: 0.4s;
}
</style>

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
                                <input class="form-control " readonly type="text" name="lokasi_kerjasama"
                                    id="lokasi_kerjasama">
                            </div>
                            <div class="form-group col-12">
                                <label for="judul" class="col-form-label"><b>Judul</b></label>
                                <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul">
                                <input type="hidden" name="table_data" id="table_data">
                            </div>
                            <div class="form-group col-4">
                                <label for="tgl_awal" class="col-form-label"><b>Tgl PKS Awal</b></label>
                                <input class="form-control" type="date" name="tgl_awal" id="tgl_awal"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group col-4">
                                <label for="tgl_akhir" class="col-form-label"><b>Tgl PKS Akhir</b></label>
                                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-4"></div>

                            <div class="form-group col-4">
                                <label for="surat_pks" class="col-form-label"><b>Surat Persetujuan PKS</b></label>
                                <input class="form-control" type="text" name="surat_pks" id="surat_pks"
                                    placeholder="Surat Persetujuan PKS">
                            </div>
                            <div class="form-group col-4">
                                <label for="file_surat_pks" class="col-form-label"><b> File Surat Persetujuan PKS</b>
                                    <sup style="color: darkblue;">(Pdf)</sup></label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file_surat_pks" id="file_surat_pks"
                                        value="" accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="no_surat_pks" class="col-form-label"><b>No. Persetujuan PKS</b></label>
                                <input class="form-control" type="text" name="no_surat_pks" id="no_surat_pks"
                                    placeholder="No Persetujuan PKS">
                            </div>
                            <div class="form-group col-12 d-flex align-items-center">
                                <?php $tahun_sekarang = date('Y'); ?>
                                <label for="ruang_lingkup" class="col-form-label"><b>Ruang Lingkup</b></label>
                                <a class="btn btn-primary ml-2" id="btnTambahKolom">Tambah Periode RKT</a>
                            </div>

                            <div class="form-group col-8 d-flex align-items-center">
                                <input class="form-control" type="text" name="ruang_lingkup" id="ruang_lingkup"
                                    placeholder="Ruang Lingkup">
                                <a class="btn btn-primary ml-2" id="btnRuangLingkup">Tambah Ruang Lingkup</a>
                            </div>

                            <div class="form-group col-16 d-flex align-items-center" id="input_program">
                                <select class="form-control" name="select_lingkup" id="select_lingkup">

                                </select>
                                <input class="form-control" type="text" name="program" id="program"
                                    placeholder="Program">
                                <input class="form-control" type="text" name="anggaran" id="anggaran"
                                    placeholder="Anggaran">
                                <input class="form-control" type="text" name="realisasi" id="realisasi"
                                    placeholder="Realisasi">
                                <a class="btn btn-primary ml-2" id="btnProgram">Tambah Program</a>
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
                                            <!-- Default colspan is 2 -->
                                            <td colspan=2><?php echo ($tahun_sekarang - 1) . '-' . $tahun_sekarang ?>
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
                                <label for="cover" class="col-form-label"><b>Dokumen PKS</b> <sup
                                        style="color: darkblue;">(Pdf)</sup></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="file_pks" id="file_pks" value=""
                                        accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="komitmen_pks" class="col-form-label"><b>Komitmen PKS</b></label>
                                <input class="form-control" type="text" name="komitmen_pks" id="komitmen_pks"
                                    placeholder="Komitmen PKS" oninput="formatCurrency(this)">
                            </div>
                            <div class="form-group col-4">
                                <label for="realisasi_pks" class="col-form-label"><b>Realisasi PKS</b></label>
                                <input class="form-control" type="text" name="realisasi_pks" id="realisasi_pks"
                                    placeholder="Realisasi PKS" oninput="formatCurrency(this)">
                            </div>

                            <div class="form-group col-4">
                                <label for="cover" class="col-form-label"><b>Dokumen RPP</b> <sup
                                        style="color: darkblue;">(Pdf)</sup></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="file_rpp" id="file_rpp" value=""
                                        accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="komitmen_rpp" class="col-form-label"><b>Komitmen RPP</b></label>
                                <input class="form-control" type="text" name="komitmen_rpp" id="komitmen_rpp"
                                    placeholder="Komitmen RPP" oninput="formatCurrency(this)">
                            </div>
                            <div class="form-group col-4">
                                <label for="realisasi_rpp" class="col-form-label"><b>Realisasi RPP</b></label>
                                <input class="form-control" type="text" name="realisasi_rpp" id="realisasi_rpp"
                                    placeholder="Realisasi RPP" oninput="formatCurrency(this)">
                            </div>

                            <div class="form-group col-4">
                                <label for="cover" class="col-form-label"><b>Dokumen RKL 1</b> <sup
                                        style="color: darkblue;">(Pdf)</sup></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="file_rkl_1" id="file_rkl_1" value=""
                                        accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="komitmen_rkl_1" class="col-form-label"><b>Komitmen RKL 1</b></label>
                                <input class="form-control" type="text" name="komitmen_rkl_1" id="komitmen_rkl_1"
                                    placeholder="Komitmen RKL 1" oninput="formatCurrency(this)">
                            </div>
                            <div class="form-group col-4">
                                <label for="realisasi_rkl_1" class="col-form-label"><b>Realisasi RKL 1</b></label>
                                <input class="form-control" type="text" name="realisasi_rkl_1" id="realisasi_rkl_1"
                                    placeholder="Realisasi RKL 1" oninput="formatCurrency(this)">
                            </div>

                            <div class="form-group col-4">
                                <label for="cover" class="col-form-label"><b>Dokumen RKL 2</b> <sup
                                        style="color: darkblue;">(Pdf)</sup></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="file_rkl_2" id="file_rkl_2" value=""
                                        accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="komitmen_rkl_2" class="col-form-label"><b>Komitmen RKL 2</b></label>
                                <input class="form-control" type="text" name="komitmen_rkl_2" id="komitmen_rkl_2"
                                    placeholder="Komitmen RKL 2" oninput="formatCurrency(this)">
                            </div>
                            <div class="form-group col-4">
                                <label for="realisasi_rkl_2" class="col-form-label"><b>Realisasi RKL 2</b></label>
                                <input class="form-control" type="text" name="realisasi_rkl_2" id="realisasi_rkl_2"
                                    placeholder="Realisasi RKL 2" oninput="formatCurrency(this)">
                            </div>

                            <div class="form-group mt-3 col-12">
                                <b style="font-size: large;">Dokumen RKT</b>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <button type="button" class="btn btn-xs btn-info" id="addDokumenRKT"><i
                                        class="fa fa-plus"></i> Add</button>

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
                                                    <input class="form-control" type="text" name="nama_rkt[]"
                                                        id="nama_rkt0" placeholder="Periode RKT">
                                                </div>
                                            </td>
                                            <td style="padding-left: 0px;">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" name="file_rkt[]"
                                                        id="file_rkt0" value="" accept=".pdf">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="komitmen_rkt[]"
                                                        id="komitmen_rkt0" placeholder="Komitmen RKT"
                                                        oninput="formatCurrency(this)">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="realisasi_rkt[]"
                                                        id="realisasi_rkt0" placeholder="Realisasi RKT"
                                                        oninput="formatCurrency(this)">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group col-4">
                                <label for="file_lokasi" class="col-form-label"><b>File Lokasi</b> <sup
                                        style="color: darkblue;">(.KML)</sup></label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="file_lokasi" id="file_lokasi"
                                        accept=".kml" value="">
                                </div>
                            </div>
                            <div class="form-group col-4"></div>



                            <div class="form-group col-12 text-center">
                                <button type="submit" class="btn btn-primary" name="simpan" id="btnSimpan"
                                    style="width: 200px;">Simpan</button>
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
let addedYears = 0; // Variable to keep track of added years

btnTambahKolom.addEventListener("click", function() {
    const table = document.getElementById('tbl_ruanglingkup');
    const currentColspan = table.rows[0].cells[2].colSpan;

    if (addedYears < 2) { // Check if less than 2 years have been added
        console.log(table.rows[0].cells[2]);
        table.rows[0].cells[2].colSpan = currentColspan + 2;

        for (let i = 1; i < table.rows.length; i++) {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() + addedYears; // Incremented by addedYears
            const newDataCell = document.createElement('td');

            if (i === 1) {
                let iter = 0;
                iter++;
                newDataCell.setAttribute('colspan', '2');
                newDataCell.textContent = currentYear + (iter - 1) + '-' + (currentYear + iter);
                table.rows[i].appendChild(newDataCell);
            } else if (i === 2) {
                const newBudgetCell = document.createElement('td');
                newBudgetCell.textContent = 'Anggaran';
                newBudgetCell.contentEditable = true;
                table.rows[i].appendChild(newBudgetCell);

                const newRealisasiCell = document.createElement('td');
                newRealisasiCell.textContent = 'Realisasi';
                newRealisasiCell.contentEditable = true;
                table.rows[i].appendChild(newRealisasiCell);

                const anggaranInput = document.createElement('input');
                anggaranInput.className = 'form-control';
                anggaranInput.type = 'text';
                anggaranInput.name = 'anggaran' + (addedYears + 1);
                anggaranInput.id = 'anggaran' + (addedYears + 1);
                anggaranInput.placeholder = 'Anggaran' + (addedYears + 1);
                inputProgramDiv.insertBefore(anggaranInput, btnProgram); // Insert before the button

                const realisasiInput = document.createElement('input');
                realisasiInput.className = 'form-control';
                realisasiInput.type = 'text';
                realisasiInput.name = 'realisasi' + (addedYears + 1);
                realisasiInput.id = 'realisasi' + (addedYears + 1);
                realisasiInput.placeholder = 'Realisasi' + (addedYears + 1);
                inputProgramDiv.insertBefore(realisasiInput, btnProgram); // Insert before the button
            }
        }

        addedYears++; // Increment addedYears
    } else {
        alert("Anda sudah menambah 2 tahun kedepan");
    }
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

    var newRow = document.createElement("tr");

    var programCell = document.createElement("td");
    programCell.textContent = alphabet[currentProgramIndex];

    var kegiatanCell = document.createElement("td");
    kegiatanCell.textContent = newKegiatan;

    var numCols = table.rows[2].cells.length + 2;
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
var totalAnggaran1 = 0;
var totalRealisasi1 = 0;
var totalAnggaran2 = 0;
var totalRealisasi2 = 0;

btnTambahProgram.addEventListener("click", function() {
    var programInput = document.getElementById("program");
    var anggaranInput = document.getElementById("anggaran");
    var realisasiInput = document.getElementById("realisasi");

    var newProgram = programInput.value;
    var newAnggaran = parseFloat(anggaranInput.value); // Convert to a floating-point number
    var newRealisasi = parseFloat(realisasiInput.value); // Convert to a floating-point number

    totalAnggaran += newAnggaran;
    totalRealisasi += newRealisasi;
    // console.log(totalAnggaran);
    // console.log(totalRealisasi);


    var jlhAnggaran = 0;
    var jlhRealisasi = 0;

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

    jlhAnggaran = newAnggaran;
    jlhRealisasi = newRealisasi;


    // var numCols = table.rows[0].cells.length;
    // var additionalTd = document.createElement("td");
    // additionalTd.textContent = "Data Tambahan";
    // additionalTd.setAttribute("colspan", numCols.toString());

    newRow.appendChild(programCell);
    newRow.appendChild(kegiatanCell);
    newRow.appendChild(anggaranCell);
    newRow.appendChild(realisasiCell);

    if (document.getElementById("anggaran1")) {
        var anggaranInput1 = document.getElementById("anggaran1");
        var newAnggaran1 = parseFloat(anggaranInput1.value); // Convert to a floating-point number

        jlhAnggaran = newAnggaran + newAnggaran1;

        anggaranInput1.value = "";
        totalAnggaran1 += newAnggaran1;
        var anggaranCell1 = document.createElement("td");
        anggaranCell1.textContent = newAnggaran1;
        newRow.appendChild(anggaranCell1);
    }

    if (document.getElementById("realisasi1")) {
        var realisasiInput1 = document.getElementById("realisasi1");
        var newRealisasi1 = parseFloat(realisasiInput1.value); // Convert to a floating-point number

        jlhRealisasi = newRealisasi + newRealisasi1;

        realisasiInput1.value = "";
        totalRealisasi1 += newRealisasi1;
        var realisasiCell1 = document.createElement("td");
        realisasiCell1.textContent = newRealisasi1;
        newRow.appendChild(realisasiCell1);
    }

    if (document.getElementById("anggaran2")) {
        var anggaranInput2 = document.getElementById("anggaran2");
        var newAnggaran2 = parseFloat(anggaranInput2.value); // Convert to a floating-point number

        jlhAnggaran = newAnggaran + newAnggaran1 + newAnggaran2;

        anggaranInput2.value = "";
        totalAnggaran2 += newAnggaran2;
        var anggaranCell2 = document.createElement("td");
        anggaranCell2.textContent = newAnggaran2;
        newRow.appendChild(anggaranCell2);
    }


    if (document.getElementById("realisasi2")) {
        var realisasiInput2 = document.getElementById("realisasi2");
        var newRealisasi2 = parseFloat(realisasiInput2.value); // Convert to a floating-point number

        jlhRealisasi = newRealisasi + newRealisasi1 + newRealisasi2;

        realisasiInput2.value = "";
        totalRealisasi2 += newRealisasi2;
        var realisasiCell2 = document.createElement("td");
        realisasiCell2.textContent = newRealisasi2;
        newRow.appendChild(realisasiCell2);
    }

    var jlhAnggaranCell = document.createElement("td");
    jlhAnggaranCell.textContent = jlhAnggaran;

    var jlhRealisasiCell = document.createElement("td");
    jlhRealisasiCell.textContent = jlhRealisasi;


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

    var totalAnggaranCell1 = document.createElement("td");
    totalAnggaranCell1.textContent = totalAnggaran1;

    var totalRealisasiCell1 = document.createElement("td");
    totalRealisasiCell1.textContent = totalRealisasi1;

    var totalAnggaranCell2 = document.createElement("td");
    totalAnggaranCell2.textContent = totalAnggaran2;

    var totalRealisasiCell2 = document.createElement("td");
    totalRealisasiCell2.textContent = totalRealisasi2;

    var jlhTotalAnggaranCell = document.createElement("td");
    jlhTotalAnggaranCell.textContent = totalAnggaran + totalAnggaran1 + totalAnggaran2;

    var jlhTotalRealisasiCell = document.createElement("td");
    jlhTotalRealisasiCell.textContent = totalRealisasi + totalRealisasi1 + totalRealisasi2;

    totalRow.appendChild(totalLabelCell);
    totalRow.appendChild(totalAnggaranCell);
    totalRow.appendChild(totalRealisasiCell);
    if (totalAnggaran1 != 0) {
        totalRow.appendChild(totalAnggaranCell1);
        totalRow.appendChild(totalRealisasiCell1);
    }

    if (totalAnggaran2 != 0){
        totalRow.appendChild(totalAnggaranCell2);
        totalRow.appendChild(totalRealisasiCell2);
    }
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
    $('#mitra').select2({
        width: '100%',
        templateResult: function(data) {
            if (data.id) {
                var mitraText = '<div class="mitra-text">' + data.text + '</div>';
                var jenisLokasiText = '<div class="jenis-lokasi"> Lokasi : ' + data.additional
                    .jenis_lokasi + '</div>';
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
function addNewRow() {
    // Get the table element
    const table = document.getElementById('tbl_ruanglingkup');

    // Get the number of existing rows in the table
    const numRows = table.rows.length;

    // Create a new row and add cells to it
    const newRow = table.insertRow(numRows);
    for (let i = 0; i < table.rows[3].cells.length; i++) {
        const newCell = newRow.insertCell();
        newCell.contentEditable = true; // Set the contenteditable attribute
        newCell.textContent = 'New'; // You can set an initial value for the new cell
    }
}

document.getElementById('btnTambahRow').addEventListener('click', function() {
    addNewRow();
});


document.getElementById("btnTambahRuangLingkup").addEventListener("click", function() {
    var ruangLingkupContainer = document.getElementById("ruangLingkupContainer");
    ruangLingkupContainer.style.display = "block";
});
</script>

<<?= $this->endSection() ?>