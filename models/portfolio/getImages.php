<?php

$folder = opendir("../../views/assets/content_images/portfolio/portfolio_small"); 
 
$pic_types = array("png");
 
$index = array();
 
while ($file = readdir ($folder)) {
 
  if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types))
	{
		array_push($index,$file);
	}
}
 
closedir($folder);

print json_encode($index);
