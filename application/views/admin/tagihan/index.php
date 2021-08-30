      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1><?= $title ?></h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="<?= base_url('Admin/Dashboard') ?>">Dashboard</a></div>
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
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Data</button>
                          <hr>
                          <table class="table table-striped" id="myTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Jenis Tagihan</th>
                                      <th>Grade</th>
                                      <th>Tahun Ajaran</th>
                                      <th>Jumlah</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($tagihan as $index => $item) : ?>
                                      <tr>
                                          <td><?= $index + 1 ?></td>
                                          <td><?= $item->jenis ?></td>
                                          <td><?= $item->grade_tagihan ?></td>
                                          <td><?= $item->tahun_ajaran ?></td>
                                          <td>Rp. <?= number_format($item->jumlah_tagihan, 0, ',', '.') ?></td>
                                          <td>
                                              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus') ? window.location.href = '<?= site_url('admin/tagihan/delete/' . $item->id) ?>' : ''"><i class="fas fa-trash"></i></button>
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
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="<?= site_url('admin/tagihan/add') ?>" method="post">
                          <div class="form-group">
                              <label for="jenis_pembayaran_id">Pilih Jenis Tagihan</label>
                              <select id="jenis_pembayaran_id" class="form-control" name="jenis_pembayaran_id">
                                  <?php foreach ($jenis as $item) : ?>
                                      <option value="<?= $item->id ?>"><?php echo $item->jenis ?></option>
                                  <?php endforeach ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="grade_tagihan">Pilih Grade</label>
                              <select id="grade_tagihan" class="form-control" name="grade_tagihan">
                                  <option value="X">X</option>
                                  <option value="XI">XI</option>
                                  <option value="XII">XII</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Jumlah Tagihan</label>
                              <input type="number" class="form-control" name="jumlah_tagihan">
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