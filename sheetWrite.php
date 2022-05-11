<?php

require './vendor/autoload.php';
include 'formatSheet.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function sheetWrite($dados,$name){
  
  $format  = explode('|',formatOfTable(explode('.',$name)[0]));
  $products= [];
  $nLines  = count($dados);
  $nColumn = count($format);
  
  for($j=0; $j < $nLines;$j++){ $products = array_merge( $products, explode(' ',$dados[$j][1])[0] ); }
  
  $planilhas = count($products);
  
  for($i=0;$i < $planilhas;$i++){
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet("planilha ".$name);
    
    for( $i=0 ; $i < $nColumn ; $i++ ){
      $sheet->setCellValue('A'.($i+3), "=A".($i+1).'+A'.($i+2) );
    }
  
    $writer = new Xlsx($spreadsheet);
    $writer->save($products[$i].'.xlsx');
  }
  
  
    
}
