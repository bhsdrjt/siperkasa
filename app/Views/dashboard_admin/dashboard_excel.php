<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Penguatan Fungsi dan Pembangunan Strategis.xls");
?>

<h4>Data Penguatan Fungsi dan Pembangunan Strategis</h4>
<?php if (isset($startDate) && isset($endDate)) {
    echo "<h5>" . $startDate . " / " . $endDate . "</h5>";
} ?>

<table border="1">
    <thead>
        <th>No</th>
        <th>Jenis</th>
        <th>Mitra</th>
        <th>Judul</th>
        <th>Ruang Lingkup Kerja Sama</th>
        <th>No Surat Persetujuan</th>
        <th>Tanggal</th>
        <th>Periode</th>
        <th>Lokasi</th>
    </thead>
    <tbody>
        <?php if (isset($penguatan_fungsi)) {
            $no = 1;
            foreach ($penguatan_fungsi as $data) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>Penguatan Fungsi</td>
                    <td><?= isset($data->nama_mitra) ? $data->nama_mitra : '' ?></td>
                    <td><?= $data->judul ?></td>
                    <td><?= $data->ruang_lingkup ?></td>
                    <td><?= $data->no_pks ?></td>
                    <td><?= $data->tgl_awal . " / " . $data->tgl_akhir ?></td>
                    <td><?php
                        $date1 = new DateTime($data->tgl_awal);
                        $date2 = new DateTime($data->tgl_akhir);
                        $interval = $date1->diff($date2);
                        echo $interval->y . " tahun"
                        ?></td>
                    <td><?= $data->lokasi ?></td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>