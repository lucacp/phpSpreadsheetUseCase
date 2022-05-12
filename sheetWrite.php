<?php

require './vendor/autoload.php';
include 'formatSheet.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function sheetWrite($dados,$name){

  $products   = [];
  $linhaAtual = 1;
  for($planilha=0; $planilha < count($dados);$planilha++){
    $format    = explode('|',formatOfTable(explode('.',$name[$planilha])[0]));
    $nLines    = count($dados[$planilha]);
    $nColumn   = count($format);
    
    for($j=0; $j < $nLines;$j++){ $products = array_merge( $products, explode(' ',$dados[$j][1])[0] ); }

  }
  
  $planilhas = count($products);
  
  for($i=0;$i < $planilhas;$i++){
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet("planilha ".$name[$planilha]);
    
    $sheet->setCellValue('A'.$linhaAtual++,'~~ '.$products[$i].' ~~');
    
    for( $j=0 ; $j < $nColumn ; $j++ ){
      $sheet->setCellValue('A'.($i+$linhaAtual), $dados[$planilha][$i][$j] );
    }
  
    $writer = new Xlsx($spreadsheet);
    $writer->save($products[$i].'.xlsx');
  }
  
  
    
}
