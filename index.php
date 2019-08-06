<?php
    require_once 'recipes.php';
    $types = require_once 'counsines.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<h3>Скачивание картинок</h3>
<form action="save_images.php" method="POST">
    <label for="url">Url страницы</label>
    <input type="text" name="url" id="url">
    <br>
    <label for="folder">Имя папки</label>
    <input type="text" name="folder" id="folder">
    <br>
    <input type="submit" value="Скачать картинки">
</form>
<a href="pagination.php">Пагиниция</a>
<h3>Генерация файла</h3>
<form action="generate.php" method="post">
    <label for="without-images">Список этапа без картинок</label>
    <input type="checkbox" name="without-images" id="without-images" value="1">
    <br/><br/>
    <label for="name">Название (на английском)</label>
    <input type="text" name="name" id="name">

    <label for="title">Title и description</label>
    <input type="text" name="headers" id="headers">

    <label for="uc_title">Название (на русском)</label>
    <input type="text" name="uc_title" id="uc_title">
    <br><br>
    <label for="second-title">Второй название (которое ниже главного)</label>
    <input type="text" name="second-title" id="second-title">

    <label for="photo-title">Название у финального фото</label>
    <input type="text" name="photo-title" id="photo-title">

    <br><br>

    <div class="types-multi">
        <label style="vertical-align: top;" for="type">Основной тип</label>
        <select  name="type" id="type" style="">
            <?php foreach (require ('category.php')as $val => $cat): ?>
                <option value="<?= $val ?>"><?= $cat['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <br><br>
    <label for="rate">Оценка</label>
    <input type="text" name="rate" id="rate" value="6">
    <label for="rate-count">Количество оценок</label>
    <input type="text" name="rate-count" id="rate-count">
    <br> <br>
    <div class="selects">
        <div class="cousines" style="margin-bottom: 5px">
            <label class="hide" style="vertical-align: top;">Кухни мира</label>
            <select name="cousines[]" id="cous"  style="height: 400px;" multiple>
                <?php foreach ($types as $idx => $cousine):  ?>
                    <option value="<?= $idx?>"><?= $cousine['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="types-multi">
            <label style="vertical-align: top;" for="types">Категория</label>
            <select style="height: 325px" name="types[]" id="types" multiple>
                <?php foreach (require ('category.php')as $val => $cat): ?>
                    <option value="<?= $val ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="popular">
            <label for="popular">По популярности</label>
            <select name="popuplar[]" id="popular" multiple>
                <?php foreach ( require ('popular.php') as $val => $item): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="ingridients">
            <label for="ingridients">По ингридиентам</label>
            <select name="ingridients[]" id="ingridients" multiple style="height: 224px;">
                <?php foreach(require ('ingridients.php')  as $val => $item): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="reason">
            <label for="reason">По поводу</label>
            <select name="reason[]" id="reason" multiple style="height: 124px;">
                <?php foreach(require 'reason.php' as $val => $item): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="price">
            <label for="price">По цене</label>
            <select name="price[]" id="price" multiple>
                <?php foreach(require 'price.php' as $val => $item): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="holidays">
            <label for="holidays">В праздгики</label>
            <select name="holidays[]" id="holidays" multiple style="height: 224px;">
                <?php foreach(require 'holidays.php' as $val => $item): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="drinks">
            <label for="drinks">Напитки</label>
            <select name="drinks[]" id="drinks" multiple>
                <?php foreach(require 'drinks.php' as $val => $item ): ?>
                    <option value="<?php echo $val; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <label for="items-count">Количество порций</label>
    <input type="text" name="items-count" id="items-count" value="6">

    <label for="hours">Время приготовления</label>
    <input type="text" name="hours" id="hours" placeholder="Часов">
    <input type="text" name="minutes" id="minutes" placeholder="Минут">

    <label for="time-link">Ссылка на категорию времени</label>
    <select name="time-link" id="time-link">
        <?php foreach (require 'times.php' as $link => $name): ?>
            <option value="<?= $link ?>"><?= $name ?></option>
        <?php endforeach; ?>
    </select>

    <h3>Ингридиенты</h3>
    <textarea  name="" id="ing-before-parse" cols="50" rows="10">–</textarea>
    <button id="parsre-ing">Автозаполнение ингридиентов</button><br>
    <div class="ingridients" style="border: 2px solid red;">
        <div class="ing-item" data-ing="1">
            <input class="name" type="text" name="ing-name[1]" placeholder="Ингридиент">
            <input class="count" type="text" name="ing-count[1]" placeholder="Количество">
            <input class="type" type="text" name="ing-type[1]" placeholder="Тип" class="ing-type">
        </div>
    </div>
    <br>
    <a href="#" id="ing-add">Добавить ингридиент</a>
    <a href="#" id="ing-del">Удалить ингридиент</a>
    <br><br>
    <button id="autocomplete-step">Автозаполнение шагов</button>
    <input type="text" name="source" id="source" placeholder="url источника">
    <br>
    <div class="steps">
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <div data-step="<?= $i; ?>" id="fields-step<?= $i ?>">
            <label for="step[<?= $i; ?>]">Шаг <?= $i; ?></label>
            <!--
            <input type="text" name="step[<?= $i; ?>]" id="step[<?= $i; ?>]" placeholder="Название шага">
            -->
            <textarea name="step[<?= $i; ?>]" id="step[<?= $i; ?>]" placeholder="Название шага"></textarea>
            <input type="text" name="title[<?= $i ?>]" placeholder="Атрибуты alt и title">
            <br><br>
        </div>
    <?php endfor; ?>
    </div>
    <a href="#" id="add-step">Добавить шаг</a>
    <a href="#" id="del-step">Удалить шаг</a>
    <br><br>
    <input type="submit" value="Генериовать файл">
</form>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
</body>
</html>
