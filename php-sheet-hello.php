<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet("planilha 1");
$sheet->setCellValue('A1', '0');
$sheet->setCellValue('A2', '1');
for($i=0;$i<20;$i++){
	$sheet->setCellValue('A'.($i+3), "=A".($i+1).'+A'.($i+2) );
}

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');