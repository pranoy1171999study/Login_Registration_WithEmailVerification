<?php
$secret=$_POST['secret'];
$response=$_POST['response'];
$url="https://www.google.com/recaptcha/api/siteverify";

$postdata = http_build_query(
    array(
        'secret' => $secret,
        'response' => $response
    )
);
$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
$context = stream_context_create($opts);
$result = file_get_contents($url, false, $context);

echo $result;
?>