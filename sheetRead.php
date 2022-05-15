<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;
use Spatie\PdfToText\Pdf;

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
    /*$arq = (new Pdf('vendor/spatie/pdfToText/Pdf'))
    ->setPdf($FileName)
    ->text();
    return $arq;*/
    var_dump($e);
  }
}
