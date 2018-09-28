<!DOCTYPE html>
<html lang="eg">
<head>
    <?php include('inc/top.php'); ?>
</head>
<body>
    <?php include('inc/header.php'); ?>
<main>
<section class="table-main clearfix">
<div class="container-fluid">
<div class="row">
    <?php include('inc/sidebar.php'); ?>
</div>
<div class="right">
<div class="container-fluid">
<div class="col-md-12">
<?php include('admin/inc/message.php'); ?>
</div>
<div class="heading">
<h3><?php echo $this->lang->line('Map Geo Tagging Information'); ?></h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
	<th><?php echo $this->lang->line('Product Name'); ?></th>
	<!-- <th>IP</th> -->
	<th><?php echo $this->lang->line('Country'); ?></th>
	<th><?php echo $this->lang->line('City'); ?></th>
	<th><?php echo $this->lang->line('Region'); ?></th>
	<th><?php echo $this->lang->line('Latitude'); ?></th>
	<th><?php echo $this->lang->line('Longitude'); ?></th>
	<th><?php echo $this->lang->line('Datetime'); ?></th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list_data)){
foreach ($list_data as $key => $value) {
$get_product_details = get_product_details($value['product_id']);
?>
<tr>
<td><?php echo $get_product_details[0]['product_name']; ?></td>
<!-- <td><?php echo $value['ip_address']; ?></td> -->
<td><?php echo $value['country_name']; ?></td>
<td><?php echo $value['city']; ?></td>
<td><?php echo $value['region']; ?></td>
<td><?php echo $value['latitude']; ?></td>
<td><?php echo $value['longitude']; ?></td>
<td><?php echo $value['datetime']; ?></td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
<br/>
<div id="map" style="width: 100%; height: 900px;"></div>
<br/>
</div>
</div>
</div>
</section>
</main>
<?php include('inc/footer.php'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACjdpaolaUHA-rjK_YEvP8UdQi9Z3YIwk&callback=initMap"></script>
<script>
function initMap() {
    var myLatLng = {lat: 51.1657, lng: 10.4515};
    var map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: 3
});
<?php
if(!empty($list_data)){
foreach ($list_data as $dat_ll) {
if(!empty($dat_ll['latitude']) && !empty($dat_ll['longitude'])){
$LAT = $dat_ll['latitude'];
$LOG = $dat_ll['longitude'];	
?>
var marker = new google.maps.Marker({
draggable: false,
position: new google.maps.LatLng(<?php echo $LAT; ?>,<?php echo $LOG; ?>),
map: map,
});
<?php	
}
}
}
?>
}
</script>    
</body>
</html>
