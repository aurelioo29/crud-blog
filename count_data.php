<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test_web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) as total FROM blog";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // echo " " . $row["total"];
}
