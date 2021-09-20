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
                  <!-- <div class="row"> -->
                  <div class="card">
                      <div class="card-body">
                          <a href="<?= site_url('admin/siswa') ?>" class="btn btn-primary mb-3">
                              <i class="fa fa-arrow-left"></i> Kembali
                          </a>
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
                          <h4 class="text-center mb-5">Upload Berkas Untuk </h4>
                          <form action="<?= site_url('admin/siswa/uploadIjazah') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                              <div class="form-group row">
                                  <label for="upload_ijazah" class="col-sm-2 col-form-label">Upload Izajah</label>
                                  <div class="col-sm-7">
                                      <input type="file" class="form-control" id="upload_ijazah" name="upload_ijazah" required>
                                      <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                                  </div>
                                  <div class="col-sm-3 text-right">
                                      <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                  <?php if (!empty($user->upload_ijazah)) : ?>
                                      <div class="col-sm-12 my-3">
                                          <img src="<?= base_url('assets/img/ijazah/' . $user->upload_ijazah) ?>" alt="Foto Ijazah" width="200px">
                                      </div>
                                  <?php endif ?>
                              </div>
                          </form>
                          <form action="<?= site_url('admin/siswa/uploadSkhun') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                              <div class="form-group row">
                                  <label for="upload_skhun" class="col-sm-2 col-form-label">Upload SKHUN</label>
                                  <div class="col-sm-7">
                                      <input type="file" class="form-control" id="upload_skhun" name="upload_skhun" required>
                                      <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                                  </div>
                                  <div class="col-sm-3 text-right">
                                      <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                  <?php if (!empty($user->upload_skhun)) : ?>
                                      <div class="col-sm-12 my-3">
                                          <img src="<?= base_url('assets/img/skhun/' . $user->upload_skhun) ?>" alt="Foto Ijazah" width="200px">
                                      </div>
                                  <?php endif ?>
                              </div>
                          </form>
                          <form action="<?= site_url('admin/siswa/uploadKK') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                              <div class="form-group row">
                                  <label for="upload_kk" class="col-sm-2 col-form-label">Upload Kartu Keluarga</label>
                                  <div class="col-sm-7">
                                      <input type="file" class="form-control" id="upload_kk" name="upload_kk" required>
                                      <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                                  </div>
                                  <div class="col-sm-3 text-right">
                                      <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                  <?php if (!empty($user->upload_kk)) : ?>
                                      <div class="col-sm-12 my-3">
                                          <img src="<?= base_url('assets/img/kk/' . $user->upload_kk) ?>" alt="Foto Ijazah" width="200px">
                                      </div>
                                  <?php endif ?>
                              </div>
                          </form>
                          <form action="<?= site_url('admin/siswa/uploadAkte') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                              <div class="form-group row">
                                  <label for="upload_akte" class="col-sm-2 col-form-label">Upload Akte Kelahiran</label>
                                  <div class="col-sm-7">
                                      <input type="file" class="form-control" id="upload_akte" name="upload_akte" required>
                                      <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                                  </div>
                                  <div class="col-sm-3 text-right">
                                      <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                  <?php if (!empty($user->upload_akte)) : ?>
                                      <div class="col-sm-12 my-3">
                                          <img src="<?= base_url('assets/img/akte/' . $user->upload_akte) ?>" alt="Foto Ijazah" width="200px">
                                      </div>
                                  <?php endif ?>
                              </div>
                          </form>
                          <form action="<?= site_url('admin/siswa/uploadKTP') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                              <div class="form-group row">
                                  <label for="upload_ktp_ortu" class="col-sm-2 col-form-label">Upload KTP Orang Tua</label>
                                  <div class="col-sm-7">
                                      <input type="file" class="form-control" id="upload_ktp_ortu" name="upload_ktp_ortu" required>
                                      <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                                  </div>
                                  <div class="col-sm-3 text-right">
                                      <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                  <?php if (!empty($user->upload_ktp_ortu)) : ?>
                                      <div class="col-sm-12 my-3">
                                          <img src="<?= base_url('assets/img/ktp_ortu/' . $user->upload_ktp_ortu) ?>" alt="Foto Ijazah" width="200px">
                                      </div>
                                  <?php endif ?>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </section>
      </div>