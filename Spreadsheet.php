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
		//$this->xlsxReader->setRead;
		$loader = $this->xlsxReader->load($fileName);
		$this->spreadsheet = $loader->getActiveSheet();
	}
	function readActiveSheet(){
		$colunas = range("A","M");
		//print_r($colunas);
		$response = [];
		$nCol = count($colunas);
		$dataArray = $this->spreadsheet->rangeToArray(('A1:'.$colunas[$nCol-1].'2000'),'',TRUE,FALSE,TRUE);
		//var_dump($dataArray); //die();
		
		for($line = 1; $line < 2000 ; $line++){
			$linha = $line.'|';
			for( $col = 0; $col < $nCol; $col++){
				$cell = $colunas[$col];
				//echo $cell,' ';
				$retorno = $dataArray[$line][$cell];
				
				//die(file_put_contents('output.txt', var_dump($dataArray));
				if($col == 0)
					$linha.= strlen($retorno)>8?$retorno:'_';
				else
					$linha.= strlen($retorno)>0?'|'.$retorno:'|';
			}
			//echo $linha,' ';
			if(strlen($linha)>19){
				array_push($response,$linha);
				$linha = null;
			}
		}
		$dataArray = null;
		$this->spreadsheet = null;
		return $response;
	}
};

$tabelas   = [
  'Almaromi Viccino.xlsx',
  'Amazon Brazil.xlsx',
  'Bantó.xlsx',
  'Brasbol.xlsx',
  'Brasil Ervas.xlsx',
  'Brasnutt.xlsx',
  'Ceará Amêndoas.xlsx',
  'Costa.xlsx',
  'CS Castanhas.xlsx',
  'Divinut.xlsx',
  'Elmar.xlsx',
  'Gramore.xlsx',
  'Granne Alimentos.xlsx',
  'Ibérica.xlsx',
  'Icau.xlsx',
  'Jandira.xlsx',
  'JTC.xlsx',
  'Labela Semente.xlsx',
  'Leryc.xlsx',
  'Letha.xlsx',
  'Lucavi.xlsx',
  'Natural Imports.xlsx',
  'Natural Sugar.xlsx',
  'NL Aromas e Temperos.xlsx',
  'Nuttini.xlsx',
  'Polico Mg.xlsx',
  'Polico.xlsx',
  'Rei Das Castanhas.xlsx',
  'Reino Alimentos.xlsx',
  'Sacre Doux Chocolates.xlsx',
  'Salbu.xlsx',
  'Shambala.xlsx',
  'Super Natural.xlsx',
  'Suprema Caju.xlsx',
  'Vida em Grãos.xlsx',
  'Vimacedo.xlsx',
];

$teste = new XlsxSpreadsheet();	
$nTabelas = count($tabelas);
for( $i = 0 ; $i < $nTabelas ; $i++ ){
	$teste->load("./Lista ".$tabelas[$i]);
	$response = $teste->readActiveSheet();
	echo $tabelas[$i].": ";
	print_r($response);
	$response = null;
	//sleep(5);
}
$teste = null;