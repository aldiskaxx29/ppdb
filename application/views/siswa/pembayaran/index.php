<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= site_url('siswa/dashboard') ?>">Dashboard</a></div>
                <!-- <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div> -->
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <!-- <div class="row"> -->
            <div class="card">
                <div class="card-body" style="overflow-x:auto;">
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                    <?php endif ?>
                    <a href="<?= site_url('siswa/pembayaran/cetakPdf') ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Pembayaran</a>
                    <hr>
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Tagihan</th>
                                <th>Jumlah Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tagihan as $no => $item) : ?>
                                <?php $tagihanCheck = $this->pembayaran->checkBayar($user->id, $item->id) ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $item->jenis ?></td>
                                    <td><?= $item->jumlah_tagihan ?></td>
                                    <td>
                                        <?php if ($tagihanCheck) : ?>
                                            <?php if ($tagihanCheck->konfirm == 0) : ?>
                                                <small class="badge badge-warning">Menunggung Konfirmasi</small>
                                            <?php else : ?>
                                                <small class="badge badge-success">Sudah</small>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <small class="badge badge-danger">Belum</small>
                                        <?php endif ?>
                                    </td>

                                    <td>
                                        <?php if ($tagihanCheck) : ?>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBayar-<?= $item->id ?>" disabled><i class="fas fa-dollar-sign"></i> Bayar</button>
                                        <?php else : ?>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBayar-<?= $item->id ?>"><i class="fas fa-dollar-sign"></i> Bayar</button>
                                        <?php endif ?>
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

<?php foreach ($tagihan as $item) : ?>
    <div class="modal fade" id="modalBayar-<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <input type="hidden" name="tagihan_id" value="<?= $item->id ?>">
                        <input type="hidden" name="jenis_pembayaran_id" value="<?= $item->jenis_id ?>">
                        <div class="form-group">
                            <label for="jenis">Jenis Tagihan</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $item->jenis ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $item->jumlah_tagihan ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="foto_bukti">Upload Foto Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="foto_bukti" name="foto_bukti">
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>