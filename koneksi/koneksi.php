<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pem_web";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
	die("Koneksi ke database gagal: " . $conn->connect_error);
}
