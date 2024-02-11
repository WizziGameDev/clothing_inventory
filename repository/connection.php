<?php
function getConnection(): PDO
{
    $host = "localhost";
    $port = 3306;
    $database = "fp_web";
    $username = "root";
    $password = "";

    return new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
}