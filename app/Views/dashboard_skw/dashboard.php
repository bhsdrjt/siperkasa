<?= $this->extend('layout'); ?>
<?= $this->section('content') ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <!-- Primary table start -->
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-7">
                                <h4>Dashboard Pelaksana <?= session('level') ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?= form_open('dashboard/skw') ?>
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 my-1">
                                <input type="date" class="form-control" name="startDate" value="<?= isset($startDate) ? $startDate : '' ?>">
                            </div>
                            <div class="col-1 text-center">
                                <!-- <hr style="border: 1px solid black;"> -->
                                Sampai
                            </div>
                            <div class="col-2 my-1">
                                <input type="date" class="form-control" name="endDate" value="<?= isset($endDate) ? $endDate : '' ?>">
                            </div>
                            <div class="col-auto my-1">
                                <button type="submit" name="filter" value="cari" class="btn btn-primary">Cari</button>
                                <!-- <button type="submit" name="filter" value="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</button> -->
                            </div>
                        </div>
                        <?= form_close() ?>


                        <div class="datatable-default">
                            <table id="table-dashboard" class="text-center table-striped" style="width: 100%;">
                                <thead class="text-capitalize bg-secondary">
                                    <tr class="text-white">
                                        <th>No</th>
                                        <th>Nama RKT</th>
                                        <th>Komitmen RKT</th>
                                        <th>Realisasi RKT</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($penguatanFungsi)) {
                                        $no = 1;
                                        foreach ($penguatanFungsi as $data) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->nama_rkt ?></td>
                                                <td><?= $data->komitmen_rkt ?></td>
                                                <td><?= $data->realisasi_rkt ?></td>
                                                <td><?= $data->tgl_awal . " / " . $data->tgl_akhir ?></td>
                                                <td>Penguatan Fungsi</td>
                                                <td><?= $data->lokasi ?></td>
                                            </tr>
                                    <?php }
                                    } ?>

                                    <?php if (isset($pembangunanStrategis)) {
                                        $no2 = $no;
                                        foreach ($pembangunanStrategis as $data2) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data2->nama_rkt ?></td>
                                                <td><?= $data2->komitmen_rkt ?></td>
                                                <td><?= $data2->realisasi_rkt ?></td>
                                                <td><?= $data2->tgl_awal . " / " . $data2->tgl_akhir ?></td>
                                                <td>Pembangunan Strategis</td>
                                                <td><?= $data2->lokasi ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Primary table end -->
        </div>
    </div>
</div>
<!-- main content area end -->

<?= $this->include('footer') ?>

<script>
    $(document).ready(function() {
        $('#table-dashboard').DataTable({
            'scrollX': true,
        });
    });
</script>
<?= $this->endSection() ?>