<?php


error_reporting(0); 

$files = array();  
 $dir = opendir('lab2');  
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
 session_start();
  if($_SESSION['file']==$file_a){
    die('Unable to delete file: '.'lab2/'.$file_a.'.txt');
 }else{
     $_SESSION['file']=$file_a;
 }
 
$file= fopen('lab2/'.$file_a.'.txt','r');
$final='';
$ul_start=false;
while(!feof($file))
{    
        
      $line= fgets($file);   //Get line
      $line=trim($line);
      if(strlen($line)==0){
          continue;
      }
      if(ctype_upper(str_replace(" ","",$line))){
          //echo "\nU->".$line;
          if($ul_start){
             $final.='</ul>'; 
          }
          $final.='<h2>'.$line.'</h2>';
          $ul_start=false; 
      }elseif(substr($line,-1)==':'){
          //echo "\nS->".$line;
          if($ul_start){
             $final.='</ul>'; 
          }
          $final.='<h3>'.$line.'</h3>';
          $ul_start=false; 
      }elseif(substr($line,0,6)=='&#149;'){
          //echo "\nB->".$line;
          if(!$ul_start){
              $final.='<ul>';
              $ul_start=true;
          }
          $final.='<li>'.trim(substr($line,6)).'</li>';
      }else{
         // echo "\nM->".$line.strlen($line);
      }
     
} if($ul_start){
             $final.='</ul>'; 
          }
 fclose($file);
//echo '<hr>'.$final;
$file_a=mysql_real_escape_string($file_a);
$final=mysql_real_escape_string($final);
$SQL=<<<EOT
INSERT INTO `clinician`.`lab` (
`lab_name` ,
`lab_desc` ,
`lab_index`
)
VALUES (
'$file_a', '$final', '$file_a[0]'
);
EOT;
if(mysql_query($SQL)){
    if(!unlink('lab2/'.$file_a.'.txt')){
        die('Unable to delete file now: '.'lab2/'.$file_a.'.txt');
    }
}else{
    die(mysql_error());
}


?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="1;url=lab_2.php" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>                                              Processing
</body>
</html>