<header class="clearfix">
<div class="header clearfix">
    <div class="container-fluid">
        <div class="logo">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public'); ?>/assets/images/logo.png" alt=""></a>
        </div>
        <div class="icon">
            <ul>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php 
                    if($site_lang == 'G'){
                    $picture_URL = base_url('public').'/assets/images/logo-img1.png';
                    }else{
                    $picture_URL = base_url('public').'/assets/images/england-Flag1.png';    
                    } 
                    ?>
                    <img src="<?php echo $picture_URL; ?>" alt="">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <ul>
                       <li><a href="<?php echo base_url('UserDashboard/switch-language/G'); ?>" class="dropdown-item"><img src="<?php echo base_url('public'); ?>/assets/images/logo-img1.png"></a></li>
                       <li><a href="<?php echo base_url('UserDashboard/switch-language/E'); ?>" class="dropdown-item"><img src="<?php echo base_url('public'); ?>/assets/images/england-Flag1.png"></a></li>
                   </ul>
                   </div>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo base_url('UserDashboard/profile'); ?>">
                <img src="<?php echo base_url('public'); ?>/assets/images/logo-img2.png" alt="">
                </a>
                <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul>
                        <li><a href="<?php echo base_url('UserDashboard/profile'); ?>" class="dropdown-item"><?php echo $this->lang->line('My Profile'); ?></a></li>
                        <li><a href="<?php echo base_url('UserDashboard/profile'); ?>" class="dropdown-item"><?php echo $this->lang->line('Change Password'); ?></a></li>
                    </ul>
                </div> -->
                </li>
                <li><a href="<?php echo base_url('Welcome/LogOut'); ?>">
                    <img src="<?php echo base_url('public'); ?>/assets/images/logo-img3.png" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
</div>
</header>