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
                          <a href="<?= site_url('admin/siswa/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Data</a>
                          <a href="<?= site_url('admin/siswa/naikanKelas') ?>" class="btn btn-success btn-sm"><i class="fas fa-user-tie"></i> Naikan Kelas Seluruh Siswa</a>
                          <hr>
                          <table class="table table-striped" id="myTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Email</th>
                                      <th>Tanggal Di Terima</th>
                                      <th>Kode Pembayaran</th>
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
                                          <td><?= $item->kode_siswa ?></td>
                                          <td>
                                              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus') ? window.location.href = '<?= site_url('admin/siswa/delete/' . $item->id) ?>' : ''"><i class="fas fa-trash"></i></button>
                                              <a href="<?= site_url('admin/siswa/edit/' . $item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                              <a href="<?= site_url('admin/siswa/uploadBerkas/' . $item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-file"></i></a>
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