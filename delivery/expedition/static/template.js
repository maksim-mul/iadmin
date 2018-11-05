function init (){
    /**
     * Создаем мультимаршрут.
     * Первым аргументом передаем модель либо объект описания модели.
     * Вторым аргументом передаем опции отображения мультимаршрута.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
     */
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        // Описание опорных точек мультимаршрута.
        referencePoints: point,
        // Параметры маршрутизации.
        params: {
            // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
            results: 3,
        }
    }, {
        // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
        boundsAutoApply: true
    });

    // Создаем кнопки для управления мультимаршрутом.
    var trafficButton = new ymaps.control.Button({
      data: { content: "Учитывать пробки" },
      options: { selectOnClick: true }
    });

    // Объявляем обработчики для кнопок.
    trafficButton.events.add('select', function () {
        /**
         * Задаем параметры маршрутизации для модели мультимаршрута.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml#setParams
         */
        multiRoute.model.setParams({ avoidTrafficJams: true }, true);
    });

    trafficButton.events.add('deselect', function () {
        multiRoute.model.setParams({ avoidTrafficJams: false }, true);
    });

    multiRoute.model.events.once("requestsuccess", function () {
      point_name.forEach(function(item, i, arr) {
        var yandexWayPoint = multiRoute.getWayPoints().get(i);
        yandexWayPoint.options.set({
            preset: "islands#nightStretchyIcon",
            iconContentLayout: ymaps.templateLayoutFactory.createClass(
                i+" "+item
            ),
            balloonContentLayout: ymaps.templateLayoutFactory.createClass(
                '{{ properties.address|raw }}'
            )
        });
      });
    });

    // Создаем карту с добавленными на нее кнопками.
    var myMap = new ymaps.Map('map', {
        center: [55.750625, 37.626],
        zoom: 7,
        controls: [trafficButton]
    }, {
        buttonMaxWidth: 300
    });

    // Добавляем мультимаршрут на карту.
    myMap.geoObjects.add(multiRoute);
}

/*Удаление пунктов доставки*/
delit = [];
$('body').on('click', '.card-stock-delit', function(e) {
  id_exp = $(this).attr("id-exp");
  delit.push(id_exp);
  $(this).closest('.card-stock').remove();
});


$('body').on('click', '.list-add-stock', function(e) {
    storage_id = $(this).attr("id_storage");
    name = $(this).attr("name");
    longitude = $(this).attr("longitude");
    latitude = $(this).attr("latitude");
    time_open = $(this).attr("time_open");
    time_close = $(this).attr("time_close");
    $content="<div class='uk-card uk-card-default card-stock' storage-id='"+storage_id+"'><div class='card-stock-title'><a style='color: #df405a;' href='/delivery/storage/?lat="+latitude+"&long="+longitude+"' target='_blank'><span uk-icon='icon: location; ratio: 1.3'></span></a><span> "+name+"</span><div class='uk-float-right'><span uk-icon='icon: clock;'></span> "+time_open+" - "+time_close+"</div></div><div><label>Комментарий:</label><textarea class='uk-textarea uk-margin-remove' rows='4'></textarea><div class='uk-margin-small-top'><div uk-grid class='uk-grid-small'><div class='uk-width-1-3'><select class='uk-select' id='pay_type'><option value='0'>Наличные</option><option value='1'>Безнал</option></select></div><div class='uk-width-1-3'><input class='uk-input' type='text' placeholder='' value='0'></div><div class='uk-width-1-3 uk-text-right'><a class='card-stock-delit'>Удалить</a></div></div></div></div></div>";
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

    //удоляем экспедиции
    $.ajax({
      type: "POST",
      url: "/delivery/expedition/controllers/day_delit.php",
      data: {
        delit: delit
        },
        success: sucEdit
    });

    location.reload();
  });

  $('.tab-calendar td').click(function(e) {
      //обнуляем массив удоляемых точек
      delit = [];

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
  var start = [54.919500, 37.432390];
  point = [];
  point_name = [];
  point_name.push("База")
  point.push(start);

  if(data){
    $("#content").html(data);

    $('#content>.card-stock').each(function(){
      latitude = $(this).attr('storage-latitude');
      longitude = $(this).attr('storage-longitude');
      name = $(this).attr('storage-name');
      loc = [latitude, longitude];
      point.push(loc);
      point_name.push(name);
    });

    point.push(start);
    point_name.push("База")
    $("#map").empty();
    ymaps.ready(init);
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



//Поиск склада=====================
$('#stor_name').on('input keyup', function(e) {
  var stor_name = $('#stor_name').val();
  $("#storage-list").html('<div class="uk-text-center uk-margin-top"><div uk-spinner="ratio: 2"></div></div>');

	$.ajax({
		type: "POST",
		url: "/delivery/expedition/controllers/ajax/search_stor.php",
		data: {
			stor_name: stor_name,
		},
		success: sucStor
	});

  function sucStor(data){
    //alert(data);
    $("#storage-list").html(data);
  }

});
