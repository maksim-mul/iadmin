<div uk-grid class="uk-grid-small">
  <div class="uk-width-1-3">
    <div>
      <h3 class="uk-margin-remove">
        <a href="?ym=<?php echo $prev; ?>"><span uk-icon="icon: chevron-left"></span></a>
          <?php echo $html_title; ?>
        <a href="?ym=<?php echo $next; ?>"><span uk-icon="icon: chevron-right"></span></a>
      </h3>
      <table class="uk-table tab-calendar">
          <tr>
              <th>Пн</th>
              <th>Вт</th>
              <th>Ср</th>
              <th>Чт</th>
              <th>Пт</th>
              <th>Сб</th>
              <th>Вс</th>
          </tr>
          <?php
            foreach ($weeks as $week) {
                echo $week;
            }
          ?>
      </table>
    </div>
  </div>
  <div class="uk-width-1-2">
    <div id="map" style="width: 100%; height: 380px;"></div>
  </div>
</div>

<div class="uk-grid" class="uk-grid-small">
  <div class="uk-width-1-3">
      <h3>Список складов</h3>
      <ul class="uk-list uk-list-striped  uk-panel-scrollable uk-resize-vertical" id="storage-list" style="height: 700px; border: 1px solid #e2e2e2; padding: 0px;">
        <? foreach ($storage as &$value) { ?>
          <li>
              <?=$value['name']?>
              <div class="uk-float-right">
                <a id_storage="<?=$value['id']?>" time_open="<?=date("H:i", strtotime($value['time_opening']))?>" time_close="<?=date("H:i", strtotime($value['time_closing']))?>" latitude="<?=$value['latitude']?>" longitude="<?=$value['longitude']?>" name="<?=$value['name']?>" class="btn-delit list-add-stock">Добавить</a>
                <a class="" style="color: #2f008a;" href="/delivery/storage/?lat=<?=$value['latitude']?>&long=<?=$value['longitude']?>" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
              </div>
          </li>
        <? } ?>
      </ul>
  </div>

  <div class="uk-width-1-2">
      <h3>Список точек</h3>

      <div class="uk-button uk-button-default uk-button-large uk-width-1-1 uk-margin-bottom" id="btn-save">Сохранить</div>

      <div uk-sortable="group: sortable-group" id="content">
          <div class="uk-margin-small">

          </div>
      </div>
  </div>
</div>


<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

<script>
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
        referencePoints: [
          [54.919500, 37.432390],
          <?foreach ($expeditions as $key => $value) {?>
            [<?=$expeditions[$key]["latitude"]?>,<?=$expeditions[$key]["longitude"]?>],<?
          }?>
          [54.919500, 37.432390],
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

    multiRoute.model.events.once("requestsuccess", function () {

        <?foreach ($expeditions as $key => $value) {?>
          var yandexWayPoint = multiRoute.getWayPoints().get(<?=$key+1?>);
          yandexWayPoint.options.set({
              preset: "islands#nightStretchyIcon",
              iconContentLayout: ymaps.templateLayoutFactory.createClass(
                  <?=$key+1?>+" <?=$value['name']?>"
              ),
              balloonContentLayout: ymaps.templateLayoutFactory.createClass(
                  '{{ properties.address|raw }}'
              )
          });
        <?}?>
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
