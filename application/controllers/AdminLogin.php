<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLogin extends CI_Controller {
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function __construct()
{
	parent::__construct();
	$this->load->model('AllModal','alm');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function getSessionValidate()
{
	$session_details = $this->session->all_userdata();
	if(isset($session_details['admin_id'])){
	redirect('AdminDashboard','refresh');
	}else{
	$this->load->view('admin/index');
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index()
{
	$this->getSessionValidate();
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function login()
{

	$this->getSessionValidate();

	$this->form_validation->set_rules('admin_username', 'Username', 'required|trim');
	$this->form_validation->set_rules('admin_pwd', 'Password', 'required|trim');

	if ($this->form_validation->run() == FALSE){

	$this->session->set_flashdata('msg',validation_errors());
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('AdminLogin/index','refresh');

	}else{

	$get_username = $this->security->xss_clean($this->input->post('admin_username'));
	$get_password = $this->security->xss_clean($this->input->post('admin_pwd'));

	$data = $this->alm->loginAdmin($get_username,$get_password);

	if($data == FALSE){

	$this->session->set_flashdata('msg','INVALID USERNAME OR PASSWORD');
	$this->session->set_flashdata('msg_class','alert-danger');
	redirect('AdminLogin/index','refresh');

	}else{

	$this->session->set_userdata('admin_id',$data[0]['admin_id']);
	$this->session->set_userdata('admin_fname',$data[0]['admin_fname']);
	$this->session->set_userdata('admin_lname',$data[0]['admin_lname']);
	$this->session->set_userdata('admin_email',$data[0]['admin_email']);
	redirect('AdminDashboard','refresh');

	}
	}

}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function LogOut()
{
	$this->session->sess_destroy();
	redirect('AdminLogin','refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
//END CLASS
}
