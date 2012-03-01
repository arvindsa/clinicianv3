<?php
require('inc/sql.php');
 if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
      $sql='SELECT * FROM habbit where hab_index=\''.$index.'\' ORDER BY hab_name ASC';
         //die($sql);
         $sql=mysql_query($sql);
      while($row=mysql_fetch_assoc($sql)){
        echo '<option value="'.$row['hab_id'].'">'.$row['hab_name'].'</option>';
    }
              
?>