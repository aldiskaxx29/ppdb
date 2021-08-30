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
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <?= $this->session->flashdata('success') ?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                              </div>
                          <?php endif ?>
                          <?php if (empty($bayar->bukti_pembayaran)) : ?>
                              <div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">Upload Bukti Pembayaran Pendaftaran</h4>
                                  <hr>
                                  <form method="post" action="<?= site_url('pendaftaran/pengumuman/index') ?>" enctype="multipart/form-data">
									  <input type="hidden" name="tagihan_id" value="<?= $tagihan->id ?>">	
                                      <div class="form-group">
                                          <label for="jumlah" class="text-light">Jumlah Bayar</label>
                                          <input id="jumlah" class="form-control" type="number" name="jumlah" readonly value="<?= $tagihan->jumlah_tagihan ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="bukti_pembayaran" class="text-light">Foto Bukti Pembayaran Pendaftaran</label>
                                          <input id="bukti_pembayaran" class="form-control" type="file" name="bukti_pembayaran">
                                      </div>
                                      <button type="submit" class="btn btn-primary mt-3 ml-auto">Submit</button>
                                  </form>
                              </div>
                          <?php elseif (empty($bayar->status_bukti_bayar)) : ?>
                              <div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">Tunggu Konfirmasi Admin</h4>
                              </div>
                          <?php else : ?>
                              <div class="alert alert-danger" role="alert">
                                  <h4 class="alert-heading">Terimakasih Telah Melalakukan Pembayaran Pendaftaran</h4>
                              </div>
                          <?php endif ?>
                      </div>
                  </div>
              </div>
          </section>
      </div>