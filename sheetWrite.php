<?php

require './vendor/autoload.php';
include_once 'formatSheet.php';
include_once 'tokenizer.php';
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
      $nome         = tokenizeProductName( $dados[$planilha][$linha][1]);
      $products     = array_unique( array_merge( $products, array($nome) ) );
      $id           = array_search( $nome, $products );

      array_push(
        $linhaProdutos,
        array(
          'id'=>$id,
          'planilha'=>$planilha,
          'linha'=>$linha,
          'colunas'=>lengthOfTable($name[$planilha])
        )
      );
    }
  }
  $linhaProdutos= merge_sortKey($linhaProdutos,'id');
  $planilhas    = count($products);
  $linhasTotais = count($linhaProdutos);
  $colunas      = ['A','B','C','D','E','F','G'];
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
      $countColunas = count($colunas)-1;
      //$colunasLength= $linhaProdutos[$linha]['colunas'];
      for(      $col = 0 ; $col < $countColunas ; $col++ ){
        $cell = $dados[$planilha][$line][$col]!=NULL?$dados[$planilha][$line][$col]:' ';
        $sheet->setCellValue(
          ''.$colunas[$col].($linhaAtual), 
          $col==0?( explode('.',$name[$planilha])[0].': '.$cell ):$cell 
        );
      }
      $id  = $linhaProdutos[$linha+1]['id'];
      //$colunasLength= $linhaProdutos[$linha+1]['colunas'];

      //echo PHP_EOL;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('.\\planilhas\\'.$products[$produto].'.xlsx');
  }
  $linhaProdutos=null;
  unset($linhaProdutos);
  $products = null;
  unset($products);
  $dados = null;
  unset($dados);   
}
 
function sheetWrite2($dados,$tabelas){
  $products     = [];
  $linhaProdutos= [];
  $numDados     =  count($dados);
  for( $planilha = 0; $planilha < $numDados ; $planilha++ ){
    $numLines      = count($dados[$planilha]);
    $numColumnName = 1;
    //$boolColumnName= false;
    for( $numLine = 0; $numLine < $numLines ; $numLine++ ){
      $line  = $dados[$planilha][$numLine];
      $split = explode("|",$line);
      $first= '';
      //echo $line.PHP_EOL;
      $intIsNumber = (int)$split[$numColumnName];
      if($intIsNumber>0) $intIsNumber = (int)$split[$numColumnName++];
      $nameProduct = tokenizeProductName($split[$numColumnName]);
      $first = $nameProduct;
      $products = array_unique( array_merge( $products, array($first) ) );
      $id       = array_search( $first,$products);
      //echo $first.",id: $id; ";
      $split    = null;
      //echo $id.', '.$planilha.', '.$numColumnName.', '.$numLine.', '.$first.PHP_EOL;
      array_push($linhaProdutos,
      array(
        'id'=>$id,
        'planilha'=>$planilha,
        'coluna'=>$numColumnName,
        'linha'=>$numLine
        )
      ); 
    }
  }
  //var_dump($products);
  
  $linhaProdutos  = merge_sortKey($linhaProdutos,'id');
  $planilhas      = count($products);
  $linhasTotais   = count($linhaProdutos);
  /* foreach($linhaProdutos as $linha){
    echo 'id: '.$linha['id'].", planilha: ".$linha['planilha'].', col: '.$linha['coluna'].', linha: '.$linha['linha'].PHP_EOL;
  } */
  $linhaAtual     = 1;
  $colunas        = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
  $countCol       = count($colunas);
  for(  $produtoId = 0, $linha = 0 ; $produtoId < $planilhas ; $produtoId++, $linhaAtual=1 ){
    $id          = $produtoId;
    $spreadsheet = new Spreadsheet();
    $sheet       = $spreadsheet->getActiveSheet();
    //$sheet->setTitle(''.$products[$produtoId]);
    $sheet->setCellValue(
      'A'.$linhaAtual++,
      '~'.$products[$produtoId].'~'
    );
    for( ; $linha < $linhasTotais && $id == $produtoId ; ++$linha,$linhaAtual++ ){
      $planilha = $linhaProdutos[$linha]['planilha'];
      $numLinha = $linhaProdutos[$linha]['linha'];
      $numColuna= $linhaProdutos[$linha]['coluna'];
      $line     = explode('|',$dados[$planilha][$numLinha]);
      for( $col = 0, $wCol = 0 ; $col < $countCol ; $col++, $wCol++ ){
        if( $col == 1 && $numColuna == 2 ) 
          ++$col;
        $cell = strlen($line[$col])>1?$line[$col]:'';
        $sheet->setCellValue(
          ''.$colunas[$wCol].$linhaAtual,
          $col==0?explode('.',$tabelas[$planilha])[0].': '.$cell:$cell
        );
      }
      $id = $linha+1<$linhasTotais?$linhaProdutos[$linha+1]['id']:$id;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('.\\planilhas\\'.$products[$produtoId].'.xlsx');
    unset($sheet);
    $spreadsheet->disconnectWorksheets();
    unset($spreadsheet);
    unset($writer);
  }
  $linhaProdutos=null;
  unset($linhaProdutos);
  $products = null;
  unset($products);
  $dados = null;
  unset($dados); 
};