      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                      <div class="breadcrumb-item"><?= $title ?></div>
                  </div>
              </div>

              <div class="section-body">
                  <!-- <div class="row"> -->
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
                          <h4 class="text-center mb-5">Edit Data Siswa</h4>
                          <form method="post" action="<?= site_url('admin/siswa/update') ?>">
                              <input type="hidden" name="user_id" value="<?= $id ?>">
                              <div class="form-group row">
                                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="email" name="email" class="form-control" required value="<?= $user->email ?>">
                                  </div>
                                  <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                              </div>
                              <div class="form-group row">
                                  <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nisn" name="nisn" required value="<?= $user->nisn ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                                  <div class="col-sm-10">
                                      <select name="jurusan_id" id="jurusan_id" class="form-control">
                                          <?php foreach ($jurusan as $item) : ?>
                                              <option value="<?= $item->id ?>" <?php echo ($item->id == $user->jurusan_id ? 'selected' : '') ?>><?= $item->nama_jurusan ?></option>
                                          <?php endforeach ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="kelas_id" class="col-sm-2 col-form-label">Kelas</label>
                                  <div class="col-sm-10">
                                      <select name="kelas_id" id="kelas_id" class="form-control">
                                          <?php foreach ($kelas as $val) : ?>
                                              <option value="<?= $val->id ?>" <?php echo ($val->id == $user->kelas_id ? 'selected' : '') ?>><?= $val->grade ?> <?= $val->nama_kelas ?></option>
                                          <?php endforeach ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                  <div class="col-sm-10">
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="jk" id="jk1" value="Laki-Laki" <?php echo ($user->jenis_kelamin == 'Laki-Laki' ? 'checked' : '') ?>>
                                          <label class="form-check-label" for="jk1">
                                              Laki - laki
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="jk" id="jk2" value="Perempuan" <?php echo ($user->jenis_kelamin == 'Perempuan' ? 'checked' : '') ?>>
                                          <label class="form-check-label" for="jk2">
                                              Perempuan
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="<?= $user->tempat_lahir ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                  <div class="col-sm-10">
                                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="<?= $user->tanggal_lahir ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="agama" name="agama" required value="<?= $user->agama ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $user->alamat ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="no_telpon" class="col-sm-2 col-form-label">No Telepon</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="no_telpon" name="no_telpon" required value="<?= $user->no_telpon ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="nama_ortu" class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" required value="<?= $user->nama_ortu ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan Orang Tua</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="pendidikan" name="pendidikan" required value="<?= $user->pendidikan ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan Orang Tua</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required value="<?= $user->pekerjaan ?>">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12 text-right mb-5">
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </section>
      </div>