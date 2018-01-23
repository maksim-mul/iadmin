//Отрисовка объектов на яндек карте==================================================================
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
        url: "controllers/map_points.php"
    }).done(function(data) {
        objectManager.add(data);
    });
}

//Добавление нового склада============================================================================
$('#f-storage-add').click( function() {
	storage_name = $("#f-storage-name").val();
  storage_adress = $("#f-storage-adress").val();
  storage_lat = $("#f-storage-lat").val();
  storage_long = $("#f-storage-long").val();
  storage_desc = $("#f-storage-desc").val();

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
		success: funcPerformed
	});
});

//Редактирование склада ==============================================================================
var id_storage = '';
$('ul').on('click', '.btn-edit', function () {
	id_storage = $($(this)).parents(".storage-row").attr("storage-id");

  storage_name = $($(this)).parents(".storage-row").attr("storage-name");
  $("#f-edit-storage-name").val(storage_name);

  storage_latitude = $($(this)).parents(".storage-row").attr("storage-latitude");
  $("#f-edit-storage-lat").val(storage_latitude);

  storage_longtitude= $($(this)).parents(".storage-row").attr("storage-longitude");
  $("#f-edit-storage-long").val(storage_longtitude);

  storage_address = $($(this)).parents(".storage-row").attr("storage-address");
  $("#f-edit-storage-address").val(storage_address);

  storage_desc = $($(this)).parents(".storage-row").attr("storage-desc");
  $("#f-edit-storage-desc").val(storage_desc);

});

$('#edit_btn').click(function() {
  storage_name = $("#f-edit-storage-name").val();
  storage_adress = $("#f-edit-storage-adress").val();
  storage_lat = $("#f-edit-storage-lat").val();
  storage_long = $("#f-edit-storage-long").val();
  storage_desc = $("#f-edit-storage-desc").val();
  $.ajax({
		type: "POST",
		url: "/delivery/storage/controllers/edit_storage.php",
		data: {
			id: id_storage,
      name: storage_name,
      address: storage_adress,
      latitude: storage_lat,
      longitude: storage_long,
      description: storage_desc
		},
		success: funcPerformed
	});
});



//Итог выполнения=======================================================================================
function funcPerformed(data){
  if(data){
    alert(data);
    location.reload();
  }
  else{
    alert("Произошла ошибка");
  }
};
