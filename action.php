<?php
function sendMessage($parameters)
{
    header('Content-Type: application/json');
    //      print_r($parameters);
    echo json_encode($parameters);
}
$post      = file_get_contents("php://input");
$post_data = json_decode($post, True);
error_log($post, 0);
if (isset($post_data["result"]["action"])) {
    $sunsign    = strtolower($post_data["result"]["parameters"]["sunsign"]);
    $url        = "http://rathankalluri.com/tr-in/horoscope.php?zodiac=".$sunsign;
    $speak      = file_get_contents($url);
    $data = json_decode($speak, true);
    //$speak      = substr($speak, 0, strpos($speak, "(c)"));
    
   foreach($data as $spe){
	$speech = $spe["desc"];
	$write = $spe["write"];
}     
	
//Want to separate the sources.. this needs some work!! Also SDKs are better to build awesome apps.	
    if($post_data["originalRequest"]["source"]){$src = $post_data["originalRequest"]["source"];}else{$src = "agent";}
    if($src == "Google"){
	    $parameters = array(
        "source" => $src,
        "speech" => "This is a demo text for google assistant", //$speak,
        "displayText" => "Demo for google assistant", //$speak,
        "contextOut" => []
    );
    sendMessage($parameters);
    }//Google
    else {
    $parameters = array(
        "source" => $src,
        "speech" => $speech,
        "displayText" => $write,
        "contextOut" => []
    );
    sendMessage($parameters);
    }//Facebook
} else {
    echo "Please let me know your sunsign";
}
?> 
