<?php 
function sendMessage($parameters) {
	header('Content-Type: application/json');
//      print_r($parameters);
 	echo json_encode($parameters);
}

$post = file_get_contents("php://input");
$post_data = json_decode($post,True);
if (isset($post_data["result"]["action"])){
  $sunsign = $post_data["result"]["parameters"]["sunsign"];
  $url = "http://sandipbgt.com/theastrologer/api/horoscope/".$sunsign."/today/";
  //$response = poster(url);
  $response = file_get_contents($url);
  $resp = json_decode($response);
  $speak = $resp->horoscope;
  $parameters = array(
            "source" => "agent",
            "speech" => "Here are the horoscope for today: ".$speak,
            "displayText" => $speak,
            "contextOut" => array()
        );  
  sendMessage($parameters);
  
}else{
echo "Please let me know your sunsign";
}

?>
