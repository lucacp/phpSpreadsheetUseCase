<?php

require './vendor/autoload.php';
include_once 'formatSheet.php';
include_once 'sort.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function sheetWrite($dados,$name){

  $products     = [];
  $linhaProdutos= [];
  $linhaAtual   = 1;
  for( $planilha = 0; $planilha < count($dados);$planilha++){
    
    //$format       = explode('|',formatOfTable(explode('.',$name[$planilha])[0]));
    $nLines       = count($dados[$planilha]);
    
    for( $linha    = 0; $linha < $nLines ; $linha++ ){ 
      //var_dump('dados[planilha][$j][1]: '.$dados[$planilha][$j][1]);
      $nome         = explode(' ',$dados[$planilha][$linha][1])[0];
      $products     = array_unique(array_merge($products,array($nome)));
      $id           = array_search($nome,$products);

      array_push($linhaProdutos,array('id'=>$id,'planilha'=>$planilha,'linha'=>$linha));
    }
  }
  $linhaProdutos= merge_sortKey($linhaProdutos,'id');
  $planilhas    = count($products);
  $linhasTotais = count($linhaProdutos);
  $colunas      = ['A','B','C','D','E','F','G','H','I','J'];
  for(  $produto = 0, $linha = 0  ; $produto < $planilhas ; $produto++,$linhaAtual=1){
    
    $spreadsheet  = new Spreadsheet();
    $sheet        = $spreadsheet->getActiveSheet();
    $sheet->setCellValue(
      'A'.$linhaAtual,
      '~'.$products[$produto].'~'
    );
    $linhaAtual++;
    $id           = $linhaProdutos[$linha]['id'];

    for(      ; $linha < $linhasTotais && $id == $produto ; $linha++, $linhaAtual++ ){
    
      $planilha     = $linhaProdutos[$linha]['planilha'];
      $line         = $linhaProdutos[$linha]['linha']; 
    
      for(      $col = 0 ; $col < count($colunas) && $dados[$planilha][$line][$col]!=null ; $col++ ){

        $cell = $dados[$planilha][$line][$col];
        $sheet->setCellValue(
          $colunas[$col].($linhaAtual), 
          $col==0?(
            explode('.',$name[$planilha])[0].': '.($cell!=null?$cell:'')
          ):($cell!=null?$cell:'') 
        );
      }
      $id       = $linhaProdutos[$linha+1]['id'];
      //echo PHP_EOL;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('.\\planilhas\\'.$products[$produto].'.xlsx');
  }
      
}
