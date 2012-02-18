<?php

require('inc/sql.php');
$q=query('SELECT * FROM symptom_cat');
?>
<h2>Add a new Symptom</h2>
<form action="a_add_symptom_1.php" method="post">
  <input type="text" name="sym_1" id="sym_1" />
  <select name="cat" id="cat">
    <?php
  while($row=mysql_fetch_assoc($q)){
  		echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
	}
  ?>
  </select>
  <div class="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="buttonblue" />
  </div>
</form>
<script>
bind_form();
</script>