<div class="content-wrapper">
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Employees List</li>
                            <li>Total Employees = <?php echo $employee_info->num_rows();?></li>
						</ul>
                        
                        
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Page length options -->
					<div class="panel panel-flat">
                    
					<?php echo form_open('','id="form_check"');?>
				  <table class="table datatable-show-all" width="100%">
							<thead>
								<tr>
                                  <th width="3%" height="26">SI</th>
                                  <th width="17%"> ID No</th>
                                  <th width="45%">Employee Name</th>
                                  <th width="35%">Status</th>
							  </tr>
							</thead>
							<tbody>
                            
                             <?php
									$i=0;
                                    foreach($todayPresent->result() as $empI):
									$emp_id=$empI->emp_id;
									$emp_name=$empI->emp_name;	
									$present = "<strong style='color:green'>Present</strong>";								
									$i++;
									?>
                            	
									<tr>
									 	<td><?php echo $i;?></td>
                                        <td><?php echo $emp_id; ?></td>
                                        <td><?php echo $emp_name ?></td>
                                        <td><?php echo $present; ?></td>
								  </tr>
                               	    <?php
                                    endforeach;
									?> 
                                    
                                     <?php
									$i=0;
                                    foreach($todayAbsant->result() as $empA):
									$aemp_id=$empA->emp_id;
									$aemp_name=$empA->emp_name;	
									$absant = "<strong style='color:red'>Absant</strong>";								
									$i++;
									?>
                            	
									<tr>
									 	<td><?php echo $i;?></td>
                                        <td><?php echo $aemp_id; ?></td>
                                        <td><?php echo $aemp_name ?></td>
                                        <td><?php echo $absant; ?></td>
								  </tr>
                               	    <?php
                                    endforeach;
									?> 
							</tbody>
						</table>
                      <?php echo form_close();?>
					</div>


<script type="text/javascript">
                        $(document).ready(function () {
						//alert('dfd');
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>