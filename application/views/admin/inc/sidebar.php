<?php $get_admin_details = adminDetails(1); ?>
<div class="left">
    <div class="image"><a href="<?php echo base_url('AdminDashboard'); ?>">
    <img src="<?php echo base_url('public'); ?>/assets/images/main-img1.png" alt="">
	</a>
	</div>
    <h2><?php echo strtoupper($get_admin_details[0]['admin_fname'].' '.$get_admin_details[0]['admin_lname']); ?></h2>
    <p><?php echo $get_admin_details[0]['admin_email']; ?></p>
    <ul>
        <li class="single <?php if(($this->router->fetch_class() == 'AdminDashboard') && ($this->router->fetch_method() == 'index')){?> selectMenu <?php } ?>"><a href="<?php echo base_url('AdminDashboard');?>"><?php echo $this->lang->line('Dashboard'); ?></a></li>
        <li class="<?php if(($this->router->fetch_class() == 'User') && ($this->router->fetch_method() == 'index')){?> single selectMenu <?php } ?>"><a href="<?php echo base_url('User/index'); ?>"><?php echo $this->lang->line('Customer'); ?></a></li>
    </ul>
</div>