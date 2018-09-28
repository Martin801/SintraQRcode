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
    <h3>Setting</h3>
    <p style="color: red; margin-top: -15px; margin-bottom: 15px;">astatic (*) filds are required filds</p>
</div>
</div>
<form action="<?php echo base_url('AdminDashboard/profile-setting'); ?>" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<div class="form-sec clearfix">
    <label>Facebook Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['facebook_link'];?>" name="facebook_link" id="facebook_link">
        <a href="#" data-toggle="tooltip" title="Facebook Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Twitter Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['twitter_link'];?>" name="twitter_link" id="twitter_link">
        <a href="#" data-toggle="tooltip" title="Twitter Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Linkedin Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['linkedIn_link'];?>" name="linkedIn_link" id="linkedIn_link">
        <a href="#" data-toggle="tooltip" title="Linkedin Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Pinterest Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['pinterest_link'];?>" name="pinterest_link" id="pinterest_link">
        <a href="#" data-toggle="tooltip" title="Pinterest Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Google Plus Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['google_plus_link'];?>" name="google_plus_link" id="google_plus_link">
        <a href="#" data-toggle="tooltip" title="Google Plus Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Instagram Link</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['instagram_link'];?>" name="instagram_link" id="instagram_link">
        <a href="#" data-toggle="tooltip" title="Instagram Link"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Address</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['address'];?>" name="address" id="address">
        <a href="#" data-toggle="tooltip" title="Address"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>State</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['state'];?>" name="state" id="state">
        <a href="#" data-toggle="tooltip" title="State"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>City</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['city'];?>" name="city" id="city">
        <a href="#" data-toggle="tooltip" title="City"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Zipcode</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['zipcode'];?>" name="zipcode" id="zipcode">
        <a href="#" data-toggle="tooltip" title="Zipcode"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Site Email</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['site_email'];?>" name="site_email" id="site_email">
        <a href="#" data-toggle="tooltip" title="Site Email"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>From Email</label>
    <div class="inr">
        <input type="text" value="<?php echo $setting[0]['form_email'];?>" name="form_email" id="form_email">
        <a href="#" data-toggle="tooltip" title="From Email"><i class="fa fa-info-circle"></i></a>
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
