<?php
require('inc/sql.php');
 if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
      $sql='SELECT * FROM symptom where sym_index=\''.$index.'\' ORDER BY symptom ASC';
         //die($sql);
         $sql=mysql_query($sql);
      while($row=mysql_fetch_assoc($sql)){
        echo '<option value="'.$row['id'].'">'.$row['symptom'].'</option>';
    }
              
?>