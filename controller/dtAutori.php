<?php
include '../model/query.php';

/**
 * dtAutori.php
 * 
 * Restituisce i dati per una datatable di anagrafica
 * 
 */

$qry = new Query;
$array = $qry->GetDataTableAutori(); 
$json =	["sEcho" => 1,
    "iTotalRecords" => count($array),
    "iTotalDisplayRecords" => count($array),
    "aaData" => $array];
echo json_encode($json);
?>