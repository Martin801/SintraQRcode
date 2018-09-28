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
<div class="top-sec clearfix">
<div class="heading">
    <h3><?php echo $this->lang->line('Most used QR-Code'); ?></h3>
</div>
<div class="btn">
    <ul>
        <li><a href="#"><?php echo $this->lang->line('List QR-Code'); ?></a></li>
    </ul>
</div>
</div>
<div class="col-md-12">
<?php include('admin/inc/message.php'); ?>    
</div>
<form action="<?php echo base_url('UserDashboard/update-product'); ?>" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />   
<input type="hidden" name="id" value="<?php echo $edit_data[0]['product_id']; ?>">
<div class="form-sec clearfix">
    <label>Name:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $edit_data[0]['product_name']; ?>" name="product_name" id="product_name" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_name'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Description'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $edit_data[0]['product_description']; ?>" name="product_description" id="product_description" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_description'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Product'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $edit_data[0]['product_product']; ?>" name="product_product" id="product_product" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_product'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Content'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="<?php echo $edit_data[0]['product_content']; ?>" name="product_content" id="product_content" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_content'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>NFC:</label>
    <div class="inr">
    <label class="switch">
      <input type="checkbox" <?php if($edit_data[0]['product_NFC'] == 'Yes'){?> checked <?php } ?> value="Yes" name="product_NFC" id="product_NFC">
      <span class="slider round"></span>
    </label>
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_NFC'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Geo-Tag:</label>
    <div class="inr">
        <label class="switch">
      <input type="checkbox" <?php if($edit_data[0]['product_geo_tag'] == 'Yes'){?> checked <?php } ?> value="Yes" name="product_geo_tag" id="product_geo_tag" >
      <span class="slider round"></span>
    </label>
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_geo_tag'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>QR-Code:<span style="color: red">*</span></label>
    <div class="inr">
        <label class="radio-inline">
          <input name="product_type" required="required" id="product_type" value="Static" <?php if($edit_data[0]['product_type'] == 'Static'){?> checked <?php } ?>  type="radio"><?php echo $this->lang->line('Static'); ?><span class="checkmark"></span>
        </label>
        <label class="radio-inline">
          <input name="product_type" required="required" id="product_type" value="Dynamic" <?php if($edit_data[0]['product_type'] == 'Dynamic'){?> checked <?php } ?> type="radio"><?php echo $this->lang->line('Dynamic'); ?><span class="checkmark"></span>
        <label>
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
