<?php include('admin_tophead.php');?>
<meta charset="utf-8">
<body>
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header" style="width:100px">
			<a  href="<?php echo base_url();?>" target="_blank" title="View Website"><img src="<?php echo base_url('asset/admin/images/logo.jpg');?>" 
            style="width:100%; height:auto;text-align: center;"></a>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

				
			</ul>

			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i>
						<span><?php echo $this->session->userdata('userAccessName');?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="<?php echo base_url('index/logout');?>"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="page-container">
		<div class="page-content">
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><i class="icon-user"></i></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo $this->session->userdata('userAccessName');?></span>
									
								</div>

								
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							 
							<?php
							if($this->session->userdata('userType')=='MasterAdmin'){?>
                            
                           		
                                 <ul class="navigation navigation-main navigation-accordion">
									<li class="active"><a href="<?php echo base_url('index/dashboard');?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
									<li>
                                        <a href="#"><i class="icon-pencil"></i> <span>Setting</span></a>
                                        <ul>
                                            <li><a href="<?php echo base_url('index/makeChangeTime');?>">Make Intime/Outtime</a></li>
                                        </ul>
                                        
                                    </li>
                                      <li><a href="<?php echo base_url('index/employees');?>"><i class="icon-users"></i> Employees</a></li>
                                    <li>
                                        <a href="#"><i class="icon-stack2"></i> <span>Attendance</span></a>
                                        <ul>
                                            
                                             <li><a href="<?php echo base_url('index/today_attendance');?>">Today Attendance</a></li>
                                             <li><a href="<?php echo base_url('index/attendance');?>">Attendance</a></li>
                                             <li><a href="<?php echo base_url('index/today_attendance_status');?>">Today Attendance Status</a></li>
                                             <li><a href="<?php echo base_url('index/attendance_status');?>">Attendance Status</a></li>
                                        </ul>
                                        
                                    </li>
                                </ul>
                            <?php 
							}							
							?>
                           
                            
                            
                            
                            
                           
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>