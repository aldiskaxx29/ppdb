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
      <li class="<?php if ($this->uri->segment('2') == 'dashboard') : ?> active <?php endif ?>">
        <a href="<?= base_url('siswa/dashboard/') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li>
        <a class="nav-link" href="<?= base_url('siswa/pembayaran')  ?>"><i class="fas fa-dollar-sign"></i> <span>Pembayaran Sekolah</span></a>
      </li>
      <!-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Laporan</span></a></li> -->
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= base_url('auth/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </aside>
</div>