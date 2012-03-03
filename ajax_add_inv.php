<?php
require('inc/sql.php');

$input = $_GET["q"];
$data = array();
$add=true;  
// query your DataBase here looking for a match to $input
$query = mysql_query("SELECT * FROM inv WHERE inv_name LIKE '%$input%'");
while ($row = mysql_fetch_assoc($query)) {
$json = array();
$json['value'] = $row['inv_id'];
$json['sym'] = $row['inv_name'];
$data[] = $json;
if($row['inv_name']==$input){
    $add=false;
}
}
/*$json['value'] = $input;
$json['sym'] = 'New Examination: '.$input;
$data[] = $json;*/
  if($add){
 $json = array();
 $json['value'] = $input;
 $json['sym'] = $input;
 $data[] = $json;
 }



header("Content-type: application/json");
echo json_encode($data);
?>