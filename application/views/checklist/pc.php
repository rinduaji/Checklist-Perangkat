<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PC | Pengecekan</title>

  <?php $this->load->view('templates/css'); ?>
</head>

<body>
  <div class="container-fluid home">
    <?php $this->load->view('templates/section1'); ?>

    <div class="isi">
      <!-- <a href="<?= site_url('laporan'); ?>" class="btn btn-primary">Print</a> -->
      <!-- <button id="btnTambah" onclick="tambah()" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button> -->
      <?= form_open('laporan/pc'); ?>
      <button type="submit" class="btn btn-primary">Print</button>
      <input type="hidden" name="bagian" value="PC">
      <h1>CLEANING DAN CHECKLIST PC</h1>
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
      <div class="text-center">
        <div class="radio" id="inputShiftForm">
          Shift :
          <label>
            <input type="radio" name="shiftForm" value="pagi" checked="checked">
            Pagi
          </label>
          <label>
            <input type="radio" name="shiftForm" value="malam">
            Malam
          </label>
        </div>
      </div>
      <?= form_close(); ?>
      <table id="myTable" class="table table-bordered table-hover" width="100%">
        <thead class="text-center">
          <tr>
            <th rowspan="3">No. PC ID</th>
            <th rowspan="3">Tanggal</th>
            <th rowspan="3">Nama Petugas</th>
            <th colspan="3">Aktifitas</th>
            <th rowspan="3">Jumlah PC</th>
            <th colspan="4">Nama dan Paraf</th>
            <th rowspan="3" width="250px">Keterangan</th>
            <!-- <th rowspan="3" width="150px">Gambar</th> -->
            <th rowspan="3">Status</th>
            <th rowspan="3">Aksi</th>
          </tr>
          <tr>
            <th colspan="3">Cleaning Perangkat</th>
            <th rowspan="2">User / TL</th>
            <th rowspan="2">Paraf User / TL</th>
            <th rowspan="2">IT</th>
            <th rowspan="2">Paraf IT</th>
          </tr>
          <tr>
            <th>M1</th>
            <th>M2</th>
            <th>CPU</th>
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
          <input id="input_id_checklist_pc" type="hidden" name="id_checklist_pc" value="">
          <table class="table table-hover">
            <tr class="form-group">
              <td>
                Tanggal
              </td>
              <td>
                <input id="input_tanggal" type="text" class="form-control" placeholder="PC ID" name="tanggal" readonly>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Shift
              </td>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="shift" id="input_shift" value="pagi">
                    Pagi
                  </label>
                  <label>
                    <input type="radio" name="shift" id="input_shift" value="malam">
                    Malam
                  </label>
                </div>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                No. PC ID
              </td>
              <td>
                <input id="input_pc_id" type="text" class="form-control" placeholder="PC ID" name="pc_id" required="true">
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Nama Petugas
              </td>
              <td>
                <select name="nama_petugas" id="input_nama_petugas" class="form-control" required="required">
                  <option value="">---Pilih Petugas---</option>
                  <?php foreach ($petugas as $val) : ?>
                    <option value="<?= $val->nama_petugas ?>"><?= $val->nama_petugas ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Aktifitas Cleaning Perangkat
              </td>
              <td>
                <div class="checkbox">
                  <label>
                    <input id="input_M1" type="checkbox" value="TRUE" name="M1">
                    M1
                  </label>
                  <label>
                    <input id="input_M2" type="checkbox" value="TRUE" name="M2">
                    M2
                  </label>
                  <label>
                    <input id="input_CPU" type="checkbox" value="TRUE" name="CPU">
                    CPU
                  </label>
                </div>
                <div>
                  <table class="table table-bordered" cellpadding="1">
                    <tr>
                      <td>M1</td>
                      <td>Monitor</td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle" rowspan="2">M2</td>
                      <td>Mouse</td>
                    </tr>
                    <tr>
                      <td>Keyboard</td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle" rowspan="6">CPU</td>
                      <td>Mainboard</td>
                    </tr>
                    <tr>
                      <td>Processor</td>
                    </tr>
                    <tr>
                      <td>RAM</td>
                    </tr>
                    <tr>
                      <td>Harddisk</td>
                    </tr>
                    <tr>
                      <td>Power Supply</td>
                    </tr>
                    <tr>
                      <td>Casing</td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Jumlah PC
              </td>
              <td>
                <input type="number" name="jumlah" id="jumlah" class="form-control" rows="3" placeholder="Jumlah PC" />
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Nama dan Paraf
              </td>
              <td>
                <label for="inputTL">Nama TL</label>
                <select name="TL" id="input_TL" class="form-control" required="required">
                  <option value="">---Pilih Nama TL---</option>
                  <?php foreach ($nama_tl as $val) : ?>
                    <option value="<?= $val->username ?>"><?= $val->username ?></option>
                  <?php endforeach ?>
                </select>

                <label for="inputIT">Nama IT</label>
                <select name="IT" id="input_IT" class="form-control" required="required">
                  <option value="">---Pilih Nama IT---</option>
                  <?php foreach ($nama_it as $val) : ?>
                    <option value="<?= $val->username ?>"><?= $val->username ?></option>
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