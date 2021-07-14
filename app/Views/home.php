<?= $this->extend('template/home') ?>

<?= $this->section('head') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>

 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
 
<style>
#mapid { height: 540px; }

.info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
.info h4 {
    margin: 0 0 5px;
    color: #777;
}

.legend {
    line-height: 18px;
    color: #555;
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}

.text-labels {
    font-size: 1em;
    font-weight: 700;
    color: #369655;
    /* Use color, background, set margins for offset, etc */
}

.text-labels span {
    border-radius:50px;
    border:2px solid #ddd;
    white-space:nowrap;
    display:inline-block;
    padding:5px;
    background: white;
}

.chart-area {
    position: relative;
    height: 25rem;
    width: 100%;
}

.p2 {
    margin-bottom:5px;
}
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5">

                <div class="col-lg-4 order-lg-0 mb-5 mb-lg-0">
                        
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-sm-6 p2">
                                
                                <div class="card border-danger h-100 py-2">
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
                                <div class="col-lg-12 col-md-6 col-sm-6 p2">
                                
                                <div class="card border-warning h-100 py-2">
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
                            
                            
                                <div class="col-lg-12 col-md-6 col-sm-6 p2">
                                
                                <div class="card border-success h-100 py-2">
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
                                <div class="col-lg-12 col-md-6 col-sm-6">
                                
                                <div class="card border-left-secondary h-100 py-2">
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
                        </div>
                    </div>
                
                        
                </div>

                <div class="col-lg-8 order-lg-1">
                    
                    <!-- Area Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </header>

    <section id="maparea" style="padding:0;">
        <div class="col" id="mapid"></div>
    </section>

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


<!-- Map Area -->
<script type="text/javascript" src="https://leafletjs.com/examples/choropleth/us-states.js"></script>
<script type='text/javascript'>

var map = L.map('mapid', {
    scrollWheelZoom: false
}).setView([-6.2779231,106.965578], 17); 

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
}).addTo(map);


var rtData = [
<?php if ($data): foreach($data as $row): ?>
    {"type": "Feature",
        "properties": {
            "Wilayah": "<?=$row->nama;?>",
            "Jumlah": <?=$row->Jumlah;?>
        },
        "geometry": {
            "type": "Polygon",
            "coordinates": [[
                <?=$row->geometry;?>
            ]]
        }
    },
<?php endforeach; endif;?>
];

var geojson;

function getColor(d) {
    return d > 10 ? '#E31A1C' :
           d > 7  ? '#FC4E2A' :
           d > 5  ? '#FD8D3C' :
           d > 3  ? '#FEB24C' :
           d > 0  ? '#FED976' :
                    '#22c965';
}

function style(feature) {
    var j = feature.properties.Jumlah;
    var c = getColor(j);
                     
    return {
        fillColor: c,
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    }
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
    });
}

geojson = L.geoJSON(rtData, {
    style: style,
    onEachFeature: onEachFeature
}).addTo(map);


var legend = L.control({position: 'bottomright'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 1, 3, 5, 7, 10],
        labels = [];

    div.innerHTML ='<b>Keterangan</b><br><br>' 
        + '<i style="background:' + getColor(grades[0]) + '"></i> ' + grades[0] + ' (nihil)<br>';
    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 1; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + ' orang<br>' : '+ orang');
    }

    return div;
};

legend.addTo(map);

<?php if ($data): foreach($data as $row): ?>
var myTextLabel<?=$row->id;?> = L.marker([<?=$row->latitude;?>, <?=$row->longitude;?>], {
    icon: L.divIcon({
        className: 'text-labels',   // Set class for CSS styling
        html: '<span><?=substr($row->nama, -2);?></span>'
    }),
    zIndexOffset: 1000     // Make appear above other map features
});
myTextLabel<?=$row->id;?>.addTo(map);
<?php endforeach; endif; ?>


var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>Jumlah Kasus</h4>' +  (props ?
        '<b>Wilayah ' + props.Wilayah + '</b><br />Positif: ' + props.Jumlah + ' orang'
        : 'Hover over a state');
};

info.addTo(map);

</script>

<?= $this->endSection() ?>
