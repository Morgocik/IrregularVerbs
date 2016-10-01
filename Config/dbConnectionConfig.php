<?php

return [
    'host' => 'localhost',
    'database' => 'irregular_verbs',
    'port' => '3306',
    'username' => 'root',
    'password' => '',
    'option' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]
];
