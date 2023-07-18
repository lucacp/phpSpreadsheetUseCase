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

//echo '-------------------------------------------------'.PHP_EOL;
$arrayLine = [];
$strings = new SplMaxHeap();
for( $i = 1 ; $i < 800 ; $i++ ){
  $line = "";
  for ( $j = 0 ; $j < 12 ; $j++ ) {
    $cell = $colunas[$j].$i;
    $dataCell = $spreadData->getCell($cell)->getCalculatedValue();
    $lengthDataCell = strlen($dataCell);
    if( $lengthDataCell > 5 ){
      $line .='|'.$dataCell;
      $strings->insert([''.$dataCell=>$lengthDataCell]);
    }
    
  }
  //echo 
  array_push($arrayLine,strlen($line)>13?("$i:".$line. PHP_EOL):'');
  
}
for($strings->top() ; $strings->valid(); $strings->next()){
  list($string, $lenght) = [key($strings->current()),current($strings->current())];
  echo $string.': '.$lenght . PHP_EOL;
}
//echo '-------------------------------------------------'.PHP_EOL;
