<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('DataPC');
    }

    function lol()
    {
        $this->load->view('Laporan/pc');
    }
    
    function index(){
        $bulan = $this->input->post('bulan');
        $shift = $this->input->post('shift');
        $bagian = $this->input->post('bagian');

        $data_PC = $this->DataPC->get($bulan);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('LAPORAN PENGECEKAN & CHECKLIST '.$bagian);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTopMargin(5);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        // $pdf->SetHeaderData(base_url('assets/gambar/ish.jpg'), PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $pdf->Image(base_url('assets/gambar/ish.jpg'), '', 15, 40, 15);
        // $pdf->Write();
        $i=0;
        $judul='
            <div style="text-align:center;line-height: normal">
                <h3 style="margin: 0">FORM CLEANING & CHECKLIST '.$bagian.'</h3>
                <h4 style="margin: 0">Bulan : '.date('F',mktime(0, 0, 0, $bulan, 10)).'</h4>
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
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */