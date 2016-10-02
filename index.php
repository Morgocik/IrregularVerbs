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

$results = $dbConnection->executeQuery("SELECT * FROM `irregular_verbs` WHERE `level` = '$level'");
//var_dump($results);
//exit();

$results_sorted = [];
foreach ($results as $result) {
    $results_sorted[ $result['id'] ] = $result;
    $results_sorted[ $result['id'] ]['status'] = '';
}

if (isset($_POST['action']) && $_POST['action'] == 'check') {
    foreach ($_POST['test'] as $verb) {
        $isValid = false;
        if (isset($results_sorted[$verb['id']])) {
            switch (true) {
                case isset($verb['infinitive']):
                    if ($results_sorted[$verb['id']]['infinitive'] == $verb['infinitive']) {
                        $isValid = true;
                    }
                    break;
                case isset($verb['past_tense']):
                    if ($results_sorted[$verb['id']]['past_tense'] == $verb['past_tense']) {
                        $isValid = true;
                    }
                    break;
                case isset($verb['past_participle']):
                    if ($results_sorted[$verb['id']]['past_participle'] == $verb['past_participle']) {
                        $isValid = true;
                    }
                    break;
            }
        }
        $results_sorted[$verb['id']]['status'] = $isValid ? 'true' : 'false';
    }
}


include 'Views/main_page.php';
var_dump($_POST);

