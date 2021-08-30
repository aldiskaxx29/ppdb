<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?= base_url('assets') ?>/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="text-success">Reset Password</h4>
                        </div>

                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                            <?php endif ?>
                            <form method="POST" action="<?= site_url('auth/checkReset') ?>" class="needs-validation">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                                        Submit
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php if ($this->session->flashdata('kode_siswa')) : ?>
    <div id="modalKode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="mb-3">Pendaftaran anda berhasil silahkan tunggu untuk activasi oleh admin</h5>
                    <h4 class="text-danger"><?= $this->session->flashdata('kode_siswa') ?></h4>
                    <p>Silahkan Catat atau Screenshoot kode diatas (kode diatas di gunakan untuk melakukan setiap pembayaran)</p>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>