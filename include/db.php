<?php
include_once "config.php";
$connect = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;

try {
    $pdo = new PDO($connect, DBUSER, DBPASSWD);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}


$pdo->query("SET NAMES utf8");
