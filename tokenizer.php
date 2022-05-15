<?php
function tokenizeProductName($productName){
  $str     = normalizarNomeProduto($productName);
  $pattern = "/\W+/";
  return preg_split($pattern,$str)[0];
}
function normalizarNomeProduto($productName){
  $str = str_replace('ç','c',$productName);
  $str = str_replace('Á','A',$str);
  $str = str_replace('Ã','A',$str);
  $str = str_replace('À','A',$str);
  $str = str_replace('Â','A',$str);
  $str = str_replace('á','a',$str);
  $str = str_replace('ã','a',$str);
  $str = str_replace('à','a',$str);
  $str = str_replace('â','a',$str);
  $str = str_replace('É','E',$str);
  $str = str_replace('Ê','E',$str);
  $str = str_replace('é','e',$str);
  $str = str_replace('ê','e',$str);
  $str = str_replace('Ç','C',$str);
  $str = str_replace('Í','I',$str);
  $str = str_replace('Ì','I',$str);
  $str = str_replace('í','i',$str);
  $str = str_replace('ì','i',$str);
  $str = str_replace('Õ','O',$str);
  $str = str_replace('Ó','O',$str);
  $str = str_replace('Ò','O',$str);
  $str = str_replace('õ','o',$str);
  $str = str_replace('ó','o',$str);
  $str = str_replace('ò','o',$str);
  $str = str_replace('Ü','U',$str);
  $str = str_replace('Ú','U',$str);
  $str = str_replace('Ù','U',$str);
  $str = str_replace('Û','U',$str);
  $str = str_replace('ü','u',$str);
  $str = str_replace('ú','u',$str);
  $str = str_replace('ù','u',$str);
  $str = str_replace('û','u',$str);
  $str = str_replace(' (',' ',$str);
  $str = strtoupper($str);
  return $str;
}