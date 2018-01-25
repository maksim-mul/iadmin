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
    objectManager.objects.options.set('preset', 'islands#redCircleDotIcon');
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
  storage_latlong = $("#f-storage-latlong").val();
  storage_desc = $("#f-storage-desc").val();
  storage_time_start = $("#f-storage-time-start").val();
  storage_time_stop = $("#f-storage-time-stop").val();

  if( storage_name !=='' && storage_adress !== '' && storage_latlong !== ''){
    $.ajax({
      type: "POST",
      url: "/delivery/storage/controllers/add_storage.php",
      data: {
      	storage_name: storage_name,
        storage_adress: storage_adress,
        storage_latlong: storage_latlong,
        storage_desc: storage_desc,
        storage_time_start: storage_time_start,
        storage_time_stop: storage_time_stop
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

  storage_latlong = $($(this)).parents(".storage-row").attr("storage-latlong");
  $("#f-edit-storage-latlong").val(storage_latlong);

  storage_address = $($(this)).parents(".storage-row").attr("storage-address");
  $("#f-edit-storage-address").val(storage_address);

  storage_desc = $($(this)).parents(".storage-row").attr("storage-desc");
  $("#f-edit-storage-desc").val(storage_desc);

  storage_time_start = $($(this)).parents(".storage-row").attr("storage-op");
  $("#f-edit-storage-time-start").val(storage_time_start);

  storage_time_stop = $($(this)).parents(".storage-row").attr("storage-clos");
  $("#f-edit-storage-time-stop").val(storage_time_stop);

});

$('#edit_btn').click(function() {
  storage_name = $("#f-edit-storage-name").val();
  storage_adress = $("#f-edit-storage-address").val();
  storage_latlong = $("#f-edit-storage-latlong").val();
  storage_desc = $("#f-edit-storage-desc").val();
  storage_time_start = $("#f-edit-storage-time-start").val();
  storage_time_stop = $("#f-edit-storage-time-stop").val();

  $.ajax({
		type: "POST",
		url: "/delivery/storage/controllers/edit_storage.php",
		data: {
			id: id_storage,
      name: storage_name,
      address: storage_adress,
      latlong: storage_latlong,
      description: storage_desc,
      storage_time_start: storage_time_start,
      storage_time_stop: storage_time_stop
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
