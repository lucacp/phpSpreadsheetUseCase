<?php

include "sheetRead.php";
include "sheetWrite.php";

$tabelas   = [
  'Costa.xlsx','Elmar.xlsx',
  //'Granne Alimentos.xlsx',
  'Magui.xlsx',
  //'Jandira.pdf',
  'JTC.xlsx',
  'Leryc.xlsx','Mundo Safra.xlsx','Polico.xlsx','Prima Frutta.xlsx','Quinta Semente.xlsx',
  'R Moura.xlsx',
  //'Tainá Alimentos.xlsx'
];
$planilhas = [];
for($i=0;$i<count($tabelas);$i++){
  $dados  = sheetRead( $tabelas[$i] );
  array_push( $planilhas , $dados );
}
sheetWrite(dados:$planilhas,name:$tabelas);
