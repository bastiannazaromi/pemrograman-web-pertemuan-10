<?php
require '../koneksi/koneksi.php';

if (isset($_POST['simpan'])) {
	$nama         = $_POST['nama'];
	$username     = $_POST['username'];
	$jenisKelamin = $_POST['jenisKelamin'];
	$status       = $_POST['status'];
	$password     = password_hash($_POST['password'], PASSWORD_BCRYPT);

	if ($_FILES['file']['name'] == "") {
		// Query SQL untuk memasukkan data ke dalam tabel user
		$sql = "INSERT INTO user (nama, username, password, jenisKelamin, status) VALUES ('$nama', '$username', '$password', '$jenisKelamin', '$status')";
	} else {
		$targetDirectory = "/pertemuan-10/uploads/";

		$originalFileName = basename($_FILES["file"]["name"]);

		$statusUpload = 1;
		$imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

		// Generate nama file baru dengan menambahkan timestamp
		$newFileName = "file_" . time() . "." . $imageFileType;
		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $newFileName;

		if (file_exists($targetFile)) {
			echo "Maaf, file sudah ada.<br>";
			$statusUpload = 0;
		}

		if ($_FILES["file"]["size"] > 5120000) {
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
			// Jika semua pemeriksaan berhasil, coba unggah file
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
				$sql = "INSERT INTO user (nama, username, password, jenisKelamin, status, foto) VALUES ('$nama', '$username', '$password', '$jenisKelamin', '$status', '$newFileName')";
			} else {
				echo "Maaf, terjadi kesalahan saat mengunggah file.<br>";

				die;
			}
		}
	}

	if ($conn->query($sql) === TRUE) {
		// Data berhasil ditambahkan

		$conn->close();

		header('location: /pertemuan-10?page=user');
	} else {
		// Jika terjadi kesalahan
		echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
		die;
	}
} else if (isset($_GET['hapus'])) {
	$id = $_GET['hapus'];

	$sql = "SELECT * FROM user WHERE id='$id'";
	$result = $conn->query($sql);

	$targetDirectory = "/pertemuan-10/uploads/";

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$targetFile = $_SERVER['DOCUMENT_ROOT'] . $targetDirectory . $row['foto'];

		$sql = "DELETE FROM user WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			// Data berhasil dihapus

			if ($row['foto'] != null && $row['foto'] != 'default.png') {
				if (file_exists($targetFile)) {
					unlink($targetFile);
				}
			}

			$conn->close();

			header('location: /pertemuan-10?page=user');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;

			$conn->close();
			die;
		}
	}
} else {
	header('location: /pertemuan-10?page=user');
}
