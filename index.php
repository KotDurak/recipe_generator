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
    <br><br>
    <label for="title">Title и description</label>
    <input type="text" name="headers" id="headers">
    <br><br>
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
