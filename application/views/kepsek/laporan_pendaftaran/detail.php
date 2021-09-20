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
                    <a href="<?= site_url('kepsek/laporanpendaftaran') ?>" class="btn btn-primary mb-3">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <h5><strong>Data Siswa</strong></h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Nama</th>
                                <th>: <?php echo $user->nama ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NISN</td>
                                <td>: <?php echo $user->nisn ? $user->nisn : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Di Terima</td>
                                <td>: <?php echo $user->tanggal_diterima ? $user->tanggal_diterima : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Masuk</td>
                                <td>: <?php echo $user->tahun_masuk ? $user->tahun_masuk : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Keluar</td>
                                <td>: <?php echo $user->tahun_keluar ? $user->tahun_keluar : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: <?php echo $user->jenis_kelamin ? $user->jenis_kelamin : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>: <?php echo $user->tempat_lahir ? $user->tempat_lahir : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <?php echo $user->tanggal_lahir ? $user->tanggal_lahir : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: <?php echo $user->agama ? $user->agama : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?php echo $user->alamat ? $user->alamat : '-' ?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>: <?php echo $user->no_telpon ? $user->no_telpon : '-' ?></td>
                            </tr>
                            <tr>
                                <td>Ijazah</td>
                                <?php if ($user->upload_ijazah) : ?>
                                    <td>: <img src="<?= base_url('assets/img/ijazah/' . $user->upload_ijazah) ?>" alt="Foto Ijazah" width="200px" class="my-2"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td>SKHUN</td>
                                <?php if ($user->upload_skhun) : ?>
                                    <td>: <img src="<?= base_url('assets/img/skhun/' . $user->upload_skhun) ?>" alt="Foto skhun" width="200px" class="my-2"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td>Kartu Keluarga</td>
                                <?php if ($user->upload_kk) : ?>
                                    <td>: <img src="<?= base_url('assets/img/kk/' . $user->upload_kk) ?>" alt="Foto skhun" width="200px" class="my-2"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <td>Akte Kelahiran</td>
                                <?php if ($user->upload_akte) : ?>
                                    <td>: <img src="<?= base_url('assets/img/akte/' . $user->upload_akte) ?>" alt="Foto skhun" width="200px" class="my-2"></td>
                                <?php else : ?>
                                    <td>: -</td>
                                <?php endif ?>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($user->orang_tua_id != 0) : ?>
                        <h5 class="mt-5 mb-3"><strong>Data Orang Tua/Wali</strong></h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="25%">Nama Orang tua/Wali</th>
                                    <th>: <?php echo $user->nama_ortu ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: <?php echo $user->pendidikan ? $user->pendidikan : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: <?php echo $user->pekerjaan ? $user->pekerjaan : '-' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
</div>