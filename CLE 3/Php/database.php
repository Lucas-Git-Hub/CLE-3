<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "justdancear15";

$db = mysqli_connect($servername,$username,$password,$dbname);

if ($db -> connect_error){
    die("error ".$db -> connect_error);
}

