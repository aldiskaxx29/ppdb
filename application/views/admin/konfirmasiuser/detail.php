<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">konfirmasi</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <a href="<?= site_url('admin/konfirmasiuser') ?>" class="btn btn-primary mb-3">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Nama</th>
                                <th>: <?php echo $user->nama ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NIS</td>
                                <td>: <?php echo $user->nis ? $user->nis : '-' ?></td>
                            </tr>
                            <tr>
                                <td>NISN</td>
                                <td>: <?php echo $user->nisn ? $user->nisn : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: <?php echo $user->jenis_kelamin ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>: <?php echo $user->tempat_lahir ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <?php echo $user->tanggal_lahir ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: <?php echo $user->agama ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?php echo $user->alamat ?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>: <?php echo $user->no_telpon ?></td>
                            </tr>
                            <tr>
                                <td>Ijazah</td>
                                <?php if ($user->upload_ijazah) : ?>
                                    <td>: <img src="<?= base_url('assets/img/ijazah/' . $user->upload_ijazah) ?>" alt="Foto Ijazah" width="250px"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td>SKHUN</td>
                                <?php if ($user->upload_skhun) : ?>
                                    <td>: <img src="<?= base_url('assets/img/skhun/' . $user->upload_skhun) ?>" alt="Foto skhun" width="250px"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>