<?php
header("Access-Control-Allow-Origin:http://rawgit.com");
$times = array();
$videos = array();
$mc = array();
$reasons = array();
foreach($_GET as $key=>$val) {
$key = test_input($key);
$val = test_input($val);
if(strpos($key,"reason")===0) {
$reasons[] = $val;
}
else if($key=="times") {
$times = str_getcsv($val);
}
else if($key=="videos") {
$videos = str_getcsv($val);
}
else if($key=="mc") {
$mc = str_getcsv($val);
}
}

$xml=<<<XML
<data>
</data>
XML;
$data = new SimpleXMLElement($xml);
date_default_timezone_set("America/Los_Angeles");
$data->addChild("date",date("m/d/y g:i:s a"));
$whistles = $data->addChild("whistles");
$quiz = $data->addChild("mc");

for($i=0;$i<count($reasons);$i++) {
	$w = $whistles->addChild("whistle",$reasons[$i]);
	$w->addAttribute("video",$videos[$i]);
	$w->addAttribute("time",$times[$i]);
}

foreach($mc as $choice) {
	$quiz->addChild("answer",$choice);
}

$dir = "data";
if(!file_exists($dir)) {
	mkdir($dir);
}
$name="person";
$file = "";
for($num = 1;file_exists(($file = $dir."/".$name.$num.".xml"));$num++) {}
echo $file;
 $data->asXML($file) or die("Sad!");

echo $data->asXML();



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>