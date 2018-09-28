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
<h3><?php echo $this->lang->line('List Customer'); ?></h3>
</div>
<div class="btn clearfix">
    <ul>
        <li><a href="#responsive-modal" data-toggle="modal" class="blue"><?php echo $this->lang->line('Add Customer'); ?></a></li>
    </ul>
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
    <th><?php echo $this->lang->line('Username'); ?></th>
    <th><?php echo $this->lang->line('Email'); ?></th>
    <th><?php echo $this->lang->line('Phone No'); ?></th>
    <th>Status</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($user_listing)){
foreach($user_listing as $user){
?>
<tr>
  <td><?php echo $user['user_company_name']; ?></td>
  <td><?php echo $user['user_name']; ?></td>
  <td><?php echo $user['user_username']; ?></td>
  <td><?php echo $user['user_email']; ?></td>
  <td><?php echo $user['user_phone_no']; ?></td>
  <td><?php echo status($user['user_status']); ?></td>
  <td>
  <a href="#responsive-modal_<?php echo $user['user_id']; ?>" data-toggle="modal" title="Edit" style="margin-right: 10px;"> 
    <img src="<?php echo base_url('public'); ?>/assets/icon/edit.png" alt=""> 
  </a>
  <div class="modal" id="responsive-modal_<?php echo $user['user_id']; ?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="header">
  <h4 class="modal-title">Update User</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="container-fluid">
<form action="<?php echo base_url('User/update-user'); ?>" method="POST">
   <input type="hidden" value="<?php echo $user['user_id']; ?>" required name="id">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Company Name'); ?>:*</label><br>
    <div class="inr">
      <input type="text" value="<?php echo $user['user_company_name']; ?>" required  id="user_company_name" name="user_company_name">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label>Name:*</label><br>
    <div class="inr">
      <input type="text" value="<?php echo $user['user_name']; ?>" required  id="user_name" name="user_name">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Email'); ?>:*</label><br>
    <div class="inr">
        <input type="text" value="<?php echo $user['user_email']; ?>" required  id="user_email" name="user_email">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Phone No'); ?>:*</label><br>
    <div class="inr">
       <input type="text" value="<?php echo $user['user_phone_no']; ?>" required  id="user_phone_no" name="user_phone_no">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Username'); ?>:*</label><br>
    <div class="inr">
        <input type="text" value="<?php echo $user['user_username']; ?>" required  id="user_username" name="user_username">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Password'); ?>:</label><br>
    <div class="inr">
        <input type="password" id="user_password" name="user_password">
    </div>
</div>
<div class="form-sec popup-form clearfix">
<label>Status:*</label><br>
<div class="inr">
    <select name="user_status" id="user_status" required>
        <option value="1" <?php if($user['user_status'] == 1){?> selected <?php } ?>><?php echo $this->lang->line('Active'); ?></option>
        <option value="2" <?php if($user['user_status'] == 2){?> selected <?php } ?>><?php echo $this->lang->line('Inactive'); ?></option>
    </select>
</div>
</div>
<button type="submit" class="code-btn"><?php echo $this->lang->line('Save'); ?></button>
</form>
</div> 
</div>
</div>
</div>
</div>
  <a href="javascript:void(0)" onclick="delete_data_all('<?php echo base_url('User/destroy/'.$user['user_id']); ?>')" title="Delete"> 
    <img src="<?php echo base_url('public'); ?>/assets/icon/delete.png" alt=""> 
  </a>
  </td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</section>
<div class="modal" id="responsive-modal">
<div class="modal-dialog">
<div class="modal-content">
<div class="header">
  <h4 class="modal-title"><?php echo $this->lang->line('Create User'); ?></h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="container-fluid">
<form action="<?php echo base_url('User/create-user'); ?>" method="POST">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />  
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Company Name'); ?>:*</label><br>
    <div class="inr">
      <input type="text" required  id="user_company_name" name="user_company_name">
    </div>
</div>  
<div class="form-sec popup-form clearfix">
    <label>Name:*</label><br>
    <div class="inr">
      <input type="text" required  id="user_name" name="user_name">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Email'); ?>:*</label><br>
    <div class="inr">
        <input type="text" required  id="user_email" name="user_email">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Phone No'); ?>:*</label><br>
    <div class="inr">
       <input type="text" required  id="user_phone_no" name="user_phone_no">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Username'); ?>:*</label><br>
    <div class="inr">
        <input type="text" required  id="user_username" name="user_username">
    </div>
</div>
<div class="form-sec popup-form clearfix">
    <label><?php echo $this->lang->line('Password'); ?>:*</label><br>
    <div class="inr">
        <input type="password" required id="user_password" name="user_password">
    </div>
</div>
<div class="form-sec popup-form clearfix">
<label>Status:*</label><br>
<div class="inr">
    <select name="user_status" id="user_status" required>
        <option value="1"><?php echo $this->lang->line('Active'); ?></option>
        <option value="2"><?php echo $this->lang->line('Inactive'); ?></option>
    </select>
</div>
</div>
<button type="submit" class="code-btn"><?php echo $this->lang->line('Save'); ?></button>
</form>
</div> 
</div>
</div>
</div>
</div>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
