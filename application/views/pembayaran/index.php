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
                <?php if (isset($error)) : ?>
                  <div class="alert alert-success"><?= $error ?></div>
                <?php endif ?>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalPembayaran">Tambah Pembayaran</button>
                <hr>
                <table class="table text-center" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Jenis Pembayaran</th>
                      <th>Foto</th>
                      <th>Konfirm</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pembayaran as $no => $item) : ?>
                      <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $item->nama ?></td>
                        <td><?= $item->jenis ?></td>
                        <td class="foto-bukti text-center" style="cursor: pointer;"><img src="<?= base_url('assets/img/bukti_pendaftaran/' . $item->foto_bukti) ?>" alt="Foto Bukti" width="150px"></td>
                        <td>
                          <?php if ($item->konfirm == 0) : ?>
                            <strong class="badge badge-warning">Belum Di Konfirmasi</strong>
                          <?php else : ?>
                            <strong class="badge badge-success">Sudah Di Konfirmasi</strong>
                          <?php endif ?>
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

      <div id="modalPembayaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalPembayaran-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="modalPembayaran-title">Tambah Pembayaran</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="kode_siswa">Kode Pembayaran Siswa</label>
                  <input id="kode_siswa" class="form-control" type="text" name="kode_siswa">
                </div>
                <div class="form-group">
                  <label for="jenis_pembayaran_id">Jenis Pembayaran</label>
                  <select id="jenis_pembayaran_id" class="form-control" name="jenis_pembayaran_id">
                    <?php foreach ($jenis_pembayaran as $item) : ?>
                      <?php if ($item->id != 1) : ?>
                        <option value="<?= $item->id ?>"><?= $item->jenis ?></option>
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="foto_bukti">Foto Bukti</label>
                  <input id="foto_bukti" class="form-control" type="file" name="foto_bukti">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sumbit</button>
              </div>
            </form>
          </div>
        </div>
      </div>