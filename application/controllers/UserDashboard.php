<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserDashboard extends CI_Controller {
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function __construct()
{
	parent::__construct();
	$this->userAuth();
	$this->load->model('AllModal','alm');
	$this->load->model('Crud','cd');
	$this->initialize();
	require_once APPPATH.'third_party/phpqrcode/qrlib.php';
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
function initialize()
{
    $this->load->helper('language');
    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang == 'G') {
    $this->lang->load("german","german");
    } else {
    $this->lang->load("english","english");
    }
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function userAuth()
{
	$this->__session_details = $this->session->all_userdata();
	if(!isset($this->__session_details['user_id'])){
	redirect('Welcome','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index()
{
	$param['qr_code_count'] = $this->cd->crud_sql_numrow("SELECT * 
			FROM ".PRODUCT." WHERE  user_id = '".$this->session->userdata('user_id')."'");
	$param['qr_code'] = $this->cd->crud_sql("SELECT * 
			FROM ".PRODUCT." WHERE  user_id = '".$this->session->userdata('user_id')."' ORDER BY product_id DESC LIMIT 0,5");
	$this->load->view('dashboard',$param);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function list_qr()
{
	$param['list_data'] = $this->cd->crud_sql("SELECT * 
			FROM ".PRODUCT." WHERE  user_id = '".$this->session->userdata('user_id')."' ",'A');
	$this->load->view('list_qr_code',$param);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function add_qr()
{
	$this->load->view('add_qr_code');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function get_qr_code(){

	$post_data = $this->input->post();
	if(!empty($post_data['product_content'])){
	$tempDir = './uploadQrCode/';
	$codeContents = json_encode( $post_data['product_content'] ); 
    $fileName = '006_file_'.md5($codeContents).'.png'; 
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);
    echo base_url('/uploadQrCode/').$fileName;
	}else{
	echo 2;	
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function create_product()
{
	$time_rand = md5(time());
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$post_data = $this->input->post();
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	if(!empty($post_data['product_name']) && !empty($post_data['product_description']) && !empty($post_data['product_product']) && !empty($post_data['product_type']) && ($post_data['product_content']) ){
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/	
	$base_our_url = base_url().'Welcome/product-detail/'.$time_rand;
	$tempDir = './uploadQrCode/';
	$codeContents = $base_our_url; 
    $fileName = '005_file_'.$time_rand.'.png'; 
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    if($pngAbsoluteFilePath){ 
	$insert = $this->cd->crud_insert(PRODUCT,array(
	'user_id'        	  => $this->session->userdata('user_id'),
	'product_name'        => $post_data['product_name'],
	'product_description' => $post_data['product_description'],
	'product_product'     => $post_data['product_product'],
	'product_content'     => $post_data['product_content'],
	'product_NFC'         => !empty($post_data['product_NFC'])? $post_data['product_NFC'] : 'No',
	'product_geo_tag'     => !empty($post_data['product_geo_tag'])? $post_data['product_geo_tag'] : 'No',
	'product_type'        => $post_data['product_type'],
	'qr_code_file'        => $fileName,
	'product_text'        => $time_rand,
	'product_status'      => 1,
	));
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	if($insert){
		$msg = 'The data successfully created';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';	
	}
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	echo 1;
	}else{
	echo 2;		
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function edit_product($id='')
{
	if(!empty($id)){
	$param['edit_data'] = $this->cd->crud_sql("SELECT * FROM ".PRODUCT." 
											   WHERE  product_id = '".$id."' ",'A');
	$this->load->view('edit_qr_code',$param);
	}else{
	redirect('UserDashboard/list-qr','refresh');	
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function update_product()
{
	$time_rand = md5(time());
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$this->form_validation->set_rules('product_name', 'Name', 'required|trim');
	$this->form_validation->set_rules('product_description', 'Description', 'required|trim');
	$this->form_validation->set_rules('product_product', 'Product', 'required|trim');
	$this->form_validation->set_rules('product_content', 'Content', 'required|trim');
	$this->form_validation->set_rules('product_type', 'QR-Code', 'required|trim');

	if($this->form_validation->run() == FALSE){
	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');
	}else{
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$post_data = $this->input->post();
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	// $base_our_url = base_url().'Welcome/product-detail/'.$time_rand;
	// $tempDir = './uploadQrCode/';
	// $codeContents = $base_our_url ; 
	// $fileName = '005_file_'.$time_rand.'.png'; 
	// $pngAbsoluteFilePath = $tempDir.$fileName; 
	// QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $pngAbsoluteFilePath = TRUE;
    if($pngAbsoluteFilePath){ 
	$insert = $this->cd->crud_update(PRODUCT,array(
	'user_id'        	  => $this->session->userdata('user_id'),
	'product_name'        => $post_data['product_name'],
	'product_description' => $post_data['product_description'],
	'product_product'     => $post_data['product_product'],
	'product_content'     => $post_data['product_content'],
	'product_NFC'         => !empty($post_data['product_NFC'])? $post_data['product_NFC'] : 'No',
	'product_geo_tag'     => !empty($post_data['product_geo_tag'])? $post_data['product_geo_tag'] : 'No',
	'product_type'        => $post_data['product_type'],
	),'product_id',$post_data['id']);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	if($insert){
		$msg = 'The data successfully update';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';	
	}
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	}
	redirect('UserDashboard/list-qr','refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function delete_product($id='')
{
	if(!empty($id)){
	$this->cd->crud_delete_single_row(PRODUCT,'product_id',$id);
	$this->cd->crud_delete_single_row(PRODUCT_ANALYTICS,'product_id',$id);
	$msg = 'The data successfully deleted';
	$msg_class = 'alert-success';
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('UserDashboard/list-qr','refresh');
	}
}	
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function profile()
{
	$parms['user_details'] = $this->alm->userDetails($this->session->userdata('user_id'));
	$this->load->view('profile',$parms);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function profile_update()
{
	$config_img['upload_path']          = './profilePicture/';
	$config_img['allowed_types']        = 'gif|jpg|png';
	$config_img['remove_spaces']        = TRUE;
    $config_img['encrypt_name']         = TRUE;
	$this->load->library('upload', $config_img);

	$this->form_validation->set_rules('user_company_name', 'Company Name', 'required|trim');
	$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
	$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');
	$this->form_validation->set_rules('user_phone_no', 'Phone No', 'required|trim');
	$this->form_validation->set_rules('user_username', 'Username', 'required|trim');

	if($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',"Fild's Can't Be Blank");
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('UserDashboard/profile','refresh');

	}else{
	$post_data = $this->input->post();
	if(!empty($_FILES["user_picture"]["name"])){
	if (!$this->upload->do_upload('user_picture')){

	$data = array('error' => $this->upload->display_errors());
	$this->session->set_flashdata('msg',$data['error']);
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('UserDashboard/profile','refresh');	
	
	}else{
	$upload_data = $this->upload->data();	
	$dataArray = array(
		'user_company_name' => $post_data['user_company_name'],
		'user_name' => $post_data['user_name'],
		'user_email' => $post_data['user_email'],
		'user_phone_no' => $post_data['user_phone_no'],
		'user_username' => $post_data['user_username'],
		'user_picture' => $upload_data['file_name'],
	);
	$update = $this->cd->crud_update(USER,$dataArray,'user_id',$this->session->userdata('user_id'));
	if($update){
		$msg = 'Profile has been updated Successfully';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('UserDashboard/profile','refresh');	
	}	
	}else{
	$dataArray = array(
		'user_company_name' => $post_data['user_company_name'],
		'user_name' => $post_data['user_name'],
		'user_email' => $post_data['user_email'],
		'user_phone_no' => $post_data['user_phone_no'],
		'user_username' => $post_data['user_username'],
	);
	$update = $this->cd->crud_update(USER,$dataArray,'user_id',$this->session->userdata('user_id'));
	if($update){
		$msg = 'Profile has been updated Successfully';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('UserDashboard/profile','refresh');	
	}		
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function change_password()
{
	$this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
	$this->form_validation->set_rules('new_password', 'New Password', 'required|trim');
	if($this->form_validation->run() == FALSE){
	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('UserDashboard/profile','refresh');
	}else{
	$get_old_password = $this->security->xss_clean($this->input->post('old_password'));
	$get_new_password = $this->security->xss_clean($this->input->post('new_password'));
	$result_data = $this->alm->userChangePassword($get_old_password,$get_new_password,$this->session->userdata('user_id'));
	if($result_data){
		$msg = 'The password has been updated';
		$msg_class = 'alert-success';
	}else{
		$msg = 'The old password did not match';
		$msg_class = 'alert-danger';
	}
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('UserDashboard/profile','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function upload_csv()
{
	$time_rand 	  = md5(time());
	$base_our_url = base_url().'Welcome/product-detail/'.$time_rand;
	$config['upload_path']    = './uploadcsv/';
	$config['allowed_types']  = 'csv';
	$this->load->library('upload', $config);
	if ( ! $this->upload->do_upload('userfile')){
	$msg_class = 'alert alert-danger';					
	$this->session->set_flashdata('msg', $this->upload->display_errors());
	$this->session->set_flashdata('msg_class', $msg_class);
	redirect('UserDashboard/list-qr','refresh');
	}else{
	if(isset($_FILES["userfile"]["name"])){
	$path = $_FILES["userfile"]["tmp_name"];
	$handle = fopen($path, "r");
	while($csv_row = fgetcsv($handle, 10000, ",")){
	if(!empty($csv_row)){
	if(!empty($csv_row[0]) && !empty($csv_row[1]) && !empty($csv_row[2]) && !empty($csv_row[3]) && !empty($csv_row[4]) && !empty($csv_row[5]) && !empty($csv_row[6])){	
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/	
	$product_name        = $csv_row[0];
	$product_description = $csv_row[1];
	$product_product     = $csv_row[2];		    
	$product_content     = $csv_row[3];		    
	$product_NFC         = $csv_row[4];		    
	$product_geo_tag     = $csv_row[5];		    
	$product_type        = $csv_row[6];		
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$tempDir = './uploadQrCode/';
	$codeContents = $base_our_url; 
	$fileName     = '005_file_'.$time_rand.'.png'; 
	$pngAbsoluteFilePath = $tempDir.$fileName; 
	QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);	
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$data[] = array(
		'user_id'			   => $this->session->userdata('user_id'),	
		'product_name' 		   => $product_name ,	
		'product_description'  => $product_description,				      	    
		'product_product'      => $product_product,
		'product_content'      => $product_content,		      
		'product_NFC'          => strtoupper($product_NFC),		      
		'product_geo_tag'      => strtoupper($product_geo_tag),		      
		'product_type'         => $product_type,		      
		'qr_code_file'         => $fileName,
		'product_text'         => $time_rand,		      
		'product_status'       => 1,		      
	);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	}
	}	
	}
	if(!empty($data)){
	$insertcsv_data = $this->cd->crud_batch_insert(PRODUCT,$data);
	}else{
	$insertcsv_data = FALSE;	
	}
	if(!empty($insertcsv_data)){
		$msg = 'CSV is Successfully uploaded';
		$msg_class = 'alert alert-success';
	}else{
		$msg = 'Error Occure';
		$msg_class = 'alert alert-danger';
	}
		$this->session->set_flashdata('msg', $msg);
		$this->session->set_flashdata('msg_class', $msg_class);
		redirect('UserDashboard/list-qr','refresh');
	}
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function list_analytics()
{
	$param['list_data'] = $this->cd->crud_sql("SELECT * 
			FROM ".PRODUCT." WHERE  user_id = '".$this->session->userdata('user_id')."' ",'A');
	$this->load->view('list_qr_analytics',$param);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function map($id='')
{
	if(!empty($id)){
	$param['list_data'] = $this->cd->crud_sql("SELECT * FROM `qr_product_analytics` WHERE product_id = '".$id."'",'A');
	$this->load->view('map',$param);
	}else{
	redirect('UserDashboard/list-analytics','refresh');	
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function switch_language($language = "")
{
		$language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER'],'refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function toogle_product($id = '')
{
	if(!empty($id)){
	$product_data = $this->cd->crud_sql("SELECT * FROM ".PRODUCT." WHERE product_id = '".$id."'",'A');
	if($product_data[0]['product_status'] == 1){
	$status = 2;	
	}else{
	$status = 1;	
	}
	$update = $this->cd->crud_update(PRODUCT,array(
		'product_status' => $status,
	),'product_id',$product_data[0]['product_id']);
	if($update){
		$msg = 'Status has been updated Successfully';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('UserDashboard/list-qr','refresh');	

	}else{
	redirect('UserDashboard/list-qr','refresh');	
	}
}
//END CLASS
}
