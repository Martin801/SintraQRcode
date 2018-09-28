<!DOCTYPE html>
<html lang="de">
<head>
    <?php include('inc/top.php'); ?>
</head>
<body>
    <?php include('inc/header.php'); ?>
<main>
<section class="table-main dashboard-main clearfix">
    <?php include('inc/sidebar.php'); ?>
<div class="middle">
<div class="container-fluid">
<ul>
    <li>
        <a href="<?php echo base_url('UserDashboard/list-qr'); ?>" class="blue">
            <h3><?php echo $this->lang->line('Created QR codes'); ?></h3>
            <h4><?php echo number_format($qr_code_count); ?></h4>
        </a>
    </li>
    <li>
        <a href="#" class="green">
            <h3><?php echo $this->lang->line('Most Used QR-Code'); ?></h3>
            <?php
            $get_data = get_used_qr_code();
            if(!empty($get_data)){
            $get_product = get_product_details($get_data[0]['product_id']);
            if(!empty($get_product)){
            ?>
            <h4>"<?php echo $get_product[0]['product_name']; ?>"</h4>
            <?php
            }else{
            ?>
            <h4><?php echo $this->lang->line('No Data Available'); ?></h4>
            <?php
            }
            }else{
            ?>
            <h4><?php echo $this->lang->line('No Data Available'); ?></h4>
            <?php } ?>
        </a>
    </li>
</ul>
</div>
</div>
<div class="right">
   <div class="container-fluid">
    <h5><?php echo $this->lang->line('Last User Actions'); ?></h5>
    <?php
    $i = 0;
    if(!empty($qr_code)){
    foreach ($qr_code as $data_qr_code){
    $get_user = get_profile_details($data_qr_code['user_id']);
    ?>
    <div class="block clearfix">
        <div class="pic" style="<?php echo ($i%2 == 0)? 'float: left' : 'float: right' ?>">
        <?php if(!empty($get_user[0]['user_picture'])){ ?>
        <img src="<?php echo base_url(); ?>/profilePicture/<?php echo $get_user[0]['user_picture']; ?>" style="width: 40px;
        height: 40px; border-radius: 100%;" alt="">
        <?php   
        }else{
        ?>
        <img src="<?php echo base_url('public'); ?>/assets/icon/icon.png" alt="">
        <?php   
        }
        ?>
        </div>
        <div class="content"style="<?php echo ($i%2 == 0)? 'padding-left: 50px' : '' ?>">
            <h6><?php echo $get_user[0]['user_name']; ?></h6>
            <p>Created new QR code</p>
            <p><i><?php echo $data_qr_code['created_on']; ?></i></p>
        </div>
    </div>
    <?php 
    $i++; 
    }
    }
    ?>

    </div>
</div>
</section>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
