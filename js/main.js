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
});