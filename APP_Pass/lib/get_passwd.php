<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/encrypt.php';

global $CFG, $USER, $DB;

$token = $_POST['token'];
$platform = $_POST['platform'];

$passwd = $DB->get_record("SELECT password FROM users_platforms WHERE token = '$token' AND platformid = (SELECT id FROM platforms WHERE name = '$platform')");
$decrypt = decrypt($passwd->password, $token);

$json_pretty_string = json_encode(["token" => $token, "platformid" => $platform].',', JSON_PRETTY_PRINT);
//error_log('test' . PHP_EOL . $json_pretty_string);

file_put_contents('log.json', $json_pretty_string, FILE_APPEND);

$result = [
    'token' =>$token,
    'platform' =>$platform,
    'passwd' => $passwd->password,
    'passwd_decrypt' => $decrypt
];

echo json_encode($result);