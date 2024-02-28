<?php

$caminho = __DIR__.'/banco.sqlite';
$pdo = new PDO('sqlite:'.$caminho);
echo 'Conectei';