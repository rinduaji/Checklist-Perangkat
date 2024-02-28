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
    <?php $this->load->view('templates/sectionOB'); ?>
    <div class="konten">
      <div class="pc">
        <i class="fas fa-desktop fa-5x"></i>
        <h2>Kebersihan</h2>
        <a href="<?= site_url('ChecklistOB/kebersihan') ?>" class="btn btn-primary">Lihat</a>
      </div>
    </div>
  </div>

  <?php $this->load->view('templates/javascriptOB'); ?>
</body>
</html>