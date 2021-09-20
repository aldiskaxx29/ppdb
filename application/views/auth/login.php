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
              <h4 class="text-success">Login Siswa</h4>
            </div>

            <div class="card-body">
              <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('error') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
              <?php endif ?>
              <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('success') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
              <?php endif ?>
              <form method="POST" action="" class="needs-validation">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus autocomplete="off" placeholder="Masukan Email Anda">
                  <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" autocomplete="off">
                  <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                    Login
                  </button>
                </div>
              </form>
              <div class="text-center ">
                <?php if ($checkPendaftaran == true) : ?>
                  <h5 class=""><a href="<?= base_url('pendaftaran/dashboard') ?>" class="text-success">Daftar Siswa Baru</a></h5>
                <?php endif ?>
                <h5 class=""><a href="<?= base_url('auth/show_reset') ?>" class="text-success">Reset Password</a></h5>
              </div>
              <div class="row sm-gutters">

              </div>

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