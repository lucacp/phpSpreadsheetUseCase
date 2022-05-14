<?php
function formatOfTable($name){
  $tabela = [
    'Costa'=>'A|B|C|D|E|J', 'Granne Alimentos'=>'A|B|C|D|F',    'JTC'=>'A|B|D|E|H|I',
    'Elmar'=>'A|B|C|E|F|G', 'Mundo Safra'=>'A|B|C|E|F|H',       'Jandira'=>'A|B|C|D|E|F',     
    'Leryc'=>'A|B|C|G',     'Prima Frutta'=>'A|B|C|E|F',        'Polico'=>'A|B|C|E|F|G',
    'Magui'=>'A|B|C|E|G',   'Quinta Semente'=>'A|B|C|E|F|G|J',  'R Moura'=>'A|B|C|D|F|G',
                            'Tainá Alimentos'=>'A|B|C|E|F|G',
  ];
  return $tabela[$name];
}
function formatedData($column,$data){
  $dataRet = [];
  $col = explode('|',$column);
  $ncol= count($col);
  for($i=10;$i<500;$i++){
    $linha = '';
    $empty = true;
    for($j=0;$j<$ncol;$j++){
      if(!($data[$i][$col[1]]==''||$data[$i][$col[1]]==null)){
        $linha.= $j>0?('|'.$data[$i][$col[$j]]):($data[$i][$col[$j]]);
        $empty = false;
      }
    }
    $empty!=true?array_push($dataRet,explode('|',$linha)):'';
    $linha = null;
  }
  return $dataRet;
}