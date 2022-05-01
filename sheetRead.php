<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$inputFileNameInit = './Tabela ';
$tabelas = [
  'Costa.xlsx','Elmar.xlsx','Granne Alimentos.xlsx','Jandira.pdf','JTC.xlsx',
  'Leryc.xlsx','Mundo Safra.xlsx','Polico.xlsx','Prima Frutta.xlsx','Quinta Semente.xlsm',
  'R Moura.xlsx','Tainá Alimentos.xlsx'
];
// $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNameInit.$tabelas[0]);

// $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
$spreadsheet = $reader->load($inputFileNameInit.$tabelas[0]);
$spreadData   = $spreadsheet->getActiveSheet()->toArray(null,true,true,true);
// var_dump($spreadData);
// var_dump($spreadsheet);
for($i=31;$i<180;$i++){
  echo PHP_EOL;
  echo $spreadData[$i]['B'].'-'.$spreadData[$i]['C'].'_'.$spreadData[$i]['D'].'_'.$spreadData[$i]['E'].'_'
      .$spreadData[$i]['F'].'_'.$spreadData[$i]['G'].'_'.$spreadData[$i]['H'].'_'.$spreadData[$i]['I'].'_'
      .$spreadData[$i]['J'];
}