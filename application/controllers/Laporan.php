<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    // report simpel data 
    public function report()
    {
        // $no = 1;
        // $name = "Ihsan Miftahul Huda";
        // $instansi = "Inixindo Bandung";
        $materi = "Networking";
        $periode = "5 - 9 April 2021";

        // $nama = array(
        //     "Nama" => "ihsan",
        //     "Instansi" => "inixindo bandung",
        //     "Durasi" => "30 mnt"
        // );

        $data['peserta'] = $this->lp->getAll();

        $pdf = new TCPDF('L', 'mm', 'a4', true, 'UTF-8', false);
        $background = "./images/r.jpeg";
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->SetMargins(PDF_MARGIN_LEFT - 15, PDF_MARGIN_TOP - 29, PDF_MARGIN_RIGHT - 16);
        $pdf->Image($background, 0, 0, 297, 210, 'jpeg', '', '', true, 800, '', false, false, 0, false, false, true);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetFont('times', 12);
        $pdf->setY(40);
        $pdf->setPageMark();

        $i = 0;
        $html = '<h3 align="center">Daftar Hadir Peserta Traininginix Indo Bandung</h3>
                <h4 align="center">Materi ' . $materi . '</h4>
                <h5 align="center">Periode ' . $periode . '</h5>
                <div style="text:align:center;">    
                <table cellpadding="5" border="1" >
                        <tr>
                            <th width="8%" align="center">No</th>
                            <th width="25%" align="center">Nama</th>
                            <th width="25%" align="center">Instansi</th>
                            <th width="20%" align="center">Tanggal Mulai</th>
                            <th width="20%" align="center">Tanggal Akhir</th>
                        </tr>';
        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr bgcolor="#ffffff">
                            <td align="center" >' . $i . '</td>
                            <td style="border:1px solid black">' . $r['name'] . '</td>
                            <td style="border:1px solid black">' . $r['instansi'] . '</td>
                            <td style="border:1px solid black">' . $r['duration_start'] . '</td>
                            <td style="border:1px solid black">' . $r['duration_end'] . '</td>
                        </tr>
                        ';
        }
        $html .= '</table></div>';
        $pdf->writeHTML($html, true, false, true, false, '');

        // $pdf->SetAutoPageBreak(false, 0);
        // $pdf->SetXY(175, 170);
        // $pdf->Setmargins(0, 0, 10, FALSE);

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }

    // report Daftar Hadir tanpa database tb_durasi
    public function report1()
    {
        $materi = "Networking";
        $periode = "1 - 7 April 2021";
        $instructor = "Nazar Firman Pratama";
        $col = 7;

        $data['peserta'] = $this->lp->getAll();


        $pdf = new TCPDF('L', 'mm', 'a4', true, 'UTF-8', false);
        $background = "./images/r.jpeg";
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->SetMargins(PDF_MARGIN_LEFT - 15, PDF_MARGIN_TOP - 29, PDF_MARGIN_RIGHT - 16);
        $pdf->Image($background, 0, 0, 297, 210, 'jpeg', '', '', true, 800, '', false, false, 0, false, false, true);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetFont('times', 12);
        // // $pdf->SetY(95);
        $pdf->setY(40);

        $pdf->setPageMark();
        $i = 0;
        $html = '<h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
                <h4 align="center">Materi ' . $materi . '</h4>
                <h5 align="center">Periode ' . $periode . '</h5>
                    <div style="text:align:center;">
                    <table cellpadding="10" border="1" >
                        <tr style="border:1px solid black">
                            <th width="5%" align="center" style="border:1px solid black" rowspan="2">No</th>
                            <th align="center"  rowspan="2">Nama</th>
                            <th align="center"  rowspan="2">Instansi</th>
                            <th align="center"  colspan="' . $col . '">Periode Training</th>
                            ';
        $html .= '</tr>
                <tr>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td  align="center">' . $j . ' April</td>';
        }
        $html .= '</tr>';


        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr>
                            <td align="center" >' . $i . '</td>
                            <td >' . $r['name'] . '</td>
                            <td >' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $html .= '<td ></td>';
            }
            $html .= '</tr>';
        }

        $html .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td ></td>';
        }
        $html .= '</tr>';
        $html .= '</table></div>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }

    // report Daftar Hadir dengan database tb_durasi
    public function report2()
    {
        $materi = "Networking";
        $periode = "1 - 7 April 2021";
        $instructor = "Nazar Firman Pratama";

        $data['peserta'] = $this->lp->getAll();
        $data['durasi'] = $this->lp->getAlldate();
        $col = count($data['durasi']);


        $pdf = new TCPDF('L', 'mm', 'a4', true, 'UTF-8', false);
        $background = "./images/r.jpeg";
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->SetMargins(PDF_MARGIN_LEFT - 15, PDF_MARGIN_TOP - 29, PDF_MARGIN_RIGHT - 16);
        $pdf->Image($background, 0, 0, 297, 210, 'jpeg', '', '', true, 800, '', false, false, 0, false, false, true);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetFont('times', 12);
        // // $pdf->SetY(95);
        $pdf->setY(40);

        $pdf->setPageMark();
        $i = 0;
        $html = '<h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
                <h4 align="center">Materi ' . $materi . '</h4>
                <h5 align="center">Periode ' . $periode . '</h5>
                    <div style="text:align:center;">
                    <table cellpadding="10" border="1" >
                        <tr style="border:1px solid black">
                            <th width="5%" align="center" style="border:1px solid black" rowspan="2">No</th>
                            <th align="center"  rowspan="2">Nama</th>
                            <th align="center"  rowspan="2">Instansi</th>
                            <th align="center"  colspan="' . $col . '">Periode Training</th>
                            ';
        $html .= '</tr>
                <tr>';

        foreach ($data['durasi'] as $c) {
            $html .= '<td  align="center">' . $c['tanggal'] . '</td>';
        }
        $html .= '</tr>';


        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr>
                            <td align="center" >' . $i . '</td>
                            <td >' . $r['name'] . '</td>
                            <td >' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $html .= '<td ></td>';
            }
            $html .= '</tr>';
        }

        $html .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';

        foreach ($data['durasi'] as $c) {
            $html .= '<td ></td>';
        }
        $html .= '</tr>';
        $html .= '</table></div>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }

    // report Daftar Hadir dengan databese tb_peserta dengan kondisi id dari kolom duration_start & duration_end
    // Full otomatis Fix
    public function reportbydate($id = 1)
    {
        $data['peserta'] = $this->lp->getAll();
        $data['durasi'] = $this->lp->getAllbyid($id);

        foreach ($data['durasi'] as $d) {
            $awal = new DateTime($d['duration_start']);
            $akhir = new DateTime($d['duration_end']);
            $selisih = date_diff($awal, $akhir);
        }
        $taw = $awal->format(' d ');
        $tak = $akhir->format(' d ');
        $bln = $awal->format(' F ');
        $thn = $awal->format(' Y ');
        $col = $selisih->d + 1;

        $materi = "Networking";
        $periode = $taw . "-" . $tak . $bln . $thn;
        $instructor = "Nazar Firman Pratama";

        $pdf = new TCPDF('L', 'mm', 'a4', true, 'UTF-8', false);
        $background = "./images/r.jpeg";
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->AddPage();
        // $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetAutoPageBreak(true, 0);

        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->SetMargins(PDF_MARGIN_LEFT - 15, PDF_MARGIN_TOP - 29, PDF_MARGIN_RIGHT - 16);
        $pdf->Image($background, 0, 0, 297, 210, 'jpeg', '', '', true, 800, '', false, false, 0, false, false, true);

        $pdf->SetAutoPageBreak(false, 0);
        // $pdf->SetFont('times', 'B', 12);
        $pdf->SetFont('times', 12);
        $pdf->setY(40);

        $pdf->setPageMark();
        $i = 0;
        $html = '<h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
                <h4 align="center">Materi ' . $materi . '</h4>
                <h4 align="center">Periode ' . $periode . '</h4>
                    <div style="text:align:center;">
                    <table cellpadding="10" border="1" >
                        <tr style="border:1px solid black">
                            <th width="5%" align="center" style="border:1px solid black" rowspan="2">No</th>
                            <th align="center"  rowspan="2">Nama</th>
                            <th align="center"  rowspan="2">Instansi</th>
                            <th align="center"  colspan="' . $col . '">Periode Training</th>
                            ';
        $html .= '</tr>
                <tr>';
        for ($j = 1; $j <= $col; $j++) {
            // $html .= '<td  align="center">' . $j . $bln . '</td>';
            $html .= '<td  align="center">Hari Ke-' . $j .  '</td>';
        }
        $html .= '</tr>';


        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr>
                            <td align="center" >' . $i . '</td>
                            <td >' . $r['name'] . '</td>
                            <td >' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $html .= '<td ></td>';
            }
            $html .= '</tr>';
        }

        $html .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td ></td>';
        }
        $html .= '</tr>';
        $html .= '</table></div>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }

    public function operasi($id = 1)
    {
        $data['durasi'] = $this->lp->getAllbyid($id);

        foreach ($data['durasi'] as $d) {

            echo "Duration Start : " . $d['duration_start'] . "<br>";
            echo "Duration End : " . $d['duration_end'] . "<br>";
        }

        $awal = new DateTime($d['duration_start']);
        $akhir = new DateTime($d['duration_end']);
        $selisih = $awal->diff($akhir);
        echo $awal->format('l F Y') . "<br>";
        echo $awal->format('d F ') . "<br>";

        echo $selisih->d;
        echo " Hari";
    }

    public function multiPages()
    {

        $data['peserta'] = $this->lp->getAll();
        $n = 3;

        $pdf = new TCPDF('L', 'mm', 'a4', true, 'UTF-8', false);
        $background = "./images/r.jpeg";
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);

        for ($i = 0; $i < $n; $i++) {
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->setCellPaddings(0, 0, 0, 0);
            $pdf->SetMargins(PDF_MARGIN_LEFT - 15, PDF_MARGIN_TOP - 29, PDF_MARGIN_RIGHT - 16);
            $pdf->Image($background, 0, 0, 297, 210, 'jpeg', '', '', true, 800, '', false, false, 0, false, false, true);
        }

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }
}
