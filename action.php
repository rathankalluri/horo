<?php
function sendMessage($parameters)
{
    header('Content-Type: application/json');
    //      print_r($parameters);
    echo json_encode($parameters);
}

$post      = file_get_contents("php://input");
$post_data = json_decode($post, True);

if (isset($post_data["result"]["action"])) {
    $sunsign    = strtolower($post_data["result"]["parameters"]["sunsign"]);
    $url        = "http://sandipbgt.com/theastrologer/api/horoscope/" . $sunsign . "/today/";
    //$response = poster(url);
    $response   = file_get_contents($url);
    $resp       = json_decode($response);
    $speak      = $resp->horoscope;
    $speak = substr($speak, 0, strpos($speak, "(c)"));
    if($post_data["originalRequest"]["source"]){$src = $post_data["originalRequest"]["source"];}else{$src = "agent";}
    $parameters = array(
        "source" => $src,
        "speech" => $speak,
        "displayText" => $speak,
        "contextOut" => []
    );
    sendMessage($parameters);
    
} else {
    echo "Please let me know your sunsign";
}
?>
