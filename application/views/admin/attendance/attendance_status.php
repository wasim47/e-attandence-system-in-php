<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('index/attendance_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				 // alert(data);
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
</script>

<div class="content-wrapper">
				<div class="page-header">
					<div class="breadcrumb-line breadcrumb-line-component" style="margin-top:10px; margin-bottom:10px;">
						<ul class="breadcrumb" style="font-size:20px;">
							<li>Employees List</li>
                            <li>Total Employees = <?php echo $employee_info->num_rows();?></li>
						</ul>
                        
                        <div style="float:right; width:50%">
							<div><input type="text" name="validity" id="from_date" placeholder="From" class="form-control date-picker"  style="width:40%; margin:5px; float:left"></div>
                            <div><input type="text" name="validity" id="to_date" placeholder="To"  class="form-control date-picker"  style="width:40%; margin:5px; float:left"></div>
                            <div><button style="width:10%; float:left; margin:5px 0" type="button" class="btn btn-success" onclick="reportsAjax();"><i class="fa fa-search"></i></button></div>
						</div

						
					></div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					<div id="reportsdisplay"></div>
					


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