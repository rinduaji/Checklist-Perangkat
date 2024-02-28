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
    else if($this->session->userdata('jabatan') == 'Security'){
      $this->load->view('templates/sectionSecurity');
    }
    else if($this->session->userdata('jabatan') == 'OB'){
      $this->load->view('templates/sectionOB');
    }
    else {
      $this->load->view('templates/section1');
    }
    ?>

    <div class="isi">
      <!-- <a href="<?= site_url('laporan'); ?>" class="btn btn-primary">Print</a> -->
      <!-- <button id="btnTambah" onclick="tambah()" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button> -->
      <?= form_open('laporan/kebersihan'); ?>
      <?php
      if($this->session->userdata('jabatan') == 'Admin' || $this->session->userdata('jabatan') == 'ME') {
      ?>
      <button type="submit" class="btn btn-primary" name="print6" value="Lantai 6">Print Lantai 6</button>
      <button type="submit" class="btn btn-info" name="print7" value="Lantai 7">Print Lantai 7</button>
      <?php
      }
      
      ?>
      <input type="hidden" name="bagian" value="Kebersihan">
      <h1>Laporan Pengecekan Kebersihan Area Operasional</h1>

      <div class="text-center">
        Periode :
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
      <br>
      <div class="text-center">
        Jam :
        <select name="jam" id="inputJam" class="">
          <option value="06:00 - 09:00" selected>06:00 - 09:00</option>
          <option value="09:00 - 12:00">09:00 - 12:00</option>
          <option value="12:00 - 15:00">12:00 - 15:00</option>
          <option value="15:00 - 18:00">15:00 - 18:00</option>
          <option value="18:00 - 21:00">18:00 - 21:00</option>
          <option value="21:00 - 24:00">21:00 - 24:00</option>
        </select>
      </div>
      <br>
      <?= form_close(); ?>
      <table id="myTable" class="table table-bordered table-hover">
        <thead class="text-center" style="align-self: center;">
          <tr>
            <th rowspan="3">TANGGAL</th>
            <th rowspan="3">JAM</th>
            <th rowspan="3">LANTAI</th>
            <th rowspan="3">RUANG</th>
            <th rowspan="3">PIC</th>
            <th colspan="15" rowspan="2">ITEM CHECKLIST</th>
            <th rowspan="1" colspan="4">PARAF</th>
            <th rowspan="3">KETERANGAN</th>
            <th rowspan="3">AKSI</th>
          </tr>
          <tr>
            <th colspan="2">CLEANING SERVICE</th>
            <th colspan="2">USER</th>
          </tr>
          <tr>
            <th>LANTAI</th>
            <th>DINDING</th>
            <th>LIST</th>
            <th>KACA</th>
            <th>PLAFON</th>
            <th>FURNITURE</th>
            <th>WS</th>
            <th>PC</th>
            <th>AC</th>
            <th>TELEPHONE</th>
            <th>AKSESORIS</th>
            <th>KAP LAMPU</th>
            <th>TEMPAT SAMPAH</th>
            <th>KURSI STAFF</th>
            <th>MEJA STAFF</th>
            <th>INSFECTED BY</th>
            <th>TL / SPV</th>
            <th>NAMA</th>
            <th>TTD</th>
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
          <input id="input_id_check_kebersihan" type="hidden" name="id_check_kebersihan">
          <table class="table table-hover" id="formInsert">
            <tr class="form-group formInsertCheck">
              <td>
                PIC
              </td>
              <td>
                <input id="pic" type="text" class="form-control" placeholder="PIC" name="pic" value="<?= $this->session->userdata('username') ?>" required="true" readonly>
              </td>
            </tr>
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
                <input id="input_periode" type="text" class="form-control" placeholder="periode" name="periode" value="<?= date('F-Y') ?>" readonly>
              </td>
            </tr>
            <tr class="form-group formInsertCheck">
              <td>
                Lantai Operasional
              </td>
              <td>
                <select name="lantai_operasional" id="input_lantai_operasional" class="form-control">
                  <option value="">---Pilih Lantai Operasional---</option>
                  <?php foreach ($lantai_ops as $r) : ?>
                    <option value="Lantai <?= $r->lantai ?>">lantai <?= $r->lantai ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group formInsertCheck">
              <td>
                Ruangan
              </td>
              <td>
                <select name="id_ruangan" id="input_id_ruangan" class="form-control">
                  <option value="">---Pilih Ruangan---</option>
                  <?php foreach ($ruangan as $r) : ?>
                    <option value="<?= $r->id_ruangan ?>"><?= $r->nama_ruangan ?> lantai <?= $r->lantai ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group formInsertCheck">
              <td>
                Jam
              </td>
              <td>
                <select name="jam" id="input_jam" class="form-control">
                  <option value="" selected>---Pilih Jam---</option>
                  <option value="06:00 - 09:00">06:00 - 09:00</option>
                  <option value="09:00 - 12:00">09:00 - 12:00</option>
                  <option value="12:00 - 15:00">12:00 - 15:00</option>
                  <option value="15:00 - 18:00">15:00 - 18:00</option>
                  <option value="18:00 - 21:00">18:00 - 21:00</option>
                  <option value="21:00 - 24:00">21:00 - 24:00</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Lantai
              </td>
              <td>
                <select name="lantai" id="input_lantai" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Lantai---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Dinding
              </td>
              <td>
                <select name="dinding" id="input_dinding" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Dinding---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                List
              </td>
              <td>
                <select name="list" id="input_list" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan List---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Kaca
              </td>
              <td>
                <select name="kaca" id="input_kaca" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Kaca---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Plafon
              </td>
              <td>
                <select name="plafon" id="input_plafon" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Plafon---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Furniture
              </td>
              <td>
                <select name="furniture" id="input_furniture" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Furniture---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                WS
              </td>
              <td>
                <select name="ws" id="input_ws" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan WS---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                PC
              </td>
              <td>
                <select name="pc" id="input_pc" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan PC---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                AC
              </td>
              <td>
                <select name="ac" id="input_ac" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan AC---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Telephone
              </td>
              <td>
                <select name="telephone" id="input_telephone" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Telephone---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Aksesoris
              </td>
              <td>
                <select name="aksesoris" id="input_aksesoris" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Aksesoris---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Kap Lampu
              </td>
              <td>
                <select name="kap_lampu" id="input_kap_lampu" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Kap Lampu---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Tempat Sampah
              </td>
              <td>
                <select name="tempat_sampah" id="input_tempat_sampah" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Tempat Sampah---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Kursi Staff
              </td>
              <td>
                <select name="kursi_staff" id="input_kursi_staff" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Kursi Staff---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Meja Staff
              </td>
              <td>
                <select name="meja_staff" id="input_meja_staff" class="form-control">
                  <option value="" selected>---Pilih Pengerjaan Meja Staff---</option>
                  <option value="vakuum">VK (VAKUUM)</option>
                  <option value="sapu">SP (SAPU)</option>
                  <option value="dilap">LP (DILAP)</option>
                  <option value="dipel">PL (DIPEL)</option>
                  <option value="tidak ada pengerjaan">X (TIDAK ADA PENGERJAAN)</option>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Insfected By
              </td>
              <td>
                <select name="insfected" id="input_insfected" class="form-control">
                  <option value="" selected>---Pilih Insfected By---</option>
                  <?php foreach ($list_insfected as $val) : ?>
                    <option value="<?= $val->username ?>"><?= $val->username ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                TL / SPV
              </td>
              <td>
                <select name="tl_spv" id="input_tl_spv" class="form-control">
                  <option value="" selected>---Pilih TL / SPV---</option>
                  <?php foreach ($list_tl_spv as $val) : ?>
                    <option value="<?= $val->username ?>"><?= $val->username ?></option>
                  <?php endforeach ?>
                </select>
              </td>
            </tr>
            <tr class="form-group">
              <td>
                Nama User
              </td>
              <td>
                <select name="nama_user" id="input_nama_user" class="form-control">
                  <option value="" selected>---Pilih Nama User---</option>
                  <?php foreach ($list_nama_user as $val) : ?>
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
                <textarea id="input_keterangan" type="text" class="form-control" placeholder="keterangan" name="keterangan"></textarea>
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
  <?php
  if($this->session->userdata('jabatan') == 'Admin') {
    $this->load->view('templates/javascript');
  } else if($this->session->userdata('jabatan') == 'ME') {
    $this->load->view('templates/javascript_ME');
  } else {
    $this->load->view('templates/javascriptOB');
  }
  ?>
</body>

</html>