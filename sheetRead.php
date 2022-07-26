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
  $reader->setReadDataOnly(TRUE);
  $ext = explode('.',$inputFileName)[1];
  if( $ext == 'xlsx' ){
    $spreadsheet  = $reader->load($FileName);
    $spreadData   = $spreadsheet->getActiveSheet()->toArray(NULL,TRUE,TRUE,TRUE);
    return formatedData(column:formatOfTable(name:$inputFileName),data:$spreadData);
  }elseif($ext == 'pdf'){
    $ret = [];
    exec(command:"node sheetReadPDF.js",output:$ret);
    //print_r($ret);
    return formatPDF(array_slice($ret,2));
  }
}
