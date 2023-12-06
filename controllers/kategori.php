<?php
require '../koneksi/koneksi.php';

if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];

	$sql = "INSERT INTO kategori (nama) VALUES ('$nama')";

	if ($conn->query($sql) === TRUE) {
		$conn->close();

		header('location: /pertemuan-10?page=berita');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = $_POST['nama'];

	$sql = "UPDATE kategori SET nama='$nama' WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		$conn->close();

		header('location: /pertemuan-10?page=berita');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_GET['hapus'])) {
	$id = $_GET['hapus'];

	$sql = "DELETE FROM kategori WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		$conn->close();

		header('location: /pertemuan-10?page=berita');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else {
	header('location: /pertemuan-10?page=berita');
}
