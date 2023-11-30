<?php
$databaseHost = 'localhost';
$databaseName = 'prototipos';
$databaseUsername = 'root';
$databasePassword = '';
$port = '3307';

// Open a new connection to the MySQL server
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName, $port); 