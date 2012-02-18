<?php
require('inc/sql.php');

$sql = "insert into predisposition (pre_name,pre_cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
