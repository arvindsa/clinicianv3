<?php
/**
* Clinican+
* @version v2.0
* @author ArvindSA, Anoop Toffy
*/
require('inc/sql.php');
$q=query('SELECT * FROM symptom_cat');
?>
<h1> Search using Lab Investigation </h1>
<form action="a_w_inv_2.php" method="post">
<table width="100%" border="0">
  <tr>
    <td style="width:200px;"><h3>Age:</h3></td>
    <td><input type="text" name="age" id="age"></td>
  </tr>
  <tr>
    <td><h3>Sex:</h3></td>
    <td><p>
      <label>
        <input type="radio" name="sex" value="m" id="sex_0">
        Male</label> 
      <label>
        <input type="radio" name="sex" value="f" id="sex_1">
        Female</label>
      <br>
    </p></td>
  </tr>
 
</table><p>&nbsp;</p><!--
<h2>Category</h2>
  <?php
	while($row=mysql_fetch_assoc($q)){
  		echo '<div class="half left"> <label><input type="checkbox" name="c['.$row['cat_id'].']" id="c['.$row['cat_id'].']">'.$row['cat_name'].'</label></div>';
	}
	?>-->

<div class="clear"></div>
      <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div>
</form>



<script type="text/javascript">
bind_form();
	</script>