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
                        <div class="col-9">
                            <?php if ($tahun == 0) : ?>
                                <a href="<?= site_url('kepsek/laporanpendaftaran/cetakPdf') ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i> Cetak Data Sekarang</a>
                            <?php else : ?>
                                <a href="<?= site_url('kepsek/laporanpendaftaran/cetakPdf/' . $tahun) ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i> Cetak Data Sekarang</a>
                            <?php endif ?>
                        </div>
                        <div class="col-3">
                            <form method="get" action="" id="formFilterTahun">
                                <div class="form-group">
                                    <select id="tahun" class="form-control" name="tahun">
                                        <option value="">Filter Tahun</option>
                                        <?php for ($i = 2018; $i <= intval(date('Y')); $i++) : ?>
                                            <option value="<?= $i ?>" <?php echo ($i == $tahun ? 'selected' : '') ?>><?= $i ?></option>
                                        <?php endfor ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Di Terima</th>
                                <th>Waktu Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laporan as $index => $item) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $item->nisn ?></td>
                                    <td><?= $item->nama ?></td>
                                    <td><?= $item->jenis_kelamin ?></td>
                                    <td>
                                        <?php if ($item->status == 0) : ?>
                                            <span class="badge badge-danger">Belum</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Sudah</span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $item->created ?></td>
                                    <td>
                                        <a href="<?= site_url('kepsek/laporanpendaftaran/detail/' . $item->id) ?>" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>