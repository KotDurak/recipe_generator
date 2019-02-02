<?php

/*

require_once  'phpQuery/phpQuery.php';
$html = file_get_contents('http://html/recipes/0templates.html');
$document = phpQuery::newDocument($html);

$categories = $document->find('.category')->find('a');
$array = array();

foreach ($categories as $cat){
    $item = pq($cat);
    $title = $item->attr('title');
    $href = $item->attr('href');
    $text = $item->text();
    $index = substr(basename($href), 0, -5);
    $array[$index] = array(
        'title' => $title,
        'href'  => $href,
        'name'  => $text
    );
}

$json = json_encode($array);
file_put_contents('category',$json);

*/

$file = file_get_contents('category');
return $categories = json_decode($file, true);

