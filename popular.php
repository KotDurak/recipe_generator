<?php
require_once  'phpQuery/phpQuery.php';



$html = file_get_contents('http://html/');
$document = phpQuery::newDocument($html);

$popuplar = $document->find('.popular')->find('li');
$types = array();
foreach ($popuplar as $c){
    $item = pq($c);
    $a = $item->find('a');
    $href = $a->attr('href');
    $index = substr(basename($href), 0, -5);
    $src = $item->find('img')->attr('src');
    $types[$index] = array(
        'href'   => $href,
        'src'    => $src,
        'title'  => trim($a->text())
    );
}
/*
$json = json_encode($types);
file_put_contents('popular',$json);
*/

$file = file_get_contents('popular');
$types = json_decode($file, true);
return $types;