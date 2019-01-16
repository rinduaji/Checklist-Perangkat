<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home | Pengecekan</title>

  <?php $this->load->view('templates/css'); ?>
</head>
<body>
  <div class="container-fluid home">
    <?php $this->load->view('templates/section1'); ?>
    <div class="konten">
      <div class="pc">
        <i class="fas fa-desktop fa-5x"></i>
        <h2>PC</h2>
        <a href="<?= site_url('checklist/pc') ?>" class="btn btn-primary">Lihat</a>
      </div>
      <div class="ac">
        <i class="fas fa-wind fa-5x"></i>
        <h2>AC</h2>
        <a href="<?= site_url('checklist/ac') ?>" class="btn btn-primary">Lihat</a>
      </div>
      <div class="cctv">
        <i class="fas fa-video fa-5x"></i>
        <h2>cctv</h2>
        <a href="<?= site_url('checklist/cctv') ?>" class="btn btn-primary">Lihat</a>
      </div>
      <div class="ups">
        <i class="fas fa-hdd fa-5x"></i>
        <h2>UPS</h2>
        <a href="<?= site_url('checklist/ups') ?>" class="btn btn-primary">Lihat</a>
      </div>
    </div>
  </div>

  <?php $this->load->view('templates/javascript'); ?>
</body>
</html>