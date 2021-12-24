$(document).ready(function () {
    //Выпадающий список
    $('.item__open').click(function () {
        $(this).parent().parent().find('.item__dropdown').toggleClass('dropdown__show');
    });

    //Обработчик по нажатию на родительский элемент
    $('.parent-check').change(function () {
        //отмечаем все пункты, если родительский заполнен, и наоборот
        if ($(this).prop('checked') == true) {
            $(this).parent().parent().parent().find('.item__dropdown').find('.dropdown__checklist').find('.checklist__item').find('input').attr('checked', 'checked');
        }
        else {
            $(this).parent().parent().parent().find('.item__dropdown').find('.dropdown__checklist').find('.checklist__item').find('input').removeAttr('checked');
        }
        var dataCheck = $(this).serializeArray();
        var user_id = $('.checklist').attr('data-user-id');
        var ajaxResult = {};
        var item_id = $(this).closest('.list__item').attr('data-item-id');
        ajaxResult.user_id = user_id;
        ajaxResult.item_id = item_id;
        ajaxResult.item_child_ar = [];
        var itemsLength = $(this).parent().parent().parent().find('.item__dropdown').find('.dropdown__checklist').find('.checklist__item');
        //Если родительский заполнен, то дочерние элементы тоже заполнены, и будут отправлены в бд
        if ($(this).prop('checked') == true) {
            ajaxResult.item_name = dataCheck;
            for (var i = 1; i <= itemsLength.length; i++) {
                //ajaxResult['item_child'+i] = $('[name="child-check' + i + '"]').serializeArray();
                ajaxResult.item_child_ar.push($('[name="child-check' + i + '"]').serializeArray());
            }
        }
        else {
            ajaxResult.item_name = 'no';
            for (var i = 1; i <= itemsLength.length; i++) {
                ajaxResult.item_child_ar.push('no');
            }
        }
        //отправляем ajax
        console.log(ajaxResult);
        $.ajax({
            type: "POST",
            url: '/saveAjax.php',
            data: ajaxResult,
            // success: function(data) {
            //     alert(data);
            // }
        });
    });
    //Обработчик по нажатию на дочерний элемент
    $('.child-check').change(function () {
        var dataCheck = $(this).serializeArray();
        var user_id = $('.checklist').attr('data-user-id');
        var ajaxResult = {};
        var item_id = $(this).closest('.list__item').attr('data-item-id');
        if ($(this).prop('checked') == true) {
            ajaxResult.item_child = dataCheck;
        }
        else {
            let child_id = $(this).attr('name');
            child_id = child_id[child_id.length - 1];
            ajaxResult.item_child = 'no';
            ajaxResult.item_child_id = child_id;
            ajaxResult.item_name_change = 'no';

            if ($(this).parents().closest('.list__item').find('.parent-check').attr('checked') == 'checked') {
                $(this).parents().closest('.list__item').find('.parent-check').removeAttr("checked");
            }
        }
        ajaxResult.user_id = user_id;
        ajaxResult.item_id = item_id;
        console.log(dataCheck);
        $.ajax({
            type: "POST",
            url: '/saveAjax.php',
            dataType: 'html',
            data: ajaxResult,
            // success: function(data) {
            //     alert(data);
            // }
        });
    });
});