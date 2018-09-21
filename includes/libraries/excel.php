<?php

namespace libraries;

require_once __DIR__.'/PHPExcel/PHPExcel.php';

class excel extends \PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }
}
