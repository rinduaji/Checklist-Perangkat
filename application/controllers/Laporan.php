<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('Pdf');
    $this->load->model('DataPC');
    $this->load->model('DataAC');
    $this->load->model('DataUPS');
    $this->load->model('DataCCTV');
    $this->load->model('DataRuangan');
    $this->load->model('DataKebersihan');
  }

  function lol()
  {
    $this->load->view('Laporan/pc');
    // $this->pc();
  }

  function pc()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $shift = $this->input->post('shiftForm');
    $bagian = $this->input->post('bagian');

    $data_PC = $this->DataPC->get($bulan, $tahun, $shift);

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('LAPORAN PENGECEKAN & CHECKLIST ' . $bagian);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(true, 10);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Aji');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/ish.jpg'), '', 15, 40, 15);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">FORM CLEANING & CHECKLIST ' . $bagian . '</h3>
                <h4 style="margin: 0">Bulan : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun . '</h4>
                <h4 style="margin: 0">Shift : ' . $shift . '</h4>
            </div>
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    // set margins
    $total_pc = 480;
    $total_mouse = 554;
    $total_keyboard = 480;
    $total_monitor = 480;

    if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'January') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'April') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'July') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'October')) {
      $total_pc -= 160;
      $total_mouse -= 160;
      $total_keyboard -= 160;
      $total_monitor -= 160;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'February') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'May') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'August') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'November')) {
      $total_pc -= 320;
      $total_mouse -= 320;
      $total_keyboard -= 320;
      $total_monitor -= 320;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'March') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'June') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'September') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'December')) {
      $total_pc -= 480;
      $total_mouse -= 480;
      $total_keyboard -= 480;
      $total_monitor -= 480;
    }
    $gambar_paraf_tl = '';
    $gambar_paraf_it = '<img src="http://10.194.41.7/Checklistuploads/Paraf/2.png"></img>';;
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th rowspan="3">No.<br>PC ID</th>
                <th rowspan="3">Tanggal</th>
                <th rowspan="3">Nama Petugas</th>
                <th colspan="3">Aktivitas</th>
                <th colspan="2">Nama dan Paraf</th>
                <th rowspan="3">Keterangan</th>
            </tr>
            <tr style="text-align:center">
                <th colspan="3">Cleaning Perangkat</th>
                <th rowspan="2">User / TL</th>
                <th rowspan="2">IT</th>
            </tr>
            <tr style="text-align:center">
                <th>M1</th>
                <th>M2</th>
                <th>CPU</th>
            </tr>
        ';
    foreach ($data_PC as $val) {
      $M1 = ($val->M1 == 'cek') ? '&#x2713;' : '-';
      $M2 = ($val->M2 == 'cek') ? '&#x2713;' : '-';
      $CPU = ($val->CPU == 'cek') ? '&#x2713;' : '-';
      $tbl .= '
                <tr>
                    <td style="text-align:center">' . $val->pc_id . '</td>
                    <td style="text-align:center">' . date('d-m-Y', strtotime($val->tanggal)) . '</td>
                    <td>' . $val->nama_petugas . '</td>
                    <td style="text-align:center">' . $M1 . '</td>
                    <td style="text-align:center">' . $M2 . '</td>
                    <td style="text-align:center">' . $CPU . '</td>
                    <td>' . $val->TL .' '. (($val->status != 'Approve TL') ? (isset($val->paraf_tl) ? ' <img src="'. base_url() .'/uploads/Paraf/'. $val->paraf_tl .'.png" width="50px" height="50px" />' : '') : '') .' </td>
                    <td>' . $val->IT  .' '. (($val->status == 'Closed') ? (isset($val->paraf_it) ? ' <img src="'. base_url() .'/uploads/Paraf/'. $val->paraf_it .'.png" width="50px" height="50px" />' : '') : '') .' </td>
                    <td>' . $val->keterangan . '</td>
                </tr>
            ';
    }
    $tbl .= '</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $ttd = '
            <br>
            <table>
              <tr>
                <td colspan="2">Kode Cleaning Perangkat :</td>
              </tr>
            </table>
            <table width="1080px">
              <tr>
                <td width="150px">
                  <table border="1" cellspacing="1" cellpadding="2" style="float: left" width="150px">
                    <tr>
                      <td>M1</td>
                      <td>Monitor</td>
                      </tr>
                        <tr> 
                      <td rowspan="2">M2</td>
                      <td>Mouse</td>
                    </tr>
                    <tr>
                      <td>Keyboard</td>
                    </tr>
                    <tr>
                      <td rowspan="6">CPU</td>
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
                </td>
                <td width="25px">
                </td>
                 <td width="150px" >
            <table>
              <tr>
                <td colspan="2">Jumlah perangkat :</td>
              </tr>
            </table>           
                  <table border="1" cellspacing="1" cellpadding="2" style="float: left" width="150px" rowspan= "2">
                    <tr>
                      <td border="0">CPU</td>
                      <td>480</td>
                      </tr>
                     <tr>
                      <td >MOUSE</td>
                      <td>554</td>
                      </tr> 
                       <tr>
                      <td >KEYBOARD</td>
                      <td>480</td>
                      </tr> 
                       <tr>
                      <td >MONITOR</td>
                      <td>480</td>
                      </tr>
                  </table>

                  <table>
              <tr>
                <td colspan="2">Perangkat Belum Cleaning :</td>
              </tr>
            </table>           
                  <table border="1" cellspacing="1" cellpadding="2" style="float: left" width="150px" rowspan= "2">
                    <tr>
                      <td border="0">CPU</td>
                      <td>' . $total_pc . '</td>
                      </tr>
                     <tr>
                      <td >MOUSE</td>
                      <td>' . $total_mouse . '</td>
                      </tr> 
                       <tr>
                      <td >KEYBOARD</td>
                      <td>' . $total_keyboard . '</td>
                      </tr> 
                       <tr>
                      <td >MONITOR</td>
                      <td>' . $total_monitor . '</td>
                      </tr>
                  </table>
                </td>


                <td width="200px" style="text-align: center">
                  SPV IT CC Malang <br>
                  PT. Infomedia Nusantara
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  (Firman Hidayat)
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }

  function ac()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $id_ruangan = $this->input->post('id_ruangan');
    $ruangan = $this->DataRuangan->get('', '', $id_ruangan);
    $bagian = $this->input->post('bagian');

    $data_AC = $this->DataAC->get($bulan, $tahun, $id_ruangan);

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('SCHEDULE CHECKLIST ' . $bagian);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(5);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Fahrul');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/ish.jpg'), '', 15, 40, 15);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">CHECKLIST ' . $bagian . '</h3>
                <h4 style="margin: 0">Bulan : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun . '</h4>
                <h4 style="margin: 0">Ruangan : ' . $ruangan[0]->nama_ruangan . ' lantai ' . $ruangan[0]->lantai . '</h4>
            </div>
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th rowspan="2" width="12%">Tanggal</th>
                <th colspan="4">Jam 08.00</th>
                <th colspan="4">Jam 20.00</th>
            </tr>
            <tr style="text-align:center">
                <th>Sts AC</th>
                <th>Temp</th>
                <th>PIC</th>
                <th>Keterangan</th>
                <th>Sts AC</th>
                <th>Temp</th>
                <th>PIC</th>
                <th>Keterangan</th>
            </tr>


        ';
    foreach ($data_AC as $val) {
      $tbl .= '
                <tr rowspan="2">
                    <td style="text-align:center">' . date('d-m-Y', strtotime($val->tanggal)) . '</td>
                    <td style="text-align:center">' . $val->sts_ac_pagi . '</td>
                    <td style="text-align:center">' . $val->temp_pagi . '</td>
                    <td>' . $val->pic_pagi . '</td>
                    <td>' . $val->keterangan_pagi . '</td>
                    <td style="text-align:center">' . $val->sts_ac_malam . '</td>
                    <td style="text-align:center">' . $val->temp_malam . '</td>
                    <td>' . $val->pic_malam . '</td>
                    <td>' . $val->keterangan_malam . '</td>
                </tr>

            ';
    }
    $tbl .= '</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    $ttd = '
            <br>
            <br>
            <br>
            <table width="100%">
              <tr>
                <td width="50%" style="text-align: center">
                  <br>
                  <br>
                  <br>
                  <br>
                  
                </td>
                <td width="50%" style="text-align: center">
                SPV IT CC Malang <br>
                  PT. Infomedia Nusantara
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  (Firman Hidayat)
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }

  function ups()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $bagian = $this->input->post('bagian');

    $data_UPS = $this->DataUPS->get($bulan, $tahun);

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('SCHEDULE CHECKLIST ' . $bagian);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(5);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Fahrul');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/ish.jpg'), '', 15, 40, 15);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">FORM CLEANING & CHECKLIST ' . $bagian . '</h3>
                <h4 style="margin: 0">PERIODE : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun . '</h4>
            </div>
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th width="12%">Tanggal</th>
                <th>Lokasi</th>
                <th>Merk</th>
                <th>Type</th>
                <th>Input (KVA)</th>
                <th>Output (KVA)</th>
                <th>Baterai Time (Menit)</th>
                <th>Petugas</th>
                <th width="12%">Keterangan</th>
            </tr>
        ';
    foreach ($data_UPS as $val) {
      $tbl .= '
                <tr>
                    <td style="text-align:center">' . date('d-m-Y', strtotime($val->tanggal)) . '</td>
                    <td>' . $val->lokasi . '</td>
                    <td>' . $val->merk . '</td>
                    <td>' . $val->type . '</td>
                    <td style="text-align:center">' . $val->input . '</td>
                    <td style="text-align:center">' . $val->output . '</td>
                    <td style="text-align:center">' . $val->baterai_time . '</td>
                    <td>' . $val->petugas . '</td>
                    <td>' . $val->keterangan . '</td>
                </tr>
            ';
    }
    $tbl .= '</table>';

    $pdf->writeHTML($tbl, true, false, false, false, '');

    $ttd = '
            <br>
            <table width="100%">
              <tr>
                <td width="50%">
                </td>
                <td width="50%" style="text-align: center">
                  SPV IT CC Malang <br>
                  PT. Infomedia Nusantara
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  (Firman Hidayat)
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }

  function cctv()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $shift = $this->input->post('shift');
    $bagian = $this->input->post('bagian');

    $data_CCTV = $this->DataCCTV->getCCTV($bulan, $tahun, $shift);

    $pdf = new TCPDF('L', 'mm', 'legal', true, 'UTF-8', false);
    $pdf->SetTitle('LAPORAN PENGECEKAN ' . $bagian . ' AREA OPERASIONAL');
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(5);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Fahrul');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/ish.jpg'), '', 15, 40, 15);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h4 style="margin: 0">LAPORAN PENGECEKAN ' . $bagian . ' AREA OPERASIONAL</h4>
                <h4 style="margin: 0">PT. INFOMEDIA NUSATARA</h4>
                <h4 style="margin: 0">JL. A YANI NO. 11 MALANG</h4>
                <h4 style="margin: 0">PERIDODE : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' ' . $tahun . '</h4>
                <h4 style="margin: 0">SHIFT : ' . $shift . '</h4>
            </div>
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th rowspan="2">NO</th>
                <th rowspan="2">LANTAI</th>
                <th rowspan="2">RUANG</th>
                <th colspan="31">TANGGAL</th>
                <th rowspan="2">KETERANGAN</th>
            </tr>
            <tr style="text-align:center">';
    for ($i = 1; $i <= 31; $i++) {
      $tbl .= '<th>' . $i . '</th>';
    }
    $loop = 0;
    $no = 1;
    $tbl .= '</tr>';
    foreach ($data_CCTV as $key => $value) {
      $tbl .= '
                <tr>';
      if ($loop == 0 || $loop == 2 || $loop == 4) {
        $tbl .= '<td rowspan="2" style="text-align:center">' . $no . '</td>';
        $tbl .= '<td rowspan="2" style="text-align:center">' . $value->lantai . '</td>';
        $no++;
      }
      $tbl .= '
                <td style="text-align:center">' . $value->nama_ruangan . '</td>';
      for ($j = 1; $j <= 31; $j++) {
        if ($j < 10) {
          $tgl = '0' . $j;
        } else {
          $tgl = $j;
        }
        $kondisi = eval('return $value->' . ('tgl' . $tgl) . ';');
        $tbl .= '<td style="text-align:center">' . (($kondisi != '') ? (($kondisi == 'baik') ? '&#x2713;' : 'x') : ' ') . '</td>';
      }
      $tbl .= '
                    <td>' . $value->keterangan . '</td>
                </tr>
            ';
      $loop++;
    }
    $tbl .= '</table>';

    $pdf->writeHTML($tbl, true, false, false, false, '');

    $ttd = '
            <br>
            <br>
            <br>
            <table width="100%">
              <tr>
                <td width="50%" style="text-align: center">
                  <br>
                  <br>
                  <br>
                  <br>
                  Security
                </td>
                <td width="50%" style="text-align: center">
                  <br>
                  <br>
                  <br>
                  <br>
                  Maintenance
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }

  function kebersihan()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $jam = $this->input->post('jam');
    $bagian = $this->input->post('bagian');
    if($this->input->post('print6') == 'Lantai 6') {
      $lantai = 'Lantai 6';
      $angka_lantai = 6;
    }
    if($this->input->post('print7') == 'Lantai 7') {
      $lantai = 'Lantai 7';
      $angka_lantai = 7;
    }
    $data_kebersihan = $this->DataKebersihan->getLaporanKebersihan($bulan, $tahun, $jam, $lantai);

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('LAPORAN KEBERSIHAN ' . $bagian);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(true, 10);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Aji');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/infomedia_logo.png'), '', 17, 40, 17);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h4 style="margin: 0;text-align:center;line-height: normal;">CHECKLIST PEKERJAAN</h4>
                <h4 style="margin: 0;text-align:center;line-height: normal;">CLEANING SERVICE</h4>
                <br>
                <table>
                  <tr>
                    <td><h5 style="text-align:left;line-height: normal;">Area : MALANG</h5></td>
                    <td><h5 style="text-align:center;line-height: normal;">Bln/Thn : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' / ' . $tahun . '</h5></td>
                    <td><h5 style="text-align:right;line-height: normal;">Lt : '.$angka_lantai.' </h5></td>
                  </tr>
                </table
            </div>
            
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    // set margins
    $total_pc = 480;
    $total_mouse = 554;
    $total_keyboard = 480;
    $total_monitor = 480;

    if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'January') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'April') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'July') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'October')) {
      $total_pc -= 160;
      $total_mouse -= 160;
      $total_keyboard -= 160;
      $total_monitor -= 160;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'February') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'May') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'August') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'November')) {
      $total_pc -= 320;
      $total_mouse -= 320;
      $total_keyboard -= 320;
      $total_monitor -= 320;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'March') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'June') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'September') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'December')) {
      $total_pc -= 480;
      $total_mouse -= 480;
      $total_keyboard -= 480;
      $total_monitor -= 480;
    }
    $gambar_paraf_tl = '';
    $gambar_paraf_it = '<img src="http://10.194.41.7/Checklistuploads/Paraf/2.png"></img>';;
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th rowspan="3">Hari / Tgl</th>
                <th rowspan="3">Jam</th>
                <th rowspan="3">PIC</th>
                <th colspan="15">ITEM CHECKLIST</th>
                <th colspan="4">PARAF</th>
            </tr>
            <tr style="text-align:center">
                <th rowspan="2">LANTAI</th>
                <th rowspan="2">DINDING</th>
                <th rowspan="2">LIST</th>
                <th rowspan="2">KACA</th>
                <th rowspan="2">PLAFON</th>
                <th rowspan="2">FURNITURE</th>
                <th rowspan="2">WS</th>
                <th rowspan="2">PC</th>
                <th rowspan="2">AC</th>
                <th rowspan="2">TELEPHONE</th>
                <th rowspan="2">AKSESORIS</th>
                <th rowspan="2">KAP LAMPU</th>
                <th rowspan="2">T. SAMPAH</th>
                <th rowspan="2">KURSI STAFF</th>
                <th rowspan="2">MEJA STAFF</th>
                <th colspan="2">CLEANING SERVICE</th>
                <th colspan="2">USER</th>
            </tr>
            <tr style="text-align:center">
                <th>INSFECTED BY</th>
                <th>TL/SPV</th>
                <th>NAMA</th>
                <th>TTD</th>
            </tr>
        ';
    foreach ($data_kebersihan as $val) {
      $tbl .= '
                <tr>
                    <td style="text-align:center">' . date('D d-m-Y', strtotime($val->tanggal)) . '</td>
                    <td style="text-align:center">' . $val->jam . '</td>
                    <td style="text-align:center">' . $val->pic . '</td>
                    <td style="text-align:center">' . $val->lantai . '</td>
                    <td style="text-align:center">' . $val->dinding . '</td>
                    <td style="text-align:center">' . $val->list . '</td>
                    <td style="text-align:center">' . $val->kaca . '</td>
                    <td style="text-align:center">' . $val->plafon . '</td>
                    <td style="text-align:center">' . $val->furniture . '</td>
                    <td style="text-align:center">' . $val->ws . '</td>
                    <td style="text-align:center">' . $val->pc . '</td>
                    <td style="text-align:center">' . $val->ac . '</td>
                    <td style="text-align:center">' . $val->telephone . '</td>
                    <td style="text-align:center">' . $val->aksesoris . '</td>
                    <td style="text-align:center">' . $val->kap_lampu . '</td>
                    <td style="text-align:center">' . $val->tempat_sampah . '</td>
                    <td style="text-align:center">' . $val->kursi_staff . '</td>
                    <td style="text-align:center">' . $val->meja_staff . '</td>
                    <td style="text-align:center">' . $val->insfected . '</td>
                    <td style="text-align:center">' . $val->tl_spv . '</td>
                    <td style="text-align:center">' . $val->nama_user . '</td>
                    <td style="text-align:center">'. (isset($val->ttd_user) ? ' <img src="'. base_url() .'/uploads/Paraf/'. $val->ttd_user .'.png" width="50px" height="50px" />' : '') .' </td>
                    
                </tr>
            ';
    }
    $tbl .= '</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $ttd = '
            <div>
              Catatan :
              <ol>
                <li>Kartu ini diisi setiap kali melakukan kontrol ruangan per 2 jam sekali</li>
                <li>Isi item dengan kode pekerjaan yang sesuai</li>
                <li>Isikan paraf PIC untuk petugas,Inspektor untuk Spv dan CC untuk petugas berwenang diruangan</li>
                <li>Sabtu & Minggu dilakukan inspeksi apabila dalam kondisi digunakan untuk bekerja (lembur)</li>
              </ol>
              Kode pekerjaan : VK (vakuum), SP (disapu), LP (dilap), PL (dipel)*( pekerjaan periodik ) X ( tidak ada pengerjaan )
            </div>
            <br><br>
            <table width="1080px" >
              <tr>
                <td width="175px" style="float:left;text-align: center">
                  Di Buat Oleh, 
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  ( Ahmad Hariri )
                  <hr style=" width:60%;margin:0 auto;">
                  <br>
                  <br>
                  Maintenance
                </td>
                <td width="400px" style="float:left;text-align: center">
                </td>
                <td width="175px" style="float:right;text-align: center">
                  Surabaya ,'.date('d F Y').' 
                  <br> Mengetahui,
                  <br>
                  <br>
                  <br>
                  <br>
                  ( Iwan Setiawan)
                  <hr style="width:60%;margin:0 auto;">
                  <br>
                  <br>
                  Supervisor GA
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }

  function kebersihan7()
  {
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $jam = $this->input->post('jam');
    $bagian = $this->input->post('bagian');
    $lantai = 'Lantai 7';

    $data_kebersihan = $this->DataKebersihan->getLaporanKebersihan($bulan, $tahun, $jam, $lantai);

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('LAPORAN KEBERSIHAN ' . $bagian);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(true, 10);
    // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
    $pdf->SetAuthor('Aji');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Image(base_url('assets/gambar/infomedia_logo.png'), '', 17, 40, 17);
    // $pdf->Write();
    $i = 0;
    $judul = '
            <div style="text-align:center;line-height: normal">
                <h4 style="margin: 0;text-align:center;line-height: normal;">CHECKLIST PEKERJAAN</h4>
                <h4 style="margin: 0;text-align:center;line-height: normal;">CLEANING SERVICE</h4>
                <br>
                <table>
                  <tr>
                    <td><h5 style="text-align:left;line-height: normal;">Area : MALANG</h5></td>
                    <td><h5 style="text-align:center;line-height: normal;">Bln/Thn : ' . date('F', mktime(0, 0, 0, $bulan, 10)) . ' / ' . $tahun . '</h5></td>
                    <td><h5 style="text-align:right;line-height: normal;">Lt : 6 </h5></td>
                  </tr>
                </table
            </div>
            
        ';
    $pdf->writeHTML($judul, true, false, false, false, '');
    $pdf->SetFont('dejavusans', '', 10);
    // set margins
    $total_pc = 480;
    $total_mouse = 554;
    $total_keyboard = 480;
    $total_monitor = 480;

    if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'January') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'April') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'July') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'October')) {
      $total_pc -= 160;
      $total_mouse -= 160;
      $total_keyboard -= 160;
      $total_monitor -= 160;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'February') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'May') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'August') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'November')) {
      $total_pc -= 320;
      $total_mouse -= 320;
      $total_keyboard -= 320;
      $total_monitor -= 320;
    } else if ((date('F', mktime(0, 0, 0, $bulan, 10)) == 'March') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'June') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'September') or (date('F', mktime(0, 0, 0, $bulan, 10)) == 'December')) {
      $total_pc -= 480;
      $total_mouse -= 480;
      $total_keyboard -= 480;
      $total_monitor -= 480;
    }
    $gambar_paraf_tl = '';
    $gambar_paraf_it = '<img src="http://10.194.41.7/Checklistuploads/Paraf/2.png"></img>';;
    $tbl = '
        <table border="1" cellspacing="1" cellpadding="2">
            <tr style="text-align:center;vertical-align:middle">
                <th rowspan="3">Hari / Tgl</th>
                <th rowspan="3">Jam</th>
                <th rowspan="3">PIC</th>
                <th colspan="15">ITEM CHECKLIST</th>
                <th colspan="4">PARAF</th>
            </tr>
            <tr style="text-align:center">
                <th rowspan="2">LANTAI</th>
                <th rowspan="2">DINDING</th>
                <th rowspan="2">LIST</th>
                <th rowspan="2">KACA</th>
                <th rowspan="2">PLAFON</th>
                <th rowspan="2">FURNITURE</th>
                <th rowspan="2">WS</th>
                <th rowspan="2">PC</th>
                <th rowspan="2">AC</th>
                <th rowspan="2">TELEPHONE</th>
                <th rowspan="2">AKSESORIS</th>
                <th rowspan="2">KAP LAMPU</th>
                <th rowspan="2">T. SAMPAH</th>
                <th rowspan="2">KURSI STAFF</th>
                <th rowspan="2">MEJA STAFF</th>
                <th colspan="2">CLEANING SERVICE</th>
                <th colspan="2">USER</th>
            </tr>
            <tr style="text-align:center">
                <th>INSFECTED BY</th>
                <th>TL/SPV</th>
                <th>NAMA</th>
                <th>TTD</th>
            </tr>
        ';
    foreach ($data_kebersihan as $val) {
      $tbl .= '
                <tr>
                    <td style="text-align:center">' . date('D d-m-Y', strtotime($val->tanggal)) . '</td>
                    <td style="text-align:center">' . $val->jam . '</td>
                    <td style="text-align:center">' . $val->pic . '</td>
                    <td style="text-align:center">' . $val->lantai . '</td>
                    <td style="text-align:center">' . $val->dinding . '</td>
                    <td style="text-align:center">' . $val->list . '</td>
                    <td style="text-align:center">' . $val->kaca . '</td>
                    <td style="text-align:center">' . $val->plafon . '</td>
                    <td style="text-align:center">' . $val->furniture . '</td>
                    <td style="text-align:center">' . $val->ws . '</td>
                    <td style="text-align:center">' . $val->pc . '</td>
                    <td style="text-align:center">' . $val->ac . '</td>
                    <td style="text-align:center">' . $val->telephone . '</td>
                    <td style="text-align:center">' . $val->aksesoris . '</td>
                    <td style="text-align:center">' . $val->kap_lampu . '</td>
                    <td style="text-align:center">' . $val->tempat_sampah . '</td>
                    <td style="text-align:center">' . $val->kursi_staff . '</td>
                    <td style="text-align:center">' . $val->meja_staff . '</td>
                    <td style="text-align:center">' . $val->insfected . '</td>
                    <td style="text-align:center">' . $val->tl_spv . '</td>
                    <td style="text-align:center">' . $val->nama_user . '</td>
                    <td style="text-align:center">'. (isset($val->ttd_user) ? ' <img src="'. base_url() .'/uploads/Paraf/'. $val->ttd_user .'.png" width="50px" height="50px" />' : '') .' </td>
                    
                </tr>
            ';
    }
    $tbl .= '</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $ttd = '
            <div>
              Catatan :
              <ol>
                <li>Kartu ini diisi setiap kali melakukan kontrol ruangan per 2 jam sekali</li>
                <li>Isi item dengan kode pekerjaan yang sesuai</li>
                <li>Isikan paraf PIC untuk petugas,Inspektor untuk Spv dan CC untuk petugas berwenang diruangan</li>
                <li>Sabtu & Minggu dilakukan inspeksi apabila dalam kondisi digunakan untuk bekerja (lembur)</li>
              </ol>
              Kode pekerjaan : VK (vakuum), SP (disapu), LP (dilap), PL (dipel)*( pekerjaan periodik ) X ( tidak ada pengerjaan )
            </div>
            <br><br>
            <table width="1080px" >
              <tr>
                <td width="175px" style="float:left;text-align: center">
                  Di Buat Oleh, 
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  ( Ahmad Hariri )
                  <hr style=" width:60%;margin:0 auto;">
                  <br>
                  <br>
                  Maintenance
                </td>
                <td width="400px" style="float:left;text-align: center">
                </td>
                <td width="175px" style="float:right;text-align: center">
                  Surabaya ,'.date('d F Y').' 
                  <br> Mengetahui,
                  <br>
                  <br>
                  <br>
                  <br>
                  ( Iwan Setiawan)
                  <hr style="width:60%;margin:0 auto;">
                  <br>
                  <br>
                  Supervisor GA
                </td>
              </tr>
            </table>
        ';
    $pdf->writeHTML($ttd, true, false, false, false, '');
    $pdf->Output('Laporan ' . $bagian . '.pdf', 'I');
  }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */