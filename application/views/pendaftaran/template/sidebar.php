<?php $userLogin = $this->m_user->byEmail($this->session->userdata('email')); ?>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#"><?= role_user($userLogin->role_id) ?></a>
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
      <li class="<?php if ($this->uri->segment('2') == 'pembayaran') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran/pembayaran')  ?>"><i class="fas fa-dollar-sign"></i> <span>Upload Bukti Pendaftaran</span></a>
      </li>
      <li class="<?php if ($this->uri->segment('2') == 'Pengumuman') : ?> active <?php endif ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran/pengumuman')  ?>"><i class="fas fa-file"></i> <span>Pengumuman</span></a>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= base_url('auth/logout') ?>" class="btn btn-success btn-lg btn-block btn-icon-split">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </aside>
</div>