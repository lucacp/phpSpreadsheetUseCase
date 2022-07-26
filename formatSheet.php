<?php
function formatOfTable($name){
  $tabela = [
             'Costa'=>['codigo'=>'A','produto'=>'B','origem'=>'C','embalagem'=>'D','unidade'=>'E','preco'=>'I'],
             'Elmar'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
  'Granne Alimentos'=>['codigo'=>'A','produto'=>'B','origem'=>'C','embalagem'=>'C','unidade'=>'D','preco'=>'F'],
               'JTC'=>['codigo'=>'A','produto'=>'B','origem'=>'A','embalagem'=>'H','unidade'=>'I','preco'=>'D'],
    //   'Mundo Safra'=>['codigo'=>'A','produto'=>'B','origem'=>'H','embalagem'=>'C','unidade'=>'C','preco'=>'F'],
           'Jandira'=>['codigo'=>'A','produto'=>'B','origem'=>'C','embalagem'=>'E','unidade'=>'F','preco'=>'D'],
             'Leryc'=>['codigo'=>'A','produto'=>'B','origem'=>'H','embalagem'=>'C','unidade'=>'C','preco'=>'G'],
      'Prima Frutta'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
            'Polico'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'F','preco'=>'E'],
             'Magui'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'D','preco'=>'E'],
    'Quinta Semente'=>['codigo'=>'A','produto'=>'C','origem'=>'J','embalagem'=>'B','unidade'=>'F','preco'=>'E'],  
           'R Moura'=>['codigo'=>'A','produto'=>'B','origem'=>'G','embalagem'=>'C','unidade'=>'D','preco'=>'F'],
      'Suprema Caju'=>['A','B','C','E','F','G'],
  ];
  $nome = explode('.',$name)[0];
  return $tabela[$nome];
}
function formatedData($column,$data){
  $dataRet = [];
  $colunas = ['codigo','produto','embalagem','unidade','preco','origem'];
  $ncol    = count($colunas);
  $nData   = count($data); 
  for( $i = 10 ; $i < 2500 && $i < $nData ; $i++){
    $linha = '';
    $empty = true;
    for( $j = 0 ; $j < $ncol ; $j++ ){
      $nome  = $colunas[$j];
      $coluna= $column[$nome];
      if($data[$i][$coluna]!=null){
        $cell  = $data[$i][$coluna];
        //print("$coluna:$i: $cell".PHP_EOL);
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
function formatPDF($dados){
  //echo 'FormatPDF'.PHP_EOL;
  $formato = [0,1,2,5,6,3];
  $array = [];
  $total = count($dados);
  var_dump($dados);
  for( $i = 0 ; $i < $total ; $i++){
    $linha = preg_replace("/ +/", " ", $dados[$i]);
    $linha = explode("_",$linha);
    $nova  = [];
    for( $j = 0 ; $j < count($linha) ; $j++ ){
      $k = $formato[$j];
      if($linha[$k]=="R$ ") continue;
      array_push($nova,$linha[$k]); 
    }
    array_push($array,$nova); 
  }
  return $array;
}