      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Admin/Dashboard') ?>">Dashboard</a></div>
              <!-- <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div> -->
              <div class="breadcrumb-item"><?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <?php if ($check == false) : ?>
                  <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?= $this->session->flashdata('success') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                  <?php endif ?>
                  <?php if ($user->status == 0) : ?>
                    <div class="alert alert-success" role="alert">
                      <h4 class="alert-heading">Tunggu Konfirmasi Admin</h4>
                      <p>Silahkan Tunggu Konfirmasi Dari Admin</p>
                    </div>
                  <?php else : ?>
                    <div class="alert alert-success text-center" role="alert">
                      <h4 class="alert-heading">Selamat Anda Lulus Dan Sudah Di Terima Di Sekolah Kami</h4>
                    </div>
                  <?php endif ?>
                <?php else : ?>
                  <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Silahkan Lengkapi Biodata Pendaftaran Anda Terlebih Dahulu</h4>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </section>
      </div>