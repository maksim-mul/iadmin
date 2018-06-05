<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

<a class="uk-button uk-button-default uk-margin-bottom" href="#add-str" uk-toggle><span uk-icon="icon: plus-circle"></span> Добавить склад</a>

<div uk-grid uk-height-match="target: > div > div">
  <div class="uk-width-1-3">
    <div style="position: relative;">
      <ul class="uk-list uk-list-striped uk-panel-scrollable"  id="storage-list" style="border: 1px solid #e2e2e2; padding: 0px; position: absolute; height: 100%; width: 100%">
        <? foreach ($storage as &$value) { ?>
          <li storage-id="<?=$value['id']?>" storage-name="<?=$value['name']?>" latitude="<?=$value['latitude']?>" longitude="<?=$value['longitude']?>" storage-latlong="<?=$value['latitude']?>, <?=$value['longitude']?>" storage-address="<?=$value['address']?>" storage-desc="<?=$value['description']?>" storage-op="<?=$value['time_opening']?>" storage-clos="<?=$value['time_closing']?>" class="storage-row"><?=$value['name']?>
            <div class="uk-float-right">
              <a href="#edit-str" uk-toggle class="btn-edit" uk-icon="icon: file-edit"></a>
              <a href="#delit-str" uk-toggle class="btn-delit" uk-icon="icon: trash"></a>
              <a class="storage_location" latitude="<?=$value['latitude']?>" longitude="<?=$value['longitude']?>" style="color: #2f008a;"><span uk-icon="icon: location; ratio: 1"></span></a>
            </div>
          </li>
        <? } ?>
      </ul>
    </div>
  </div>
  <div class="uk-width-2-3">
    <div>
      <div id="map" style="width: 100%; height:600px;"></div>
    </div>
  </div>
</div>


<!--Добавление нового склада-------------------------------------------------------------------------------------------------->
<div id="add-str" class="uk-flex-top" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="h1-blc">
      <h3 style="margin-bottom: 10px;">Добавить новый склад</h3>
    </div>
    <div id="map_3" style="width: 100%; height: 400px;"></div>
    <form class="uk-form-stacked">
        <div class="uk-margin-small">
            <label class="uk-form-label">Название склада/фирмы</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-storage-name" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Адрес точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-storage-adress" type="text">
            </div>
        </div>
        <div class="uk-margin-small" style="display: none;">
            <label class="uk-form-label">Координаты точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-storage-latlong" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Время работы</label>
            <div class="uk-form-controls">
                Открывается в <input class="uk-input uk-width-auto" type="time" id="f-storage-time-start"> и работает до <input class="uk-input uk-width-auto" type="time" id="f-storage-time-stop">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Описание/Подробности</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" rows="2" maxlength="300" id="f-storage-desc"></textarea>
            </div>
        </div>
    </form>
    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" id="f-storage-add">Добавить склад</button>
  </div>
</div>

<!--Удаление склада----------------------------------------------------------------------------------------------------------->
<div id="delit-str" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-body">
            <h3>Вы уверены что хотите удалить этот склад?</h3>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
            <button class="uk-button uk-button-danger uk-modal-close" type="button" name="sample1" id="del_btn">Удалить</button>
        </div>
    </div>
</div>

<!--Редактирование склада----------------------------------------------------------------------------------------------------------->
<div id="edit-str" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="h1-blc">
      <h3 style="margin-bottom: 10px;">Редактиование склада</h3>
    </div>
    <div id="map_2" style="width: 100%; height: 400px;"></div>
    <form class="uk-form-stacked">
        <div class="uk-margin-small">
            <label class="uk-form-label">Название склада/фирмы</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-edit-storage-name" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Адрес точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-edit-storage-address" type="text">
            </div>
        </div>

        <div class="uk-margin-small" style="display: none;">
            <label class="uk-form-label">Координаты точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-edit-storage-latlong" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Время работы</label>
            <div class="uk-form-controls">
                Открывается в <input class="uk-input uk-width-auto" type="time" id="f-edit-storage-time-start"> и работает до <input class="uk-input uk-width-auto" type="time" id="f-edit-storage-time-stop">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Описание/Подробности</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" rows="2" maxlength="300" id="f-edit-storage-desc"></textarea>
            </div>
        </div>
    </form>
    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" id="edit_btn">Редактировать склад</button>
  </div>
</div>
