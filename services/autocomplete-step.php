<?php
require_once  '../phpQuery/phpQuery.php';
header("Content-type: application/json; charset=utf-8");

function print_pre($arg){
    echo '<pre>';
    echo print_r($arg);
    echo '</pre>';
}


$html = file_get_contents($_POST['url']);
$document = phpQuery::newDocument($html);
$steps_array = [];
$steps = $document->find('.instructions');
if($steps->length != 0){
    $steps = $steps->find('.content_step');
    foreach ($steps as $step){
        $s = pq($step);
        foreach ($s->find('.instruction') as $i){
            $i = pq($i);
            $text = $i->text();
            break;
        }
        foreach ($s->find('img') as $img){
            $img = pq($img);
            $alt = $img->attr('alt');
            break;
        }
        $steps_array[] = [
          'instruction' => $text,
          'alt'         => $alt
        ];
    }
} else{
   $steps = $document->find('.content_step');
   $no_step = true;
   foreach ($steps as $step){
       if($no_step){
           $no_step = false;
           continue;
       }
       $s = pq($step);
       $li = $s->find('ul')->find('li')[0];
       $alt = $s->find('img')[0]->attr('alt');
       $steps_array[] = [
         'instruction' =>   $li->text(),
           'alt'    => $alt
       ];

   }

}
echo json_encode($steps_array);