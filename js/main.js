$(function () {
    $('body').on('click', '#add-step' ,function (e) {
        e.preventDefault();
        var D_step = $('.steps').children(':last');
        var step_number = D_step.data('step');
        step_number++;
        /*
        var html = ' <div data-step="'+step_number+'" id="fields-step'+step_number+'">\n' +
            '            <label for="step['+step_number+']">Шаг '+step_number+'</label>\n' +
            '            <input type="text" name="step['+step_number+']" id="step['+step_number+']" placeholder="Название шаша">\n' +
            '<input type="text" name="title['+step_number+']" placeholder="Атрибуты alt и title"><br><br>\n' +
            '        </div>';
        */
        var html = ' <div data-step="'+step_number+'" id="fields-step'+step_number+'">\n' +
            '            <label for="step['+step_number+']">Шаг '+step_number+'</label>\n' +
            '            <textarea  name="step['+step_number+']" id="step['+step_number+']" placeholder="Название шаша"></textarea>\n' +
            '<input type="text" name="title['+step_number+']" placeholder="Атрибуты alt и title"><br><br>\n' +
            '        </div>';
        var new_elem = $(html);
        $('.steps').append(new_elem);

    });

    $('body').on('click', '#del-step', function (e) {
        e.preventDefault();
        $('.steps').children(':last').remove();
    })

    $('body').on('click', '#ing-add', function (e) {
        e.preventDefault();
        var D_ing = $('.ingridients').children(':last');
        var ing_number = D_ing.data('ing');
        ing_number++;
        var html = '<div class="ing-item" data-ing="'+ing_number+'">' +
            '            <input class="name" type="text" name="ing-name[' +ing_number+']" placeholder="Ингридиент">' +
            '            <input class="count" type="text" name="ing-count[' +ing_number+']" placeholder="Количество">' +
            '            <input class="type" type="text" name="ing-type[' +ing_number+']" placeholder="Тип">' +
            '        </div>';
        var new_elem = $(html);
        $('.ingridients').append(new_elem);
    });

    $('#ing-del').on('click', function (e) {
        e.preventDefault();
        $('.ingridients').children(':last').remove();
    });

    $('body').on('keypress', '.ing-type', function(e){
       console.log(e);
    });


    $('#parsre-ing').on('click', function (e) {
        e.preventDefault();
        var text = $('#ing-before-parse').val();
        var lines = text.split("\n");
        for (var i = 0; i < lines.length; i++) {
            var line = lines[i];
            var name_reg = new RegExp("^(.*?)\\s[^\\s\\d\\w]\\s", 'i');
            var name = line.match(name_reg)[1];
            var count_reg = new RegExp(/([—–]).*?\s([\d]+|([\d]+.*?[\d]{1}))\s/i);
            var count = line.match(count_reg);
            if (!count) {
                count_reg = new RegExp(/([—–])\s(.*)/i);
                count = line.match(count_reg);
            }
            if(!isNaN(count[2]) || count[2].match(/[\d]/)){
                var type_reg = new RegExp(/\d\s(.*)/i);
                var type = line.match(type_reg)[1];

            } else{
                var type = '';
            }

            var D_fields = $('.ing-item:last');
            D_fields.find('.name').val(name);
            D_fields.find('.count').val(count[2]);
            D_fields.find('.type').val(type);
            $('#ing-add').trigger('click');
        }
        $('#ing-del').trigger('click');
    });
});