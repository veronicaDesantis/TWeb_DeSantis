<?php
include '../model/query.php';

/**
 * dtTag_book.php
 * 
 * Restituisce i dati per una datatable
 * 
 */

$qry = new Query;
$array = $qry->GetDataTableTag(); 
$json =	["sEcho" => 1,
    "iTotalRecords" => count($array),
    "iTotalDisplayRecords" => count($array),
    "aaData" => $array];
echo json_encode($json);
?>