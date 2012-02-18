<?php
require('inc/sql.php');

$sql = "insert into symptom (symptom,cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
