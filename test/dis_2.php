<?php


//error_reporting(0); 

$files = array();  
 $dir = opendir('dis2');  
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
    die('Unable to delete file: '.'dis2/'.$file_a.'.txt');
 }else{
     $_SESSION['file']=$file_a;
 }
 
$file= fopen('dis2/'.$file_a.'.txt','r');
$final='';
$ul_start=false;
$heads=array();
$heads[]='CLINICAL PRESENTATION';
$heads[]='CLINICAL EXAMINATION';
$heads[]='CAUSES';
$heads[]='LAB INVESTIGATION';
$heads[]='PROGNOSIS';
$heads[]='MEDICATIONS';
$heads[]='PREDISPOSITION';
$heads[]='RISK FACTORS';
$heads[]='HABIT';
$headsn=array();
$matches=array();
$heads_final=array();
$content_final=array();
$currenthead='';
$currentshead='';

//Flags
$flag_headstd=false;
$flag_headsea=false;
$flag_subhead=false;
$flag_listart=false;
$flag_age=false;
$flag_sex=false;

$debug=false;
$sex='';

while(!feof($file))
{            
    $line= fgets($file);   //Get line
    $line=trim($line);
    if(strlen($line)==0 or $line==''){
        continue;
    }
    
    if($line=='Age:'){
         if($debug){
                echo "Detected Age : '$line'\n";
          }
          $flag_age=true;
          continue; 
    }
    
    if($line=='Sex:'){
         if($debug){
                echo "Detected Sex : '$line'\n";
          }
          $flag_sex=true;
          continue; 
    }
    
    if($flag_age){
        preg_match_all('!\d+!', $line, $matches);
        $flag_age=false;
        continue;
    }
    
    if($flag_sex){
        $line=strtolower($line);
        $line=str_replace("female","fetale",$line);
        $f=strpos($line,'fetale');
        $m=strpos($line,'male');
        echo $f.'|'.$m;
        if($m!==false && $f!==false){
            //Both are present
            if($f >strpos($line,'more') || $f<strpos($line,'less')){
                $sex='m';
            }else{
                $sex='f';
            }
        }elseif($f!==false){
            $sex='f';
        }else{
            $sex='m';
        }
        $flag_sex=false;
        continue;
    }
    
    //Check if its a heading
    if(ctype_upper(str_replace(" ","",$line))){
        //Its a heading
        if($flag_listart){
                $content_final[$currenthead].='</ul>';
                $flag_listart=false;    
         }  
        //CHeck if its a searchabe
        if(in_array($line,$heads)){
            $heads_final[$line]=array();
            $flag_headsea=true;
            $currenthead=$line;
            if($debug){
                echo "Detected Searchable head: '$line'\n";
            }
        }else{
            //Not a searchable
            $flag_headsea=false;
            $currenthead=$line;
            $content_final[$currenthead]='';
            if($debug){
                echo "Detected Head: '$line'\n";
            }
        }
    }elseif(substr($line,-1)==':'){ //check if sub string
		if($flag_listart){
                $content_final[$currenthead].='</ul>';
                $flag_listart=false;
                   
        }   
        if($flag_headsea){
            $flag_subhead=true;
            $currentshead=$line;
            if($debug){
                    echo "Detected Searchable Subhead: '$line'\n";
            }
		}else{
            $content_final[$currenthead].='<h3>'.$line.'</h3>';
            if($debug){
                    echo "Detected Non Searchable Subhead: '$line'\n";
            }
        }
		
    }elseif(substr($line,0,6)=='&#149;'){
        //Its a bulet
        $line=trim(substr($line,6));
        //Check if the std head
        if($flag_headsea){
            //Check if subhead is used
            if($flag_subhead){
                $heads_final[$currenthead][]=$currentshead.$line;
                if($debug){
                    echo "Detected Searchable Bullet with sub: '$line'\n";
                }
            }else{
                $heads_final[$currenthead][]=$line;
                if($debug){
                    echo "Detected Searchable bullet: '$line'\n";
                }
            }  
        }else{
            //Non searchable
            if(!$flag_listart){
                $content_final[$currenthead].='<ul>';
                $flag_listart=true;   
            }
            $content_final[$currenthead].='<li>'.$line.'</li>';
            if($debug){
                    echo "Detected non Searchable bullet: '$line'\n";
            }
        }
    }else{
        $flag_subhead=false;
         $content_final[$currenthead].='<p>'.$line.'</p>';
         if($debug){
                    echo "Detected Searchable para: '$line'\n";
         }
    }
 
     
}
if($flag_listart){
                $content_final[$currenthead].='</ul>';
                $flag_listart=false;
                   
        }
           echo "$sex\n";

$head_n=array('KEY NOTES','BASICS','TREATMENT','DIAGNOSIS');

foreach($head_n as $v){
    if(!array_key_exists($v,$content_final)){
        $content_final[$v]='';     
    }
}
$other='';
foreach($content_final as $k=>$v){
    if(!in_array($k,$head_n)){
        $other.='<h2>'.$k.'</h2>'.$v;
    }
}

$age=0;
$matches=$matches[0];
if(count($matches)>0){
    foreach($matches as $v){
         $age+=intval($v);
    }
    $age=intval($age/count($matches));
}
echo "$age\n";

foreach($content_final as $k=>$v){
    $content_final[$k]=mysql_real_escape_string($v);
}
$key=$content_final['KEY NOTES'];
$other=mysql_real_escape_string($other);
$SQ=<<<EOT
INSERT INTO `clinician`.`disease` (
`disease_id` ,
`disease_name` ,
`keynotes` ,
`basics` ,
`lab` ,
`treatement` ,
`diagnosis` ,
`sex` ,
`age` ,
`disease_index` ,
`other`
)
VALUES (
NULL , '$file_a', '$key', '$content_final[BASICS]', '', '$content_final[TREATMENT]', '$content_final[DIAGNOSIS]', '$sex', '$age', '$file_a[0]', '$other'
);
EOT;

//Now get relations
/*$heads[]='CLINICAL PRESENTATION';
$heads[]='CLINICAL EXAMINATION';
$heads[]='CAUSES';
$heads[]='LAB INVESTIGATION';
$heads[]='PROGNOSIS';
$heads[]='MEDICATIONS';
$heads[]='PREDISPOSITION';
$heads[]='RISK FACTORS';
$heads[]='HABIT';*/

//Cinical exam
$master=array();
foreach($heads as $v){
	$master[$v]=array();
    if(array_key_exists($v,$heads_final)){
        if(count($heads_final[$v])>0){
            foreach($heads_final[$v] as $vv){   $vv=mysql_real_escape_string($vv);
                switch($v){
                    case 'CLINICAL PRESENTATION':
                        $q="SELECT id from symptom WHERE symptom='$vv'";
                        break;
                    case 'CLINICAL EXAMINATION':
                        $q="SELECT ex_id from examination WHERE ex_desc='$vv'";
                        break;
                    case 'CAUSES':
                        $q="SELECT cau_id FROM causes WHERE cau_name='$vv'";
                        break;                    
                    case 'LAB INVESTIGATION':
                        $q="SELECT inv_id FROM inv WHERE inv_name='$vv'";
                        break;
                    case 'MEDICATIONS':
                        $q="SELECT med_id FROM medication WHERE med_name='$vv'";
                        break;
                    case 'PREDISPOSITION':
                        $q="SELECT pre_id FROM predisposition WHERE pre_name='$vv'";
                        break;
                    case 'PROGNOSIS':
                        $q="SELECT pro_id FROM prognosis WHERE pro_name='$vv'";
                        break;
                    case 'RISK FACTORS':
                        $q="SELECT ris_id FROM risk WHERE ris_name='$vv'";
                        break;
                    case 'HABIT':
                        $q="SELECT hab_id FROM habbit WHERE hab_name='$vv'";
                }
                $r=mysql_query($q);
                if(!$r){
                    echo "\n".$q."\n";
                    die(mysql_error());
                }
                if(mysql_num_rows($r)>0){
                    $r=mysql_fetch_row($r);
                    $master[$v][]=$r[0];
                }else{      
                    switch($v){
                        
                        case 'CLINICAL PRESENTATION':
                            $q="INSERT INTO symptom VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'CLINICAL EXAMINATION':
                            $q="INSERT INTO examination VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'CAUSES':
                            $q="INSERT INTO causes VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;                    
                        case 'LAB INVESTIGATION':
                            $q="INSERT INTO inv VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'MEDICATIONS':
                            $q="INSERT INTO medication VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'PREDISPOSITION':
                            $q="INSERT INTO predisposition VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'CLINICAL EXAMINATION':
                            $q="INSERT INTO prognosis VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'RISK FACTORS':
                            $q="INSERT INTO risk VALUES (NULL,'$vv',0,'$vv[0]')";
                            break;
                        case 'HABIT':
                            $q="INSERT INTO habit VALUES (NULL,'$vv',0,'$vv[0]')";
                    }
                    mysql_query($q);
                    $master[$v][]=mysql_insert_id();			     
				}  
            }
        }
    }
}

$sym=':'.implode(':',$master['CLINICAL PRESENTATION']).':';
$ex=':'.implode(':',$master['CLINICAL EXAMINATION']).':';
$pro=':'.implode(':',$master['PROGNOSIS']).':';
$med=':'.implode(':',$master['MEDICATIONS']).':';
$cau=':'.implode(':',$master['CAUSES']).':';
$hab=':'.implode(':',$master['HABIT']).':';
$pre=':'.implode(':',$master['PREDISPOSITION']).':';
$ris=':'.implode(':',$master['RISK FACTORS']).':';
$inv=':'.implode(':',$master['LAB INVESTIGATION']).':';

if($sym=='::'){
    $sym='';
}
if($ex=='::'){
    $ex='';
}
if($pro=='::'){
    $pro='';
}
if($med=='::'){
    $med='';
}
if($cau=='::'){
    $cau='';
}
if($hab=='::'){
    $hab='';
}
if($pre=='::'){
    $pre='';
}
if($ris=='::'){
    $ris='';
}
if($inv=='::'){
    $inv='';
}

$r2=mysql_query($SQ);
$did=mysql_insert_id();

$SQ2=<<<EOT
INSERT INTO `relation` (
`disease_id` ,
`sym` ,
`ex` ,
`pro` ,
`med` ,
`cau` ,
`hab` ,
`pre` ,
`ris` ,
`inv`
)
VALUES (
'$did', '$sym', '$ex', '$pro', '$med', '$cau', '$hab', '$pre', '$ris', '$inv'
);
EOT;

if($r2 && mysql_query($SQ2)){
    fclose($file);
    unlink('dis2/'.$file_a.'.txt'); 
}else{
    echo mysql_error();
    die('BAD');
}
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="3;url=dis_2.php" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>                                              Processing
</body>
</html>