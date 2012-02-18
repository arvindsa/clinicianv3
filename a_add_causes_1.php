<?php
require('inc/sql.php');

$sql = "insert into causes (cau_name,cau_cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
