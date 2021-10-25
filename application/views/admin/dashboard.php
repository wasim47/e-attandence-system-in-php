
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<div class="row">
						<div class="col-lg-12">

							<div class="panel panel-flat">
								
								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
                                        	<tr>
												<th>Today Attendence</th>
											</tr>
                                                        <tr>
                                              <th width="2%" height="26">SI</th>
                                              <th width="7%"> ID No</th>
                                              <th width="21%">User Name</th>
                                              <th width="13%">Access Date</th>
                                              <th width="10%">In Time</th>
                                              <th width="10%">Late</th>
                                              <th width="11%">Out Time</th>
                                              <th width="11%">Total Time</th>
                                              <th width="10%">Early Out</th>
                                              <th width="12%">Unit Name</th>
                                              <th width="11%">Details</th>
                                          </tr>
										</thead>
										<tbody>
                            
                             <?php
									$i=0;
									$timeQuery = $timeUpdate->row_array();
									$dbIntime = $timeQuery['intime'];
									$dbOuttime = $timeQuery['outtime'];
									
                                    foreach($today_attend_data->result() as $attenData):
									$atid=$attenData->atid;
									$std_id=$attenData->std_id;
									$mintime=$attenData->mintime;
									$maxtime=$attenData->maxtime;
									$access_date = $attenData->access_date;
									$unit_name=$attenData->unit_name;
									$device_username=$attenData->device_username;
									
									$start_date = new DateTime($maxtime);
									$since_start = $start_date->diff(new DateTime($mintime));
									//echo $since_start->days.' days total<br>';
									/*$thr = $since_start->h.' hours<br>';
									$tmin = $since_start->i.' minutes<br>';
									$totaltimestay = $thr.' '.$tmin;*/
									
									$thr = $since_start->h;
									$tmin = $since_start->i;
									$sec = $since_start->s;
									$totaltimestay = $thr.':'.$tmin.':'.$sec;
									
									
									// Late Time calculate
									$comIn = new DateTime($dbIntime);
									$attIn = new DateTime($mintime);
									
									if ($comIn < $attIn){
										$ltimeStart = $comIn->diff(new DateTime($mintime));
										$lthr = $ltimeStart->h;
										$ltmin = $ltimeStart->i;
										$lsec = $ltimeStart->s;
										$ltotaltimestay = $lthr.':'.$ltmin.':'.$lsec;
										$latetime = $ltotaltimestay;
										$lcolor = '#CC0000';
									}
									else{
										$latetime ='00:00:00';
										$lcolor = '#be8a10';
									}
									
									
									// Early Out Time calculate
									$comOut = new DateTime($dbOuttime);
									$attOut = new DateTime($maxtime);
									
									if ($comOut > $attOut){
										$earimeStart = $comOut->diff(new DateTime($maxtime));
										$ethr = $earimeStart->h;
										$etmin = $earimeStart->i;
										$esec = $earimeStart->s;
										$etotaltimestay = $ethr.':'.$etmin.':'.$esec;
										$earlytime = $etotaltimestay;
										$ecolor = '#CC0000';
									}
									else{
										$earlytime ='00:00:00';
										$ecolor = '#87991e';
									}
									
									
									$queryAtt = $this->db->query("SELECT * FROM attendance_device WHERE access_date='".$access_date."' AND std_id='".$std_id."' ORDER BY atid ASC");
									$i++;
									?>
                            	
									<tr>
									 	<td><?php echo $i;?></td>
                                        <td><?php echo $std_id; ?></td>
                                        <td><?php echo $device_username ?></td>
                                        <td><?php echo $access_date; ?></td>
                                        <td><strong style="color:#009933"><?php echo $mintime; ?></strong></td>
                                        <td><strong style="color:<?php echo $lcolor;?>"><?php echo $latetime; ?></strong></td>
                                        <td><strong style="color:#009933"><?php echo $maxtime; ?></strong></td>

                                        <td><strong style="color:#00798a"><?php echo $totaltimestay; ?></strong></td>
                                        <td><strong style="color:<?php echo $ecolor;?>"><?php echo $earlytime; ?></strong></td>
                                        <td><?php echo $unit_name; ?></td>
										<td>
										<a href="javascript:void()" class="btn btn-info btn-xs"  
										data-target="#mymodal<?php echo $std_id;?>" data-toggle="modal">View Details</a>
										
										
										<div id="mymodal<?php echo $std_id;?>" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="btn btn-danger pull-right" title="Close" data-dismiss="modal">&times; </button>
                                                                        <h4 class="modal-title">View Details</h4>
                                                                    </div>
                                                                      <div class="modal-body">
                                                                        <table class="table table-striped" width="100%">
                                                                        <tbody>
                                                                          <tr>
                                                                            <th width="61%" align="left">Access Date</th>
                                                                            <th width="61%" align="left">Access Time</th>
                                                                           </tr>
                                                                          <?php
                                                                          foreach($queryAtt->result() as $atr):
																			$accessDate = $atr->access_date;
																			$access_time = $atr->access_time;
																		  ?>
                                                                          <tr>
                                                                            <td width="39%" align="left"><?php echo $accessDate; ?></td>
                                                                            <td align="left"><?php echo $access_time; ?></td>
                                                                          </tr>
                                                                          <?php endforeach;?>
                                                                        </tbody>
                                                                        </table>
                                                                      </div>
                                                                      
                                                                      
                                                                    </div>
                                                                </div>
                                                        </div>
														
										</td>
									   <!--<td><?php //echo $status;?></td>-->
								  </tr>
                               	    <?php
                                    endforeach;
									?> 
							</tbody>
									</table>
                                    <table class="table text-nowrap">
										<thead>
                                        	<tr>
												<th>Yesterday Attendence</th>
											</tr>
											                                                        <tr>
                                              <th width="2%" height="26">SI</th>
                                              <th width="7%"> ID No</th>
                                              <th width="21%">User Name</th>
                                              <th width="13%">Access Date</th>
                                              <th width="10%">In Time</th>
                                              <th width="10%">Late</th>
                                              <th width="11%">Out Time</th>
                                              <th width="11%">Total Time</th>
                                              <th width="10%">Early Out</th>
                                              <th width="12%">Unit Name</th>
                                              <th width="11%">Details</th>
                                          </tr>

										</thead>
										<tbody>
                            
                             <?php
									$i=0;
									$timeQuery = $timeUpdate->row_array();
									$dbIntime = $timeQuery['intime'];
									$dbOuttime = $timeQuery['outtime'];
									
                                    foreach($total_attend_data->result() as $attenData):
									$atid=$attenData->atid;
									$std_id=$attenData->std_id;
									$mintime=$attenData->mintime;
									$maxtime=$attenData->maxtime;
									$access_date = $attenData->access_date;
									$unit_name=$attenData->unit_name;
									$device_username=$attenData->device_username;
									
									$start_date = new DateTime($maxtime);
									$since_start = $start_date->diff(new DateTime($mintime));
									//echo $since_start->days.' days total<br>';
									/*$thr = $since_start->h.' hours<br>';
									$tmin = $since_start->i.' minutes<br>';
									$totaltimestay = $thr.' '.$tmin;*/
									
									$thr = $since_start->h;
									$tmin = $since_start->i;
									$sec = $since_start->s;
									$totaltimestay = $thr.':'.$tmin.':'.$sec;
									
									
									// Late Time calculate
									$comIn = new DateTime($dbIntime);
									$attIn = new DateTime($mintime);
									
									if ($comIn < $attIn){
										$ltimeStart = $comIn->diff(new DateTime($mintime));
										$lthr = $ltimeStart->h;
										$ltmin = $ltimeStart->i;
										$lsec = $ltimeStart->s;
										$ltotaltimestay = $lthr.':'.$ltmin.':'.$lsec;
										$latetime = $ltotaltimestay;
										$lcolor = '#CC0000';
									}
									else{
										$latetime ='00:00:00';
										$lcolor = '#be8a10';
									}
									
									
									// Early Out Time calculate
									$comOut = new DateTime($dbOuttime);
									$attOut = new DateTime($maxtime);
									
									if ($comOut > $attOut){
										$earimeStart = $comOut->diff(new DateTime($maxtime));
										$ethr = $earimeStart->h;
										$etmin = $earimeStart->i;
										$esec = $earimeStart->s;
										$etotaltimestay = $ethr.':'.$etmin.':'.$esec;
										$earlytime = $etotaltimestay;
										$ecolor = '#CC0000';
									}
									else{
										$earlytime ='00:00:00';
										$ecolor = '#87991e';
									}
									
									
									$queryAtt = $this->db->query("SELECT * FROM attendance_device WHERE access_date='".$access_date."' AND std_id='".$std_id."' ORDER BY atid ASC");
									$i++;
									?>
                            	
									<tr>
									 	<td><?php echo $i;?></td>
                                        <td><?php echo $std_id; ?></td>
                                        <td><?php echo $device_username ?></td>
                                        <td><?php echo $access_date; ?></td>
                                        <td><strong style="color:#009933"><?php echo $mintime; ?></strong></td>
                                        <td><strong style="color:<?php echo $lcolor;?>"><?php echo $latetime; ?></strong></td>
                                        <td><strong style="color:#009933"><?php echo $maxtime; ?></strong></td>

                                        <td><strong style="color:#00798a"><?php echo $totaltimestay; ?></strong></td>
                                        <td><strong style="color:<?php echo $ecolor;?>"><?php echo $earlytime; ?></strong></td>
                                        <td><?php echo $unit_name; ?></td>
										<td>
										<a href="javascript:void()" class="btn btn-info btn-xs"  
										data-target="#mymodal<?php echo $std_id;?>" data-toggle="modal">View Details</a>
										
										
										<div id="mymodal<?php echo $std_id;?>" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="btn btn-danger pull-right" title="Close" data-dismiss="modal">&times; </button>
                                                                        <h4 class="modal-title">View Details</h4>
                                                                    </div>
                                                                      <div class="modal-body">
                                                                        <table class="table table-striped" width="100%">
                                                                        <tbody>
                                                                          <tr>
                                                                            <th width="61%" align="left">Access Date</th>
                                                                            <th width="61%" align="left">Access Time</th>
                                                                           </tr>
                                                                          <?php
                                                                          foreach($queryAtt->result() as $atr):
																			$accessDate = $atr->access_date;
																			$access_time = $atr->access_time;
																		  ?>
                                                                          <tr>
                                                                            <td width="39%" align="left"><?php echo $accessDate; ?></td>
                                                                            <td align="left"><?php echo $access_time; ?></td>
                                                                          </tr>
                                                                          <?php endforeach;?>
                                                                        </tbody>
                                                                        </table>
                                                                      </div>
                                                                      
                                                                      
                                                                    </div>
                                                                </div>
                                                        </div>
														
										</td>
									   <!--<td><?php //echo $status;?></td>-->
								  </tr>
                               	    <?php
                                    endforeach;
									?> 
							</tbody>
									</table>
								</div>
							</div>
						</div>

						
					</div>
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
    </body>

</html>