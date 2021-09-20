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
                <?php if ($user === null) : ?>
                  <h5 class="mb-3"><strong>Data Diri Calon Siswa</strong></h5>
                  <form method="post" action="<?= site_url('pendaftaran/biodata/dataSiswa') ?>">
                    <div class="form-group row">
                      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" required value="<?= set_value('email') ?>">
                      </div>
                      <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control">
                        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="konfir_password" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nisn" name="nisn" required value="<?= set_value('nisn') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                      <div class="col-sm-10">
                        <select name="jurusan_id" id="jurusan_id" class="form-control">
                          <?php foreach ($jurusan as $item) : ?>
                            <option value="<?= $item->id ?>"><?= $item->nama_jurusan ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jk" id="jk1" value="Laki-Laki">
                          <label class="form-check-label" for="jk1">
                            Laki - laki
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jk" id="jk2" value="Perempuan">
                          <label class="form-check-label" for="jk2">
                            Perempuan
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="<?= set_value('tempat_lahir') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="<?= set_value('tanggal_lahir') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="agama" name="agama" required value="<?= set_value('agama') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= set_value('alamat') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_telpon" class="col-sm-2 col-form-label">No WA</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" required value="<?= set_value('no_telpon') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nama_ortu" class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" required value="<?= set_value('nama_ortu') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan Orang Tua</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="pendidikan" name="pendidikan" required value="<?= set_value('pendidikan') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan Orang Tua</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required value="<?= set_value('pekerjaan') ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 text-right mb-5">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
                <?php else : ?>
                  <form action="<?= site_url('pendaftaran/biodata/uploadSkhun') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                    <div class="form-group row">
                      <label for="upload_skhun" class="col-sm-2 col-form-label">Upload SKHUN</label>
                      <div class="col-sm-7">
                        <input type="file" class="form-control" id="upload_skhun" name="upload_skhun" required>
                        <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                      </div>
                      <div class="col-sm-3 text-right">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                      <?php if (!empty($user->upload_skhun)) : ?>
                        <div class="col-sm-12 my-3">
                          <img src="<?= base_url('assets/img/skhun/' . $user->upload_skhun) ?>" alt="Foto Ijazah" width="200px">
                        </div>
                      <?php endif ?>
                    </div>
                  </form>
                  <form action="<?= site_url('pendaftaran/biodata/uploadKK') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                    <div class="form-group row">
                      <label for="upload_kk" class="col-sm-2 col-form-label">Upload Kartu Keluarga</label>
                      <div class="col-sm-7">
                        <input type="file" class="form-control" id="upload_kk" name="upload_kk" required>
                        <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                      </div>
                      <div class="col-sm-3 text-right">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                      <?php if (!empty($user->upload_kk)) : ?>
                        <div class="col-sm-12 my-3">
                          <img src="<?= base_url('assets/img/kk/' . $user->upload_kk) ?>" alt="Foto Ijazah" width="200px">
                        </div>
                      <?php endif ?>
                    </div>
                  </form>
                  <form action="<?= site_url('pendaftaran/biodata/uploadAkte') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                    <div class="form-group row">
                      <label for="upload_akte" class="col-sm-2 col-form-label">Upload Akte Kelahiran</label>
                      <div class="col-sm-7">
                        <input type="file" class="form-control" id="upload_akte" name="upload_akte" required>
                        <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                      </div>
                      <div class="col-sm-3 text-right">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                      <?php if (!empty($user->upload_akte)) : ?>
                        <div class="col-sm-12 my-3">
                          <img src="<?= base_url('assets/img/akte/' . $user->upload_akte) ?>" alt="Foto Ijazah" width="200px">
                        </div>
                      <?php endif ?>
                    </div>
                  </form>
                  <form action="<?= site_url('pendaftaran/biodata/uploadKTP') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                    <div class="form-group row">
                      <label for="upload_ktp_ortu" class="col-sm-2 col-form-label">Upload KTP Orang Tua</label>
                      <div class="col-sm-7">
                        <input type="file" class="form-control" id="upload_ktp_ortu" name="upload_ktp_ortu" required>
                        <small class="text-info">Dalam Bentuk Foto (Upload Ulang jika ingin mengganti)</small>
                      </div>
                      <div class="col-sm-3 text-right">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                      <?php if (!empty($user->upload_ktp_ortu)) : ?>
                        <div class="col-sm-12 my-3">
                          <img src="<?= base_url('assets/img/ktp_ortu/' . $user->upload_ktp_ortu) ?>" alt="Foto Ijazah" width="200px">
                        </div>
                      <?php endif ?>
                    </div>
                  </form>
                  <form method="post" action="<?= site_url('pendaftaran/biodata/uploadPembayaran') ?>" enctype="multipart/form-data">
                    <h4>Upload Bukti Pembayaran</h4>
                    <input type="hidden" name="tagihan_id" value="<?= $tagihan->id ?>">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                    <div class="form-group">
                      <label for="jumlah">Jumlah Bayar</label>
                      <input id="jumlah" class="form-control" type="number" name="jumlah" readonly value="<?= $tagihan->jumlah_tagihan ?>">
                    </div>
                    <div class="form-group">
                      <label for="bukti_pembayaran">Foto Bukti Pembayaran Pendaftaran</label>
                      <input id="bukti_pembayaran" class="form-control" type="file" name="bukti_pembayaran">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 ml-auto">Submit</button>
                  </form>
                <?php endif ?>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php if ($this->session->flashdata('kode_siswa')) : ?>
        <div id="modalKode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <h5 class="mb-3">Pendaftaran anda berhasil silahkan tunggu untuk activasi oleh admin</h5>
                <h4 class="text-danger"><?= $this->session->flashdata('kode_siswa') ?></h4>
                <p>Silahkan Catat atau Screenshoot kode diatas (kode diatas di gunakan untuk melakukan setiap pembayaran)</p>
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>