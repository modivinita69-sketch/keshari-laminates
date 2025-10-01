<?php

function httpGet($url) {
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Test theme.css route
$css = httpGet('http://localhost/keshari/public/css/theme.css');
echo $css;