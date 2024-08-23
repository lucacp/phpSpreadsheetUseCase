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
		for($line = 1; $line < 2000 ; $line++){
			$linha = $line.'|';
			for( $col = 0; $col < $nCol; $col++){
				$cell = $colunas[$col].''.$line;
				//echo $cell,' ';
				$retorno = $this->spreadsheet->getCell($cell)->getCalculatedValue();
				if($col == 0)
					$linha.= strlen($retorno)>8?$retorno:'_';
				else
					$linha.= strlen($retorno)>8?'|'.$retorno:'|';
			}
			//echo $linha,' ';
			if(strlen($linha)>19){
				array_push($response,$linha);
			}
		}
		return $response;
	}
};

$tabelas   = [
  'Costa.xlsx','Elmar.xlsx',
  'Granne Alimentos.xlsx',
  'Iberica.xlsx',
  'Jandira.xlsx',
  'JTC.xlsx',
  'Leryc.xlsx',
  'Gramore.xlsx',
  'Polico.xlsx',
  'R Moura.xlsx', //leek de memoria
  'Reino Alimentos.xlsx'
];
for($i=0;$i<count($tabelas);$i++){
	$teste = new XlsxSpreadsheet();
	$teste->load("./Lista ".$tabelas[$i]);
	$response = $teste->readActiveSheet();
	echo $tabelas[$i].": ";
	print_r($response);
	$teste = null;
	$response = null;
}