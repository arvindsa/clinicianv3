<?php
require('inc/sql.php');

$sql = "insert into habbit (hab_name,hab_cat) values ('$_POST[sym_1]','$_POST[cat]');";

if(query($sql)){
	echo 'Added';
}

?>
