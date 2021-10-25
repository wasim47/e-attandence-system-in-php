<?php
if($adminUpdate->num_rows()>0){
	foreach($adminUpdate->result() as $adminData);
	$user_id=$adminData->id;
	$username=$adminData->username;
	$email=$adminData->email;
	$password=$adminData->pass_hints;
}
else{
	$user_id='';
	$username=set_value('username');
	$email=set_value('email');
	$password=set_value('password');
	}
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Patient Registration Details</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Admin Registraion Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo $this->session->flashdata('successMsg');?>
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><h4 class="panel-title">
                                                   Registration Information </h4></a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        			    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="username" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Username' value="<?php echo $username; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Username'">
                                             <?php echo form_error('username', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="email" name="email" required class="form-control col-md-7 col-xs-12"
                                                                placeholder='Login Email' onFocus="this.placeholder=''" value="<?php echo $email; ?>" onBlur="this.placeholder='Login Email'">
                                                                 <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="password" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Password' onFocus="this.placeholder=''" onBlur="this.placeholder='Password'" value="<?php echo $password; ?>">
                                                <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" name="confirmpassword" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Confirm Password' onFocus="this.placeholder=''" onBlur="this.placeholder='Confirm Password'" value="<?php echo $password; ?>">
                                                <?php echo form_error('confirmpassword', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>

                </div>
               