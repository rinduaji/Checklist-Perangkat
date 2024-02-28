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
  <?php
     if($this->session->userdata('jabatan') == 'ME'){
      $this->load->view('templates/sectionME');
    }
    else if($this->session->userdata('jabatan') == 'IT'){
      $this->load->view('templates/sectionIT');
    }
    else if($this->session->userdata('jabatan') == 'Team Leader'){
      $this->load->view('templates/sectionTL');
    }
    else {
      $this->load->view('templates/section1');
    }
    ?>
    <div class="kontenIT">
      <div class="pc">
        <i class="fas fa-desktop fa-5x"></i>
        <h2>PC</h2>
        <a href="<?= site_url('ChecklistIT/pc') ?>" class="btn btn-primary">Lihat</a>
      </div>
    </div>
  </div>

  <?php $this->load->view('templates/javascript_it'); ?>
</body>

</html>