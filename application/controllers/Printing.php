<?php
defined('BASEPATH') or exit('No direct script access allowed');

// multipages sesuai data
class Printing extends CI_Controller
{
    // Print daftar Hadir dengan database tb_durasi sebagai kolom, 
    // Tanpa header di next page 
    public function print()
    {
        $materi = "Networking";
        $periode = "1 - 7 April 2021";
        $instructor = "Nazar Firman Pratama";

        $data['peserta'] = $this->lp->getAll();
        $data['durasi'] = $this->lp->getAlldate();
        $col = count($data['durasi']);
        $colh = count($data['durasi']) * 10;

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT - 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set font
        $pdf->SetFont('helvetica', 12);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage('L');
        // Table with rowspans no thead
        $i = 0;
        $tbl = '
        <h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
        <h4 align="center">Materi ' . $materi . '</h4>
        <h4 align="center">Periode ' . $periode . '</h4>
            <table border="1" cellpadding="3">
                    <tr>
                        <td width="5%" align="center" rowspan="2"><b>No</b></td>
                        <td width="20%" align="center" rowspan="2"><b>Nama</b></td>
                        <td width="15%" align="center" rowspan="2"><b>Instansi</b></td>
                        <td width="' . $colh . '%" align="center" colspan="' . $col . '"> <b>Priode Training</b></td>

                    </tr>
                    <tr>';
        foreach ($data['durasi'] as $c) {
            $tbl .= '<td width="10%" align="center"><b>' . $c['tanggal'] . '</b></td>';
        }
        $tbl .= '</tr>
            ';
        foreach ($data['peserta'] as $r) {
            $i++;
            $tbl .= '<tr>
                <td width="5%" align="center">' . $i . '.</td>
                <td width="20%" align="center">' . $r['name'] . '</td>
                <td width="15%" align="center">' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $tbl .= '<td width="10%" align="center"><br /><br></td>';
            }
            $tbl .= '</tr>';
        }
        $tbl .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $tbl .= '<td><br><br></td>';
        }
        $tbl .= '</tr></table>';

        $pdf->writeHTML($tbl, true, false, true, false, '');

        $pdf->Output('example_051.pdf', 'I');
    }

    // Print daftar Hadir dengan database tb_durasi sebagai kolom, 
    // Dengan header di next page 
    public function printh()
    {
        $materi = "Networking";
        $periode = "1 - 7 April 2021";
        $instructor = "Nazar Firman Pratama";

        $data['peserta'] = $this->lp->getAll();
        $data['durasi'] = $this->lp->getAlldate();
        $col = count($data['durasi']);
        $colh = count($data['durasi']) * 10;

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT - 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set font
        $pdf->SetFont('helvetica', 12);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage('L');
        // Table with rowspans no thead
        $i = 0;
        $tbl = '
        <h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
        <h4 align="center">Materi ' . $materi . '</h4>
        <h4 align="center">Periode ' . $periode . '</h4>
            <table border="1" cellpadding="3">
                <thead>
                    <tr>
                        <td width="5%" align="center" rowspan="2"><b>No</b></td>
                        <td width="20%" align="center" rowspan="2"><b>Nama</b></td>
                        <td width="15%" align="center" rowspan="2"><b>Instansi</b></td>
                        <td width="' . $colh . '%" align="center" colspan="' . $col . '"> <b>Priode Training</b></td>

                    </tr>
                    <tr>';
        foreach ($data['durasi'] as $c) {
            $tbl .= '<td width="10%" align="center"><b>' . $c['tanggal'] . '</b></td>';
        }
        $tbl .= '</tr></thead>
            ';
        foreach ($data['peserta'] as $r) {
            $i++;
            $tbl .= '<tr>
                <td width="5%" align="center">' . $i . '.</td>
                <td width="20%" align="center">' . $r['name'] . '</td>
                <td width="15%" align="center">' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $tbl .= '<td width="10%" align="center"><br /><br></td>';
            }
            $tbl .= '</tr>';
        }
        $tbl .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $tbl .= '<td><br><br></td>';
        }
        $tbl .= '</tr></table>';

        $pdf->writeHTML($tbl, true, false, true, false, '');

        $pdf->Output('example_051.pdf', 'I');
    }

    // Print Daftar Hadir dengan databese tb_peserta dengan kondisi id dari kolom duration_start & duration_end pada tb_peserta
    // tanpa header di next page (full Otomatis)
    public function report($id = 1)
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
        $colheader = $col * 10;

        $materi = "Networking";
        $periode = $taw . "-" . $tak . $bln . $thn;
        $instructor = "Nazar Firman Pratama";

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 14, PDF_MARGIN_RIGHT - 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set font
        $pdf->SetFont('helvetica', 12);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage('L');

        $i = 0;
        $html = '
        <h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
        <h4 align="center">Materi ' . $materi . '</h4>
        <h4 align="center">Periode ' . $periode . '</h4>
            <table border="1" cellpadding="2">
                    <tr>
                        <td width="5%" align="center" rowspan="2"><b>No</b></td>
                        <td width="20%" align="center" rowspan="2"><b>Nama</b></td>
                        <td width="15%" align="center" rowspan="2"><b>Instansi</b></td>
                        <td width="' . $colheader . '%" align="center" colspan="' . $col . '"> <b>Priode Training</b></td>
                            ';
        $html .= '</tr>
                <tr>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td  align="center">Hari Ke-' . $j .  '</td>';
        }
        $html .= '</tr>';


        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr>
                    <td width="5%" align="center">' . $i . '.</td>
                    <td width="20%" align="center">' . $r['name'] . '</td>
                    <td width="15%" align="center">' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $html .= '<td width="10%" align="center"><br /><br></td>';
            }
            $html .= '</tr>';
        }

        $html .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td><br><br></td>';
        }
        $html .= '</tr></table>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }

    // Print Daftar Hadir dengan databese tb_peserta dengan kondisi id dari kolom duration_start & duration_end pada tb_peserta
    // Dengan header di next page (full Otomatis)
    public function reportbyheader($id = 1)
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
        $colheader = $col * 10;

        $materi = "Networking";
        $periode = $taw . "-" . $tak . $bln . $thn;
        $instructor = "Nazar Firman Pratama";

        // create new PDF document
        $pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 14, PDF_MARGIN_RIGHT - 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set font
        $pdf->SetFont('helvetica', 12);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage('L');

        $i = 0;
        $html = '
        <h3 align="center">Daftar Hadir Peserta Training Inixindo Bandung</h3>
        <h4 align="center">Materi ' . $materi . '</h4>
        <h4 align="center">Periode ' . $periode . '</h4>
            <table border="1" cellpadding="2">
                <thead>
                    <tr>
                        <td width="5%" align="center" rowspan="2"><b>No</b></td>
                        <td width="20%" align="center" rowspan="2"><b>Nama</b></td>
                        <td width="15%" align="center" rowspan="2"><b>Instansi</b></td>
                        <td width="' . $colheader . '%" align="center" colspan="' . $col . '"> <b>Priode Training</b></td>
                            ';
        $html .= '</tr>
                <tr>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td  align="center">Hari Ke-' . $j .  '</td>';
        }
        $html .= '</tr></thead>';


        foreach ($data['peserta'] as $r) {
            $i++;
            $html .= '<tr>
                    <td width="5%" align="center">' . $i . '.</td>
                    <td width="20%" align="center">' . $r['name'] . '</td>
                    <td width="15%" align="center">' . $r['instansi'] . '</td>';
            for ($j = 1; $j <= $col; $j++) {
                $html .= '<td width="10%" align="center"><br /><br></td>';
            }
            $html .= '</tr>';
        }

        $html .= '
        <tr>
            <td colspan="3" align="center">Instructor : ' . $instructor . '</td>';
        for ($j = 1; $j <= $col; $j++) {
            $html .= '<td><br><br></td>';
        }
        $html .= '</tr></table>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Daftar Peserta.pdf', 'I');
    }
}
