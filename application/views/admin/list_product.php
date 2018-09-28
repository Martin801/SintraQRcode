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
<div class="heading">
<h3><?php echo $this->lang->line('List Product'); ?></h3>
</div>
<div class="success-table">
<div class="row clearfix">
<div class="col-md-12">
  <?php include('inc/message.php'); ?> 
    </div>   
</div> 
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
    <th><?php echo $this->lang->line('Company Name'); ?></th>
    <th>Name</th>
    <th><?php echo $this->lang->line('Description'); ?></th>
    <th><?php echo $this->lang->line('Product'); ?></th>
    <th><?php echo $this->lang->line('Created On'); ?></th>
    <th><?php echo $this->lang->line('QR-Code'); ?></th>
    <th>NFC</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list_product)){
foreach($list_product as $data_list){ 
$get_user_details = get_profile_details($data_list['user_id']);   
?>
<tr>
    <td><?php echo $get_user_details[0]['user_company_name']; ?></td>
    <td><?php echo $data_list['product_name']; ?></td>
    <td><?php echo $data_list['product_description']; ?></td>
    <td><?php echo $data_list['product_product']; ?></td>
    <td><?php echo $data_list['created_on']; ?></td>
    <td><a href="#myModal_<?php echo $data_list['product_id'];?>" data-toggle="modal"><img style="height: 25px; width: 25px;" src="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" alt=""></a></td>
    <?php if($data_list['product_NFC'] == 'No'){?>
    <td><a href="#">No</a></td>
    <?php }else{ ?>
    <td><a href="#"><img src="<?php echo base_url('public'); ?>/assets/icon/code_2.png" alt=""></a></td>
    <?php } ?>
    <td>
    <a href="<?php echo base_url('AdminDashboard/delete-product/'.$data_list['product_id']); ?>" style="margin-right: 10px;"><img src="<?php echo base_url('public'); ?>/assets/icon/delete.png" alt=""></a>
    </td>
</tr>
<div class="modal" id="myModal_<?php echo $data_list['product_id'];?>">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="header">
            <h4 class="modal-title"><?php echo $this->lang->line('QR-Code'); ?></h4>
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
        </div>
        <div class="modal-body">
            <img src="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" alt="">
            <ul>
              <li><a href="<?php echo base_url('/uploadQrCode/'); echo $data_list['qr_code_file']; ?>" download class="blue">Download</a></li>
              <li><a href="javascript:void(0)" onclick="window.print()" class="green">Print</a></li>
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
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
