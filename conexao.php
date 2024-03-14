<?php

require __DIR__.'/vendor/autoload.php';

use PDO;

$caminho = __DIR__.'/banco.sqlite';
$pdo = new PDO('sqlite:'.$caminho);
echo 'Conectei';

Class DAO
{
	private $pdo;
	function getPdoConnection(PDO $connection){
		$this->pdo = $connection;
	}
};