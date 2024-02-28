<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>APAR | Pengecekan</title>

  <?php $this->load->view('templates/css'); ?>
</head>

<body>
  <div class="container-fluid home">
    <?php $this->load->view('templates/section1'); ?>

    <div class="isi">
      <!-- <a href="<?= site_url('laporan'); ?>" class="btn btn-primary">Print</a> -->
      <!-- <button id="btnTambah" onclick="tambah()" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button> -->
      <?= form_open('laporan/pc'); ?>
      <!-- <button type="submit" class="btn btn-primary">Print</button> -->
      <input type="hidden" name="bagian" value="APAR">
      <h1>CHECKLIST APAR</h1>
      <div class="text-center">
        Bulan :
        <select name="bulan" id="inputBulan" class="">
          <?php foreach ($bulan as $b => $b_val) : ?>
            <option value="<?= $b_val ?>" <?= (date('m') == $b) ? 'selected' : ''; ?>><?= $b ?></option>
          <?php endforeach ?>
        </select>
        <select name="tahun" id="inputTahun" class="">
          <?php foreach ($tahun as $t) : ?>
            <option value="<?= $t ?>" <?= (date('Y') == $t) ? 'selected' : ''; ?>><?= $t ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <?= form_close(); ?>
      <table id="myTable" class="table table-bordered table-hover" width="100%">
        <thead class="text-center">
          <tr>
            <th>NO ID</th>
            <th>Bulan dan Tahun</th>
            <th>Jenis</th>
            <th width="700px">Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Insert dan Edit -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <?= form_open_multipart('', 'id="myForm"'); ?>
          <input id="input_id_apar" type="hidden" name="id_apar" value="">
          <table class="table table-hover">
            <tr class="form-group">
              <td>
                Bulan dan Tahun
              </td>
              <td>
                <input type="month" name="bulan_tahun" id="input_bulan_tahun" class="form-control" rows="3" placeholder="Bulan Tahun PC"/>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Jenis
              </td>
              <td>
                <input type="text" name="jenis" id="input_jenis" class="form-control" rows="3" placeholder="Jenis" />
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Gambar
              </td>
              <td>
                <input type="file" name="image" id="input_image" class="form-control" />
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('templates/javascript'); ?>
</body>

</html>