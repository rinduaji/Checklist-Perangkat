<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AC | Pengecekan</title>

  <?php $this->load->view('templates/css'); ?>
</head>
<body>
  <div class="container-fluid home">
    <?php $this->load->view('templates/section1'); ?>

    <div class="isi">
      <!-- <a href="<?= site_url('laporan'); ?>" class="btn btn-primary">Print</a> -->
      <!-- <button id="btnTambah" onclick="tambah()" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button> -->
      <?= form_open('laporan'); ?>
      <button type="submit" class="btn btn-primary">Print</button>
      <input type="hidden" name="bagian" value="PC">
      <h1>Checklist AC TELKOM 147</h1>
      <div class="text-center">
        Bulan :
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
      <div class="text-center">
        Ruangan :
        <select name="ruangan" id="inputRuangan" class="">
          <!-- <?php foreach ($ruangan as $b => $b_val): ?>
            <option value="<?= $b_val ?>"><?= $b ?></option>
            <?php endforeach ?> -->
          </select>
        </div>
        <?= form_close(); ?>
        <table id="myTable" class="table table-bordered table-hover" width="100%">
          <thead class="text-center" style="align-self: center;">
            <tr>
              <th rowspan="2">Tanggal</th>
              <th colspan="4">Jam 08.00</th>
              <th colspan="4">Jam 20.00</th>
              <th rowspan="2">Aksi</th>
            </tr>
            <tr>
              <?php for ($i = 0; $i < 2; $i++) { ?>
                <th>Sts AC</th>
                <th>Temp</th>
                <th>PIC</th>
                <th>Keterangan</th>
              <?php } ?>
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
            <input id="input_id_checklist_ac" type="hidden" name="id_checklist_ac" value="">
            <table class="table table-hover">
              <tr class="form-group">
                <td>
                  Ruangan
                </td>
                <td>
                  <input id="input_ruangan" type="text" class="form-control" placeholder="Ruangan" name="ruangan" required="true">
                </td>
              </tr>
              <tr class="form-group text-center">
                <td>
                  Jam 08.00
                </td>
                <td>
                  Jam 20.00
                </td>
              </tr>
              <tr class="form-group">
                <td>
                  Status AC
                  <select name="sts_ac_pagi" id="input_sts_ac_pagi" class="form-control">
                    <option value="">---Pilih Status AC---</option>
                    <option value="ok">OK</option>
                    <option value="not ok">Not OK</option>
                  </select>
                  Temperature
                  <input id="input_temp_pagi" type="text" class="form-control" placeholder="Temperature" name="temp_pagi">
                  PIC
                  <select name="pic_pagi" id="input_pic_pagi" class="form-control">
                    <option value="">---Pilih Petugas---</option>
                    <?php foreach ($petugas as $val): ?>
                      <option value="<?= $val->nama_petugas ?>"><?= $val->nama_petugas ?></option>
                    <?php endforeach ?>
                  </select>
                  Keterangan
                  <input id="input_keterangan_pagi" type="text" class="form-control" placeholder="Keterangan" name="keterangan_pagi">
                </td>
                <td>
                  Status AC
                  <select name="sts_ac_malam" id="input_sts_ac_malam" class="form-control">
                    <option value="">---Pilih Status AC---</option>
                    <option value="ok">OK</option>
                    <option value="not ok">Not OK</option>
                  </select>
                  Temperature
                  <input id="input_temp_malam" type="text" class="form-control" placeholder="Temperature" name="temp_malam">
                  PIC
                  <select name="pic_malam" id="input_pic_malam" class="form-control">
                    <option value="">---Pilih Petugas---</option>
                    <?php foreach ($petugas as $val): ?>
                      <option value="<?= $val->nama_petugas ?>"><?= $val->nama_petugas ?></option>
                    <?php endforeach ?>
                  </select>
                  Keterangan
                  <input id="input_keterangan_malam" type="text" class="form-control" placeholder="Keterangan" name="keterangan_malam">
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