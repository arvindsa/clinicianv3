<?php
require('inc/sql.php');

$sql = "insert into prognosis (pro_name,pro_cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
