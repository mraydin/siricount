<html>
<head>
<link href="css/owfont-regular.css" rel="stylesheet" type="text/css">
</head>
<?php
  $json_string ='http://mersign.com/cpu_temp.json';
  $jsondata = file_get_contents($json_string);
  $obj = json_decode($jsondata, true);

  $now = date('U'); //get current time

  //echo $obj[0]['temp']

?>
<?php 
	foreach ($obj as $a):
		if ($a['temp']<69){
		 echo $a['temp']," - ",$a['time']; 
		 echo "<br>";
		 continue; }
	endforeach;?>

<?php for ($i = 0; $i<6; $i++) {
	echo $obj[$i]['temp'];
	echo "</br>";
}?>
<b>CPU Temp: </b><i><?php echo $obj[0]['temp'];?></i></br>
<b>Time: </b><i><?php echo $obj[0]['time'];?></i>
