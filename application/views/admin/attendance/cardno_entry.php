<?php
$f1 = 'D:\xampp\htdocs\wasim\ims\application\views\institute_admin\attendance\cgwcidcard.txt';
$file1 = fopen($f1, "r");
while (!feof($file1)) {
   $members1[] = fgets($file1);
}
//print_r($members1);

fclose($file1);

$f2 = 'D:\xampp\htdocs\wasim\ims\application\views\institute_admin\attendance\cgwcidcard_roll.txt';
$file2 = fopen($f2, "r");
while (!feof($file2)) {
   $members2[] = fgets($file2);
}
fclose($file2);


//$finalarray = array_merge( $members1, $members2);
//print_r($finalarray);
//echo count($members1);
$i=0;
foreach($members1 as $ro2){
	$cardid = $ro2;
	$roll = $members2[$i];
	$query = $this->db->query("UPDATE student SET idcard='".$cardid."' WHERE roll='".$roll."' AND institute='15'");
	$i++;
}

if($query){
	echo 'Success';
}
else{
	echo 'Failed';
}
?>