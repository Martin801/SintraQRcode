<?php
function status($id = '')
{
	if($id == 1){
	$text = "<span class='label label-success'>ACTIVE</span>";	
	}else{
	$text = "<span class='label label-danger'>INACTIVE</span>";	
	}
	return $text;
}
function get_profile_details($id='')
{
	$CI =& get_instance();
	if(!empty($id)){
	$sql = "SELECT * FROM ".USER." WHERE user_id= ".$id." ";
	$exe = $CI->db->query($sql);
	return $exe->result_array();
	}else{
	return FALSE;
	}
}
function get_product_analytics_pdetails($id='')
{
	$CI =& get_instance();
	if(!empty($id)){
	$sql = "SELECT * FROM ".PRODUCT_ANALYTICS." WHERE product_id= ".$id." ";
	$exe = $CI->db->query($sql);
	return $exe->result_array();
	}else{
	return FALSE;
	}
}
function get_product_details($id='')
{
	$CI =& get_instance();
	if(!empty($id)){
	$sql = "SELECT * FROM ".PRODUCT." WHERE product_id= ".$id." ";
	$exe = $CI->db->query($sql);
	return $exe->result_array();
	}else{
	return FALSE;
	}
}
function get_used_qr_code()
{
	$CI =& get_instance();
	$sql = "SELECT `product_id`, COUNT(*) as countData FROM qr_product_analytics GROUP BY `product_id` ORDER BY countData DESC LIMIT 1";
	$exe = $CI->db->query($sql);
	return $exe->result_array();
}
function adminDetails($id=1)
{
	$CI =& get_instance();
	$sql = "SELECT * FROM ".ADMIN." WHERE admin_id= ".$id." ";
	$exe = $CI->db->query($sql);
	return $exe->result_array();
}

