<?php


require_once __DIR__ . '/app_db.php';

unset($CFG, $DB, $USER);

global $CFG, $DB, $USER;

$CFG = new stdClass();

$CFG->dbhost = 'localhost';
$CFG->dbuser = 'root';
$CFG->dbpass = '';
$CFG->dbname = 'app_pass';
$CFG->port = '3306';

$CFG->admin = 'admin';

$CFG->path = 'http://localhost/APP_Pass';

$DB = new app_db();

if (!empty($_SESSION['iduser'])) {

    $userid = $_SESSION['iduser'];

    $USER = $DB->get_record("SELECT id, username, email, timecreated FROM users WHERE id = '$userid'");

}
//else{
//    $USER = new stdClass();
//    $USER->id = null;
//    $USER->email = null;
//    $USER->rolid = null;
//    $USER->timecreated = null;
//    $USER->lastaccess = null;
//    $USER->status = null;
//    $USER->img = null;
//}

//$DB = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);


