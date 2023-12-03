<?php
$DBhostname = 'localhost';
$DBusername = 'admin';
$DBpassword = 'admin';
$DBname = 'risk_management_system';

$db = new mysqli($DBhostname, $DBusername, $DBpassword, $DBname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


function getProjects()
{
    global $db;
    $raw = $db->query('SELECT id, name FROM `projects`');
    $result = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($raw)) {
        $result[$i] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
        $i ++;
    }
    return $result;
}

function updateDataById($id){
    global $db;
    $data = str_replace('"', '\\"', json_encode($_SESSION['data']));
    $db->query("UPDATE `projects` SET `data` = '$data' WHERE `projects`.`id` = $id;");
}

function getDataById($id){
    global $db;
    $result = $db->query("SELECT data FROM `projects` WHERE id=$id")->fetch_all()[0][0];
    return json_decode($result, true);
}

function createProject($name, $company, $address, $detail){
    global $db;
    $db->query("INSERT INTO `projects` (`id`, `name`, `company`, `logo`, `data`, `address`, `detail`) VALUES (NULL, '$name', '$company', 'assets/image/logo.png', '{\"dimension1\":{\"sub1\":{\"a\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]},\"sub2\":{\"a\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"b\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]}}}', '$address', '$detail');");
}