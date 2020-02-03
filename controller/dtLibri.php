<?php
include '../model/query.php';

/**
 * dtLibri.php
 * 
 * Restituisce i dati per una datatable di anagrafica
 * 
 */

$qry = new Query;
$array = $qry->GetDataTableLibri(); 
$json =	["sEcho" => 1,
    "iTotalRecords" => count($array),
    "iTotalDisplayRecords" => count($array),
    "aaData" => $array];
echo json_encode($json);
?>