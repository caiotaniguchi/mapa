<?
$mapFile = 'planta2.jpg';
$pointX = 499;
$pointY =  277;
exec("getContours.py $mapFile $pointX $pointY", $output);
echo json_encode($output[0]); 