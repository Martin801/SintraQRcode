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
<h3><?php echo $this->lang->line('QR-Code Analytics'); ?></h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
    <th><?php echo $this->lang->line('Product Name'); ?></th>
    <th><?php echo $this->lang->line('Created On'); ?></th>
    <th>QR-Code</th>
    <th><?php echo $this->lang->line('Total Visit'); ?></th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list_data)){
foreach($list_data as $data_list){
$get_a_details = get_product_analytics_pdetails($data_list['product_id']);
if(!empty($get_a_details)){
?>
<tr>
<td><?php echo $data_list['product_name']; ?></td>
<td><?php echo $data_list['created_on']; ?></td>
<td><a href="#myModal_<?php echo $data_list['product_id'];?>" data-toggle="modal">
<img style="height: 25px; width: 25px;" src="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" alt=""></a>
</td>
<td><?php echo !empty($get_a_details)? count($get_a_details) : '0' ?></td>
<td>
<!-- <a href="#myModallist_<?php echo $data_list['product_id'];?>" data-toggle="modal" class="btn btn-info" style="float: none; margin-right: 10px;"><?php echo $this->lang->line('Details'); ?></a> -->
<a href="<?php echo base_url('UserDashboard/map/'.$data_list['product_id']);?>" class="btn btn-danger" style="float: none;"><?php echo $this->lang->line('Details'); ?></a>
<div class="modal" id="myModallist_<?php echo $data_list['product_id'];?>">
<div class="modal-dialog modal-lg" style="max-width: 1200px;">
<div class="modal-content">
<div class="header">
<h4 class="modal-title"><?php echo $this->lang->line('QR-Code Analytics'); ?></h4>
<button type="button" class="close" data-dismiss="modal">&times;
</button>
</div>
<div class="modal-body">
<table class="table">
<thead>
<tr>
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
</tr>
</thead>
<tbody>
<?php
if(!empty($get_a_details)){
foreach ($get_a_details as $key => $value) {
?>
<tr>
<td><?php echo $data_list['product_name']; ?></td>
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
</div>
</div>
</div>
</td>
</tr>
<div class="modal" id="myModal_<?php echo $data_list['product_id'];?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="header">
<h4 class="modal-title">QR-Code</h4>
<button type="button" class="close" data-dismiss="modal">&times;
</button>
</div>
<div class="modal-body">
<img src="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" alt="">
<ul>
<li><a href="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" download class="blue"><?php echo $this->lang->line('Download'); ?></a></li>
<li><a href="javascript:void(0)" onclick="window.print()" class="green"><?php echo $this->lang->line('Print'); ?></a></li>
</ul>
</div>
</div>
</div>
</div>
<?php }}} ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
