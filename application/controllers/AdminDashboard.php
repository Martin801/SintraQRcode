<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminDashboard extends CI_Controller {
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function __construct()
{
	parent::__construct();
	$this->getSessionValidate();
	$this->load->model('AllModal','alm');
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
public function getSessionValidate()
{
	$this->__session_details = $this->session->all_userdata();
	if(!isset($this->__session_details['admin_id'])){
	redirect('AdminLogin','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index()
{
	$this->load->view('admin/dashboard');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function profile()
{
	$parms['admin_details'] = $this->alm->adminDetails();
	$this->load->view('admin/profile',$parms);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function profile_update()
{
	$this->form_validation->set_rules('admin_username', 'Username', 'required|trim');
	$this->form_validation->set_rules('admin_fname', 'First Name', 'required|trim');
	$this->form_validation->set_rules('admin_lname', 'Last Name', 'required|trim');
	$this->form_validation->set_rules('admin_email', 'Email', 'required|trim|valid_email');
	$this->form_validation->set_rules('admin_phone', 'Phone No', 'required|trim');

	if($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('AdminDashboard/profile','refresh');

	}else{

	// GET ALL THE POST DATA
	$post_data = $this->input->post();

	if(count($post_data) > 0){
	foreach($post_data as $key=>$value){
	$dataArray[$key] = $value;
	}

	$update = $this->cd->crud_update(ADMIN,$dataArray,'admin_id',1);

	if($update){
		$msg = 'Profile has been updated Successfully';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}

	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('AdminDashboard/profile','refresh');

	}else{
	redirect('AdminDashboard/profile','refresh');
	}

	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function change_password()
{
	$this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
	$this->form_validation->set_rules('new_password', 'New Password', 'required|trim');

	if($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('AdminDashboard/profile','refresh');

	}else{

	$get_old_password = $this->security->xss_clean($this->input->post('old_password'));
	$get_new_password = $this->security->xss_clean($this->input->post('new_password'));

	$result_data = $this->alm->adminChangePassword($get_old_password,$get_new_password);

	if($result_data){
		$msg = 'The password has been updated';
		$msg_class = 'alert-success';
	}else{
		$msg = 'The old password did not match';
		$msg_class = 'alert-danger';
	}

	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('AdminDashboard/profile','refresh');

	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function setting()
{
	$parms['setting'] = $this->alm->settingsDetails();
	$this->load->view('admin/setting',$parms);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function profile_setting()
{
	$post_data = $this->input->post();

	if(count($post_data) > 0){

	foreach($post_data as $key=>$value){
	$dataArray[$key] = $value;
	}

	$update = $this->cd->crud_update(SETTINGS,$dataArray,'id',1);

	if($update){
		$msg = 'Setting has been updated Successfully';
		$msg_class = 'alert-success';
	}else{
		$msg = 'Oops! Something went wrong';
		$msg_class = 'alert-danger';
	}

	$this->session->set_flashdata('msg',$msg);
	$this->session->set_flashdata('msg_class',$msg_class);
	redirect('AdminDashboard/setting','refresh');
	}else{
	redirect('AdminDashboard/setting','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function list_product()
{
	$param['list_product'] = $this->cd->crud_sql("SELECT * FROM ".PRODUCT." ",'A');
	$this->load->view('admin/list_product',$param);
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
	redirect('AdminDashboard/list-product','refresh');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function switch_language($language = "")
{
		$language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER'],'refresh');
}
//END CLASS
}
