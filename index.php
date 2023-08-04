<?php
header("Content-Type: application/json; charset=UTF-8");
include_once './db/db.provider.php';
include_once './pontos/pontos.provider.php';

$db = new DBClass();
$connection = $db->getConnection();
$Pontos = new PontosProvider($connection);

$data = $Pontos->getData();
echo json_encode($data);
