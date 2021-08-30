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
                          <form action="<?= site_url('admin/config/update') ?>" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label>Nama Sekolah</label>
                                  <input type="text" class="form-control" name="nama_sekolah" value="<?= $config->nama_sekolah ?>">
                              </div>
                              <div class="form-group">
                                  <label>Logo Sekolah</label>
                                  <input type="file" class="form-control" name="logo_sekolah">
								  <img src="<?= base_url('assets/img/config/'.$config->logo_sekolah) ?>" width="150px" class="mt-2">	
                              </div>
                              <div class="form-group">
                                  <label>Buka Pendaftaran</label>
                                  <input type="date" class="form-control" name="buka_pendaftaran" value="<?= $config->buka_pendaftaran ?>">
                              </div>
                              <div class="form-group">
                                  <label>Tutup Pendaftaran</label>
                                  <input type="date" class="form-control" name="tutup_pendaftaran" value="<?= $config->tutup_pendaftaran ?>">
                              </div>
                              <div class="form-group">
                                  <label>Tahun Ajaran</label>
                                  <input type="text" class="form-control" name="tahun_ajaran" value="<?= $config->tahun_ajaran ?>">
                              </div>
                              <div class="form-group float-right">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </section>
      </div>