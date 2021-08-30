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
                          <hr>
                          <table class="table table-striped" id="myTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Email</th>
                                      <th>Tanggal Di Terima</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($user as $index => $item) : ?>
                                      <tr>
                                          <td><?= $index + 1 ?></td>
                                          <td><?= $item->nama ?></td>
                                          <td><?= $item->email ?></td>
                                          <td><?= $item->tanggal_diterima ?></td>
                                          <td>
                                              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus') ? window.location.href = '<?= site_url('admin/user/delete/' . $item->id) ?>' : ''"><i class="fas fa-trash"></i></button>
                                              <a href="<?= site_url('admin/user/edit/' . $item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                              <a href="<?= site_url('admin/user/detail/' . $item->id . '?redirect=siswa') ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                          </td>
                                      </tr>
                                  <?php endforeach ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </section>
      </div>

      <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('Admin/user/add') ?>" method="post">
                          <div class="form-group">
                              <label>Nama User</label>
                              <input type="text" class="form-control" name="nama">
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email">
                          </div>
                          <div class="form-group">
                              <label>Password</label>
                              <input type="text" class="form-control" name="password">
                          </div>
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
                          <div class="form-group">
                              <select class="form-control" name="status">
                                  <option value="">-- Plihan Status --</option>
                                  <option value="1">Active</option>
                                  <option value="0">No</option>
                              </select>
                          </div>
                          <div class="form-group float-right">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>