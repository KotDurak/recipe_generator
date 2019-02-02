<?php
    require_once  'phpQuery/phpQuery.php';
    require_once  'recipes.php';

    $cousines = require_once 'counsines.php';
    $category_array = require_once ('category.php');

    function print_pre($args){
        print '<pre>';
        print_r($args);
        print '</pre>';
    }

    function getTemplate($tpl){
        return file_get_contents('templates/' . $tpl . '.html');
    }

    $count_step = count($_POST['step']);




    $template = file_get_contents('templates/0templates.html');
    $recipe_name = 'omlet-s-syrom';
    $recipe_name_new = trim($_POST['name']);

    $template = str_replace($recipe_name, $recipe_name_new ,$template);
    $template = str_replace('{title}', trim($_POST['headers']), $template);
    $template = str_replace('{uc_title}', trim($_POST['uc_title']), $template);
    $template = str_replace('{second_title}', $_POST['second-title'], $template);
    $template = str_replace('{photo_title}', $_POST['photo-title'], $template);
    $template = str_replace('{rec_rate}', $_POST['rate'], $template);
    $template = str_replace('{count_rates}', $_POST['rate-count'], $template);


    $cous_tpl = file_get_contents('templates/cousine.html');
    $couses_tpl = '';
    $i = 1;
    foreach ($_POST['cousines'] as $cous) {
        $item = str_replace('{cous_name}', $cousines[$cous]['title'], $cous_tpl);
        $item = str_replace('{cous_png}', $cousines[$cous]['src'], $item);
        if(count($_POST['cousines']) == $i)
             $item = str_replace('{cous_href}', $cousines[$cous]['href'], $item);
        else
            $item = str_replace('{cous_href}', $cousines[$cous]['href'], $item) . ',';
        $couses_tpl .= $item . "\n";


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
            $item .= ',';
        }
        $categs_tpl .= $item . "\n";
        $i++;
    }
    $template = str_replace('{categories}', $categs_tpl, $template);


    $step_tpl = getTemplate('step');

    /**
     * Работа с шагами;
    */
    $steps = '';
    for ($i = 1; $i <= $count_step; $i++){
        $step = str_replace('{step_number}', $i, $step_tpl);
        $step = str_replace('{recipe}', $recipe_name_new, $step);
        $step = str_replace('{step_text}', $_POST['step'][$i], $step);
        $step = str_replace('{step_title}', $_POST['title'][$i], $step);
        $steps .= $step . "\n";
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
        $str .= "\n";
        $stars_list .= $str;
    }
    $template = str_replace('{rating_stars}', $stars_list, $template);

    /**
     * Заполняем ингридиенты;
    */
    $count_ing = count($_POST['ing-name']);
    $ingriditnts = '';
    $ing_tpl = getTemplate('ingridient');


    for($i = 1; $i <= $count_ing; $i++){
        $ing_item = str_replace('{ing_name}', $_POST['ing-name'][$i], $ing_tpl);
        $ing_item = str_replace('{ing_value}', $_POST['ing-count'][$i], $ing_item);
        $ing_item = str_replace('{ing_type}', $_POST['ing-type'][$i], $ing_item);
        $ing_item .= "\n";
        $ingriditnts .= $ing_item;
    }
    $template = str_replace('{ingridients}', $ingriditnts, $template);

    file_put_contents('file.html', $template);