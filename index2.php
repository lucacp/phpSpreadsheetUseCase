<?php

require __DIR__.'/vendor/autoload.php';

include "sheetRead.php";
include "sheetWrite.php";

$tabelas   = [
  'Costa.xlsx','Elmar.xlsx',
  'Granne Alimentos.xlsx',
  'Jandira.xlsx',
  'JTC.xlsx',
  'Leryc.xlsx',
  'Gramore.xlsx',
  'Polico.xlsx',
  'R Moura.xlsx','Iberica.xlsx','Reino Alimentos.xlsx'
];
$planilhas = [];

for($i=0;$i<count($tabelas);$i++){
  $dados  = sheetRead2( $tabelas[$i] );
  //var_dump($dados);
  array_push( $planilhas , $dados );
}
sheetWrite2(dados:$planilhas,tabelas:$tabelas);
