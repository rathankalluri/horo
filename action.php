<?php
function sendMessage($parameters)
{
    header('Content-Type: application/json');
    //      print_r($parameters);
    echo json_encode($parameters);
}
$post      = file_get_contents("php://input");
$post_data = json_decode($post, True);
#error_log($post, 0);
if (isset($post_data["result"]["action"])) {
    $sunsign    = strtolower($post_data["result"]["parameters"]["sunsign"]);
    $url        = "http://rathankalluri.com/tr-in/horoscope.php?zodiac=".$sunsign;
    $speak      = file_get_contents($url);
    //$speak      = substr($speak, 0, strpos($speak, "(c)"));
    if($post_data["originalRequest"]["source"]){$src = $post_data["originalRequest"]["source"];}else{$src = "agent";}
    $parameters = array(
        "source" => $src,
        "speech" => $speak." If you want to know more about another sign, please say it.",
        "displayText" => $speak,
        "contextOut" => []
    );
    sendMessage($parameters);
    
} else {
    echo "Please let me know your sunsign";
}
?>
