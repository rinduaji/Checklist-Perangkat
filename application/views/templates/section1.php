<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navigasi">
  <a class="navbar-brand" href="#">PENGECEKAN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= ($this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('home') ?>">Home</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'pc') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/pc') ?>">PC</a>
      </li>
      <!--    <li class="nav-item <?= ($this->uri->segment(2) == 'ac') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/ac') ?>">AC</a>
      </li> -->
      <li class="nav-item <?= ($this->uri->segment(2) == 'cctv') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/cctv') ?>">CCTV</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'ups') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/ups') ?>">UPS</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'apar') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/apar') ?>">Apar</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'lift') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/lift') ?>">Lift</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'genset') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/genset') ?>">Genset</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'hydrant') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/hydrant') ?>">Hydrant</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'fap') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/fap') ?>">FAP</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'penilaian_vendor') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/penilaian_vendor') ?>">Penilaian Vendor</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'me_vendor') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/me_vendor') ?>">Maintenance Vendor</a>
      </li>
      <li class="nav-item <?= ($this->uri->segment(2) == 'kebersihan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= site_url('checklist/kebersihan') ?>">Kebersihan</a>
      </li>
    </ul>
    <form class="my-2 my-lg-0">
      <a href="<?= site_url('login/logout') ?>" class="btn btn-primary">Logout</a>
    </form>
  </div>
</nav>

<div class="" id="pesan">
  <?php if ($pesan = $this->session->flashdata('pesan')) : ?>
    <p class="alert <?= ($this->session->flashdata('status')) ? 'alert-success' : 'alert-danger'; ?>"><?= $pesan ?></p>
  <?php endif ?>
</div>