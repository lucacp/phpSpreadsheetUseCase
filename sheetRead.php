<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;

function sheetRead($inputFileName){
  $FileName = './Tabela '.$inputFileName;
  // $reader = new Reader\Xls();
  $reader = new Reader\Xlsx();
  //    $reader = new Reader\Xml();
  //    $reader = new Reader\Ods();
  //    $reader = new Reader\Slk();
  //    $reader = new Reader\Gnumeric();
  //    $reader = new Reader\Csv();
  try{
    $spreadsheet = $reader->load($FileName);
    $spreadData   = $spreadsheet->getActiveSheet()->toArray(null,true,true,true);
    return formatedData(column:formatOfTable(name:explode('.',$inputFileName)[0]),data:$spreadData);
  }catch(Exception $e){
    var_dump($e);
  }
  
}
function formatOfTable($name){
  $tabela = [
    'Costa'=>'A|B|C|D|E|J', 'Granne Alimentos'=>'A|B|C|D|F',    'JTC'=>'A|B|D|E|H|I',
    'Elmar'=>'A|B|C|E|F|G', 'Mundo Safra'=>'A|B|C|E|F|H',       'Jandira'=>'A|B|C|D|E|F',     
    'Leryc'=>'A|B|C|G',     'Prima Frutta'=>'A|B|C|E|F',        'Polico'=>'A|B|C|E|F|G',
    'Magui'=>'A|B|C|E|G',   'Quinta Semente'=>'A|B|C|I|J|K|L',  'R Moura'=>'A|B|C|D|F|G',
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