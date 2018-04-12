<?php
$times = array();
$videos = array();
$mc = array();
$reasons = array();
foreach($_POST as $key=>$val) {
$key = $test_input($key);
$val = $test_input($val);
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
echo join($reasons);
for($i=0;$i<count($reasons);$i++) {
	echo "<div>".$reasons[$i]." ".$times[$i]." ".$videos[$i]."</div>";
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>