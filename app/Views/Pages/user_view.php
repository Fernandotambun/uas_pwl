<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Tambah Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Username</th>
	<th scope="col">Email</th>
	<th scope="col">Password</th> 
	<th scope="col">Role</th> 
	<th scope="col">Akses</th> 
	<th scope="col">Aksi</th> 
	</tr>
</thead>
<tbody>
	<?php foreach($users as $index => $user): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
    <td><?php echo $user['username'] ?></td>
    <td><?php echo $user['email'] ?></td>
    <td><?php echo $user['password'] ?></td>
    <td><?php echo $user['role'] ?> </td>
    <td>
        <?php if($user['is_aktif']==true){
            echo "<span class='badge bg-success'>Aktif</span>";
        }else{
            echo "<span class='badge bg-warning'>Tidak Aktif</span>";
        } ?>
    </td>
	<td>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">
            Edit
        </button>
		<a href="<?= base_url('user/delete/'.$user['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
        Hapus
        </a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('user/edit/'.$user['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" placeholder="Username" required>
				</div>
				<div class="form-group">
					<label for="name">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?= $user['email'] ?>" placeholder="Email" >
				</div>
				<div class="form-group">
					<label for="name">Role</label>
					<select name="role" class="form-select" aria-label="Default select example">
						<option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
						<option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>user</option>
					</select>
				</div>
				<div class="form-group">
					<label for="name">Akses</label>
					<br>
					<label><input type="radio" name="is_aktif" value="1" <?= $user['is_aktif'] == true ? 'checked' : '' ?>>Aktif</label>
					<label><input type="radio" name="is_aktif" value="0" <?= $user['is_aktif'] == false ? 'checked' : '' ?>>Tidak Aktif</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Tambah Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form action="<?= base_url('user') ?>" method="post" enctype="multipart/form-data">
		<?= csrf_field(); ?>
		<div class="modal-body">
			<div class="form-group">
				<label for="name">Username</label>
				<input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
			</div>
			<div class="form-group">
				<label for="name">Email</label>
				<input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
			</div>
			<div class="form-group">
				<label for="name">password</label>
				<input type="text" name="password" class="form-control" id="jumlah" placeholder="password" required>
			</div>
			<div class="form-group">
				<label for="name">Akses</label>
				<input type="text" name="is_aktif" class="form-control" id="is_aktif" placeholder="Akses" required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>