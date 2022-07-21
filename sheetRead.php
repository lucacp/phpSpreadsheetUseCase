<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;

include_once 'formatSheet.php';

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
    return formatedData(column:formatOfTable(name:$inputFileName),data:$spreadData);
  }catch(Exception $e){
    $ret = [];
    exec(command:"node sheetReadPDF.js",output:$ret);
    var_dump($ret);
    return $ret;
  }
}
