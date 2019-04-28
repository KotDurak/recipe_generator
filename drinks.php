<?php
require_once  'phpQuery/phpQuery.php';

$html = file_get_contents('http://html/');
$document = phpQuery::newDocument($html);


$cousines = $document->find('.drinks')->find('li');
$types = array();
foreach ($cousines as $c){
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
file_put_contents('drinks',$json);
*/
$file = file_get_contents('drinks');
$types = json_decode($file, true);

return $types;