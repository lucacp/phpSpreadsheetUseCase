<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;

class Spreadsheet
{
	protected function save($fileName){}
	protected function load($fileName){}
}

class XlsxSpreadsheet extends Spreedsheet
{
	private $xlsxReader;
	
	function __construct(){
		$this->xlsxReader = new Reader\Xlsx();
	}

	protected function load($fileName){
		$this->xlsxReader->setReadDataOnly(TRUE);
		$loader = $this->xlsxReader->load($fileName);

	}
}