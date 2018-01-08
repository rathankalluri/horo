<?php

if($_GET["zodiac"]){

$horos = file_get_contents("horoapi.json");
$json = json_decode($horos, TRUE);

foreach($json as $horo)
{
     if (array_key_exists($_GET["zodiac"], $horo)) {
              header('Content-Type: application/json');  
              print_r(json_encode($horo));
       }
}

}
else{
function getFeed($feed_url) {
    
//Recent add

    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
    $hor_stack = array();

    foreach($x->channel->item as $entry) {
	$title = substr($entry->title, 0, strpos($entry->title, "Hor"));
	$title = trim(strtolower($title));

        if(($pos = strpos($entry->description, ',')) !== false)
	{
	   $desc = substr($entry->description, $pos + 2);
	}
	else
	{
	   $desc = get_last_word($entry->description);
	}
	//Restricting length of WRITE to 600 for Google Assistant
	$write = substr($desc, 0, 600);
	$write = strip_tags(substr($write, 0, strrpos($write, ' '))). " ...";
 
 	$desc = substr($desc, 0, strpos($desc, "<div "));
        $desc = str_replace("<br/><br/><B>","Your ",$desc);
        $desc = str_replace(": </B>"," today is ",$desc);
        $desc = trim($desc);
       
//        $hor_stack[] = array('sunsign' => "$title",'desc' => "$desc", 'write' => "$write");
          $hor_stack[] = array($title => array('desc' => "$desc", 'write' => "$write"));	
    }
        $hor_json = json_encode($hor_stack);

    if(file_put_contents("horoapi.json", $hor_json)){echo "Success";}else{echo "Could not Write to File";}
}

$feed_url = "http://feeds.feedburner.com/dayhoroscope?format=xml";  
try{
getFeed($feed_url);
}catch(Exception $e) {
 echo "Something Failed!! Please try again";
}

}
?>