<?
require('inc/sql.php');
$h = explode(",",$_GET["s_id"]);
echo $h[0];
echo '</br>';
//echo '<h2>Do you want to delete disease ? </h2>';
mysql_query('DELETE FROM disease WHERE disease_id=\''.$h[0].'\'');
mysql_query('DELETE FROM relation WHERE disease_id=\''.$h[0].'\'');
echo '<div class="msg failure"><span>Disease Deleted</span><div>';
?>