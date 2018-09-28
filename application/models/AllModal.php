<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class AllModal extends CI_Model
{
public function __construct()
{
	parent::__construct();
	$this->load->model('Crud','cd');
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function get_total($table_name)
{
    return $this->db->count_all($table_name);
}	
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function loginAdmin($username, $password)
{
	if(!empty($username) and !empty($password))
	{

		$sql  = "SELECT * FROM ".ADMIN." WHERE ";
		$sql .= "admin_username='".$username."' ";
		$sql .= "AND ";
		$sql .= "admin_pwd='".md5($password)."' ";

		$exe   = $this->db->query($sql);
		$count = $exe->num_rows();

		if($count > 0)
		return $exe->result_array();
		else
		return FALSE;

	}else{
		return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function adminDetails($id=1)
{
	if(!empty($id)){
		$sql = "SELECT * FROM ".ADMIN." WHERE admin_id= ".$id." ";
		$this->__exe = $this->db->query($sql);
		return $this->__exe->result_array();
	}else{
		return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function adminChangePassword($oldPassword='',$newPassword='')
{
	if(!empty($oldPassword) and !empty($newPassword)){

		$data = $this->adminDetails();

		$oldPassword = md5($oldPassword);
		$newPassword = md5($newPassword);

		if($data[0]['admin_pwd'] == $oldPassword){

			$this->db->where('admin_id',$data[0]['admin_id']);
			$this->db->update(ADMIN,array('admin_pwd'=>$newPassword));

			return TRUE;

		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function settingsDetails($id=1)
{
	if(!empty($id))
	{
		$sql = "SELECT * FROM ".SETTINGS." WHERE id= ".$id." ";
		$exe = $this->db->query($sql);
		return $exe->result_array();
		
	}else{
		return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function loginUser($username, $password)
{
	if(!empty($username) and !empty($password))
	{

		$sql  = "SELECT * FROM ".USER." WHERE ";
		$sql .= "user_username='".$username."' ";
		$sql .= "AND ";
		$sql .= "user_password='".md5($password)."' AND  user_status = 1 ";

		$exe   = $this->db->query($sql);
		$count = $exe->num_rows();

		if($count > 0)
		return $exe->result_array();
		else
		return FALSE;

	}else{
		return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function userDetails($id='')
{
	if(!empty($id)){
	$sql = "SELECT * FROM ".USER." WHERE user_id= ".$id." ";
	$this->__exe = $this->db->query($sql);
	return $this->__exe->result_array();
	}else{
	return FALSE;
	}
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function userChangePassword($oldPassword='',$newPassword='',$id='')
{
	if(!empty($oldPassword) and !empty($newPassword)  and !empty($id)){

		$data = $this->userDetails($id);

		$oldPassword = md5($oldPassword);
		$newPassword = md5($newPassword);

		if($data[0]['user_password'] == $oldPassword){

			$this->db->where('user_id',$data[0]['user_id']);
			$this->db->update(USER,array('user_password'=>$newPassword));

			return TRUE;

		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}
//CLASS END
}
