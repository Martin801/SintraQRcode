<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function __construct()
{
parent::__construct();
$this->load->model('AllModal','alm');
$this->switch_language('G');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function userAuth()
{
$get_user_data = $this->session->all_userdata();
if(!empty($get_user_data['user_id'])){
redirect('UserDashboard','refresh');
}else{
$this->load->view('login');
}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index()
{
$this->userAuth();
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function user_login()
{
$this->userAuth();
$this->form_validation->set_rules('user_nutzername', 'Username', 'required|trim');
$this->form_validation->set_rules('user_passwort', 'Password', 'required|trim');
if ($this->form_validation->run() == FALSE){
$this->session->set_flashdata('msg',validation_errors());
$this->session->set_flashdata('msg_class','alert-danger');
redirect('Welcome/index','refresh');
}else{
$get_username = $this->security->xss_clean($this->input->post('user_nutzername'));
$get_password = $this->security->xss_clean($this->input->post('user_passwort'));
$data = $this->alm->loginUser($get_username,$get_password);
if($data == FALSE){
$this->session->set_flashdata('msg','INVALID USERNAME OR PASSWORD');
$this->session->set_flashdata('msg_class','alert-danger');
redirect('Welcome/index','refresh');
}else{
$this->session->set_userdata('user_id',$data[0]['user_id']);
$this->session->set_userdata('user_name',$data[0]['user_name']);
$this->session->set_userdata('user_email',$data[0]['user_email']);
$this->session->set_userdata('user_phone_no',$data[0]['user_phone_no']);
$this->session->set_userdata('user_username',$data[0]['user_username']);
redirect('UserDashboard','refresh');
}
}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function LogOut(){
$this->session->sess_destroy();
redirect('Welcome','refresh');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function product_detail($id_code = ''){
include APPPATH . 'third_party/geoplugin/geoplugin.php';
if(!empty($id_code)){
$geoplugin = new geoPlugin();
$geoplugin->locate();
$this->db->select('*');
$this->db->from(PRODUCT);
$this->db->where('product_text',$id_code);
$query = $this->db->get();
$count = $query->num_rows();
if($count > 0){
$get_query_details = $query->result_array();
if($get_query_details[0]['product_status'] == 1){
$insert = $this->cd->crud_insert(PRODUCT_ANALYTICS,array(
'user_id'      => $get_query_details[0]['user_id'],
'product_id'   => $get_query_details[0]['product_id'],
'ip_address'   => $geoplugin->ip,
'country_name' => $geoplugin->countryName,
'country_code' => $geoplugin->countryCode,
'city' 		   => $geoplugin->city,
'region'       => $geoplugin->region,
'latitude'     => $geoplugin->latitude,
'longitude'    => $geoplugin->longitude
));
if($insert){
$parsed = parse_url($get_query_details[0]['product_content']);
if(!empty($parsed['scheme'])){
redirect($get_query_details[0]['product_content'],'refresh');
}else{
$new_url = 'http://' .$get_query_details[0]['product_content'].'/';	
redirect($new_url,'refresh');	
}
}else{
echo "Sorry!! something went wrong.Please try after some time.";
die();
}
}else{
echo "Sorry!! the QR-Code you have scan is not actived.";
die();	
}
}else{
echo "Sorry!! something went wrong.Please try after some time.";
die();
}
}else{
echo "Sorry!! something went wrong.Please try after some time.";
die();
}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function switch_language($language = "")
{
	$language = ($language != "") ? $language : "english";
    $this->session->set_userdata('site_lang', $language);
}
//END CLASS
}
