/*Удаление пунктов доставки*/
$('body').on('click', '.card-stock-delit', function(e) {
  id_exp = $(this).attr("id-exp");
  $.ajax({
    type: "POST",
    url: "/delivery/expedition/controllers/day_delit.php",
    data: {
      id_exp: id_exp
      },
      success: sucEdit
  });
  $(this).closest('.card-stock').remove();
});

$('body').on('click', '.list-add-stock', function(e) {
    storage_id = $(this).attr("id_storage");
    name = $(this).attr("name");
    longitude = $(this).attr("longitude");
    latitude = $(this).attr("latitude");
    time_open = $(this).attr("time_open");
    time_close = $(this).attr("time_close");
    $content="<div class='uk-card uk-card-default card-stock' storage-id='"+storage_id+"'><div class='card-stock-title'><a style='color: #df405a;' href='https://yandex.ru/maps/213/moscow/?mode=search&text="+latitude+"%2C"+longitude+"&sll=37.489376%2C54.902805' target='_blank'><span uk-icon='icon: location; ratio: 1.3'></span></a><span> "+name+"</span><div class='uk-float-right'><span uk-icon='icon: clock;'></span> "+time_open+" - "+time_close+"</div></div><div><label>Комментарий:</label><textarea class='uk-textarea uk-margin-remove' rows='4'></textarea><div class='uk-margin-small-top'><div uk-grid class='uk-grid-small'><div class='uk-width-1-3'><select class='uk-select' id='pay_type'><option value='0'>Наличные</option><option value='1'>Безнал</option></select></div><div class='uk-width-1-3'><input class='uk-input' type='text' placeholder='' value='0'></div><div class='uk-width-1-3 uk-text-right'><a class='card-stock-delit'>Удалить</a></div></div></div></div></div>";
    $("#content").append($content);
});



$(document).ready(function(){

  // текущая дата
  var date = new Date();
  day = date.getFullYear()+":"+(date.getMonth()+1)+":"+date.getDate();

  //Доставка в текущий день
  $.ajax({
    type: "POST",
    url: "/delivery/expedition/controllers/day_info.php",
    data: {
      day: day
      },
      success: sucPull
  });

  $('#btn-save').click(function(e) {
    //Отправка в БД
    var i=0;

    $('#content>div').each(function(){
      i++;
      id = $(this).attr('id_exp');
      id_warehouses = $(this).attr('storage-id');
      comment = $(this).find("textarea").val();
      sum = $(this).find("input").val();
      oplata = $(this).find("select").val();

      $.ajax({
        type: "POST",
        url: "/delivery/expedition/controllers/day_edit.php",
        data: {
          id: id,
          id_warehouses: id_warehouses,
          day: day,
          comment: comment,
          oplata: oplata,
          sum: sum,
          priority: i
        },
        success: sucEdit
      });
    });
    //ymaps.ready(init);
  });

  $('.tab-calendar td').click(function(e) {
      //Получение информации из БД
      day = $(this).attr("day");
      $('.tab-calendar .active').removeClass('active');
      $(this).addClass('active');

      $.ajax({
        type: "POST",
        url: "/delivery/expedition/controllers/day_info.php",
        data: {
          day: day
          },
          success: sucPull
      });
  });
});

function sucPull(data){
  if(data){
    $("#content").html(data);
    $("#map").empty();
    init();
  }
  else{
    alert("Произошла ошибка");
  }
};

function sucEdit(data){
  if(data){
    //alert("Маршрут обновлен.");
  }
  else{
    alert("Произошла ошибка");
  }
};
