<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

<div id="map" style="width: 100%; height:600px;"></div>


<script>
function init () {
    /**
     * Создаем мультимаршрут.
     * Первым аргументом передаем модель либо объект описания модели.
     * Вторым аргументом передаем опции отображения мультимаршрута.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
     */
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        // Описание опорных точек мультимаршрута.
        referencePoints: [
            [54.923245, 37.413406],
            [55.805851, 37.511865],
            [55.819193, 37.834203],
            [54.923245, 37.413406],
        ],
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
ymaps.ready(init);
</script>




























<a id="import-dveri" class="uk-button uk-button-default">Испорт дверей</a>

<div class="loader">
   <center>
       <div uk-spinner></div>
   </center>
</div>

<style>
.loading-image {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 10;
}
.loader{
    display: none;
    width:200px;
    height: 200px;
    position: fixed;
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
    overflow: auto;
}
</style>

<script>
$('body').on('click', '#import-dveri', function(e) {
  id = "Успех";
  $.ajax({
    type: "POST",
    url: "http://plitkanadom.com/import/import_other.php",
    data: {
      id: id
    },
    success: sucEdit,
    beforeSend: function(){
         $('.loader').show()
     },
    complete: function(){
         $('.loader').hide();
    }
  });
});

function sucEdit(data){
  if(data){
    alert(data);
  }
  else{
    alert("Произошла ошибка");
  }
};
</script>
