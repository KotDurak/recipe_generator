<?php
require_once  'phpQuery/phpQuery.php';

function print_pre($arg){
    print '<pre>';
    print_r($arg);
    print  '</pre>';
}

function save_image($url, $folder){
	if(!$url){
		return;
	}
    $ch = curl_init($url);
    $fp = fopen($folder . DIRECTORY_SEPARATOR . basename($url), 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);

}


if(!is_dir($_POST['folder'])){
    mkdir($_POST['folder']);
}


$url = $_POST['url'];
$page = file_get_contents($url);
$document = phpQuery::newDocument($page);
$images = $document->find('.instructions')->find('img.photo');

$result_photo = $document->find('img.result-photo');
$final_url = $result_photo->attr('src');
$final_1_url = $result_photo->parent()->attr('href');

save_image($final_url, $_POST['folder']);
save_image($final_1_url, $_POST['folder']);

$imgs = $document->find('img');
foreach ($imgs as $img){
    $src = pq($img)->attr('src');
    if(preg_match('/\/0\.JPG$/', $src) && empty($images)){
        save_image(pq($img)->parent()->attr('href'), $_POST['folder']);
        save_image($src, $_POST['folder']);
    } else if(preg_match('/\/[\d]{1,2}\.JPG/', $src)){
        save_image(pq($img)->parent()->attr('href'), $_POST['folder']);
        save_image($src, $_POST['folder']);
	} else if(preg_match('/\/Final\.JPG/', $src)){
		save_image(pq($img)->parent()->attr('href'), $_POST['folder']);
		save_image($src, $_POST['folder']);
	}

}




foreach ($images as $elem){
    $pq = pq($elem);
    $src = $pq->attr('src');
    $img_href = $pq->parent()->attr('href');
    save_image($src, $_POST['folder']);
    save_image($img_href, $_POST['folder']);
}

header('Location: /');

