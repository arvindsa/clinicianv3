<?php
require('inc/sql.php');

$input = $_GET["q"];
$data = array();
// query your DataBase here looking for a match to $input
$query = mysql_query("SELECT * FROM symptom WHERE symptom LIKE '%$input%'");
while ($row = mysql_fetch_assoc($query)) {
$json = array();
$json['value'] = $row['id'];
$json['sym'] = $row['symptom'];
$data[] = $json;
}
/*$json['value'] = $input;
$json['sym'] = 'New Symptom: '.$input;
$data[] = $json;*/




header("Content-type: application/json");
echo json_encode($data);
?>