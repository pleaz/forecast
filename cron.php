<?php

require 'vendor/autoload.php';
use PHPHtmlParser\Dom;

$url = 'https://www.accuweather.com/en/es/torrevieja/306480/daily-weather-forecast/306480';
$ua = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, $ua);
$result = curl_exec($curl);

$dom = new Dom;
$dom->load($result);

$ul = $dom->find('div[id=feed-tabs] ul', 1);
$li = $ul->find('li');

$days = [];

foreach ($li as $li_el) {
    $day = $li_el->find('h3 a')->text;
    $date = $li_el->find('h4')->text;
    $large_temp = preg_replace('/\D/', '', $li_el->find('div.info div.temp span.large-temp')->text);
    $small_temp = preg_replace('/\D/', '', $li_el->find('div.info div.temp span.small-temp')->text);
    $cond = $li_el->find('div.info span.cond')->text;
    $image = $li_el->find('div.icon')->getAttribute('class');
    $days[] = [
      'day' => $day,
      'date' => $date,
      'large_temp' => $large_temp,
      'small_temp' => $small_temp,
      'cond' => $cond,
      'image' => $image
    ];
}

if(file_put_contents('cache_file', serialize($days))){
    return true;
}
