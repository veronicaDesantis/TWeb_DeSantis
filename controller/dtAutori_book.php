<?php
include '../model/query.php';

/**
 * dtAutori_book.php
 * 
 * Restituisce i dati per una datatable di dettaglio
 * 
 */

$qry = new Query;
$array = $qry->GetDataTableAutori_Book(); 
$json =	["sEcho" => 1,
    "iTotalRecords" => count($array),
    "iTotalDisplayRecords" => count($array),
    "aaData" => $array];
echo json_encode($json);
?>