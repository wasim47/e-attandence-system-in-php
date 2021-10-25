<?php defined('BASEPATH') OR exit('No direct script access allowed');
				
	class Index extends CI_Controller { 
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('url');
        $this->load->library('email');
		$this->load->helper('common_helper');
	}
	
    function index()
	{
			$data['title'] =  'Lithy Group | Copotronic eAttendance';

			if($this->session->userdata('adminAccessMail')) redirect("index/dashboard");
			$data['title']="Admin Panel Copotronic eAttendance  | eAttendance ";
			$this->load->view('admin/index',$data);
	}


function makeChangeTime()
	{
			
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
		
			$data['timeUpdate'] = $this->Index_model->getAllItemTable('time_setting','','','','','id','desc');
			$data['title']="Time Setting Update | Copotronic eAttendance";
			$this->form_validation->set_rules('intime', 'In Time', 'trim|required');
			$this->form_validation->set_rules('outtime', 'Out Time', 'trim|required');

		if($this->input->post('registration') && $this->input->post('registration')!=""){

			if($this->form_validation->run() != false){
			
				$save['intime']=$this->input->post('intime');
				$save['outtime']=$this->input->post('outtime');
				
				if($data['timeUpdate']->num_rows() > 0){
					$id=$this->input->post('id');
					$this->Index_model->update_table('time_setting','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('time_setting', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('index/makeChangeTime', 'refresh');
			}
			else{
				$data['main_content']="admin/attendance/make_change_time";
        		$this->load->view('admin_template', $data);
			}
		}
		else{
			$data['main_content']="admin/attendance/make_change_time";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	
	
	 public function userLogin()
     {
			$data['title'] =  ' Admin Panel | Copotronic eAttendance ';
          $username = $this->input->post("username");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("username", "Username or Email", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('index');
          }
          else
          {
                    $usr_result = $this->Index_model->get_memberLogin($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
						$userType = $usr_result['userType'];
						if(isset($usr_result['adminResult'])){
							$adminQuery = $usr_result['adminResult'];
							if ($adminQuery > 0)
							  {
							  	 $sessiondata = array(
									'adminAccessMail'=>$username,
									'adminAccessName'=> $adminQuery['username'],
									'adminType'=> $adminQuery['admin_type'],
									'userType'=> $userType,
									'adminAccessId' => $adminQuery['id'],
									'password' => TRUE
								   );
							  }
							  
							  $this->session->set_userdata($sessiondata);
							  redirect("index/dashboard/");
						}
						
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('index', 'refresh');
                    }
				}
     }
	 
	 
    function logout()
  	{
			$data['title'] =  ' Admin Panel | Copotronic eAttendance ';
	  	
			$sessiondata = array(
					'adminAccessMail'=>'',
					'adminAccessName'=> '',
					'adminType'=> '',
					'adminAccess'=>'',
					'userType'=>'',
					'instituteAccessId' => '',
					'password' => FALSE
			 );
		$this->session->unset_userdata($sessiondata);
		$this->session->sess_destroy();
		redirect('index', 'refresh');
  }
	
	
	     
	function dashboard()
	{
		

			$data['title'] =  'Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');

			$today = date('Y-m-d');
			$data['timeUpdate'] = $this->Index_model->getAllItemTable('time_setting','','','','','id','desc');
			
			$data['total_attend_data'] = $this->Index_model->getAllAttandence('','',10);
			$data['today_attend_data'] = $this->Index_model->getAllAttandence('','',10);
			
			//$data['total_attend_data'] = $this->Index_model->getAllItemTable('attendance_device','','','','','atid','asc');
			//$data['today_attend_data'] = $this->Index_model->getAllItemTable('attendance_device','access_date',$today,'','','atid','asc');
			
			$data['main_content']="admin/dashboard";
			$this->load->view('admin_template',$data);
	}
	
	
	
	
	function employees()
	{
			$data['title'] =  'Employees List of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');

			$today = date('Y-m-d');
			$data['employee_info'] = $this->Index_model->getAllItemTable('employees','','','','','emp_name','asc');
			
			$data['main_content']="admin/attendance/employees";
			$this->load->view('admin_template',$data);
	}
	
	
	/*function attendance_status()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$todayPresent = $this->Index_model->getAllAttandencePresent();
			//$todayPresent = $this->Index_model->getAllAttandenceAbsent();
			foreach($todayPresent->result() as $res){
				$empid[] = $res->emp_id;
			}
			$todayAbsant = $this->Index_model->getAllAttandenceAbsent($empid);
			foreach($todayAbsant->result() as $resa){
				$empida[] = $resa->emp_id;
			}
			
			$arrayMarg = array_merge($empid,$empida);
			//print_r($arrayMarg);
			
			$data['employee_info'] = $this->Index_model->getAllAttenEmployee($arrayMarg);
			$data['main_content']="admin/attendance/attendance_status";
			$this->load->view('admin_template',$data);
	}*/
	
	
	
	function today_attendance_status()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$data['employee_info'] = $this->Index_model->getAllItemTable('employees','','','','','emp_name','asc');
			$today =date('Y-m-d');
			
			$data['todayPresent'] = $this->Index_model->getTodayPresent($today);
			foreach($data['todayPresent']->result() as $res){
				$empid[] = $res->emp_id;
			}
			$data['todayAbsant'] = $this->Index_model->getAllAttandenceAbsent($empid);
			//$data['employee_info'] = $this->Index_model->getAllAttenEmployee($arrayMarg);
			$data['main_content']="admin/attendance/today_attendance_status";
			$this->load->view('admin_template',$data);
	}
	
	function attendance_status()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$data['employee_info'] = $this->Index_model->getAllItemTable('employees','','','','','emp_name','asc');
			
			$data['main_content']="admin/attendance/attendance_status";
			$this->load->view('admin_template',$data);
	}
	
	
	function attendance_ajax()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$data['employee_info'] = $this->Index_model->getAllItemTable('employees','','','','','emp_name','asc');
			
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sessiondata = array(
							'toDate'=>$fromdate,
							'fromDate'=> $todate
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('toDate');
			$todate=$this->session->userdata('fromDate');
		
		
			
			$data['todayPresent'] = $this->Index_model->getAllPresent($fromdate,$todate);
			foreach($data['todayPresent']->result() as $res){
				$empid[] = $res->emp_id;
			}
			$data['todayAbsant'] = $this->Index_model->getAllAttandenceAbsent($empid);
			$this->load->view('admin/attendance/attendance_ajax',$data);
	}
	
///////////////// Attendence Insert //////////////////////

	public function attendanceDataInsert(){
			$data['title'] =  ' Admin Panel | Copotronic eAttendance ';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			
			$data2=array(
				"get_log"=>array(
					"user_name" => "lithe",
					"auth"=>"3efd234cefa324567a342deafd32672",
					"log"=>array(
						"date1"=>"2017-02-01",
						"date2"=>date('Y-m-d')
					)
				)
			);
						
			$url_send ="https://rumytechnologies.com/rams/api";
			$str_data = json_encode($data2);
			//$this->db->query("DELETE FROM attendance_device");
			$this->_send_json($url_send,$str_data);
			$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Updated</h2>');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			//$this->load->view('admin/attendance/api_data',$data);
			
	}


private function _send_json($url,$json)
			{
				$ch = curl_init($url);                                                                      
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
				curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);                                                                 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				   'Content-Type: application/json',                                                                                
				   'Content-Length: ' . strlen($json))                                                                       
				);                                                                                                                   
			
				//echo "printing json.........";
				//print_r($json);                                                                                                                  
				$result = (curl_exec($ch));
				//echo "<br>";
				//print_r($result);
				$decoded = json_decode($result, true);
				//print_r($decoded);
				
				$i=0;
				foreach($decoded as $row)
				{
				   foreach($row as $k)
				   {
					  $attendance_insert_data = array(
						"std_id"=>$k['registration_id'],
						"access_date"=>$k['access_date'],
						"access_time"=>$k['access_time'],
						"unit_name"=>$k['unit_name'],
						"device_username"=>$k['user_name'],
						"date"=>date('Y-m-d H:i:s'),
					  );
					  
					  
					 /*  $query1 = $this->db->msQuery("SELECT * FROM attendance_device WHERE std_id='".$k['registration_id']."' 
					   AND access_date ='".$k['access_date']."' AND access_time ='".$k['access_time']."' AND inst_id=15");
					  // echo mysqli_num_rows($query1);
					   $r = $this->db->execute($query1);
					   $std_idQ = $r['std_id'];
					   if(isset($std_idQ) && $std_idQ!=''){					  
						  	   $insertQuery = '';
							   $regid[] = '';
							   $smstime[]='';
					   }
					   else{
					   		  $regid[] = $k['registration_id'];
							  $smstime[]= $k['access_time'];								  
							  $insertQuery = $this->db->inertTable('attendance_device', $attendance_insert_data);
					   }*/
					  
					  $insertQuery = $this->Index_model->inertTable('attendance_device', $attendance_insert_data);
					  
					 $i++;
				   }
			   }
			   
			  /* $rollarray = join(',',$regid);
			   $query = $this->db->msQuery("SELECT * FROM student WHERE student_id IN($rollarray) AND institute='".$inst_id."'");
			   while($r = $this->db->execute($query)){
					$details[] = $r['fcontact'];
					$stdname[] = $r['std_name'];
				}*/
					 
					 if($insertQuery && $insertQuery!=''){
						$msg = 'Successfully Inserted';
						// echo  $commaSapareted = join(',',$details);
						 //$this->sendSmsAPI($details,$stdname,$smstime);
					  }
					  else{
						$msg = 'Failed Inserted';
					  }
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">'.$msg.'</h2>');  
					redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
				
  
  
  
  function attendance()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$data['attend_data'] = $this->Index_model->getAllAttandence('','','');
			
			$data['main_content']="admin/attendance/totalattendance";
			$this->load->view('admin_template',$data);
	}
	
	
	function total_attendance_ajax()
	{
			$data['title'] =  'Atendance Status of Lithy Group | Copotronic eAttendance';
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sessiondata = array(
							'toDate'=>$fromdate,
							'fromDate'=> $todate
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('toDate');
			$todate=$this->session->userdata('fromDate');
		
			$data['total_attend_data'] = $this->Index_model->getTotalAttandence($fromdate,$todate);
			$this->load->view('admin/attendance/totalattendance_ajax',$data);
	}
	
	
 /* public function total_attendance(){
			$data['title'] =  ' Admin Panel | Copotronic eAttendance ';
			
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			
			$config['base_url'] = base_url('index/total_attendance');
			$config["per_page"] = 500;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$total_row = $this->Index_model->record_count('attendance_device');
			$config["total_rows"] = $total_row;
			$config['num_links'] = 10;
			$config['cur_tag_open'] = '&nbsp;<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$data['pagination']= $this->pagination->create_links();
			$data['pageSl'] = $page;
		
			$data['attend_data'] = $this->Index_model->getTotalAttandence('',$config["per_page"],$page);
			//$data['attend_data']= $this->Index_model->getDataById('attendance_device','','','atid','asc','100');
			
			$data['main_content']="admin/attendance/totalattendance";
			$this->load->view('admin_template',$data);
	}*/
	
	public function today_attendance(){
			$data['title'] =  ' Admin Panel | Copotronic eAttendance ';
			$today = date('Y-m-d');
			if(!$this->session->userdata('adminAccessMail')) redirect('index');
			$data['timeUpdate'] = $this->Index_model->getAllItemTable('time_setting','','','','','id','desc');
			
			$config['base_url'] = base_url('index/today_attendance');
			$config["per_page"] = 500;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$total_row = $this->Index_model->record_count('attendance_device');
			$config["total_rows"] = $total_row;
			$config['num_links'] = 10;
			$config['cur_tag_open'] = '&nbsp;<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$data['pagination']= $this->pagination->create_links();
			$data['pageSl'] = $page;
		
			$data['attend_data'] = $this->Index_model->getAllAttandence($today,$config["per_page"],$page);
			
			
			//$data['attend_data'] = $this->Index_model->getAllAttandence($inst_id,$today);
			//$data['attend_data'] = $this->Index_model->getAllItemTable('attendance_device','access_date',$today,'','','atid','asc');
			
			$data['main_content']="admin/attendance/todayattendance";
			$this->load->view('admin_template',$data);
	}

	function apitest()
		{
			$this->load->view('admin/attendance/api_data');
        }

}
