<?php  
 $files = array();  
 $dir = opendir('dictionary');  
 while(($file = readdir($dir)) !== false)  
 {  
  if($file !== '.' && $file !== '..' && !is_dir($file))  
  {  
    $files[] = $file;
    break;  
  }
 } 
 
 if(count($files)==0){
     die('Compete');
 }
                  
 closedir($dir); 
 
mysql_connect('localhost','root','usbw');
mysql_select_db('clinician');
  
 $file=$files[0];
 $file_a=substr($file,0,-4);
 $content=file_get_contents('dictionary/'.$file);
 
 $sql = 'INSERT INTO `dictionary` (`dic_name`, `dic_desc`,`dic_index`) VALUES (\''.$file_a.'\', \''.$content.'\',\''.strtolower($file_a[0]).'\');'; 
              //die($sql);
 if(mysql_query($sql)){
     unlink(('ip/'.$file));
 }
 
 if(!isset($_GET['i'])){
           $_GET['i']=1;
 }                      else{
     $_GET['i']++;
 }
 
 ?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="3;url=dis.php?i=<?php echo $_GET['i'];?>" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>                                              <?php echo $_GET['i']-1;?> Done 
</body>
</html>
