$(function () {
    $('body').on('click', '#add-step' ,function (e) {
        e.preventDefault();
        var D_step = $('.steps').children(':last');
        var step_number = D_step.data('step');
        step_number++;
        var html = ' <div data-step="'+step_number+'" id="fields-step'+step_number+'">\n' +
            '            <label for="step['+step_number+']">Шаг '+step_number+'</label>\n' +
            '            <input type="text" name="step['+step_number+']" id="step['+step_number+']" placeholder="Название шаша">\n' +
            '<input type="text" name="title['+step_number+']" placeholder="Атрибуты alt и title"><br><br>\n' +
            '        </div>';
        var new_elem = $(html);
        $('.steps').append(new_elem);

    });

    $('body').on('click', '#del-step', function (e) {
        e.preventDefault();
        $('.steps').children(':last').remove();
    })

    $('#ing-add').on('click', function (e) {
        e.preventDefault();
        var D_ing = $('.ingridients').children(':last');
        var ing_number = D_ing.data('ing');
        ing_number++;
        var html = '<div class="ing-item" data-ing="1">' +
            '            <input type="text" name="ing-name[' +ing_number+']" placeholder="Ингридиент">' +
            '            <input type="text" name="ing-count[' +ing_number+']" placeholder="Количество">' +
            '            <input type="text" name="ing-type[' +ing_number+']" placeholder="Тип">' +
            '        </div>';
        var new_elem = $(html);
        $('.ingridients').append(new_elem);
    });

    $('#ing-del').on('click', function (e) {
        e.preventDefault();
        $('.ingridients').children(':last').remove();
    })
});