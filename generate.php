<?php
    require_once  'phpQuery/phpQuery.php';
    require_once  'recipes.php';

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
    $template = str_replace('{type}', str_replace(',','',$html_types[$_POST['type']]. ','), $template);


    $document = phpQuery::newDocument($template);
    $document->find('.instructions')->find('.content_step')->count();

    $content_steps = $document->find('.instructions')->find('.content_step');

    if(preg_match('/\./', $_POST['rate'])){
        $type_rate = 'float';
    } else{
        $type_rate = 'int';
    }
    $flag_half = false;
$document->find('span.rating')->append("\n");
    for($i = 1; $i <= 10; $i++){
        if($i <= $_POST['rate']){
           $r = 'on';

        } else if($i > $_POST['rate'] && $type_rate == 'float' && !$flag_half){
            $flag_half = true;
            $t = 'half';
        } else{
            $r = 'off';
        }
        $str = '<span><img src="http://rf-stone.ru/images/stars_crystal/rating_'.$r.'.png"/></span>';
        $str .= "\n";
        $document->find('span.rating')->append($str );
    }
    /**
     * Заполняем категории;
    */
    $count_ing = count($_POST['ing-name']);
    for($i = 1; $i <= $count_ing; $i++){
        $ing_str = '<li class="ingredient"><span class="name">'.$_POST['ing-name'][$i].' </span> - <span class="value">'.$_POST['ing-count'][$i].'</span> <span class="type">'.$_POST['ing-type'][$i].'</span></li>';
        $document->find('.content_step')->
            find('ul.rec')->append($ing_str . "\n");
    }

    $i = 1;
    $count_category = count($_POST['types']);
    foreach ($_POST['types'] as $type){
        if($i == $count_category){
            $document->find('span.category')->append(str_replace(',','',$html_types[$type]. ',') . "\n");
        } else{
            $document->find('span.category')->append($html_types[$type] . "\n");
        }
        $i++;
    }

    if($count_step < 10){
        $diff = 10 - $count_step;
        for($d = 0; $d < $diff; $d++){
            $document->find('.instructions')->find('.content_step:last')->remove();
        }
    }

    /**
     * Заполняем инигридиенты;
    */


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
            $document->find('.instructions')->append($content_step . "\n");

        }
    }
    file_put_contents('file.html', $document);