<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './pontos.provider.php';
include_once '../db/db.provider.php';

try {

    $data = json_decode(file_get_contents('php://input'));

    $line = $data->line;
    $audio_link =  $data->audio_link;
    $lyric = $data->lyric;
    $rythm = $data->rythm;
    $type = $data->type;
    $title = $data->title;
    $errors = array();

    // echo "\nline: ".$line;
    // echo "\naudio_link: ".$audio_link;
    // echo "\nlyric: ".$lyric;
    // echo "\nrythm: ".$rythm;
    // echo "\ntype: ".$type;
    // echo "\ntitle: ".$title;

    if (!isset($line)) {
        array_push($errors, array('line' => 'line property is required.'));
    }
    if (!isset($lyric)) {
        array_push($errors, array('lyric' => 'lyric property is required.'));
    }
    if (!isset($rythm)) {
        array_push($errors, array('rythm' => 'rythm property is required.'));
    }
    if (!isset($type)) {
        array_push($errors, array('type' => 'type property is required.'));
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(array("errors" => $errors));
        return;
    }

    $db = new DBClass();
    $connection = $db->getConnection();
    $Pontos = new PontosProvider($connection);

    if (!$Pontos->validateLine($line)) {
        array_push($errors, array('line' => 'Invalid line property.'));
    }
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(array("errors" => $errors));
        return;
    }

    $data = $Pontos->create($audio_link, $line, $lyric, $rythm, $type, $title);
    echo json_encode($data);
} catch (\Exception $e) {
    http_response_code(400);
    echo json_encode(array('errors' => $e->getMessage()));
}
