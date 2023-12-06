<?php
require 'koneksi/koneksi.php';

$sql = "SELECT * FROM kategori ORDER BY nama ASC";
$kategori = $conn->query($sql);

$sql = "SELECT berita.*, kategori.nama FROM berita LEFT JOIN kategori ON berita.idKategori = kategori.id ORDER BY berita.createdAt DESC";
$berita = $conn->query($sql);
?>

<div class="row">
	<div class="col-lg-4">
		<div class="d-flex justify-content-between mb-3">
			<h3>Kategori</h3>
			<button class="btn btn-primary" data-toggle="modal" data-target="#tambahKategori">Tambah</button>
		</div>

		<!-- Tabel Data Pengguna -->
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					if ($kategori->num_rows > 0) : ?>
						<?php while ($row = $kategori->fetch_assoc()) : ?>
							<tr>
								<td class="text-center align-middle"><?php echo $i++; ?></td>
								<td class="align-middle"><?php echo $row['nama']; ?></td>
								<td class="text-center align-middle">
									<div class="btn-group">
										<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editKategori<?= $row['id']; ?>">Edit</a>
										<a href="controllers/kategori.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin data akan dihapus ?')">Hapus</a>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					<?php else : ?>
						<tr class="text-center">
							<td colspan='3'>Tidak ada kategori</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="d-flex justify-content-between mb-3">
			<h3>Berita</h3>
			<button class="btn btn-primary" data-toggle="modal" data-target="#tambahBerita">Tambah</button>
		</div>

		<!-- Tabel Data Pengguna -->
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Judul</th>
						<th class="text-center">Isi</th>
						<th class="text-center">gambar</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					if ($berita->num_rows > 0) : ?>
						<?php while ($row = $berita->fetch_assoc()) : ?>
							<tr>
								<td class="text-center align-middle"><?php echo $i++; ?></td>
								<td class="align-middle"><?php echo $row['nama']; ?></td>
								<td class="align-middle"><?php echo $row['judul']; ?></td>
								<td class="align-middle"><?php echo $row['isi']; ?></td>
								<td class="text-center align-middle">
									<?php if ($row['gambar'] != null) : ?>
										<a href="<?php echo 'uploads/' . $row['gambar']; ?>" target="gambar">
											<img class="img-thumbnail" src="<?php echo 'uploads/' . $row['gambar']; ?>" alt="<?php echo $row['judul']; ?>" width="100">
										</a>
									<?php endif; ?>
								</td>
								<td class="align-middle text-center">
									<?php if ($row['status'] == 1) : ?>
										<span class="badge badge-success">Publish</span>
									<?php else : ?>
										<span class="badge badge-danger">Draft/ Not Publish</span>
									<?php endif; ?>
								</td>
								<td class="text-center align-middle">
									<div class="btn-group">
										<a href="#" class="btn btn-warning edit_btn" data-toggle="modal" data-target="#editBerita" data-id="<?= $row['id']; ?>" data-idkategori="<?= $row['idKategori']; ?>" data-judul="<?= $row['judul']; ?>" data-isi="<?= $row['isi']; ?>" data-status="<?= $row['status']; ?>">Edit</a>
										<a href="controllers/berita.php?hapus=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin data akan dihapus ?')">Hapus</a>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					<?php else : ?>
						<tr class="text-center">
							<td colspan='6'>Tidak ada berita</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h5 class="modal-title" id="tambahKategori">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controllers/kategori.php" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="nama">Nama Kategori</label>
								<input type="text" class="form-control" name="nama" required autocomplete="off">
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
<!-- End Modal Tambah -->

<?php

$sql = "SELECT * FROM kategori";
$kategori = $conn->query($sql);

?>

<?php if ($kategori->num_rows > 0) : ?>
	<?php while ($row = $kategori->fetch_assoc()) : ?>
		<!-- Modal Edit Kategori -->
		<div class="modal fade" id="editKategori<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editKategori<?= $row['id']; ?>ModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-secondary">
						<h5 class="modal-title" id="editKategori<?= $row['id']; ?>">Tambah Kategori</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="controllers/kategori.php" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" name="id" value="<?= $row['id']; ?>" required autocomplete="off">
									<div class="form-group">
										<label for="nama">Nama Kategori</label>
										<input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>" required autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary" name="edit">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Modal Edit -->
	<?php endwhile; ?>
<?php endif; ?>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="tambahBerita" tabindex="-1" role="dialog" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h5 class="modal-title" id="tambahBerita">Tambah Berita</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controllers/berita.php" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<?php

					$sql = "SELECT * FROM kategori";
					$kategori = $conn->query($sql);

					?>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="nama">Nama Kategori</label>
								<select name="idKategori" class="form-control">
									<option value="">-- Pilih Kategori --</option>
									<?php if ($kategori->num_rows > 0) : ?>
										<?php while ($row = $kategori->fetch_assoc()) : ?>
											<option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
										<?php endwhile; ?>
									<?php endif; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="text" name="judul" class="form-control" required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="isi">Isi</label>
								<textarea type="text" name="isi" class="form-control" rows="5" cols="30" required autocomplete="off"></textarea>
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" class="form-control">
									<option value="">-- Pilih Status</option>
									<option value="1">Publish</option>
									<option value="0">Draft/ Not Publish</option>
								</select>
							</div>
							<div class="form-group">
								<label for="gambar">Gambar</label>
								<input type="file" class="form-control" name="gambar" accept=".png,.jpg,.jpeg">
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
<!-- End Modal Tambah -->

<!-- Modal Edit Berita -->
<div class="modal fade" id="editBerita" tabindex="-1" role="dialog" aria-labelledby="editBeritaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h5 class="modal-title" id="editBerita">Edit Berita</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controllers/berita.php" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<?php

					$sql = "SELECT * FROM kategori";
					$kategori = $conn->query($sql);

					?>

					<div class="row">
						<div class="col-lg-12">
							<input type="hidden" name="id" id="id" required>
							<div class="form-group">
								<label for="nama">Nama Kategori</label>
								<select name="idKategori" class="form-control" id="idKategori">
									<option value="">-- Pilih Kategori --</option>
									<?php if ($kategori->num_rows > 0) : ?>
										<?php while ($row = $kategori->fetch_assoc()) : ?>
											<option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
										<?php endwhile; ?>
									<?php endif; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="text" name="judul" class="form-control" required autocomplete="off" id="judul">
							</div>
							<div class="form-group">
								<label for="isi">Isi</label>
								<textarea type="text" name="isi" class="form-control" rows="5" cols="30" required autocomplete="off" id="isi"></textarea>
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" class="form-control" id="status">
									<option value="">-- Pilih Status</option>
									<option value="1">Publish</option>
									<option value="0">Draft/ Not Publish</option>
								</select>
							</div>
							<div class="form-group">
								<label for="gambar">Gambar</label>
								<input type="file" class="form-control" name="gambar" accept=".png,.jpg,.jpeg">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" name="edit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal Edit -->

<script>
	let editBtn = $('.edit_btn');

	$(editBtn).each(function(i) {
		$(editBtn[i]).click(function() {
			let id = $(this).data('id');
			let idKategori = $(this).data('idkategori');
			let judul = $(this).data('judul');
			let isi = $(this).data('isi');
			let status = $(this).data('status');

			$('#id').val(id);
			$('#idKategori').val(idKategori);
			$('#judul').val(judul);
			$('#isi').text(isi);
			$('#status').val(status);
		});
	});
</script>