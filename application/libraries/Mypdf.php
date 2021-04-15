<?php
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Mypdf extends TCPDF
{

    function __construct()
    {
        parent::__construct();
    }

    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        // set bacground image
        $img_file = K_PATH_IMAGES . 'r.jpeg';
        $this->Image($img_file, 0, 0,  297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}
