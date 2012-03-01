<?php
require('inc/sql.php');
 if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
      $sql='SELECT * FROM medication where med_index=\''.$index.'\' ORDER BY med_name ASC';
         //die($sql);
         $sql=mysql_query($sql);
      while($row=mysql_fetch_assoc($sql)){
        echo '<option value="'.$row['med_id'].'">'.$row['med_name'].'</option>';
    }
              
?>