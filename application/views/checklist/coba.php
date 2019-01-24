<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Coba | Pengecekan</title>

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
      <h1>Laporan Pengecekan CCTV Area Operasional</h1>
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
      <div class="text-center">
        Shift : 
        <select name="shift" id="inputShift" class="">
          <option value="pagi" selected>Pagi</option>
          <option value="sore">Sore</option>
          <option value="malam">Malam</option>
        </select>
      </div>
      <br>
      <?= form_close(); ?>
      <table id="myTable" class="table table-bordered table-hover" width="100%">
        <thead class="text-center" style="align-self: center;">
          <tr>
            <th rowspan="2">Lantai</th>
            <th rowspan="2">Ruang</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">Keterangan</th>
            <th rowspan="2">Aksi</th>
          </tr>
          <tr>
            <?php for ($i = 1; $i <= 31; $i++) { ?>
              <th><?= $i ?></th>
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
          <input id="input_id_check_cctv" type="hidden" name="id_check_cctv" value="">
          <table class="table table-hover" id="formInsert">
            <tr class="form-group formInsertCheck">
              <td>
                Tanggal
              </td>
              <td>
                <input id="input_tanggal" type="text" class="form-control" placeholder="tanggal" name="tanggal" value="<?= date('d-m-Y') ?>" required="true" readonly>
              </td>
            </tr>
            <tr class="form-group formEditCheck" hidden>
              <td>
                Tanggal
              </td>
              <td class="form-group">
                <input id="input_tanggalEdit" type="number" class="form-control" placeholder="Masukkan Tanggal Ke berapa" name="tanggal_edit">
                <input id="input_bulanTahun" type="text" class="form-control" placeholder="BulanTahun" name="bulanTahun" value="<?= date('F-Y') ?>" readonly>
              </td>
            </tr>
            <tr class="form-group formInsertCheck">
              <td>
                Ruangan
              </td>
              <td>
                <select name="id_ruangan" id="input_id_ruangan" class="form-control">
                  <option value="">---Pilih Ruangan---</option>
                  <?php foreach ($ruangan as $r): ?>
                    <option value="<?= $r->id_ruangan ?>"><?= $r->nama_ruangan ?> lantai <?= $r->lantai ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group formInsertCheck">
              <td>
                Shift
              </td>
              <td>
                <select name="shift" id="input_shift" class="form-control">
                  <option value="" selected>---Pilih Shift---</option>
                  <option value="pagi">Pagi</option>
                  <option value="sore">Sore</option>
                  <option value="malam">Malam</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Kondisi
              </td>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="kondisi" id="input_kondisi" value="baik">
                    <?= '&#x2713;' ?>
                  </label>
                  <label>
                    <input type="radio" name="kondisi" id="input_kondisi" value="tidak">
                    X
                  </label>
                </div>
              </td>
            </tr>
          </table>
          <table class="table table-hover" id="formEditKeterangan" hidden>
            <tr class="form-group">
              <td>
                Keterangan
              </td>
              <td>
                <input id="input_keterangan" type="text" class="form-control" placeholder="keterangan" name="keterangan">
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

  <!-- Modal Pilih yang akan di Edit -->
  <div class="modal fade" id="pilihModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <button id="btnEditCheck" type="button" class="btn btn-info">Edit Checklist</button>
          <button id="btnEditKeterangan" type="button" class="btn btn-primary">Edit Keterangan</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('templates/javascript'); ?>
</body>
</html>