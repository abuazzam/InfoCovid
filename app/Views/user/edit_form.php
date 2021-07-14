<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">                                    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
    </div>
    <div class="card-body">
        <form class="row g-3 needs-validation" novalidate method="post">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" value="<?= $data->nama;?>" id="nama" name="nama">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $data->email;?>" id="email" name="email" required>
                <div class="invalid-feedback">
                    Silakan isi email.
                </div>
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" value="<?= $data->username;?>" id="username" name="username" required>
                <div class="invalid-feedback">
                    Silakan isi username.
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-12">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select form-control" name="role" required>
                    <option value="">Pilih Role...</option>
                    <?=select_option($role, $data->role);?>
                </select>
                <div class="invalid-feedback">
                    Silakan pilih Role.
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-lg btn-primary mb-3">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('footer') ?>

<script src="<?=base_url('js/form-validation.js');?>"></script>

<?= $this->endSection(); ?>