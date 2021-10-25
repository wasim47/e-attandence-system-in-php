<?php
$data2=array(
	"get_log"=>array(
		"user_name" => "lithe",
		"auth"=>"3efd234cefa324567a342deafd32672",
		"log"=>array(
			"date1"=>"2017-01-01",
			"date2"=>date('Y-m-d')
		)
	)
);

$url_send ="https://rumytechnologies.com/rams/api";
$str_data = json_encode($data2);

function send_json($url,$json)
{
	//echo "<br>".gettype($url)."<br>";
	//echo $url."<br>";

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
	if($decoded){
		foreach($decoded as $row)
		{
		   foreach($row as $k)
		   {
			  echo  $accessdate =  $k['access_date'];
			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			  echo  $access_time = $k['access_time'];
			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			  echo  $stdId =  $k['registration_id'];
			  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			  echo  $unit_name =  $k['unit_name'];
			  echo  "<br>";
			  //$this->db->query("INSERT INTO attendance_device VALUES('','".$inst_id."','".$stdId."','".$inst_id."','".$accessdate."','".$access_time."','".$unit_name."','NOW()')");
			 $i++;
		   }
	   }
	  }
	  else{
	  	echo '<h1>No Data Found</h1>';
	  }
	//return $displayres;
}
send_json($url_send,$str_data);

?>
