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
						  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i> Edit Profile</button>
						  <hr>
                          <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="15%">Nama</th>
                                    <th>: <?php echo $user->nama ?></th>
                                </tr>
								<tr>
                                    <th width="15%">Email</th>
                                    <th>: <?php echo $user->email ?></th>
                                </tr>
                            </thead>
                          </table>
                      </div>
                  </div>
              </div>
          </section>
      </div>
	  
	  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			  <div class="modal-content">
				  <div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
					  </button>
				  </div>
				  <div class="modal-body">
					  <form action="<?= site_url('profile/update') ?>" method="post">
						  <input type="hidden" name="id" value="<?= $id ?>">
						  <div class="form-group">
							  <label>Nama</label>
							  <input type="text" class="form-control" name="nama" value="<?= $user->nama ?>">
						  </div>
						  <div class="form-group">
							  <label>Email</label>
							  <input type="email" class="form-control" name="email" value="">
							  <small class="text-info">Masukan Email Baru Jika Ingin Di Ganti</small>
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