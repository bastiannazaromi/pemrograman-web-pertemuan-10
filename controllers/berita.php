<?php
require '../koneksi/koneksi.php';

if (isset($_POST['simpan'])) {
	$idKategori = $_POST['idKategori'];
	$judul      = $_POST['judul'];
	$isi        = $_POST['isi'];
	$status     = $_POST['status'];

	if ($_FILES['gambar']['name'] == "") {
		$sql = "INSERT INTO berita (idKategori, judul, isi, status) VALUES ('$idKategori', '$judul', '$isi', '$status')";
	} else {
		$targetDirectory = "/pertemuan-10/uploads/";

		$originalFileName = basename($_FILES["gambar"]["name"]);

		$statusUpload = 1;
		$imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

		$newFileName = "file_" . time() . "." . $imageFileType;
		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $newFileName;

		if (file_exists($targetFile)) {
			echo "Maaf, file sudah ada.<br>";
			$statusUpload = 0;
		}

		if ($_FILES["gambar"]["size"] > 5120000) {
			echo "Maaf, file terlalu besar.<br>";
			$statusUpload = 0;
		}

		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.<br>";
			$statusUpload = 0;
		}

		if ($statusUpload == 0) {
			echo "Maaf, file tidak diunggah<br>.";

			die;
		} else {
			if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
				$sql = "INSERT INTO berita (idKategori, judul, isi, gambar, status) VALUES ('$idKategori', '$judul', '$isi', '$newFileName', '$status')";
			} else {
				echo "Maaf, terjadi kesalahan saat mengunggah file.<br>";

				die;
			}
		}
	}

	if ($conn->query($sql) === TRUE) {
		$conn->close();

		header('location: /pertemuan-10?page=berita');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_POST['edit'])) {
	$id         = $_POST['id'];
	$idKategori = $_POST['idKategori'];
	$judul      = $_POST['judul'];
	$isi        = $_POST['isi'];
	$status     = $_POST['status'];

	if ($_FILES['gambar']['name'] == "") {
		$sqlUpdate = "UPDATE berita SET idKategori='$idKategori', judul='$judul', isi='$isi', status='$status' WHERE id=$id";
	} else {
		$targetDirectory = "/pertemuan-10/uploads/";

		$originalFileName = basename($_FILES["gambar"]["name"]);

		$statusUpload = 1;
		$imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

		$newFileName = "file_" . time() . "." . $imageFileType;
		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $newFileName;

		if (file_exists($targetFile)) {
			echo "Maaf, file sudah ada.<br>";
			$statusUpload = 0;
		}

		if ($_FILES["gambar"]["size"] > 5120000) {
			echo "Maaf, file terlalu besar.<br>";
			$statusUpload = 0;
		}

		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.<br>";
			$statusUpload = 0;
		}

		if ($statusUpload == 0) {
			echo "Maaf, file tidak diunggah<br>.";

			die;
		} else {
			if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
				$sqlUpdate = "UPDATE berita SET idKategori='$idKategori', judul='$judul', isi='$isi', gambar='$newFileName', status='$status' WHERE id=$id";
			} else {
				echo "Maaf, terjadi kesalahan saat mengunggah file.<br>";

				die;
			}
		}
	}

	$sql = "SELECT gambar FROM berita WHERE id='$id'";
	$result = $conn->query($sql);

	$targetDirectory = "/pertemuan-10/uploads/";

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $row['gambar'];

		if ($conn->query($sqlUpdate) === TRUE) {
			if ($_FILES['gambar']['name'] != "") {
				if ($row['gambar'] != null) {
					if (file_exists($targetFile)) {
						unlink($targetFile);
					}
				}
			}

			$conn->close();

			header('location: /pertemuan-10?page=berita');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;

			$conn->close();
			die;
		}
	}
} else if (isset($_GET['hapus'])) {
	$id = $_GET['hapus'];

	$sql = "SELECT gambar FROM berita WHERE id='$id'";
	$result = $conn->query($sql);

	$targetDirectory = "/pertemuan-10/uploads/";

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $row['gambar'];

		$sql = "DELETE FROM berita WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			if ($row['gambar'] != null) {
				if (file_exists($targetFile)) {
					unlink($targetFile);
				}
			}

			$conn->close();

			header('location: /pertemuan-10?page=berita');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;

			$conn->close();
			die;
		}
	}
} else {
	header('location: /pertemuan-10?page=berita');
}
