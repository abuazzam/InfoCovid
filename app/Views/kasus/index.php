<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<?php if(session()->getFlashdata('flash_msg')):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check"></i>
    <?=session()->getFlashdata('flash_msg') ?>
</div>
<?php endif; ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Kasus</h6>
        <a href="<?=base_url('kasus/add');?>" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i> </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>L/P</th>
                        <th>Umur</th>
                        <th>RT</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>L/P</th>
                        <th>Umur</th>
                        <th>RT</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if ($kasus): foreach($kasus as $row): ?>
                    <tr>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->kelamin;?></td>
                        <td><?=$row->usia;?></td>
                        <td><?=$row->rt;?></td>
                        <td><?=$row->alamat;?></td>
                        <td><?=show_status_modal($row->status, $row->id);?></td>
                        <td class="text-nowrap">
                            <?=btn_action_type('/kasus/edit/'.$row->id, 'edit');?>
                            <?=btn_action_type('/kasus/delete/'.$row->id, 'delete');?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="7">Belum ada data.</td>
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

    $(document).on("click", ".open-statusModal", function () {
        var id = $(this).data('id');
        
        $(".modal-body .open-statusModal").each(function() {
            $(this).attr('href', $(this).data('url') + '/' + id);
            $(this).data('id', id);
            $(this).removeClass('btn-sm');
        });
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
});
</script>

<!-- Status Modal-->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="btn-group-vertical col">
                <?=show_status(1, '/kasus/status/1');?>
                <?=show_status(2, '/kasus/status/2');?>
                <?=show_status(3, '/kasus/status/3');?>
                <?=show_status(4, '/kasus/status/4');?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <!-- a class="btn btn-primary" href="#">OK</a -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>