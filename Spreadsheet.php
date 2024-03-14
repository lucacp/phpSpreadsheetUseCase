<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader;

class Spreadsheet
{
	protected $spreadsheet;
	//protected function save($fileName){}
	//protected function load($fileName){}
};

class XlsxSpreadsheet extends Spreadsheet
{
	private $xlsxReader;
	
	function __construct(){
		$this->xlsxReader = new Reader\Xlsx();
	}

	function load($fileName){
		$this->xlsxReader->setReadDataOnly(TRUE);
		$loader = $this->xlsxReader->load($fileName);
		$this->spreadsheet = $loader->getActiveSheet();
	}
	function readActiveSheet(){
		$colunas = range("A","M");
		//print_r($colunas);
		$response = [];
		$nCol = count($colunas);
		for($line = 1; $line < 2000; $line++){
			$linha = '';
			for( $col = 0; $col < $nCol; $col++){
				$cell = $colunas[$col].''.$line;
				//echo $cell,' ';
				$retorno = $this->spreadsheet->getCell($cell)->getCalculatedValue();
				if($col == 0)
					$linha.= strlen($retorno)>2?$retorno:'_';
				else
					$linha.= strlen($retorno)>2?'|'.$retorno:'|';
			}
			//echo $linha,' ';
			if(strlen($linha)>13){
				array_push($response,$linha);
			}
		}
		return $response;
	}
};

$teste = new XlsxSpreadsheet();
$teste->load("./Lista Costa.xlsx");
$response = $teste->readActiveSheet();
print_r($response);
unset($teste);