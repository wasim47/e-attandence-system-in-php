
<div class="content-wrapper">
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Employees List</li>
                            <li>Total Employees = <?php echo $employee_info->num_rows();?></li>
						</ul>

						
					</div>
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
                                  <th width="7%" height="26">SI</th>
                                  <th width="14%"> ID No</th>
                                  <th width="79%">Employee Name</th>
							  </tr>
							</thead>
							<tbody>
                            
                             <?php
									$i=0;
                                    foreach($employee_info->result() as $empI):
									$emp_id=$empI->emp_id;
									$emp_name=$empI->emp_name;									
									$i++;
									?>
                            	
									<tr>
									 	<td><?php echo $i;?></td>
                                        <td><?php echo $emp_id; ?></td>
                                        <td><?php echo $emp_name ?></td>
								  </tr>
                               	    <?php
                                    endforeach;
									?> 
							</tbody>
						</table>
                      <?php echo form_close();?>
					</div>
