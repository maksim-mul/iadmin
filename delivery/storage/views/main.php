<script src="http://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
<script>
ymaps.ready(init);
function init () {
    var myMap = new ymaps.Map('map', {
            center: [55.76, 37.64],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            // Чтобы метки начали кластеризоваться, выставляем опцию.
            clusterize: true,
            // ObjectManager принимает те же опции, что и кластеризатор.
            gridSize: 32,
            clusterDisableClickZoom: true
        });

    // Чтобы задать опции одиночным объектам и кластерам,
    // обратимся к дочерним коллекциям ObjectManager.
    objectManager.objects.options.set('preset', 'islands#blueCircleIcon');
    objectManager.clusters.options.set('preset', 'islands#invertedBlueClusterIcons');
    myMap.geoObjects.add(objectManager);

    $.ajax({
        url: "data.json"
    }).done(function(data) {
        objectManager.add(data);
    });
}
</script>
<div id="map" style="width: 100%; height: 550px;"></div>

<!--Добавление нового склада-------------------------------------------------------------------------------------------------->
<a class="uk-button uk-button-default uk-margin-top" href="#add-str" uk-toggle><span uk-icon="icon: plus-circle"></span> Добавить склад</a>
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
                <textarea class="uk-textarea uk-form-large" rows="2" maxlength="300" id="f-storage-desc"></textarea>
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


<div class="uk-margin-top" uk-grid>
  <div class="uk-width-1-2">
    <ul class="uk-list uk-list-striped" id="storage-list">
      <? foreach ($storage as &$value) { ?>
        <li storage-id="<?=$value['id']?>" class="storage-row"><?=$value['name']?>
          <div class="uk-float-right">
            <a class="uk-text-warning btn-edit" uk-icon="icon: file-edit"></a>
            <a href="#delit-str" uk-toggle class="uk-text-danger btn-delit" uk-icon="icon: trash"></a>
            <a class="" style="color: #2f008a;" href="https://yandex.ru/maps/213/moscow/?mode=search&text=<?=$value['latitude']?>%2C<?=$value['longitude']?>&sll=37.489376%2C54.902805" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
          </div>
        </li>
      <? } ?>
    </ul>
  </div>
</div>

<script>

//Добавление нового склада============================================================================
$('#f-storage-add').click( function() {
	var storage_name = $("#f-storage-name").val();
  var storage_adress = $("#f-storage-adress").val();
  var storage_lat = $("#f-storage-lat").val();
  var storage_long = $("#f-storage-long").val();
  var storage_desc = $("#f-storage-desc").val();

  if( storage_name !=='' && storage_adress !== '' && storage_lat !== '' && storage_long !== '' ){
    $.ajax({
      type: "POST",
      url: "/delivery/storage/controllers/add_storage.php",
      data: {
      	storage_name: storage_name,
        storage_adress: storage_adress,
        storage_lat: storage_lat,
        storage_long: storage_long,
        storage_desc: storage_desc
        },
        success: funcPerformed
      });
    }
    else{
      UIkit.notification({
        message: 'Некоторые поля не заполнены!',
        status: 'danger',
        pos: 'top-center',
        timeout: 5000
    	});
    }
  });

  function funcPerformed(data){
  	if(data){
  		alert("Склад успешно добавлен в список");
      location.reload();
  	}
  	else{
  		UIkit.notification({
  	    message: 'Ошибка при добавлении!',
  	    status: 'danger',
  	    pos: 'top-center',
  	    timeout: 5000
  		});
  	}
  };

//Удаление нового склада============================================================================
//удаление динамических элементов
var id_storage = '';
$('ul').on('click', '.btn-delit', function () {
	id_storage = $($(this)).parents(".storage-row").attr("storage-id");
});

$('#del_btn').click(function() {
  $.ajax({
		type: "POST",
		url: "/delivery/storage/controllers/delit_storage.php",
		data: {
			id: id_storage
		},
		success: funcDelPerformed
	});
});


function funcDelPerformed
(data){
  if(data){
    alert("Склад успешно удален из списока");
    location.reload();
  }
  else{
    UIkit.notification({
      message: 'Ошибка при удалении!',
      status: 'danger',
      pos: 'top-center',
      timeout: 5000
    });
  }
};
</script>
