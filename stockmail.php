<?php

header('Cache-Control: no-cache'); // recommended to prevent caching of event data.


if(isset($_GET['user']) && isset($_GET['email']))
{
	$fp = fopen($_GET['room']."email.txt", 'a');  
    fwrite($fp, "<div class='msgln'><b>".strip_tags($_GET['user'])."</b>: ".$_GET['email']."<br></div>");  
    fclose($fp);  
}

if(file_exists($_GET['room']."email.txt") && filesize($_GET['room']."email.txt") > 0)
{  
    $handle = fopen($_GET['room']."email.txt", "r");  
    $contents = fread($handle, filesize($_GET['room']."email.txt"));  
    fclose($handle);
    echo $contents;
	
	//deleting file when it get bigger
	//if(filesize($_GET['room']."email.txt")>1100){
	//	@unlink($_GET['room']."email.txt");
	//}
}  


?>