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
        <a href="<?php echo base_url('User/index'); ?>" class="blue">
            <h3><?php echo $this->lang->line('Total Companys'); ?></h3>
            <h4><?php echo $this->db->count_all_results(USER); ?></h4>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('AdminDashboard/list-product'); ?>" class="green">
            <h3><?php echo $this->lang->line('Totally Created QR-Codes'); ?></h3>
            <h4><?php echo $this->db->count_all_results(PRODUCT); ?></h4>
        </a>
    </li>
</ul>
</div>
</div>
</section>
</main>
    <?php include('inc/footer.php'); ?>
</body>
</html>
