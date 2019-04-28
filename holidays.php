<?php
require_once  'phpQuery/phpQuery.php';

$html = file_get_contents('http://html/recipes/parse.html');
$document = phpQuery::newDocument($html);
$d = function($arg){
    print '<pre>';
    print_r($arg);
    print '</pre>';
};

$popuplar = $document->find('.parse-holidays')->find('a');
$types = array();
foreach ($popuplar as $c){
    $item = pq($c);
    $href = $item->attr('href');
    $name = $item->text();
    $title = $item->attr('title');
    $index = substr(basename($href), 0, -5);
    $types[$index] = array(
        'name'  => $name,
        'title' => $title,
        'href'  => $href
    );
}
/*
$json = json_encode($types);
file_put_contents('holidays',$json);
*/
$file = file_get_contents('holidays');
$types = json_decode($file, true);

return $types;