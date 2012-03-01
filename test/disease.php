<?php  
 $files = array();  
 $dir = opendir('lab');  
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
 require('rtfclass.php') ;
 $content=file_get_contents('lab/'.$file);
 
 $r = new rtf( stripslashes( $content));
        $r->output( "html");
        $r->parse();
        if( count( $r->err) == 0) // no errors detected
            echo $r->out;
 
                    