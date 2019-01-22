<!DOCTYPE html>
<html>
<form method="post">
<input type="text" name="address" placeholder="Enter Address">
<input type="submit" name="submit" value="submit">
</form>
</html>
<?php
if(isset($_POST['submit']))
{
function getLatLong($address){
if(!empty($address)){
//Formatted address
$formattedAddr = str_replace(' ','+',$address);
//Send request and receive json data by address
$geocodeFromAddr = file_get_contents('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$formattedAddr.'.json?access_token=pk.eyJ1IjoicHJlbW9saXZlIiwiYSI6ImNqcjdqcnAxNTJ0YzE0YnM3azdiNDVxZDgifQ.RdMwZb5BglQM3g0oIdBaEA');
//echo'<pre>';print_r($geocodeFromAddr);
$output = json_decode($geocodeFromAddr);
//echo'<pre>';print_r($output->features[0]->geometry->coordinates[0]);
//Get latitude and longitute from json data
//$data['latitude'] = $output[0];
$data['latitude']=  $output->features[0]->geometry->coordinates[0];
$data['longitude'] = $output->features[0]->geometry->coordinates[1];
//Return latitude and longitude of the given address
if(!empty($data)){
return $data;
}else{
return false;
}
}else{
return false;
}
}
$address = $_POST['address'];
$latLong = getLatLong($address);
$latitude = $latLong['latitude']?$latLong['latitude']:'Not found';
$longitude = $latLong['longitude']?$latLong['longitude']:'Not found';
echo "Latitude:".$latitude."<br>";
echo "longitude:".$longitude."";
}
?>