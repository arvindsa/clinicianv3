<?php
require('inc/sql.php');
 if(isset($_GET['index'])){
         $index=strtolower($_GET['index']);
         $index=$index[0]; 
     }else{
         $index='a';
     }
      $sql='SELECT * FROM examination where ex_index=\''.$index.'\' ORDER BY ex_desc ASC';
         //die($sql);
         $sql=mysql_query($sql);
      while($row=mysql_fetch_assoc($sql)){
        echo '<option value="'.$row['ex_id'].'">'.$row['ex_desc'].'</option>';
    }
              
?>