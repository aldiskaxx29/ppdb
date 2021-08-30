      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('Admin/Konfirmasiuser') ?>">Konfirmasi User</a></div>
                      <div class="breadcrumb-item"><?= $title ?></div>
                  </div>
              </div>

              <div class="section-body">
                  <div class="card">
                      <div class="card-body">
                          <form action="<?= base_url('Admin/KonfirmasiUser/add') ?>" method="post">
                              <input type="hidden" name="pendaftaran_id" value="<?= $pendaftaran_id ?>">
                              <input type="hidden" name="role_id" value="2">
                              <div class="form-group">
                                  <label>Jurusan</label>
                                  <select class="form-control" name="jurusan_id">
                                      <option value="">-- Pilih Jurusan --</option>
                                      <?php foreach ($jurusan as $item) : ?>
                                          <option value="<?= $item->id ?>"><?= $item->nama_juurusan ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Kelas</label>
                                  <select class="form-control" name="kelas_id">
                                      <option value="">-- Pilih Kelas --</option>
                                      <?php foreach ($kelas as $item) : ?>
                                          <option value="<?= $item->id ?>"><?= $item->nama_kelas ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Kelas</label>
                                  <select class="form-control" name="kelas_id">
                                      <option value="">-- Pilih Kelas --</option>
                                      <?php foreach ($kelas as $item) : ?>
                                          <option value="<?= $item->id ?>"><?= $item->nama_kelas ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Nama</label>
                                  <select class="form-control" name="kelas_id">
                                      <input type="text" class="form-control" name="nama">
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <select class="form-control" name="kelas_id">
                                      <input type="email" class="form-control" name="email">
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <select class="form-control" name="kelas_id">
                                      <input type="password" class="form-control" name="password">
                                  </select>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </section>
      </div>