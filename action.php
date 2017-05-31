<?php 
function sendMessage($parameters) {
	header('Content-Type: application/json');
//      print_r($parameters);
 	echo json_encode($parameters);
}

$post_data = file_get_contents("php://input");
if($post_data["result"]["parameters"]["sunsign"]){
  $sunsign = $post_data["result"]["parameters"]["sunsign"];
  $sunsign = 'cancer';
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
