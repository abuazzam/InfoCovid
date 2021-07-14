<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<?php if(session()->getFlashdata('flash_msg')):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check"></i>
    <?=session()->getFlashdata('flash_msg') ?>
</div>
<?php endif; role_text(1); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        <a href="<?=base_url('user/add');?>" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i> </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if ($user): foreach($user as $row): ?>
                    <tr>
                        <td><?=$row->username;?></td>
                        <td><?=$row->email;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=role_text($row->role);?></td>
                        <td class="text-nowrap">
                            <?=btn_action_type('/user/edit/'.$row->id, 'edit');?>
                            <?=btn_action_type('/user/delete/'.$row->id, 'delete');?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5">Belum ada data.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('head') ?>

<!-- Custom styles for this page -->
<link href="<?=base_url('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<!-- Page level plugins -->
<script src="<?=base_url('sb-admin/vendor/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>

<script>
// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

<?= $this->endSection() ?>