<?php
include 'Classes\DbConnection\DbConnection.php';

$core = include 'Config\core.php';
$ver = $core['version'];

$dbConnectionConfig = include 'Config\dbConnectionConfig.php';

$dbConnection = new \Classes\DbConnection($dbConnectionConfig);

$level = (isset($_POST['level']) ? $_POST['level'] : 'a2');


//$tableRows = (isset($_GET['rows']) ? $_GET['rows'] : 10);
//$offset = (isset($_GET['offset']) ? $_GET['offset'] : 0);
//$newOffset = $offset + $tableRows;

$results = $dbConnection->executeQuery("SELECT * FROM `irregular_verbs` WHERE `level`='$level'");
//var_dump($results);
//exit();




include 'Views/main_page.php';
var_dump($_POST);

