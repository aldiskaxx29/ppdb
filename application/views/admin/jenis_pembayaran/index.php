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
                          <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Data</a>
                          <hr>
                          <table class="table table-striped" id="myTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Jenis Pembayaran</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($jenis_pembayaran as $index => $item) : ?>
                                      <tr>
                                          <td><?= $index + 1 ?></td>
                                          <td><?= $item->jenis ?></td>
                                          <td>
                                              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus') ? window.location.href = '<?= site_url('admin/jenispembayaran/delete/' . $item->id) ?>' : ''"><i class="fas fa-trash"></i></button>
                                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editJenis<?= $item->id ?>"><i class="fas fa-edit"></i></button>
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
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pembayaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= base_url('Admin/jenispembayaran/add') ?>" method="post">
                          <div class="form-group">
                              <label>Nama Jenis Pembayaran</label>
                              <input type="text" class="form-control" name="jenis">
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

      <?php foreach ($jenis_pembayaran as $index => $item) : ?>
          <div class="modal fade" id="editJenis<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form action="<?= base_url('Admin/jenispembayaran/update') ?>" method="post">
                              <input type="hidden" name="id" value="<?= $item->id ?>">
                              <div class="form-group">
                                  <label>Nama Jenis Pembayaran</label>
                                  <input type="text" class="form-control" name="jenis" value="<?= $item->jenis ?>">
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
      <?php endforeach ?>