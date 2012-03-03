<?php
set_time_limit(0);
$file=fopen('abbrev/abbrev.rtf','r');
mysql_connect('localhost','root','usbw');
mysql_select_db('clinician');
while(!feof($file))
  {
      
      $line= fgets($file);
      if($line[0]=='|'){
          $content=substr($line,1);
          $content=trim($content);
          $line= fgets($file); 
          if($line[0]=='~'){
              $content2=substr($line,1);
              $content2=trim($content2);  
              echo $content.'->'.$content2.'<br>'; 
              $sql = 'INSERT INTO `abbreviation` (`abb_code`, `abb_full`,`abb_index`) VALUES (\''.mysql_real_escape_string($content).'\', \''.mysql_real_escape_string($content2).'\',\''.strtolower($content[0]).'\');';
              mysql_query($sql);
          } 
      }
     
  }
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>                                              
</body>
</html>
