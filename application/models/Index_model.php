<?php
Class Index_model extends CI_Model
{


	
	
	function get_memberLogin($usr, $pwd)
     	{
			$admin = $this->db->query("SELECT * FROM admin_users WHERE (email='".$usr."' OR urlname='".$usr."') AND password='".sha1($pwd)."'");
			//$admin = $this->db->query($user);
				
				if ($admin->num_rows() > 0)
				{
				 	 return array(
						'adminResult' => $admin->row_array(),
						'userType' => 'MasterAdmin'
						);
				}
				
    	 }
	 
	 
	 
	
	function record_count($table) {
        return $this->db->count_all($table);
    }
	
	
function getDataById($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($colId!=""){
				$this->db->where($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}

	
	function getDataByIdArray($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($id!=""){
				$this->db->where_in($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
	
	function getTable($table,$column,$order){
		$query =   $this->db
						->order_by($column, $order)
						->get($table);
		return $query;	
	}

function getOneItemTable($table,$tableColum,$userColum,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->get($table);
		return $query->row_array();	
	}
	
function getOneItemTableFromInstitute($table,$tableColum,$userColum,$instid,$instval,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->where($instid,$instval)
						->get($table);
		return $query->row_array();	
	}
// Display All data with id
function getAllItemTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($status!=""){
				  $this->db->where($statusColum,$status);
			  }
			
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}



function getAllAttandence($today,$start,$limit){
	   $this->db->select('*, MIN(access_time) AS mintime, MAX(access_time) AS maxtime');
	   
	   if($today!=""){
	   	$this->db->where('access_date',$today);
	   }
	   $this->db->group_by('std_id');
	   $this->db->order_by('std_id','ASC');
        if($start!="" && $limit!=""){
	       $this->db->limit($start,$limit);
        }
        elseif($start=="" && $limit!=""){
	       $this->db->limit($limit);
        }
	   $query = $this->db->get('attendance_device');
			 
	   return $query;
}


function getTotalAttandence($from,$to){
	   $this->db->select('*, MIN(access_time) AS mintime, MAX(access_time) AS maxtime');
	   
	   if($from!="" && $to!=""){
		 $this->db->where('access_date >=', $from);
	     $this->db->where('access_date <=', $to);
	   }
	   $this->db->group_by('std_id');
	   $this->db->order_by('std_id','ASC');
	   $query = $this->db->get('attendance_device');
			 
	   return $query;
}








function getTodayPresent($today){
	   
	   $this->db->select('*');
	   $this->db->from('employees e');
	   $this->db->join('attendance_device a', 'a.std_id=e.emp_id', 'left');
	   
	   $this->db->where('a.access_date',$today);
	   $this->db->order_by('e.emp_id','ASC');
	   $query = $this->db->get();
			 
	   return $query;
}

function getAllPresent($from,$to){
	   
	   $this->db->select('*');
	   $this->db->from('employees e');
	   $this->db->join('attendance_device a', 'a.std_id=e.emp_id', 'left');
	   
	   $this->db->where('a.access_date >=', $from);
	   $this->db->where('a.access_date <=', $to);

	   $this->db->order_by('e.emp_id','ASC');
	   $query = $this->db->get();
			 
	   return $query;
}

function getAllAttandenceAbsent($presentId){

	   $this->db->where_not_in('emp_id', $presentId);
	   $this->db->order_by('emp_id','ASC');
	   $query = $this->db->get('employees');
			 
	   return $query;
}


function getAllAttenEmployee($emplid){

	   $this->db->where_in('emp_id', $emplid);
	   $this->db->order_by('emp_name','ASC');
	   $query = $this->db->get('employees');
			 
	   return $query;
}




function getAllItemTableGroupBy($table,$colum,$id,$statusColum,$status,$userid,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($status!=""){
				  $this->db->where($statusColum,$status);
			  }
			
			  $this->db->group_by($userid);
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}


function getAllMember($keyword,$searchkey){
	  if($keyword!=""){
		  $this->db->like('company_name', $keyword);
		  $this->db->or_like('head_organization', $keyword);
		  $this->db->or_like('contact_person', $keyword);
		  $this->db->or_like('contact', $keyword);
		  $this->db->or_like('email', $keyword);
	  }
	  if($searchkey!=""){
		  $this->db->like('company_name', $searchkey, 'after');
	  }
	  $this->db->order_by('company_name','asc');
	  $query = $this->db->get('member');
	 return $query;
}

/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $insertData){
		if($this->db->insert($table, $insertData)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}

	 
	function update_table($table, $colid,$idval, $uvalue){
		$this->db->where($colid,$idval);
		$dbquery = $this->db->update($table, $uvalue); 
		if($dbquery)
			return true;
		else
			return false;
	}
	
	function updateTable($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	 function checkOldPass($table,$old_password,$cid)
		{
			$this->db->where('email', $this->session->userdata('instituteAccessMail'));
			$this->db->where('id', $cid);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
			/*if($query->num_rows() > 0)
				return 1;
			else
				return 0;*/
		}




public function productrecord_count() {
    	return $this->db->count_all("product");
    }
function get_product($field_name) 
	{
		$this->db->select('*');
		if($field_name!=""){
			$this->db->like('product_name', $field_name);
		}
		$this->db->order_by('product_id', 'desc');
		$query= $this->db->get('product');
		return $query->result();	  
			  
	}

 function update_status($table,$status,$id)
	{
		 $save=array('status'=>$status);
			$this->db->where('order_id', $id);
			$this->db->update($table, $save);
			return false;
	}
	
	
function stock_update($update,$savedata,$status)
	{
		$this->db->where('pro_id', $update['pro_id']);
		$this->db->update('stock', $update);
		
		if($status=="stockout"){
			$this->db->insert('stock_out', $savedata);
		}
		elseif($status=="return"){
			$this->db->insert('return_product', $savedata);
		}
		return false;
	}
	

	
	
	
function update_inventory($update)
	{
		$this->db->where('product_id', $update['product_id']);
		$this->db->update('inventory', $update);
		return false;
	}
	
	
	
	function getAllItemLikeItem($table,$colum,$id,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->like($colum,$id);
			  }
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}

/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}
}

?>