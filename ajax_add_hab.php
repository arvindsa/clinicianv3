<?php
require('inc/sql.php');

$input = $_GET["q"];
$data = array();
// query your DataBase here looking for a match to $input
$query = mysql_query("SELECT * FROM habbit WHERE hab_name LIKE '%$input%'");
while ($row = mysql_fetch_assoc($query)) {
$json = array();
$json['value'] = $row['hab_id'];
$json['sym'] = $row['hab_name'];
$data[] = $json;
}
/*$json['value'] = $input;
$json['sym'] = 'New Examination: '.$input;
$data[] = $json;*/




header("Content-type: application/json");
echo json_encode($data);
?>