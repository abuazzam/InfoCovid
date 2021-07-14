<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Kasus Baru (Mingguan)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$baru;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-plus-square fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Positif</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$status->positif;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sembuh
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$status->sembuh;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-square fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                        Meninggal</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$status->meninggal;?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- Content Row -->


<!-- Area Chart -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
        <hr>
        Styling for the area chart can be found in the
        <code>/js/demo/chart-area-demo.js</code> file.
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('footer') ?>

<?php

$labels = [];
$dataset1 = [];
$dataset2 = [];
$dataset3 = [];
$dataset4 = [];

foreach($daily as $r)
{
    array_push($labels, date("d", strtotime($r->tgl)));
    array_push($dataset1, $r->positif);
    array_push($dataset2, $r->sembuh);
    array_push($dataset3, $r->meninggal);
    array_push($dataset4, $r->total);
}

?>

<script>
const today = '<?=date("d");?>';
const labels = [<?=implode(",", $labels);?>]
const dataset1 = [<?=implode(",", $dataset1);?>];
const dataset2 = [<?=implode(",", $dataset2);?>];
const dataset3 = [<?=implode(",", $dataset3);?>];
const dataset4 = [<?=implode(",", $dataset4);?>];
</script>

<!-- Page level plugins -->
<script src="<?=base_url('sb-admin/vendor/chart.js/Chart.min.js');?>"></script>

<!-- Page level custom scripts -->
<script src="<?=base_url('js/chart-kasus.js');?>"></script>

<?= $this->endSection() ?>