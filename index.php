<?php

include "sheetRead.php";
include "sheetWrite.php";

$tabelas   = [
  'Costa.xlsx','Elmar.xlsx',
  'Granne Alimentos.xlsx',
  'Jandira.xlsx',
  'JTC.xlsx',
  'Leryc.xlsx',
  'Gramore.xlsx',
  'Polico.xlsx','Prima Frutta.xlsx',
  'R Moura.xlsx'
];
$planilhas = [];
for($i=0;$i<count($tabelas);$i++){
  $dados  = sheetRead( $tabelas[$i] );
  array_push( $planilhas , $dados );
}
sheetWrite(dados:$planilhas,name:$tabelas);
