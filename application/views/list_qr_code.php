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
<h3><?php echo $this->lang->line('QR-Code Administration'); ?></h3>
</div>
<div class="btn">
    <ul>
        <li><a href="#myModal" data-toggle="modal" class="green"><?php echo $this->lang->line('CSV File'); ?></a></li>
        <li><a href="<?php echo base_url('UserDashboard/add-qr'); ?>" class="blue"><?php echo $this->lang->line('Add QR Code'); ?></a></li>
    </ul>
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
    <th>Name</th>
    <th><?php echo $this->lang->line('Description'); ?></th>
    <th><?php echo $this->lang->line('Product'); ?></th>
    <th><?php echo $this->lang->line('Created On'); ?></th>
    <th>QR-Code</th>
    <th>NFC</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list_data)){
foreach($list_data as $data_list){    
?>
<tr>
    <td><?php echo $data_list['product_name']; ?></td>
    <td><?php echo $data_list['product_description']; ?></td>
    <td><?php echo $data_list['product_product']; ?></td>
    <td><?php echo $data_list['created_on']; ?></td>
    <td><a href="#myModal_<?php echo $data_list['product_id'];?>" data-toggle="modal">
    <img style="height: 25px; width: 25px;" src="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" alt="">
    </a>
    </td>
    <?php if($data_list['product_NFC'] == 'No'){?>
    <td><a href="#">No</a></td>
    <?php }else{ ?>
    <td><a href="#"><img src="<?php echo base_url('public'); ?>/assets/icon/code_2.png" alt=""></a></td>
    <?php } ?>
    <td>
    <?php if($data_list['product_status'] ==  1){?>    
    <a href="<?php echo base_url('UserDashboard/toogle-product/'.$data_list['product_id']); ?>" style="float: none;" class="btn btn-success"><?php echo $this->lang->line('Active'); ?></a>
<?php }else{ ?>
    <a href="<?php echo base_url('UserDashboard/toogle-product/'.$data_list['product_id']); ?>" style="float: none;" class="btn btn-danger"><?php echo $this->lang->line('Inactive'); ?></a>
<?php } ?>
</td>
    <td>
    <a href="<?php echo base_url('UserDashboard/delete-product/'.$data_list['product_id']); ?>" style="margin-right: 10px;"><img src="<?php echo base_url('public'); ?>/assets/icon/delete.png" alt=""></a>
    <?php if($data_list['product_type'] == 'Dynamic'){ ?>
    <a href="<?php echo base_url('UserDashboard/edit-product/'.$data_list['product_id']); ?>"><img src="<?php echo base_url('public'); ?>/assets/icon/edit.png" alt=""></a>
    <?php } ?>
    </td>
</tr>
<div class="modal" id="myModal_<?php echo $data_list['product_id'];?>">
<div class="modal-dialog modal-lg">
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
<?php }} ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>
<div class="modal" id="myModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="header">
<h4 class="modal-title"><?php echo $this->lang->line('Upload CSV'); ?></h4>
<button type="button" class="close" data-dismiss="modal">&times;
</button>
</div>
<div class="modal-body">
<p><?php echo $this->lang->line('csv-data'); ?></p>    
<form action="<?php echo base_url('UserDashboard/upload_csv'); ?>" method="post" enctype="multipart/form-data">
<div class="form-group">
<input type="file" class="form-control" id="upload_csv" name="userfile">
</div>
<button type="submit" class="btn btn-default" style="float: right;"><?php echo $this->lang->line('Submit'); ?></button>
<ul class="modal1-new">
<li class="modal-download"><a href="<?php echo base_url('testSmaple.csv'); ?>" target="_blank" class="blue"><?php echo $this->lang->line('Download'); ?></a></li>
</ul>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
</form>    
</div>
</div>
</div>
</div>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
