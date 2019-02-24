
<html>
<head>
<link href="css/owfont-regular.css" rel="stylesheet" type="text/css">
</head>


<?php
  $json_string = 'http://api.openweathermap.org/data/2.5/weather?q=Mersin&appid=541515afee797cfd215e0b69dfe8c5d9';
  $jsondata = file_get_contents($json_string);
  $obj = json_decode($jsondata, true);
?>
<i class="owf owf-<?php echo $obj['weather'][0]['id'];?>"></i>
<?php echo $obj['main']['temp']-273;?></br>
<?php echo $obj['name'];?>

</html>
