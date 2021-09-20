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
            <div class="card" style="overflow-x:auto;">
              <div class="card-body" style="overflow-x:auto;">
                <?php if ($this->session->flashdata('success')) : ?>
                  <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                <?php endif ?>
                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Data</a>
                <hr>
                <table class="table text-center" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Jenis Pembayaran</th>
                      <th>Jumlah Bayar</th>
                      <th>Foto</th>
                      <th>Konfirm</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pembayaran as $no => $item) : ?>
                      <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $item->nama ?></td>
                        <td><?= $item->grade_tagihan ?></td>
                        <td><?= $item->jenis ?></td>
                        <td>Rp. <?= number_format($item->jumlah, 0, ',', '.') ?></td>
                        <td class="foto-bukti text-center" style="cursor: pointer;"><img src="<?= base_url('assets/img/bukti_pembayaran/' . $item->foto_bukti) ?>" alt="Foto Bukti" width="100px"></td>
                        <td>
                          <?php if ($item->konfirm == 0) : ?>
                            <small style="cursor: pointer;" class="badge badge-warning" onclick="return confirm('Yakin Konfirmasi Pembayaran') ? window.location.href = '<?= site_url('admin/pembayaran/konfirm/' . $item->id) ?>' : ''">Confirm</small>
                          <?php else : ?>
                            <strong class="badge badge-success">Sudah Di Konfirmasi</strong>
                          <?php endif ?>
                        </td>
                        <td>
                          <a href="<?= base_url('Admin/Pembayaran/hapus/' . $item->id) ?>" onclick="return confirm('Yakin Ingin Di Hapus')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit<?= $item->id ?>"><i class="fas fa-edit"></i></a>
                          <a href="<?= base_url('Admin/Pembayaran/detail/' . $item->id) ?>" data-toggle="modal" data-target="#exampleModalDetail<?= $item->id ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Admin/Pembayaran/tambah') ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama</label>
            <select class="form-control" name="nama">
              <option>-- Pilihan --</option>
              <?php foreach ($user as $item): ?>
                <option value="<?= $item->id ?>"><?= $item->nama ?></option>                
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tagihan</label>
            <select class="form-control" name="tagihan">
              <option>-- Pilhian --</option>
              <option value="1">X</option>
              <option value="2">XI</option>
              <option value="3">XIII</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jenis Pembayaran</label>
            <select class="form-control" name="jenis_pembayaran">
              <option value="">-- Pilihan --</option>              
              <?php foreach ($jenis as $item): ?>
                <option value="<?= $item->id ?>"><?= $item->jenis ?></option>               
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control">
          </div>
          <div class="form-group">
            <label>Bukti Pembayaran</label>
            <input type="file" name="bukti" class="form-control">
          </div>
          <div class="form-group float-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>


<!-- modal detail -->
<?php foreach ($pembayaran as $no => $item): ?>

<div class="modal fade" id="exampleModalDetail<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Data Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Admin/Pembayaran/tambah') ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $item->nama ?>" class="form-control">
            <!-- <select class="form-control" name="nama">
              <?php foreach ($user as $us): ?>
                <?php if ($us->nama == $item->nama): ?>
                  <option value="<?= $us->id ?>" selected><?= $us->nama ?></option>                
                <?php else: ?>
                  <option value="<?= $us->id ?>"><?= $us->nama ?></option> 
                <?php endif ?>
              <?php endforeach ?>
            </select> -->
          </div>
          <div class="form-group">
            <label>Tagihan</label>
            <!-- <select class="form-control" name="tagihan">
              <option>-- Pilhian --</option>
              <option value="1">X</option>
              <option value="2">XI</option>
              <option value="3">XIII</option>
            </select> -->
            <input type="text" name="" class="form-control" value="<?= $item->grade_tagihan ?>">
          </div>
          <div class="form-group">
            <label>Jenis Pembayaran</label>
            <input type="text" name="" class="form-control" value="<?= $item->jenis ?>">
          </div>
          <div class="form-group">
            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control" value="<?= $item->jumlah ?>">
          </div>
          <div class="form-group">
            <label>Bukti Pembayaran</label><br>
            <img src="<?= base_url('assets/img/bukti_pembayaran/' . $item->foto_bukti) ?>" width="100px">
          </div>
          <!-- <div class="form-group float-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div> -->
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
  
<?php endforeach ?>

<!-- modal edit -->
<?php foreach ($pembayaran as $no => $item): ?>

<div class="modal fade" id="exampleModalEdit<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Admin/Pembayaran/update') ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama</label>
            <input type="hidden" name="id" value="<?= $item->id ?>">
            <select class="form-control" name="nama">
              <?php foreach ($user as $us): ?>
                <?php if ($us->nama == $item->nama): ?>
                  <option value="<?= $us->id ?>" selected><?= $us->nama ?></option>                
                <?php else: ?>
                  <option value="<?= $us->id ?>"><?= $us->nama ?></option> 
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tagihan</label>
            <select class="form-control" name="tagihan">
              <option value="1" <?php if ($item->grade_tagihan == "X"): ?>selected<?php endif ?>>X</option>
              <option value="2" <?php if ($item->grade_tagihan == "XI"): ?>selected<?php endif ?>>XI</option>
              <option value="3" <?php if ($item->grade_tagihan == "XII"): ?>selected<?php endif ?>>XII</option>
            </select>
            <!-- <input type="text" name="tagihan" class="form-control" value="<?= $item->grade_tagihan ?>"> -->
          </div>
          <div class="form-group">
            <label>Jenis Pembayaran</label>
            <!-- <input type="text" name="jenis" class="form-control" value="<?= $item->jenis ?>"> -->
            <select class="form-control" name="jenis_pembayaran">
                <?php foreach ($jenis as $j): ?>
                  <?php if ($j->id == $item->jenis_pembayaran_id): ?>
                    <option value="<?= $j->id ?>" selected><?= $j->jenis ?></option>                 
                  <?php else: ?>
                    <option value="<?= $j->id ?>"><?= $j->jenis ?></option>
                  <?php endif ?>
                <?php endforeach ?>              
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control" value="<?= $item->jumlah ?>">
          </div>
          <div class="form-group">
            <label>Bukti Pembayaran</label><br>
            <img src="<?= base_url('assets/img/bukti_pembayaran/' . $item->foto_bukti) ?>" width="100px">
            <input type="file" name="bukti" class="form-control">
            <small class="text-info">Biarkan jika tidak ingiin di ubah gambar</small>
          </div>
          <div class="form-group float-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
  
<?php endforeach ?>
