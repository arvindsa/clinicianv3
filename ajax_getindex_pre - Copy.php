<?php
require('inc/sql.php');
 if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
      $sql='SELECT * FROM predisposition where pre_index=\''.$index.'\' ORDER BY pre_name ASC';
         //die($sql);
         $sql=mysql_query($sql);
      while($row=mysql_fetch_assoc($sql)){
        echo '<option value="'.$row['pre_id'].'">'.$row['pre_name'].'</option>';
    }
              
?>