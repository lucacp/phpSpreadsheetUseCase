<?php
function tokenizeProductName($productName){
  $str     = normalizarNomeProduto($productName);
  $pattern = "/\W+/";
  return preg_split($pattern,$str)[0];
}
function normalizarNomeProduto($productName){
  $str = str_replace('ç','C',$productName);
  $str = str_replace('Á','A',$str);
  $str = str_replace('Ã','A',$str);
  $str = str_replace('À','A',$str);
  $str = str_replace('Â','A',$str);
  $str = str_replace('á','A',$str);
  $str = str_replace('ã','A',$str);
  $str = str_replace('à','A',$str);
  $str = str_replace('â','A',$str);
  $str = str_replace('É','E',$str);
  $str = str_replace('Ê','E',$str);
  $str = str_replace('é','E',$str);
  $str = str_replace('ê','E',$str);
  $str = str_replace('Ç','C',$str);
  $str = str_replace('Í','I',$str);
  $str = str_replace('Ì','I',$str);
  $str = str_replace('í','I',$str);
  $str = str_replace('ì','I',$str);
  $str = str_replace('Õ','O',$str);
  $str = str_replace('Ó','O',$str);
  $str = str_replace('Ò','O',$str);
  $str = str_replace('õ','O',$str);
  $str = str_replace('ó','O',$str);
  $str = str_replace('ò','O',$str);
  $str = str_replace('Ü','U',$str);
  $str = str_replace('Ú','U',$str);
  $str = str_replace('Ù','U',$str);
  $str = str_replace('Û','U',$str);
  $str = str_replace('ü','U',$str);
  $str = str_replace('ú','U',$str);
  $str = str_replace('ù','U',$str);
  $str = str_replace('û','U',$str);
  $str = str_replace(' (',' ',$str);
  $str = strtoupper($str);
  return $str;
}