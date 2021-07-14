<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">                                    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
    </div>
    <div class="card-body">
        <form class="row g-3 needs-validation" novalidate method="post">
            <div class="col-md-6">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>
            <div class="col-md-6">
                <label for="no_kk" class="form-label">No. KK</label>
                <input type="text" class="form-control" id="no_kk" name="no_kk">
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="invalid-feedback">
                    Silakan isi nama.
                </div>
            </div>
            <div class="col-md-2">
                <label for="usia" class="form-label">Usia</label>
                <input type="text" class="form-control" id="usia" name="usia">
            </div>
            <div class="col-md-4">
                <legend class="col-form-label">Jenis Kelamin</legend>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="jk_l" name="kelamin" value="L">
                    <label class="form-check-label" for="jk_l">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="jk_p" name="kelamin" value="P">
                    <label class="form-check-label" for="jk_p">
                        Perempuan
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">RT</label>
                <select id="status" class="form-select form-control" name="rt_id" required>
                    <option value="">Pilih RT...</option>
                    <?=select_option($rt);?>
                </select>
                <div class="invalid-feedback">
                    Silakan pilih RT.
                </div>
            </div>
            <div class="col-md-5">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-select form-control" name="status">
                    <option value="">Pilih Status...</option>
                    <?=select_option($status, 0);?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" data-date="" data-date-format="DD MMMM YYYY" value="<?=date('Y-m-d');?>" class="form-control" id="tanggal" name="tanggal">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
$(document).ready(function() {
    $('input[type="date"]').on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        );
    }).trigger("change");
});
</script>

<?= $this->endSection(); ?>