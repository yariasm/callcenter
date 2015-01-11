<?php

if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class My_PHPEXCEL {

   public function My_PHPEXCEL() {
       set_include_path('PHPExcel/');
       include 'PHPExcel/IOFactory.php';
       include 'PHPExcel/PHPExcel.php';
   }

}

?>