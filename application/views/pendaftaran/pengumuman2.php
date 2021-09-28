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
                <div class="alert alert-success">
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat Biodata Anda Berhasil Di Input</h4>
                    <p>Tunggu konfirmasi selanjutnya dari admin</p>
                    <hr>
                    <p class="mb-0"><?= date('Y/m/d') ?></p>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </section>
      </div>