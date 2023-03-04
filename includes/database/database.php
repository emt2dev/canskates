<?php
session_start();

/* The only thing used here is the logout button */
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'can_skates';

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?>
