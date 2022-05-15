<?php
function formatOfTable($name){
  $tabela = [
             'Costa'=>['codigo'=>'A','produto'=>'B','origem'=>'C','embalagem'=>'D','unidade'=>'E','preco'=>'J'],
             'Elmar'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
   //'Granne Alimentos'=>['A','B','C','D','F'],
               'JTC'=>['codigo'=>'A','produto'=>'B','origem'=>'A','embalagem'=>'H','unidade'=>'I','preco'=>'D'],
       'Mundo Safra'=>['codigo'=>'A','produto'=>'B','origem'=>'H','embalagem'=>'C','unidade'=>'C','preco'=>'F'],
           'Jandira'=>['A','B','C','D','E','F'],
             'Leryc'=>['codigo'=>'A','produto'=>'B','origem'=>'H','embalagem'=>'C','unidade'=>'C','preco'=>'G'],
      'Prima Frutta'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
            'Polico'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
             'Magui'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'D','preco'=>'E'],
    'Quinta Semente'=>['codigo'=>'A','produto'=>'C','origem'=>'J','embalagem'=>'B','unidade'=>'F','preco'=>'E'],  
           'R Moura'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'D','preco'=>'F'],
   'Tainá Alimentos'=>['A','B','C','E','F','G'],
  ];
  $nome = explode('.',$name)[0];
  return $tabela[$nome];
}
function formatedData($column,$data){
  $dataRet = [];
  $colunas = ['codigo','produto','embalagem','unidade','preco','origem'];
  $ncol= count($colunas);
  for($i=10;$i<500;$i++){
    $linha = '';
    $empty = true;
    for( $j = 0 ; $j < $ncol ; $j++ ){
      $nome  = $colunas[$j];
      $coluna= $column[$nome];
      $cell  = $data[$i][$coluna];
      if(!($cell==null)){
        $linha.= $j>0?('|'.$cell):($cell);
        $empty = false;
      }
    }
    $empty!=true?array_push($dataRet,explode('|',$linha)):'';
    $linha = null;
  }
  return $dataRet;
}
function lengthOfTable($name){
  return count(formatOfTable($name));
}