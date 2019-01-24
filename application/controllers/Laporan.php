<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('DataPC');
        $this->load->model('DataAC');
        $this->load->model('DataUPS');
        $this->load->model('DataCCTV');
        $this->load->model('DataRuangan');
    }

    function lol()
    {
        $this->load->view('Laporan/pc');
    }
    
    function pc()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $shift = $this->input->post('shiftForm');
        $bagian = $this->input->post('bagian');

        $data_PC = $this->DataPC->get($bulan,$tahun,$shift);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN PENGECEKAN & CHECKLIST '.$bagian);
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
        $i=0;
        $judul='
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">FORM CLEANING & CHECKLIST '.$bagian.'</h3>
                <h4 style="margin: 0">Bulan : '.date('F',mktime(0, 0, 0, $bulan, 10)).' '.$tahun.'</h4>
                <h4 style="margin: 0">Shift : '.$shift.'</h4>
            </div>
        ';
        $pdf->writeHTML($judul, true, false, false, false, '');
        $pdf->SetFont('dejavusans', '', 10);
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
            $tbl.='
                <tr>
                    <td style="text-align:center">'.$val->pc_id.'</td>
                    <td style="text-align:center">'.date('d-m-Y',strtotime($val->tanggal)).'</td>
                    <td>'.$val->nama_petugas.'</td>
                    <td style="text-align:center">'.$M1.'</td>
                    <td style="text-align:center">'.$M2.'</td>
                    <td style="text-align:center">'.$CPU.'</td>
                    <td>'.$val->TL.'</td>
                    <td>'.$val->IT.'</td>
                    <td>'.$val->keterangan.'</td>
                </tr>
            ';
        }
        $tbl.='</table>';

        $pdf->writeHTML($tbl, true, false, false, false, '');

        $ttd = '
            <br>
            <table>
              <tr>
                <td colspan="2">Kode Cleaning Perangkat :</td>
              </tr>
            </table>
            <table width="100%">
              <tr>
                <td width="50%">
                  <table border="1" cellspacing="1" cellpadding="2" style="float: left" width="50%">
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
        $pdf->Output('Laporan '.$bagian.'.pdf', 'I');
    }

    function ac()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $id_ruangan = $this->input->post('id_ruangan');
        $ruangan = $this->DataRuangan->get('','',$id_ruangan);
        $bagian = $this->input->post('bagian');

        $data_AC = $this->DataAC->get($bulan,$tahun,$id_ruangan);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('SCHEDULE CHECKLIST '.$bagian);
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
        $i=0;
        $judul='
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">CHECKLIST '.$bagian.'</h3>
                <h4 style="margin: 0">Bulan : '.date('F',mktime(0, 0, 0, $bulan, 10)).' '.$tahun.'</h4>
                <h4 style="margin: 0">Ruangan : '.$ruangan[0]->nama_ruangan.' lantai '.$ruangan[0]->lantai.'</h4>
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
            $tbl.='
                <tr>
                    <td style="text-align:center">'.date('d-m-Y',strtotime($val->tanggal)).'</td>
                    <td style="text-align:center">'.$val->sts_ac_pagi.'</td>
                    <td style="text-align:center">'.$val->temp_pagi.'</td>
                    <td>'.$val->pic_pagi.'</td>
                    <td>'.$val->keterangan_pagi.'</td>
                    <td style="text-align:center">'.$val->sts_ac_malam.'</td>
                    <td style="text-align:center">'.$val->temp_malam.'</td>
                    <td>'.$val->pic_malam.'</td>
                    <td>'.$val->keterangan_malam.'</td>
                </tr>
            ';
        }
        $tbl.='</table>';

        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('Laporan '.$bagian.'.pdf', 'I');
    }

    function ups()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bagian = $this->input->post('bagian');

        $data_UPS = $this->DataUPS->get($bulan,$tahun);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('SCHEDULE CHECKLIST '.$bagian);
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
        $i=0;
        $judul='
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">FORM CLEANING & CHECKLIST '.$bagian.'</h3>
                <h4 style="margin: 0">PERIODE : '.date('F',mktime(0, 0, 0, $bulan, 10)).' '.$tahun.'</h4>
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
            $tbl.='
                <tr>
                    <td style="text-align:center">'.date('d-m-Y',strtotime($val->tanggal)).'</td>
                    <td>'.$val->lokasi.'</td>
                    <td>'.$val->merk.'</td>
                    <td>'.$val->type.'</td>
                    <td style="text-align:center">'.$val->input.'</td>
                    <td style="text-align:center">'.$val->output.'</td>
                    <td style="text-align:center">'.$val->baterai_time.'</td>
                    <td>'.$val->petugas.'</td>
                    <td>'.$val->keterangan.'</td>
                </tr>
            ';
        }
        $tbl.='</table>';

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
        $pdf->Output('Laporan '.$bagian.'.pdf', 'I');
    }

    function cctv()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $shift = $this->input->post('shift');
        $bagian = $this->input->post('bagian');

        $data_CCTV = $this->DataCCTV->getCCTV($bulan,$tahun,$shift);

        $pdf = new TCPDF('L', 'mm', 'legal', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN PENGECEKAN '.$bagian.' AREA OPERASIONAL');
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
        $i=0;
        $judul='
            <div style="text-align:center;line-height: normal">
                <h4 style="margin: 0">LAPORAN PENGECEKAN '.$bagian.' AREA OPERASIONAL</h4>
                <h4 style="margin: 0">PT. INFOMEDIA NUSATARA</h4>
                <h4 style="margin: 0">JL. A YANI NO. 11 MALANG</h4>
                <h4 style="margin: 0">PERIDODE : '.date('F',mktime(0, 0, 0, $bulan, 10)).' '.$tahun.'</h4>
                <h4 style="margin: 0">SHIFT : '.$shift.'</h4>
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
            $tbl .= '<th>'.$i.'</th>';
        }
        $loop = 0;
        $no = 1;
        $tbl .= '</tr>';
        foreach ($data_CCTV as $key => $value) {
            $tbl.='
                <tr>';
            if ($loop == 0 || $loop == 2 || $loop == 4) {
                $tbl .= '<td rowspan="2" style="text-align:center">'.$no.'</td>';
                $tbl .= '<td rowspan="2" style="text-align:center">'.$value->lantai.'</td>';
                $no++;
            }
            $tbl.='
                <td style="text-align:center">'.$value->nama_ruangan.'</td>';
            for ($j = 1; $j <= 31; $j++) {
                if ($j < 10) {
                    $tgl = '0'.$j;
                } else {
                    $tgl = $j;
                }
                $kondisi = eval('return $value->'.('tgl'.$tgl).';');
                $tbl .= '<td style="text-align:center">'.(($kondisi != '')?(($kondisi == 'baik')?'&#x2713;':'x'):' ').'</td>';
            } 
            $tbl.='
                    <td>'.$value->keterangan.'</td>
                </tr>
            ';
            $loop++;
        }
        $tbl.='</table>';

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
        $pdf->Output('Laporan '.$bagian.'.pdf', 'I');
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */