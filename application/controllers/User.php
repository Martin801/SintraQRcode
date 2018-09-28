<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function __construct(){
	parent::__construct();
	$this->getSessionValidate();
	$this->load->model('Crud','cd');
	$this->initialize();
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
public function getSessionValidate(){
	$this->__session_details = $this->session->all_userdata();
	if(!isset($this->__session_details['admin_id'])){
	redirect('AdminLogin','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index(){
	$parms['user_listing'] = $this->cd->crud_sql("SELECT * FROM ".USER." ",'A');
	$this->load->view('admin/user_listing',$parms);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function create_user(){


	$this->form_validation->set_rules('user_company_name', 'Company Name', 'required|trim');
	$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
	$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|is_unique[qr_user.user_email]');
	$this->form_validation->set_rules('user_phone_no', 'Phone No', 'required|trim');
	$this->form_validation->set_rules('user_username', 'Username', 'required|trim|is_unique[qr_user.user_username]');
	$this->form_validation->set_rules('user_password', 'Password', 'required|trim');
	$this->form_validation->set_rules('user_status', 'Status', 'required');

	if($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');

	}else{
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$post_data = $this->input->post();
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$insert = $this->cd->crud_insert(USER,array(
	'user_company_name' => $post_data['user_company_name'],
	'user_name'    => $post_data['user_name'],
	'user_email'   => $post_data['user_email'],
	'user_phone_no'=> $post_data['user_phone_no'],
	'user_username'=> $post_data['user_username'],
	'user_password'=> md5($post_data['user_password']),
	'user_status'=> $post_data['user_status']
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
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	}
	redirect('User/index','refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function update_user(){

	$this->form_validation->set_rules('id', 'ID', 'required|trim');
	$this->form_validation->set_rules('user_company_name', 'Company Name', 'required|trim');
	$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
	$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');
	$this->form_validation->set_rules('user_phone_no', 'Phone No', 'required|trim');
	$this->form_validation->set_rules('user_username', 'Username', 'required|trim');
	$this->form_validation->set_rules('user_status', 'Status', 'required');

	if($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');

	}else{
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$post_data = $this->input->post();
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	if(!empty($post_data['user_password'])){
	$data = array(
		'user_company_name' => $post_data['user_company_name'],
		'user_name'    => $post_data['user_name'],
		'user_email'   => $post_data['user_email'],
		'user_phone_no'=> $post_data['user_phone_no'],
		'user_username'=> $post_data['user_username'],
		'user_password'=> md5($post_data['user_password']),
		'user_status'=> $post_data['user_status']
	);
	}else{
	$data = array(
		'user_company_name' => $post_data['user_company_name'],
		'user_name' => $post_data['user_name'],
		'user_email'  => $post_data['user_email'],
		'user_phone_no'=> $post_data['user_phone_no'],
		'user_username'=> $post_data['user_username'],
		'user_status'=> $post_data['user_status']
	);
	}
	$update = $this->cd->crud_update(USER,$data,'user_id',$post_data['id']);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	if($update){
		$msg = 'The data successfully updated';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	}
	redirect('User/index','refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function destroy($id = '')
{
	if(!empty($id)){
	$this->cd->crud_delete_single_row(USER,'user_id',$id);
	$msg = 'The data successfully deleted';
	$msg_class = 'alert-success';
	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	}
	redirect('User/index','refresh');
}
//END CLASS
}
