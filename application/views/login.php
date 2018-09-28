<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/media.css" type="text/css">
    <script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/jquery.min.js"></script>
</head>
<body>
<header class="clearfix">
<div class="header clearfix">
<div class="container-fluid">
<div class="logo">
    <a href="<?php echo base_url(); ?>">
    <img src="<?php echo base_url('public'); ?>/assets/images/logo.png" alt="">
    </a>
</div>
<div class="icon">
    <ul>
        <li>
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('public'); ?>/assets/images/logo-img1.png" alt="">
        </a>
        </li>
    </ul>
</div>
</div>
</div>
</header>
<main>
<section class="login-sec">
    <div class="container">
        <div class="image">
            <img src="<?php echo base_url('public'); ?>/assets/images/login-img.jpg" alt="">
        </div>
        <div class="col-md-12">
        <?php include('admin/inc/message.php'); ?>    
        </div>
        <form action="<?php echo base_url('Welcome/user-login'); ?>" method="POST">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" /> 
            <div class="input-block">
                <i class="fa fa-user-circle"></i>
                <input required="required" type="text" placeholder="Username" name="user_nutzername" id="user_nutzername">
            </div>
            <div class="input-block">
                <i class="fa fa-lock"></i>
                <input required="required" type="password" placeholder="Password" name="user_passwort" id="user_passwort">
            </div>
            <button type="submit" class="code-btn">Login</button>
        </form>
    </div>
</section>
</main>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/script.js"></script>
</body>
</html>
