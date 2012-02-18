<?php
mysql_connect('localhost','root','usbw');
mysql_select_db('clinician');

$input = $_GET["q"];
$data = array();
// query your DataBase here looking for a match to $input
$query = mysql_query("SELECT * FROM disease WHERE disease_name LIKE '%$input%'");
while ($row = mysql_fetch_assoc($query)) {
$json = array();
$json['value'] = $row['disease_id'];
$json['sym'] = $row['disease_name'];
$data[] = $json;
}
header("Content-type: application/json");
echo json_encode($data);
?>