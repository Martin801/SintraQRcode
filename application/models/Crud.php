<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Crud extends CI_Model
{
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
private $sql;
private $query;
private $get_last_insert_id;
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function __construct()
{
parent::__construct();
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_compiled_insert($table_name,$data)
{
if (count($data) > 0 && !empty($table_name))
{
$sql = $this->db->set($data)->get_compiled_insert($table_name);
return $this->sql;
} else {
throw new Exception("THE TABLE NAME OR VALUE MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_insert($table_name,$data)
{
if (count($data) > 0 && !empty($table_name))
{
$this->db->insert($table_name, $data);
$this->get_last_insert_id = $this->db->insert_id();
return $this->get_last_insert_id;
} else {
throw new Exception("THE TABLE NAME OR VALUE MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_batch_insert($table_name,$data)
{
if (count($data) > 0 && !empty($table_name))
{
$this->db->insert_batch($table_name, $data);
$this->get_last_insert_id = $this->db->insert_id();
return $this->get_last_insert_id;
} else {
throw new Exception("THE TABLE NAME OR VALUE MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_update($table_name,$data,$field_name,$id)
{
if (count($data) > 0 && !empty($table_name) && !empty($field_name) && !empty($id))
{
$this->db->where($field_name, $id);
$this->db->update($table_name, $data);
return true;
} else {
throw new Exception("THE TABLE NAME OR VALUE OR FILD NAME OR ID MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_select_full_table($table_name,$type_of_data='A')
{
if (!empty($table_name))
{
$this->query = $this->db->get($table_name);
if($type_of_data == 'A'){
return $this->query->result_array();
}else{
if($type_of_data == 'O'){
return $this->query->result();
}else{
throw new Exception("THE TYPE MUST BE A-(ARRAY) OR O-(OBJECT)");
}
}
}else{
throw new Exception("THE TABLE NAME MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_sql($sql,$type_of_data='A')
{
if (!empty($sql))
{
$this->query = $this->db->query($sql);
if($type_of_data == 'A'){
return $this->query->result_array();
}else{
if($type_of_data == 'O'){
return $this->query->result();
}else{
throw new Exception("THE TYPE MUST BE A-(ARRAY) OR O-(OBJECT)");
}
}
}else{
throw new Exception("THE SQL NAME MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_sql_numrow($sql)
{
if (!empty($sql))
{
$this->query = $this->db->query($sql);
return $this->query->num_rows();
}else{
throw new Exception("THE SQL NAME MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_delete_single_row($table_name,$fild_name,$id)
{
if((!empty($table_name)) && (!empty($fild_name)) && (!empty($id))){
$this->db->delete($table_name, array($fild_name => $id));
return true;
}else{
throw new Exception("THE TABLE NAME OR FILD NAME OR ID MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_delete_foreignkey_row($table_name,$fild_name,$id)
{
if((count($table_name) > 0) && (!empty($fild_name)) && (!empty($id))){
$this->db->where($fild_name, $id);
$this->db->delete($tables);
return true;
}else{
throw new Exception("THE TABLE NAME OR FILD NAME OR ID MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_empty_table($table_name)
{
if((!empty($table_name))){
$this->db->empty_table($table_name);
return true;
}else{
throw new Exception("THE TABLE NAME MISSING");
}
}
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
///
/* ==+++++++++++++++++++++++++++++++++++++++++++++++== */
public function crud_truncate($table_name)
{
if((!empty($table_name))){
$this->db->truncate($table_name);
return true;
}else{
throw new Exception("THE TABLE NAME MISSING");
}
}
//CLASS END
}
