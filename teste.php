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
$fileName = 'Lista '.'Polico.xlsx';
$reader = new Reader\Xlsx();
$reader->setReadDataOnly(TRUE);
$spreadsheet  = $reader->load($fileName);
$spreadData   = $spreadsheet->getActiveSheet();
$colunas      = ["A","B","C","D","E","F","G","H","I"];
$conteudo = false;
for( $i = 1 ; $i < 800 ; $i++ ){
  $line = "";
  foreach ($colunas as $col) {
    $cell = $col.$i;
    $dataCell = $spreadData->getCell($cell);
    $line .=' '.$dataCell;
    echo "$cell: ".$dataCell;
  }
  if(!$conteudo && preg_filter("/Código/", null,$line)) { $conteudo = true; }
  if($conteudo && strlen($line) < 15) break;
} 