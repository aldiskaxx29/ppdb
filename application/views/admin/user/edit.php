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
                          <form action="<?= site_url('Admin/user/update') ?>" method="post">
                              <input type="hidden" name="id" value="<?= $user->id ?>">
                              <div class="form-group">
                                  <label>Nama User</label>
                                  <input type="text" class="form-control" name="nama" value="<?= $user->nama ?>">
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" class="form-control" name="email" value="<?= $user->email ?>">
                                  <small class="text-info">Isikan Email Baru jika ingin mengganti</small>
                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="text" class="form-control" name="password">
                                  <small class="text-info">Isikan Password Baru jika ingin mengganti</small>
                              </div>
                              <?php if ($user->role_id == 2) : ?>
                                  <div class="form-group">
                                      <select class="form-control" name="kelas_id">
                                          <option value="">-- Plihan Kelas --</option>
                                          <?php foreach ($kelas as $item) : ?>
                                              <option value="<?= $item->id ?>"><?= $item->nama_kelas ?></option>
                                          <?php endforeach ?>
                                      </select>
                                      <small>Jika Ada</small>
                                  </div>
                                  <div class="form-group">
                                      <select class="form-control" name="jurusan_id">
                                          <option value="">-- Plihan Jurusan --</option>
                                          <?php foreach ($jurusan as $item) : ?>
                                              <option value="<?= $item->id ?>"><?= $item->nama_jurusan ?></option>
                                          <?php endforeach ?>
                                      </select>
                                      <small>Jika Ada</small>
                                  </div>
                              <?php endif ?>
                              <?php if ($user->role_id != 2) : ?>
                                  <div class="form-group">
                                      <select class="form-control" name="role_id">
                                          <option value="">-- Plihan Type User --</option>
                                          <option value="1" <?php echo ($user->status == 1 ? 'selected' : '')  ?>>Admin</option>
                                          <option value="3" <?php echo ($user->status == 3 ? 'selected' : '')  ?>>Kepala Sekolah</option>
                                      </select>
                                  </div>
                              <?php endif ?>
                              <div class="form-group">
                                  <select class="form-control" name="status">
                                      <option value="">-- Plihan Status --</option>
                                      <option value="1" <?php echo ($user->status == 1 ? 'selected' : '')  ?>>Active</option>
                                      <option value="0" <?php echo ($user->status == 0 ? 'selected' : '')  ?>>No</option>
                                  </select>
                              </div>
                              <div class="form-group float-right">
                                  <a href="<?= site_url('admin/user') ?>" class="btn btn-secondary">Kembali</a>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </section>
      </div>