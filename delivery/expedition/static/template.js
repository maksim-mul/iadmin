/*Удаление пунктов доставки*/
$('body').on('click', '.card-stock-delit', function(e) {
    $(this).closest('.card-stock').remove();
});

$('body').on('click', '.list-add-stock', function(e) {
    $ttt="<div class='uk-margin-small'><div class='uk-card uk-card-default card-stock'><div class='card-stock-title'><a style='color: #df405a;' href='https://yandex.ru/maps' target='_blank'><span uk-icon='icon: location; ratio: 1.3'></span></a> Бау Подольск<div class='uk-float-right'><span uk-icon='icon: menu; ratio: 1.3'></span></div></div><div><label>Комментарий:</label><textarea class='uk-textarea uk-margin-remove' rows='3'></textarea><div class='uk-margin-small-top'><div uk-grid class='uk-grid-small'><div class='uk-width-1-3'><select class='uk-select' id='form-stacked-select'><option>Безнал</option><option>Наличные</option></select></div><div class='uk-width-1-3'><input class='uk-input' id='form-stacked-text' type='text' placeholder='Сумма'></div><div class='uk-width-1-3 uk-text-right'><a class=\card-stock-delit\>Удалить</a></div></div></div></div></div></div>";
    $("#test").append($ttt);

});
