<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../db/db.provider.php';
include_once './dashboard.provider.php';

$db = new DBClass();
$connection = $db->getConnection();
$Dash = new DashboardProvider($connection);

$data = $Dash->dashboard();

echo json_encode($data);
