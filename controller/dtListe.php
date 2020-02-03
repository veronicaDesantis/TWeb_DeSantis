<?php
include '../model/query.php';

/**
 * dtListe.php
 * 
 * Restituisce i dati per una datatable
 * 
 */

$id_utente = $_GET["id_utente"];
$qry = new Query;
$array = $qry->GetDataTableListe($id_utente); 
$json =	["sEcho" => 1,
    "iTotalRecords" => count($array),
    "iTotalDisplayRecords" => count($array),
    "aaData" => $array];
echo json_encode($json);
?>