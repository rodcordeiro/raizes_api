<?php

header("Content-Type: application/json; charset=UTF-8");
include_once './pontos.provider.php';
include_once '../db/db.provider.php';

$line = $_GET['line'];
if (!isset($line)) {
    http_response_code(400);
    echo json_encode(array('error' => 'Must provide line id as query param'));
} else {
    $db = new DBClass();
    $connection = $db->getConnection();
    $Pontos = new PontosProvider($connection);
    $data = $Pontos->filterByLine($line);
    echo json_encode($data);
}
