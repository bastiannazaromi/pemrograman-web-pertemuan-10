<?php
require 'koneksi/koneksi.php';

$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between mb-3">
	<h3>Data User</h3>
	<button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">Tambah User</button>
</div>

<!-- Tabel Data Pengguna -->
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Username</th>
				<th class="text-center">Foto</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			if ($result->num_rows > 0) : ?>
				<?php while ($row = $result->fetch_assoc()) : ?>
					<tr>
						<td class="text-center align-middle"><?php echo $i++; ?></td>
						<td class="align-middle"><?php echo $row['nama']; ?></td>
						<td class="align-middle"><?php echo $row['username']; ?></td>
						<td class="text-center align-middle">
							<img class="img-thumbnail rounded-circle" src="<?php echo 'uploads/' . $row['foto']; ?>" alt="<?php echo $row['nama']; ?>" width="100">
						</td>
						<td class="text-center align-middle">
							<div class="btn-group">
								<a href="#" class="btn btn-warning">Edit</a>
								<a href="controllers/user.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin data akan dihapus ?')">Hapus</a>
							</div>
						</td>
					</tr>
				<?php endwhile; ?>
			<?php else : ?>
				<tr>
					<td colspan='4'>Tidak ada data user</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahUserModalLabel">Tambah User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controllers/user.php" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="text" class="form-control" name="nama" required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" name="username" required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="jenisKelamin">Jenis Kelamin</label>
								<select class="form-control" name="jenisKelamin">
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
							<label for="status">Status</label>
							<br>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="status" value="Aktif">Aktif
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="status" value="Tidak Aktif">Tidak Aktif
								</label>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<input type="file" class="form-control" name="file" accept=".png,.jpg,.jpeg,.gif">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--  -->