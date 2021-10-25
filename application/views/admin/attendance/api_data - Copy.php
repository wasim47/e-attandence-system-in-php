<?php
$data2=array(
	"get_log"=>array(
		"user_name" => "BHKSCBD",
		"auth"=>"3efd234cefa324567a342deafd32672",
		"log"=>array(
			"date1"=>"2017-02-01",
			"date2"=>"2017-02-09"
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
	$displayres = '';
	$displayres .='
		<table width="100%" border="1">
			<tr>
				<th>SI</th>
				<th>Access Date</th>
				<th>Access Time</th>
				<th>Registration ID</th>
				<th>Unit Name</th>
			</tr>
	';
	
	
	$i=0;
	foreach($decoded as $row)
    {
       foreach($row as $k)
       {
	   		// echo $k['access_date'];
            // echo $k['access_time'];
			// echo $k['registration_id'];
			// echo $k['unit_name'];
			// echo "<br>";
			$displayres .='<tr>
				<td align="center">'.$i.'</td>
				<td align="center">'.$k['access_date'].'</td>
				<td align="center">'.$k['access_time'].'</td>
				<td align="center">'.$k['registration_id'].'</td>
				<td align="center">'.$k['unit_name'].'</td>
			</tr>';
		 $i++;
       }
	  
   }
$displayres .='</table>';
echo $displayres;
	//echo $decoded['log'][0]['access_date'];

	//echo gettype($result);
	return $displayres;
}
send_json($url_send,$str_data);

?>
