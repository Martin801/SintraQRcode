<!DOCTYPE html>
<html lang="eg">
<head>
    <?php include('inc/top.php'); ?>
</head>
<body>
    <?php include('inc/header.php'); ?>
<main>
<section class="table-main form-main clearfix">
<div class="container-fluid">
<div class="row">
    <?php include('inc/sidebar.php'); ?>
</div>
<div class="right">
<div class="container-fluid">
<div class="col-md-12">
    <?php include('admin/inc/message.php'); ?>    
</div>    
<div class="top-sec clearfix">
<div class="heading">
    <h3><?php echo $this->lang->line('Profile'); ?></h3>
    <p style="color: red; margin-top: -15px; margin-bottom: 15px;"><?php echo $this->lang->line('vali'); ?></p>
</div>
</div>
<form action="<?php echo base_url('UserDashboard/profile-update'); ?>" enctype="multipart/form-data"  method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Company Name'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $user_details[0]['user_company_name'];?>" name="user_company_name" id="user_company_name" required="required">
        <a href="#" data-toggle="tooltip" title="Username"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Name<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $user_details[0]['user_name'];?>" name="user_name" id="user_name" required="required">
        <a href="#" data-toggle="tooltip" title="First Name"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Email'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $user_details[0]['user_email'];?>" name="user_email" id="user_email" required="required">
        <a href="#" data-toggle="tooltip" title="Last Name"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Phone No'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $user_details[0]['user_phone_no'];?>" name="user_phone_no" id="user_phone_no" required="required">
        <a href="#" data-toggle="tooltip" title="Email Address"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Username'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $user_details[0]['user_username'];?>" name="user_username" id="user_username" required="required">
        <a href="#" data-toggle="tooltip" title="Phone No"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Profile Picture'); ?></label>
    <div class="inr">
        <input type="file" name="user_picture" id="user_picture">
        <a href="#" data-toggle="tooltip" title="Phone No"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<button type="submit" class="code-btn"><?php echo $this->lang->line('Update'); ?></button>
</form>
<div class="top-sec clearfix">
<div class="heading">
    <h3><?php echo $this->lang->line('Change Password'); ?></h3>
    <p style="color: red; margin-top: -15px; margin-bottom: 15px;"><?php echo $this->lang->line('vali'); ?></p>
</div>
</div>
<form action="<?php echo base_url('UserDashboard/change-password'); ?>" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Old Password'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="password" value="" name="old_password" id="old_password" required="required">
        <a href="#" data-toggle="tooltip" title="Old Password"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('New Password'); ?><span style="color: red">*</span></label>
    <div class="inr">
        <input type="password" value="" name="new_password" id="new_password" required="required">
        <a href="#" data-toggle="tooltip" title="New Password"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<button type="submit" class="code-btn"><?php echo $this->lang->line('Update'); ?></button>
</form>
</div>
</div>
</div>
</section>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
