<?php

function merge_sortKey($my_array,$key){
    //$my_array = vetor a ordenar, $key = texto da chave usada para ordenar 
    if(count( $my_array ) == 1 ) return $my_array;
    $mid   =  count( $my_array ) / 2;
    $left  =  array_slice( $my_array, 0, $mid);
    $right =  array_slice( $my_array,    $mid);
    $left  =  merge_sortKey(  $left,    $key);
    $right =  merge_sortKey(  $right,   $key);
    return    mergeKey( $left,$right,   $key);
  }
  function mergeKey($left, $right,$key){
    $response = array();
    while (count($left) > 0 && count($right) > 0){
      if($left[0][$key] > $right[0][$key]){
        $response[] = $right[0];
        $right = array_slice($right , 1);
      }else{
        $response[] = $left[0];
        $left = array_slice($left, 1);
      }
    }
    while (count($left) > 0){
      $response[] = $left[0];
      $left = array_slice($left, 1);
    }
    while (count($right) > 0){
      $response[] = $right[0];
      $right = array_slice($right, 1);
    }
    return $response;
  } 
