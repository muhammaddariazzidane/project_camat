<aside class="sidebar-wrapper " data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <i class='bx bxs-business fs-2 text-white'></i>
    </div>
    <div>
      <h4 class="logo-text">Dashboard</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-menu'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="<?= base_url('dashboard') ?>">
        <div class="parent-icon"><i class='bx bxs-widget'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>
    <li class="menu-label">Data wishlist</li>
    <li>
      <a href="<?= base_url('pengajuan') ?>">
        <div class="parent-icon"><i class='bx bx-receipt'></i>
        </div>
        <div class="menu-title">Data pengajuan</div>
        <?php if ($this->session->role_id == 3) : ?>
          <span class="badge text-bg-danger ms-1 "><?= $jml_pengajuan ? $jml_pengajuan : '' ?></span>
        <?php endif ?>
        <?php if ($this->session->role_id == 2) : ?>
          <span class="badge text-bg-danger ms-1 "><?= $jml_pengajuan_petugas ? $jml_pengajuan_petugas : '' ?></span>
        <?php endif ?>
        <?php if ($this->session->role_id == 1) : ?>
          <span class="badge text-bg-danger ms-1 "><?= $jml_pengajuan_camat ? $jml_pengajuan_camat : '' ?></span>
        <?php endif ?>
      </a>
    </li>
    <?php if ($this->session->role_id == 1) : ?>
      <li>
        <a href="<?= base_url('riwayat_pengajuan') ?>">
          <div class="parent-icon"><i class='bx bx-repeat'></i>
          </div>
          <div class="menu-title">Riwayat pengajuan</div>
        </a>
      </li>
    <?php endif ?>
    <li class="menu-label">auth</li>

    <li>
      <a href="<?= base_url('logout') ?>" class="text-bg-danger">
        <div class="parent-icon "><i class='bx bx-log-out-circle'></i>
        </div>
        <div class="menu-title">Logout</div>
      </a>
    </li>


</aside>