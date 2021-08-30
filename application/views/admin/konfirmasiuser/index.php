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
                <?= $this->session->flashdata('confirm') ?>
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Data</a>
                <hr>
                <table class="table table-striped" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <!-- <th>Role Id</th> -->
                      <th>Status</th>
                      <!-- <th>Gambar</th> -->
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($user as $no => $us) : ?>
                      <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $us->nama ?></td>
                        <td><?= $us->email ?></td>
                        <!-- <td><?= $us->role_id ?></td> -->
                        <td>
                          <?php if ($us->status == 0) : ?>
                            <small class="badge badge-warning" data-toggle="modal" data-target="#exampleModalCon<?= $us->id ?>">No</small>
                          <?php else : ?>
                            <small class="badge badge-success" data-toggle="modal" data-target="#exampleModalCon<?= $us->id ?>">Active</small>
                          <?php endif ?>
                        </td>
                        <!-- <td><?= $us->gambar ?></td> -->
                        <td><?= $us->created ?></td>
                        <td>
                          <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus')"><i class="fas fa-trash"></i></a>
                          <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit"><i class="fas fa-edit"></i></a>
                          <?php if ($us->role_id == 2) : ?>
                            <a href="<?= site_url('admin/konfirmasiuser/detail/' . $us->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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


      <!-- Modal Tambah -->

      <!-- Modal -->
      <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control">
            <?= form_error('kode_barang', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control">
            <?= form_error('nama_barang', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Harga Barang</label>
            <input type="text" name="harga_barang" class="form-control">
            <?= form_error('harga_barang', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi"></textarea>
            <?= form_error('deskripsi', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control">
            <?= form_error('qty', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" name="foto" class="form-control">
            <?= form_error('foto', '<small class="text-danger text-form">', '</small>') ?>
          </div>
          <div class="form-group float-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->

      <?php foreach ($user as $no => $us) : ?>
        <div class="modal fade" id="exampleModalCon<?= $us->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= site_url('Admin/KonfirmasiUser/confirm') ?>" method="post">
                  <div class="form-group">
                    <label>Status</label>
                    <input type="hidden" name="id" value="<?= $us->id ?>">
                    <select class="form-control" name="status">
                      <option value="">-- Plihan --</option>
                      <option value="1">Active</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                  <div class="form-group float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>