<?php
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Mypdf extends TCPDF
{

    function __construct()
    {
        parent::__construct();
    }
}
