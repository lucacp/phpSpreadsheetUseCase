<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;

include_once 'formatSheet.php';

function sheetRead($inputFileName){
  $FileName = './Lista '.$inputFileName;
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

function sheetRead2($inputFileName){
  $FileName = './Lista '.$inputFileName;
  // $reader = new Reader\Xls();
  $reader = new Reader\Xlsx();
  $reader->setReadDataOnly(TRUE);
  $ext = explode('.',$inputFileName)[1];
  if( $ext == 'xlsx' ){
    $spreadsheet  = $reader->load($FileName);
    $spreadData   = $spreadsheet->getActiveSheet();
    $dataRet = [];
    $colunas = ["A","B","C","D","E","F","G","H","I","J","K","L","M"];
    $ncol    = count($colunas); 
    $dataIn  = false;
    for( $i = 1 ; $i < 2000 ; $i++){
      $line = '';
      for( $j = 0 ; $j < $ncol ; $j++ ){
        $cell = $colunas[$j].$i;
        $cellData= $spreadData->getCell($cell);
        if(preg_filter("/=/",'',$cellData)) 
          $cellData = $spreadData->getCell($cell)->getCalculatedValue();
        $lengthCellData = strlen($cellData);
        if($lengthCellData < 150){
          $line  .= '|'.$cellData;
        }
      };
      //echo "$i:".$line.PHP_EOL;
      strlen($line)>19?array_push($dataRet,("$i".$line)):'';

      if(!$dataIn && preg_filter("/ICMS/",'',$line)) { $dataIn = true; }
      if( $dataIn && strlen($line) < 20 ) {
        $dataIn = false; 
        break;
      };
    }
    return $dataRet;
  }
}