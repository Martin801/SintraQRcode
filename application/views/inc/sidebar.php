<?php $get_all_the_details = get_profile_details($this->session->userdata('user_id')); ?>
<div class="left">
<div class="image">
	<a href="<?php echo base_url(); ?>">
	<?php 
	if(!empty($get_all_the_details[0]['user_picture'])){
	?>
	<img src="<?php echo base_url(); ?>/profilePicture/<?php echo $get_all_the_details[0]['user_picture']; ?>" style="width: 200px;
    height: 103px; border-radius: 100%;" alt="">
	<?php	
	}else{
	?>
	<img src="<?php echo base_url('public'); ?>/assets/images/main-img1.png" alt="">
	<?php	
	}
	?>	
	</a></div>
<h2><?php echo strtoupper($get_all_the_details[0]['user_name']); ?></h2>
<p><?php echo strtolower($get_all_the_details[0]['user_email']); ?></p>
<ul>
    <li class="single <?php if(($this->router->fetch_class() == 'UserDashboard') && ($this->router->fetch_method() == 'index')){?> selectMenu <?php } ?>"><a href="<?php echo base_url('UserDashboard');?>"><?php echo $this->lang->line('Dashboard'); ?></a></li>

    <li class="<?php if(($this->router->fetch_class() == 'UserDashboard') && ($this->router->fetch_method() == 'list_qr') || ($this->router->fetch_method() == 'add_qr')){?> single selectMenu <?php } ?>" ><a href="<?php echo base_url('UserDashboard/list-qr');?>"><?php echo $this->lang->line('QR-Code Administration'); ?></a></li>
    
    <li class="<?php if(($this->router->fetch_class() == 'UserDashboard') && ($this->router->fetch_method() == 'list_analytics')){?> single selectMenu <?php } ?>" ><a href="<?php echo base_url('UserDashboard/list-analytics');?>"><?php echo $this->lang->line('QR-Code Analytics'); ?></a></li>
</ul>
</div>