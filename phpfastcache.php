<?php

require './vendor/autoload.php';

/// start of PSR-16-adapter phpfastcache/phpfastcache
use Phpfastcache\Helper\Psr16Adapter;

$defaultDriver = 'Files';
$cache = new Psr16Adapter($defaultDriver);

/*if(!$Psr16Adapter->has('test-key')){
    // Setter action
    $data = 'lorem ipsum';
    $Psr16Adapter->set('test-key', 'lorem ipsum', 300);// 5 minutes
}else{
    // Getter action
    $data = $Psr16Adapter->get('test-key');
}*/
/// end of PSR-16-adapter phpfastcache/phpfastcache

/*
//echo $Psr16Adapter->has('test-key') . PHP_EOL;
echo $Psr16Adapter->get('test-key') . PHP_EOL;
$Psr16Adapter->set('test-key','Bankai',15) . PHP_EOL;
//echo $Psr16Adapter->has('test-key') . PHP_EOL;
echo $Psr16Adapter->get('test-key') . PHP_EOL;
sleep(5);
echo $Psr16Adapter->get('test-key') . PHP_EOL;
sleep(5);
echo $Psr16Adapter->get('test-key') . PHP_EOL;
sleep(5);
echo $Psr16Adapter->get('test-key') . PHP_EOL;
*/