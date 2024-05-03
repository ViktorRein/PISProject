<?php
$serverName = 'localhost';
$dbUserName = 'root';
$dbpassword = '';
$dbName = 'rpbd_project';

$dbs = "mysql:host=$serverName;dbname=$dbName;charset=utf8";

$opt = [
    PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
  ];
try {

    $conn = new PDO($dbs,$dbUserName,$dbpassword,$opt);

} catch(PDOException $e) {
    echo "Connection failed" . $e ->getMessage();
    exit();
}