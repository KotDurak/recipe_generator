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

<h3>Генерация файла</h3>
<form action="generate.php" method="post">
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
    <div class="cousines" style="margin-bottom: 5px">
        <label class="hide" style="vertical-align: top;">Кухни мира</label>
        <select name="cousines[]" id="cous"  style="height: 400px;" multiple>
            <?php foreach ($types as $idx => $cousine):  ?>
                <option value="<?= $idx?>"><?= $cousine['title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="types-multi">
        <label style="vertical-align: top;" for="types">Типы</label>
        <select style="height: 325px" name="types[]" id="types" multiple>
            <?php foreach (require ('category.php')as $val => $cat): ?>
                <option value="<?= $val ?>"><?= $cat['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <label for="hours">Время приготовления</label>
    <input type="text" name="hours" id="hours" placeholder="Часов">
    <input type="text" name="minutes" id="minutes" placeholder="Минут">
    <h3>Ингридиенты</h3>
    <textarea name="" id="" cols="50" rows="10"></textarea>
    <div class="ingridients" style="border: 2px solid red; width: 540px">
        <div class="ing-item" data-ing="1">
            <input type="text" name="ing-name[1]" placeholder="Ингридиент">
            <input type="text" name="ing-count[1]" placeholder="Количество">
            <input type="text" name="ing-type[1]" placeholder="Тип" class="ing-type">
        </div>

    </div>
    <a href="#" id="ing-add">Добавить ингридиент</a>
    <a href="#" id="ing-del">Удалить ингридиент</a>
    <div class="steps">
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <div data-step="<?= $i; ?>" id="fields-step<?= $i ?>">
            <label for="step[<?= $i; ?>]">Шаг <?= $i; ?></label>
            <input type="text" name="step[<?= $i; ?>]" id="step[<?= $i; ?>]" placeholder="Название шаша">
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
