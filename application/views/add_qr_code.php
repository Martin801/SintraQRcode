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
    <h3><?php echo $this->lang->line('QR-Code Administration'); ?></h3>
</div>
<div class="btn">
    <ul>
        <li class="cancel"><a href="<?php echo base_url('UserDashboard/list-qr');?>"><?php echo $this->lang->line('Cancel'); ?></a></li>
        <li class="save"><a href="javascript:void(0)" onclick="saveData()" id="saveData"><?php echo $this->lang->line('Save'); ?></a></li>
    </ul>
</div>
</div>
<div class="col-md-12">
<?php include('admin/inc/message.php'); ?>    
</div>
<div>
<div class="form-sec clearfix">
    <label>Name:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="" name="product_name" id="product_name" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_name'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Description'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="" name="product_description" id="product_description" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_description'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Product'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="" name="product_product" id="product_product" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_product'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label><?php echo $this->lang->line('Content'); ?>:<span style="color: red">*</span></label>
    <div class="inr">
        <input type="text" value="" name="product_content" id="product_content" placeholder="http://yourwebsite.com" required="required">
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_content'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>NFC:</label>
    <div class="inr">
    <label class="switch">
      <input type="checkbox" value="Yes" name="product_NFC" id="product_NFC">
      <span class="slider round"></span>
    </label>
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_NFC'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>Geo-Tag:</label>
    <div class="inr">
        <label class="switch">
      <input type="checkbox" value="Yes" name="product_geo_tag" id="product_geo_tag" >
      <span class="slider round"></span>
    </label>
        <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_geo_tag'); ?>"><i class="fa fa-info-circle"></i></a>
    </div>
</div>
<div class="form-sec clearfix">
    <label>QR-Code:<span style="color: red">*</span></label>
    <div class="inr">
        <label class="radio-inline">
          <input name="product_type" required="required" id="product_type" value="Static"  type="radio"><?php echo $this->lang->line('Static'); ?><span class="checkmark"></span>
        </label>
        <label class="radio-inline">
          <input name="product_type" required="required" id="product_type" value="Dynamic" type="radio"><?php echo $this->lang->line('Dynamic'); ?><span class="checkmark"></span>
        <label>
    </div>
</div>
<div class="form-sec clearfix">
<div class="inr">
    <div id="dataQr" style="width: 200px; height: 200px; border:1px solid #000; margin: 0 0 0 320px; "></div>
</div>
</div>
<button type="button" onclick="generateQrCode()" class="code-btn" id="qr_gen">
    <?php echo $this->lang->line('Generate QR-Code'); ?></button>
</div>
</div>
</div>
</div>
</section>
</main>
<?php include('inc/footer.php'); ?>
<script type="text/javascript">
function generateQrCode(){
//++++++++++++++++++++++++++++++++++++++++++++++++
var product_content = $("#product_content").val();
//++++++++++++++++++++++++++++++++++++++++++++++++
if (product_content == '') {
swal("Content Fild's Can't Be Blank");
} else {
$.ajax({
url: "<?php echo base_url('UserDashboard/get_qr_code'); ?>",
type: "POST",
dataType: "html",
beforeSend: function() {
$("#qr_gen").html('Processing.....');
},
data: {
product_content: product_content,
},
success: function(x) {
$("#qr_gen").html('Generate QR-Code');
if(x == 2){
swal("Content Fild's Can't Be Blank");
}else{
var img = '<img style="height: 100%; width: 100%;" src="'+x+'" alt="">';
$('#dataQr').html(img);
} 
}
});   
}
}
function saveData(){
//++++++++++++++++++++++++++++++++++++++++++++++++
var product_name    = $("#product_name").val();
var product_description = $("#product_description").val();
var product_content = $("#product_content").val();
var product_product = $("#product_product").val();
var product_NFC     = $('input[name="product_NFC"]:checked').val();
var product_geo_tag = $('input[name="product_geo_tag"]:checked').val();
var product_type    = $("input[name='product_type']:checked").val();
//++++++++++++++++++++++++++++++++++++++++++++++++
if ( (product_name == '') && (product_description == '') && (product_product == '') && (product_type == '') ) {
//++++++++++++++++++++++++++++++++++++++++++++++++    
let timerInterval
swal({
title: "Error!!!",
html:  "Fild's Can't Be Blank",
timer: 2000,
onOpen: () => {
swal.showLoading()
timerInterval = setInterval(() => {
swal.getContent().querySelector('strong')
.textContent = swal.getTimerLeft()
}, 100)
},onClose: () => {
clearInterval(timerInterval)
}
}).then((result) => {
if (result.dismiss === swal.DismissReason.timer) {
location.reload();
}
})
//++++++++++++++++++++++++++++++++++++++++++++++++
} else {
$.ajax({
url: "<?php echo base_url('UserDashboard/create_product'); ?>",
type: "POST",
dataType: "html",
beforeSend: function() {
$("#saveData").html('Saving...');
},
data: {
product_name: product_name,
product_description: product_description,
product_product: product_product,
product_content: product_content,
product_NFC: product_NFC,
product_geo_tag: product_geo_tag,
product_type: product_type,
'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
},
success: function(x) {
$("#saveData").html('Save');
if(x == 2){
let timerInterval
swal({
title: "Fild's Can't Be Blank",
html:  "I will close in <strong></strong> seconds.",
timer: 2000,
onOpen: () => {
swal.showLoading()
timerInterval = setInterval(() => {
swal.getContent().querySelector('strong')
.textContent = swal.getTimerLeft()
}, 100)
},
onClose: () => {
clearInterval(timerInterval)
}
}).then((result) => {
if (result.dismiss === swal.DismissReason.timer) {
location.reload();
}
})
}else{
location.href = '<?php echo base_url('UserDashboard/list-qr'); ?>';
} 
}
});   
}
}
</script>    
</body>
</html>
