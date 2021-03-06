<?php
    require_once  'phpQuery/phpQuery.php';
   // require_once  'recipes.php';

    $cousines = require_once 'counsines.php';
    $category_array = require_once 'category.php';
    $popular_array = require_once 'popular.php';
    $ingriditnts_array = require_once 'ingridients.php';
    $reason_array = require_once 'reason.php';
    $price_array = require_once 'price.php';
    $holidays_array = require_once 'holidays.php';
    $drinks_array = require_once 'drinks.php';

    function print_pre($args){
        print '<pre>';
        print_r($args);
        print '</pre>';
    }



    function getTemplate($tpl){
        return file_get_contents('templates/' . $tpl . '.html');
    }

    function num2word($num, $words)
    {
        if(!$num){
            return null;
        }
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: {
                return($words[0]);
            }
            case 2: case 3: case 4: {
            return($words[1]);
        }
            default: {
                return($words[2]);
            }
        }
    }
	
	
    $hours_words = array('час', 'часа', 'часов');
    $hours_minutes = array('минута', 'минуты', 'минут');
    $count_step = count($_POST['step']);

    //старый шаблон 0templates/html
    $template = file_get_contents('templates/1templates.html');


    $recipe_name = 'omlet-s-syrom';
    $recipe_name_new = trim($_POST['name']);

    $template = str_replace($recipe_name, $recipe_name_new ,$template);
    $template = str_replace('{title}', trim($_POST['headers']), $template);
    $template = str_replace('{uc_title}', trim($_POST['uc_title']), $template);
    $template = str_replace('{second_title}', $_POST['second-title'], $template);
    $template = str_replace('{photo_title}', $_POST['photo-title'], $template);
    $template = str_replace('{rec_rate}', $_POST['rate'], $template);
    $template = str_replace('{count_rates}', $_POST['rate-count'], $template);
    $template = str_replace('{items_count}', $_POST['items-count'], $template);
    $template = str_replace('{time_link}', $_POST['time-link'], $template);

    $cous_tpl = file_get_contents('templates/cousine.html');
    $couses_tpl = '';
    $i = 1;
    foreach ($_POST['cousines'] as $cous) {
        $item = str_replace('{cous_name}', $cousines[$cous]['title'], $cous_tpl);
        $item = str_replace('{cous_png}', $cousines[$cous]['src'], $item);
        $item = str_replace('{7t}', str_repeat("\t",7), $item);
        if(count($_POST['cousines']) == $i)
             $item = str_replace('{cous_href}', $cousines[$cous]['href'], $item);
        else
            $item = str_replace('{cous_href}', $cousines[$cous]['href'], $item) . ',' . "\n" . str_repeat("\t", 7);
        $couses_tpl .= $item;


        $i++;
    }
    $template = str_replace('{cousine_types}', $couses_tpl, $template);
    /**
     * Установка основного типа
    */

    $cat_tpl = getTemplate('category');
    $main_cat = str_replace('{categ_title}', $category_array[$_POST['type']]['title'], $cat_tpl);
    $main_cat = str_replace('{categ_href}',  $category_array[$_POST['type']]['href'], $main_cat);
    $main_cat = str_replace('{categ_name}',  $category_array[$_POST['type']]['name'], $main_cat);

    $template = str_replace('{type}', $main_cat, $template);


    /**
     * Работа с категориями
    */
    $count_category = count($_POST['types']);
    $categs_tpl = '';

    $i = 1;

    foreach ($_POST['types'] as $type){
        $item = str_replace('{categ_title}',$category_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $category_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $category_array[$type]['name'], $item);

        if($i != $count_category){
            $item .= ',' . "\n" . str_repeat("\t", 6);
        } else{
            $item .= '.';
        }
        $categs_tpl .= $item;
        $i++;
    }
    $template = str_replace('{categories}', $categs_tpl, $template);

    /**
     * Работа с остальными видами категорий
    */
    $count_popuplar = count($_POST['popuplar']);
    $popular_tpl = '';
    $i = 1;
    foreach ($_POST['popuplar'] as $type){

        $item = str_replace('{categ_title}',$popular_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $popular_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $popular_array[$type]['name'], $item);
        if($i != $count_popuplar){
            $item .= ',' . "\n" . str_repeat("\t", 6);
        } else{
            $item .= '.';
        }
        $popular_tpl .= $item;
        $i++;
    }
    $template = str_replace('{popular}', $popular_tpl, $template);

    $count = count($_POST['ingridients']);
    $ingriditnts_tpl = '';
    $i = 1;
    foreach($_POST['ingridients'] as $type){
        $item = str_replace('{categ_title}',$ingriditnts_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $ingriditnts_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $ingriditnts_array[$type]['name'], $item);
        if($i != $count){
            $item .= ',' . "\n" .  str_repeat("\t", 6);
        } else{
            $item .= '.';
        }
        $ingriditnts_tpl .= $item;
        $i++;
    }
    $template = str_replace('{ingridients}', $ingriditnts_tpl, $template);

    $count = count($_POST['reason']);
    $reason_tpl = '';
    $i = 1;
    foreach($_POST['reason'] as $type){
        $item = str_replace('{categ_title}',$reason_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $reason_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $reason_array[$type]['name'], $item);
        if($i != $count){
            $item .= ',' . "\n" .  str_repeat("\t", 6);
        } else{
            $item .= '.';
        }
        $reason_tpl .= $item;
        $i++;
    }
    $template = str_replace('{reason}', $reason_tpl, $template);

    $count = count($_POST['price']);
    $price_tpl = '';
    $i = 1;
    foreach ($_POST['price'] as $type){
        $item = str_replace('{categ_title}',$price_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $price_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $price_array[$type]['name'], $item);
        if($i != $count){
            $item .= ',' . "\n" .  str_repeat("\t", 7);
        } else{
            $item .= '.';
        }
        $price_tpl .= $item;
        $i++;
    }
    $template = str_replace('{price}', $price_tpl, $template);

    $count = count($_POST['holidays']);
    $holidays_tpl = '';
    $i = 1;
    foreach($_POST['holidays'] as $type){
        $item = str_replace('{categ_title}',$holidays_array[$type]['title'] , $cat_tpl);
        $item = str_replace('{categ_href}', $holidays_array[$type]['href'], $item);
        $item = str_replace('{categ_name}', $holidays_array[$type]['name'], $item);
        if($i != $count){
            $item .= ',' . "\n" .  str_repeat("\t", 7);
        } else{
            $item .= '.';
        }
        $holidays_tpl .= $item;
        $i++;
    }
    $template = str_replace('{holidays}', $holidays_tpl, $template);

    /**
     * Работа с напитками
    */
    $dr_tpl = '';
    if(isset($_POST['drinks']) && !empty($_POST['drinks'])){
        $dr_tpl = getTemplate('drinks');
        $count = count($_POST['drinks']);
        $drinks_tpl = '';
        $i = 1;
        foreach ($_POST['drinks'] as $type){
            $item = str_replace('{categ_title}',$drinks_array[$type]['title'] , $cat_tpl);
            $item = str_replace('{categ_href}', $drinks_array[$type]['href'], $item);
            $item = str_replace('{categ_name}', $drinks_array[$type]['name'], $item);
            if($i != $count){
                $item .= ',' . "\n" .  str_repeat("\t", 7);
            } else{
                $item .= '.';
            }
            $drinks_tpl .= $item;
            $i++;
        }
        $drinks_tpl = str_replace('{drinks}', $drinks_tpl, $dr_tpl);
        $template = str_replace('{drinks_template}', $drinks_tpl, $template);
    } else{
        $template = str_replace('{drinks_template}', '', $template);
    }
    /**
     * Работа со времеем приготовления
    */
    $time_hours = trim($_POST['hours'] . ' ' . num2word($_POST['hours'], $hours_words));
    $time_minutes = trim($_POST['minutes'] . ' ' . num2word($_POST['minutes'], $hours_minutes));

    $short_minutes = ($_POST['minutes']) ? $_POST['minutes'] . ' мин.' : '';

    if($_POST['hours']){
        $seo_hours = $_POST['hours'].'H';
    } else{
        $seo_hours = '';
    }

    if($_POST['minutes']){
        $seo_minutes = $_POST['minutes'] . 'M';
    } else{
        $seo_minutes = '';
    }

    $template = str_replace('{word_hours}', $time_hours, $template);
    $template = str_replace('{word_minutes}', $time_minutes, $template);
    $template = str_replace('{short_minutes}', $short_minutes, $template);
    $template = str_replace('{seo_hours}', $seo_hours, $template);
    $template = str_replace('{seo_minutes}', $seo_minutes, $template);

    if(isset($_POST['without-images']) && !empty($_POST['without-images'])){
        $a_remove = '<a href="http://rf-stone.ru/images/recipes/'. $recipe_name_new .'/0-1.JPG" class="highslide-image"><img   alt="Ингредиенты приготовления {second_title}" src="http://rf-stone.ru/images/recipes/'.$recipe_name_new.'/0.JPG" width="320" height="240" align="right" /></a>';
        $template =  preg_replace('{<a.+0-1.JPG.+</a>}', '', $template);
        $step_tpl = getTemplate('step_no_images');
    } else{
        $step_tpl = getTemplate('step');
    }


    /**
     * Работа с шагами;
    */
    $steps = '';
    for ($i = 1; $i <= $count_step; $i++){
        $step = str_replace('{step_number}', $i, $step_tpl);
        $step = str_replace('{recipe}', $recipe_name_new, $step);
        $step = str_replace('{step_text}', $_POST['step'][$i], $step);
        $step = str_replace('{step_title}', $_POST['title'][$i], $step);
        $steps .= $step . "\n{7t}";
    }
    $template = str_replace('{steps}', $steps, $template);

    /**
     * Работа с рейтингом;
     */


    if(preg_match('/\./', $_POST['rate'])){
        $type_rate = 'float';
    } else{
        $type_rate = 'int';
    }
    $flag_half = false;

    $star_tpl = getTemplate('rate');
    $stars_list = '';

    for($i = 1; $i <= 10; $i++){
        if($i <= $_POST['rate']){
           $r = 'on';
        } else if($i > $_POST['rate'] && $type_rate == 'float' && !$flag_half){
            $flag_half = true;
            $r = 'half';
        } else{
            $r = 'off';
        }
        $str = str_replace('{rating_type}', $r, $star_tpl);
        if($i != 10){
            $str .= "\n" . str_repeat("\t", 5);
        }
        $stars_list .= $str;
    }
    $template = str_replace('{rating_stars}', $stars_list, $template);

    /**
     * Заполняем ингридиенты;
    */
    $count_ing = count($_POST['ing-name']);
    $count_ing = count($_POST['ing-name']);
    $ingriditnts = '';
    $ing_tpl = getTemplate('ingridient');


    for($i = 1; $i <= $count_ing; $i++){
		if(empty($_POST['ing-name'][$i])){
			continue;
		}
        $ing_item = str_replace('{ing_name}', $_POST['ing-name'][$i], $ing_tpl);
        $ing_item = str_replace('{ing_value}', $_POST['ing-count'][$i], $ing_item);
        $ing_item = str_replace('{ing_type}', $_POST['ing-type'][$i], $ing_item);
        if($i != $count_ing)
            $ing_item .= "\n" . '{7t}';
        $ingriditnts .= $ing_item;
    }
    $template = str_replace('{list_ingridients}', $ingriditnts, $template);


    $template =preg_replace_callback('/{([\d]+?)(t|n)}/', function($matches){
        $t = $matches[2] == 't' ? "\t" : "\n";
        return str_repeat($t, $matches[1]);
    }, $template);


    file_put_contents('recipes/' . $recipe_name_new.'.html', $template);




    /**
     * Сформируем html для категорийной страницы;
    */
    $portions = array('порция', 'порции', 'порций');
    $portions_str = $_POST['items-count'] . ' ' . num2word($_POST['items-count'], $portions);
    $tpl = getTemplate('tpl_for_categories');
    $tpl = str_replace('{new_addr}', $recipe_name_new, $tpl);
    $tpl = str_replace('{word_hours}', $time_hours, $tpl);
    $tpl = str_replace('{word_minutes}', $time_minutes, $tpl);
    $tpl = str_replace('{count_porions}', $portions_str, $tpl);
    $tpl = str_replace('{name}', trim($_POST['uc_title']), $tpl);
    file_put_contents('recipes/' . $recipe_name_new . '_category.html', $tpl);