<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 16/03/2016
 * Time: 19:19
 */
if (isset($_GET['t']) && isset($_GET['lang'])) {
    $apiKey = "AIzaSyB_26FVUmkEurjgCSbjWzAjlCeQjgJDvkw";

    $text = $_GET['t'];
    $target = $_GET['lang'];
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&target='.$target;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);
    $responseDecoded = json_decode($response, true);
    curl_close($handle);
    echo $responseDecoded['data']['translations'][0]['translatedText'];
}
