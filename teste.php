<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;
/* 'Costa.xlsx','Elmar.xlsx',
  'Granne Alimentos.xlsx',
  'Jandira.xlsx',
  'JTC.xlsx',
  'Leryc.xlsx',
  'Gramore.xlsx',
  'Polico.xlsx','Prima Frutta.xlsx','R Moura.xlsx'
*/
$fileName = 'Lista '.'Costa.xlsx';
$reader = new Reader\Xlsx();
$reader->setReadDataOnly(TRUE);
$spreadsheet  = $reader->load($fileName);
$spreadData   = $spreadsheet->getActiveSheet();
$colunas      = ["A","B","C","D","E","F","G","H","I","J","K","L"];
$conteudo = false;
//echo '-------------------------------------------------'.PHP_EOL;
$arrayLine = [];
for( $i = 1 ; $i < 800 ; $i++ ){
  $line = "";
  for ( $j = 0 ; $j < 12 ; $j++ ) {
    $cell = $colunas[$j].$i;
    $dataCell = $spreadData->getCell($cell);
    $lengthDataCell = strlen($dataCell);
    if( $lengthDataCell < 150 ){
      $line .='|'.$dataCell;
    }
  }
  //echo 
  array_push($arrayLine,strlen($line)>13?("$i:".$line. PHP_EOL):'');
  
  if(!$conteudo && preg_filter("/ICMS/",'',$line)) { $conteudo = true; }
  if($conteudo && strlen($line) < 15) break;
}
/* foreach($arrayLine as $line){
  echo $line;
}; */
//echo '-------------------------------------------------'.PHP_EOL;
