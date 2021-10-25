<?php
if($timeUpdate->num_rows()>0){
	foreach($timeUpdate->result() as $ctD);
	$id=$ctD->id;
	$intime=$ctD->intime;
	$outtime=$ctD->outtime;
	$newstitle='Edit music';
}
else{
	$id='';
	$intime=set_value('intime');
	$outtime=set_value('outtime');
	$newstitle='Add New music';
}
?>
<style>
.required{
	color:#f00;
}
</style>


<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					

					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
                                <li>Time Setting Information</li>
						</ul>

						<ul class="breadcrumb-elements">
							<div class="heading-btn-group">
								<a href="<?php echo base_url('admin/music_list');?>" class="btn btn-link btn-float has-text">
                                <i class="glyphicon glyphicon-list"></i><span>Time List</span></a>
							</div>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
						    <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');
								echo $this->session->flashdata('successMsg');
							?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title"><?php echo $newstitle;?> </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                
    
                                        	<div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event-name">In Time<span class="required">*</span></label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="intime" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='00:00:00' value="<?php echo $intime; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='00:00:00'">
                                             	<?php echo form_error('intime', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                           	 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="event-name">Out Time</label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="outtime" class="form-control col-md-7 col-xs-12" 
                                                placeholder='00:00:00' value="<?php echo $outtime; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='00:00:00'">
                                           	 </div>
                                            </div>
                                            
                                            
                                        
                                        
                                    	  
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
                                        	<input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
					</div>


<script>
$(document).ready(function(){
	$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
});

</script>