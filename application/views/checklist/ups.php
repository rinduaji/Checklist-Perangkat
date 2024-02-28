<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UPS | Pengecekan</title>

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

    <div class="isi">
      <!-- <a href="<?= site_url('laporan'); ?>" class="btn btn-primary">Print</a> -->
      <!-- <button id="btnTambah" onclick="tambah()" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button> -->
      <?= form_open('laporan/ups'); ?>
      <button type="submit" class="btn btn-primary">Print</button>
      <input type="hidden" name="bagian" value="UPS">
      <h1>SCHEDULE CHECKLIST UPS</h1>
      <div class="text-center">
        Periode :
        <select name="bulan" id="inputBulan" class="">
          <?php foreach ($bulan as $b => $b_val): ?>
            <option value="<?= $b_val ?>" <?= (date('m')==$b) ? 'selected' : ''; ?> ><?= $b ?></option>
          <?php endforeach ?>
        </select>
        <select name="tahun" id="inputTahun" class="">
          <?php foreach ($tahun as $t): ?>
            <option value="<?= $t ?>" <?= (date('Y')==$t) ? 'selected' : ''; ?> ><?= $t ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <br>
      <?= form_close(); ?>
      <table id="myTable" class="table table-bordered table-hover" width="100%">
        <thead class="text-center" style="align-self: center;">
          <tr>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Input (KVA)</th>
            <th>Output (KVA)</th>
            <th>Baterai Time (menit)</th>
            <th>Petugas</th>
            <th>Keterangan</th>
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
          <?= form_open('', 'id="myForm"'); ?>
          <input id="input_id_checklist_ups" type="hidden" name="id_checklist_ups" value="">
          <table class="table table-hover">
            <tr class="form-group">
              <td>
                Lokasi
              </td>
              <td>
                <input id="input_lokasi" type="text" class="form-control" placeholder="Lokasi" name="lokasi" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Merk
              </td>
              <td>
                <input id="input_merk" type="text" class="form-control" placeholder="Merk" name="merk" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Type
              </td>
              <td>
                <input id="input_type" type="text" class="form-control" placeholder="Type" name="type" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Input (KVA)
              </td>
              <td>
                <input id="input_input" type="number" class="form-control" placeholder="Input(KVA)" name="input" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Output (KVA)
              </td>
              <td>
                <input id="input_output" type="number" class="form-control" placeholder="Output(KVA)" name="output" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Baterai Time
              </td>
              <td>
                <input id="input_baterai_time" type="number" class="form-control" placeholder="Baterai Time" name="baterai_time" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Petugas
              </td>
              <td>
                <select name="petugas" id="input_petugas" class="form-control">
                  <option value="">---Pilih Petugas---</option>
                  <?php foreach ($petugas as $val): ?>
                    <option value="<?= $val->nama_petugas ?>"><?= $val->nama_petugas ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Keterangan
              </td>
              <td>
                <textarea name="keterangan" id="input_keterangan" class="form-control" rows="3"></textarea>
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