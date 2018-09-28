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
    <?php include('inc/message.php'); ?>    
</div>    
<div class="top-sec clearfix">
<div class="heading">
    <h3>Profile</h3>
    <p style="color: red; margin-top: -15px; margin-bottom: 15px;">astatic (*) filds are required filds</p>
</div>
</div>
<form action="<?php echo base_url('AdminDashboard/profile-update'); ?>" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<div class="form-sec clearfix">
    <label>Username*</label>
    <div class="inr">
        <input type="text" value="<?php echo $admin_details[0]['admin_username'];?>" name="admin_username" id="admin_username" required="required">
        <a href="#" data-toggle="tooltip" title="Username"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>First Name*</label>
    <div class="inr">
        <input type="text" value="<?php echo $admin_details[0]['admin_fname'];?>" name="admin_fname" id="admin_fname" required="required">
        <a href="#" data-toggle="tooltip" title="First Name"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Last Name*</label>
    <div class="inr">
        <input type="text" value="<?php echo $admin_details[0]['admin_lname'];?>" name="admin_lname" id="admin_lname" required="required">
        <a href="#" data-toggle="tooltip" title="Last Name"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Email Address*</label>
    <div class="inr">
        <input type="text" value="<?php echo $admin_details[0]['admin_email'];?>" name="admin_email" id="admin_email" required="required">
        <a href="#" data-toggle="tooltip" title="Email Address"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Phone No*</label>
    <div class="inr">
        <input type="text" value="<?php echo $admin_details[0]['admin_phone'];?>" name="admin_phone" id="admin_phone" required="required">
        <a href="#" data-toggle="tooltip" title="Phone No"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<button type="submit" class="code-btn">Save</button>
</form>
<div class="top-sec clearfix">
<div class="heading">
    <h3>Change Password</h3>
    <p style="color: red; margin-top: -15px; margin-bottom: 15px;">astatic (*) filds are required filds</p>
</div>
</div>
<form action="<?php echo base_url('AdminDashboard/change-password'); ?>" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<div class="form-sec clearfix">
    <label>Old Password*</label>
    <div class="inr">
        <input type="password" value="" name="old_password" id="old_password" required="required">
        <a href="#" data-toggle="tooltip" title="Old Password"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>New Password*</label>
    <div class="inr">
        <input type="password" value="" name="new_password" id="new_password" required="required">
        <a href="#" data-toggle="tooltip" title="New Password"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<button type="submit" class="code-btn">Save</button>
</form>
</div>
</div>
</div>
</section>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
