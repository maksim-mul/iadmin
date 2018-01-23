<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

<a class="uk-button uk-button-default uk-margin-bottom" href="#add-str" uk-toggle><span uk-icon="icon: plus-circle"></span> Добавить склад</a>

<div uk-grid class="uk-grid-small">
  <div class="uk-width-2-5">
    <ul class="uk-list uk-list-striped" id="storage-list" style="border: 1px solid #ababab;">
      <? foreach ($storage as &$value) { ?>
        <li storage-id="<?=$value['id']?>" storage-name="<?=$value['name']?>" storage-latitude="<?=$value['latitude']?>" storage-longitude="<?=$value['longitude']?>" storage-address="<?=$value['address']?>" storage-desc="<?=$value['description']?>" class="storage-row"><?=$value['name']?>
          <div class="uk-float-right">
            <a href="#edit-str" uk-toggle class="btn-edit" uk-icon="icon: file-edit"></a>
            <a href="#delit-str" uk-toggle class="btn-delit" uk-icon="icon: trash"></a>
            <a class="" style="color: #2f008a;" href="https://yandex.ru/maps/213/moscow/?mode=search&text=<?=$value['latitude']?>%2C<?=$value['longitude']?>&sll=37.489376%2C54.902805" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
          </div>
        </li>
      <? } ?>
    </ul>
  </div>
  <div class="uk-width-3-5">
    <div id="map" style="width: 100%; height: 550px;"></div>
  </div>
</div>


<!--Добавление нового склада-------------------------------------------------------------------------------------------------->
<div id="add-str" class="uk-flex-top" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="h1-blc">
      <h3 style="margin-bottom: 10px;">Добавить новый склад</h3>
    </div>
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
        <div class="uk-margin-small">
            <label class="uk-form-label">Широта точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-storage-lat" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Долгота точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-storage-long" type="text">
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
        <div class="uk-margin-small">
            <label class="uk-form-label">Широта точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-edit-storage-lat" type="text">
            </div>
        </div>
        <div class="uk-margin-small">
            <label class="uk-form-label">Долгота точки</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="f-edit-storage-long" type="text">
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
