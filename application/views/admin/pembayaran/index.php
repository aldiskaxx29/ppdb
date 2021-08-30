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
                <table class="table text-center" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Jenis Pembayaran</th>
                      <th>Jumlah Bayar</th>
                      <th>Foto</th>
                      <th>Konfirm</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pembayaran as $no => $item) : ?>
                      <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $item->nama ?></td>
                        <td>Rp. <?= number_format($item->jumlah, 0, ',', '.') ?></td>
                        <td><?= $item->jenis ?></td>
                        <td class="foto-bukti text-center" style="cursor: pointer;"><img src="<?= base_url('assets/img/bukti_pendaftaran/' . $item->foto_bukti) ?>" alt="Foto Bukti" width="100px"></td>
                        <td>
                          <?php if ($item->konfirm == 0) : ?>
                            <small style="cursor: pointer;" class="badge badge-warning" onclick="return confirm('Yakin Konfirmasi Pembayaran') ? window.location.href = '<?= site_url('admin/pembayaran/konfirm/' . $item->id) ?>' : ''">Confirm</small>
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