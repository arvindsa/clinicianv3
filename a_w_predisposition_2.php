<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/

require('inc/sql.php');

//Process checkbox
if(isset($_POST['c'])){
	$c=$_POST['c'];
	$c2=array();
	foreach($c as $k=>$v){
		$c2[]=$k;
	}
	$c2=implode(',',$c2);
	$q=query('SELECT * FROM predisposition where pro_cat IN ('.$c2.')');
}else{
	$q=query('SELECT * FROM predisposition');
}
?>

	  <p>
	   
  </p>
	  <table width="600px" border="0">
	    <tr>
	      <td  style="width:50%"><h2>Available symptoms</h2><select name="available" size="30" id="available"  style="width:100%">
           <?php
	while($row=mysql_fetch_assoc($q)){
		echo '<option value="'.$row['pre_id'].'">'.$row['pre_name'].'</option>';
	}
	?>
          </select></td>
	      <td><h2>Selected symptoms</h2>
          <form action="a_w_predisposition_3.php" method="post">
          <select name="selected[]" size="30" id="selected" style="width:100%" multiple="multiple">
          </select><input name="age" type="hidden" value="<?php echo $_POST['age'];?>" />
          <input name="sex" type="hidden" value="<?php echo $_POST['sex'];?>" />
          <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div></form></td>
        </tr>
  </table>
	  <p>&nbsp; </p><script>bind_slist();bind_form();</script>
    <div class="clear"></div>
