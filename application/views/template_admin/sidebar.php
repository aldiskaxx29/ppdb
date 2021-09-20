<?php $userLogin = $this->m_user->byEmail($this->session->userdata('email')); ?>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#"><?= role_user($userLogin->role_id) ?></a>
      <!-- <a href="#">Super Admin</a> -->
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">Ad</a>
      <!-- <a href="#">Sa</a> -->
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?php if ($this->uri->segment('2') == 'Dashboard') : ?> active <?php endif ?>">
        <a href="<?= base_url('admin/dashboard/') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Menu</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data Master</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= site_url('admin/kelas') ?>">Data Kelas</a></li>
          <li><a class="nav-link" href="<?= site_url('admin/jurusan') ?>">Data Jurusan</a></li>
          <li><a class="nav-link" href="<?= site_url('admin/jenispembayaran') ?>">Data Jenis Pembayaran</a></li>
          <li><a class="nav-link" href="<?= base_url('admin/siswa')  ?>">Siswa</a></li>
          <li><a class="nav-link" href="<?= base_url('admin/user')  ?>">User</a></li>
        </ul>
      </li>
      
      <li class="<?php if ($this->uri->segment('2') == 'tagihan') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/tagihan/')  ?>"><i class="fas fa-dollar-sign"></i> <span>Data Tagihan</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'pembayaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/pembayaran/')  ?>"><i class="fas fa-dollar-sign"></i> <span>Data Pembayaran</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'konfirmasiPendaftaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/konfirmasiPendaftaran')  ?>"><i class="fas fa-user"></i> <span>Konfirmasi Pendaftaran</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'config') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/config')  ?>"><i class="fas fa-cog"></i> <span>Konfigurasi Aplikasi</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'laporanpendaftaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/laporanpendaftaran')  ?>"><i class="fas fa-users"></i> <span>Laporan Pendaftaran</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'laporanpembayaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('admin/laporanpembayaran')  ?>"><i class="fas fa-dollar-sign"></i> <span>Laporan Pembayaran</span></a>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= base_url('auth/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </aside>
</div>