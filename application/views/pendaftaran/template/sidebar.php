<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Calon Siswa</a>
      <!-- <a href="#">Super Admin</a> -->
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">Cs</a>
      <!-- <a href="#">Sa</a> -->
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?php if ($this->uri->segment('2') == 'Dashboard') : ?> active <?php endif ?>">
        <a href="<?= base_url('pendaftaran/dashboard/') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Starter</li>
      <li class="<?php if ($this->uri->segment('2') == 'Biodata') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran/biodata/')  ?>"><i class="fas fa-user"></i> <span>Biodata Pendaftaran</span></a>
      </li>
      <!-- <li class="<?php if ($this->uri->segment('2') == 'Pengumuman') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran/pengumuman')  ?>"><i class="fas fa-file"></i> <span>Pengumuman</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'pembayaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran/pembayaran')  ?>"><i class="fas fa-dollar-sign"></i> <span>Pembayaran Pendaftaran</span></a>
      </li> -->
    </ul>
  </aside>
</div>