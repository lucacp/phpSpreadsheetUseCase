<?php

include "sheetRead.php";

$tabelas = [
  'Costa.xlsx','Elmar.xlsx','Granne Alimentos.xlsx','Jandira.pdf','JTC.xlsx',
  'Leryc.xlsx','Mundo Safra.xlsx','Polico.xlsx','Prima Frutta.xlsx','Quinta Semente.xlsm',
  'R Moura.xlsx','Tainá Alimentos.xlsx'
];
for($i=0;$i<count($tabelas);$i++){
  $dados = sheetRead($tabelas[$i]);
  var_dump($dados);
}
