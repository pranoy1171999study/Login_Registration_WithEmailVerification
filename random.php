<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

$mail = $data['mail'];
$v_code=rand(100000,999999);

echo  json_encode($v_code);


?>
