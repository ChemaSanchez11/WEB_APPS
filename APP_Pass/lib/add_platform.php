<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/encrypt.php';

global $CFG, $DB;

if(!empty($_POST)){
    var_dump($_POST);
    if(!isset($_POST['update'])){
        $userid = $_POST["user"];
        $platformid = $_POST["platform"];
        $USER = $DB->get_record("SELECT * FROM users WHERE id = '$userid'");

        $password = encrypt($_POST["password"], $USER->token);

        $DB->db_insert("INSERT INTO users_platforms (userid, platformid, password, token) VALUES ($userid, $platformid, '$password', '$USER->token');");
    }
    elseif ($_POST['update'] == true){
        $userid = $_POST['user'];
        $USER = $DB->get_record("SELECT * FROM users WHERE id = '$userid'");
        $password = encrypt($_POST["pass"], $USER->token);
        $platform = $_POST['platform'];

        $DB->db_update("UPDATE users_platforms SET password = '$password' WHERE userid = $userid AND platformid = (SELECT id FROM platforms WHERE name = '$platform')");

    }
}