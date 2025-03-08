<?php

$host = "localhost";
$database = "faq_server";
$user = "root";
$password = "";

$conn = new mysqli($host, $database, $user, $password);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}
echo "Connected successfully to the database!";

?>