      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></div>
              <!-- <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div> -->
              <div class="breadcrumb-item"><?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <!-- <div class="row"> -->
            <div class="card">
              <div class="card-body" style="overflow-x:auto;">
                <?php if ($this->session->flashdata('success')) : ?>
                  <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                <?php endif ?>
                <hr>
                <table class="table" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Jurusan</th>
                      <th>Konfirmasi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($c_siswa as $no => $cs) : ?>
                      <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $cs->nama ?></td>
                        <td><?= $cs->email ?></td>
                        <td><?= $cs->nama_jurusan ?></td>
                        <td>
                          <small style="cursor: pointer;" class="badge badge-warning" data-toggle="modal" data-target="#modalKonfirmasi-<?= $cs->id ?>">Confirm</small>
                        </td>

                        <td>
                          <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <a href="<?= site_url('admin/konfirmasipendaftaran/detail/' . $cs->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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

      <?php foreach ($c_siswa as $item) : ?>
        <div class="modal fade" id="modalKonfirmasi-<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= site_url('admin/konfirmasipendaftaran/active_user/') ?>" method="post">
                  <input type="hidden" name="user_id" value="<?= $item->id ?>">
                  <div class="form-group">
                    <label for="kelas_id">Pilih Kelas Untuk Siswa Baru</label>
                    <select id="kelas_id" class="form-control" name="kelas_id">
                      <?php foreach ($kelas as $value) : ?>
                        <option value="<?= $value->id ?>"><?= $value->grade ?> <?= $value->nama_kelas ?></option>
                      <?php endforeach ?>
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
      <?php endforeach ?>