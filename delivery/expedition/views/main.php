<div uk-grid>
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
  <div class="uk-width-2-3">
    <div id="map" style="width: 100%; height: 400px;"></div>
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
      <div class="uk-button uk-button-primary uk-button-large uk-margin-bottom" id="btn-save">Сохранить изменения <span uk-icon="server"></span></div>
      <div uk-sortable="group: sortable-group" id="content">
          <div class="uk-margin-small">
          </div>
      </div>
  </div>
</div>


<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
