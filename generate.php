<?php
    require_once  'phpQuery/phpQuery.php';

    function print_pre($args){
        print '<pre>';
        print_r($args);
        print '</pre>';
    }
    $count_step = count($_POST['step']);


    $template = file_get_contents('templates/0templates.html');
    $recipe_name = 'omlet-s-syrom';
    $recipe_name_new = trim($_POST['name']);

    $template = str_replace($recipe_name, $recipe_name_new ,$template);
    $template = str_replace('{title}', trim($_POST['headers']), $template);

    $document = phpQuery::newDocument($template);
    $document->find('.instructions')->find('.content_step')->count();

    $content_steps = $document->find('.instructions')->find('.content_step');

    if($count_step < 10){
        $diff = 10 - $count_step;
        for($d = 0; $d < $diff; $d++){
            $document->find('.instructions')->find('.content_step:last')->remove();
        }
    }

    for ($i = 1; $i <= $count_step; $i++){
        $document->find('.instructions')->find('.content_step')->eq($i-1)->
             find('.instruction')->text($_POST['step'][$i]);
        $document->find('.instructions')->find('.content_step')->eq($i-1)->
        find('img')->attr('title',$_POST['title'][$i]);
        $document->find('.instructions')->find('.content_step')->eq($i-1)->
        find('img')->attr('alt',$_POST['title'][$i]);
        if($i > 10){
            $content_step = '<div class="content_step"><p></p>
								<ul>
									<li><strong>Шаг '. $i .'</strong>
									<span class="instruction">'.$_POST['step'][$i].'</span>
									<a href="http://rf-stone.ru/images/recipes/'. $recipe_name_new.'/'.$i.'-1.JPG" class="highslide-image" onclick=""><img class="photo aligncenter size-large wp-image-4939" 
									title="'.$_POST['title'][$i].'" alt="'.$_POST['title'][$i].'" src="http://rf-stone.ru/images/recipes/'. $recipe_name_new.'/'.$i.'.JPG" width="320" height="240" align="right"></a></li>
								</ul>
							<p></p>
							</div>';

            $document->find('.instructions')->append($content_step);

        }
    }
    file_put_contents('file.html', $document);