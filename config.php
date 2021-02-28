<?php
$hostname = 'localhost';
$dbname = 'simple-crud-operation';
$username = 'root';
$password = '';

$connect = mysqli_connect($hostname, $username, $password, $dbname);

if ($connect === false) {
    die('Database could not connect: '. mysqli_connect_error());
}