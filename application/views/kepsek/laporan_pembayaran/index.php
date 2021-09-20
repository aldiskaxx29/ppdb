<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('kepsek/dashboard') ?>">Dashboard</a></div>
                <!-- <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div> -->
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-6">
                            <form action="<?= site_url('kepsek/laporanpembayaran/cetakPdf') ?>" method="post">
                                <input type="hidden" name="kelas_id" value="<?= $params['kelas_id'] ?>">
                                <input type="hidden" name="bulan" value="<?= $params['bulan'] ?>">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i> Cetak Data Sekarang</button>
                            </form>
                        </div>
                    </div>
                    <form method="get" action="" id="formFilter">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select id="kelas_id" class="form-control" name="kelas_id">
                                        <option value="">Kelas</option>
                                        <?php foreach ($kelas as $item) : ?>
                                            <option value="<?= $item->id ?>" <?php echo ($item->id == $params['kelas_id'] ? 'selected' : '') ?>><?= $item->grade ?> <?= $item->nama_kelas ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select id="bulan" class="form-control" name="bulan">
                                        <option value="">Bulan</option>
                                        <option value="01" <?php echo ($params['bulan'] == '01' ? 'selected' : '') ?>>Januari</option>
                                        <option value="02" <?php echo ($params['bulan'] == '02' ? 'selected' : '') ?>>Februari</option>
                                        <option value="03" <?php echo ($params['bulan'] == '03' ? 'selected' : '') ?>>Maret</option>
                                        <option value="04" <?php echo ($params['bulan'] == '04' ? 'selected' : '') ?>>April</option>
                                        <option value="05" <?php echo ($params['bulan'] == '05' ? 'selected' : '') ?>>Mei</option>
                                        <option value="06" <?php echo ($params['bulan'] == '06' ? 'selected' : '') ?>>Juni</option>
                                        <option value="07" <?php echo ($params['bulan'] == '07' ? 'selected' : '') ?>>Juli</option>
                                        <option value="08" <?php echo ($params['bulan'] == '08' ? 'selected' : '') ?>>Agustus</option>
                                        <option value="09" <?php echo ($params['bulan'] == '09' ? 'selected' : '') ?>>September</option>
                                        <option value="10" <?php echo ($params['bulan'] == '10' ? 'selected' : '') ?>>Oktober</option>
                                        <option value="11" <?php echo ($params['bulan'] == '11' ? 'selected' : '') ?>>November</option>
                                        <option value="12" <?php echo ($params['bulan'] == '12' ? 'selected' : '') ?>>Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-3">
                            <strong>Total Pembayaran</strong>
                        </div>
                        <div class="col-9">
                            : Rp. <?= number_format($total, 0, ',', '.') ?>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Pembayaran</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status Bayar</th>
                                <th>Waktu Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laporan as $index => $item) : ?>
                                <?php $kelas = $this->kelas->edit($item->kelas_id) ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $item->nama ?></td>
                                    <td><?= $kelas->grade ?> <?= $kelas->nama_kelas ?></td>
                                    <td><?= $item->jenis ?></td>
                                    <td>Rp. <?= number_format($item->jumlah, 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($item->konfirm == 0) : ?>
                                            <span class="badge badge-danger">Belum</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Sudah</span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $item->created_at ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>