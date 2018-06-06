//Отрисовка объектов на яндек карте==================================================================
ymaps.ready(init);
function init () {
    //основная карта
    var myMap = new ymaps.Map('map', {
        center: [lat, long],
        zoom: zoom
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
    objectManager.clusters.options.set('preset', 'islands#invertedBlueClusterIcons');
    myMap.geoObjects.add(objectManager);

    $.ajax({
        url: "controllers/map_points.php"
    }).done(function(data) {
        objectManager.add(data);
    });

    //перемещение к точке================================
    $('.storage_location').click(function(e) {
        var latitude = $($(this)).attr("latitude");
        var longitude = $($(this)).attr("longitude");
        myMap.setCenter([latitude, longitude], 15);
    });



    //карта для редактирования===========================
    myMap_2 = new ymaps.Map('map_2', {
        center: [54.913468, 37.416843],
        zoom: 9
    }, {
        searchControlProvider: 'yandex#search'
    });
    myPlacemark2 = new ymaps.Placemark([54.913468, 37.416843], {}, {
        draggable: true,
        preset: 'islands#blueGovernmentIcon'
    });
    myMap_2.geoObjects.add(myPlacemark2);



    //карта для добавления==============================
    myMap_3 = new ymaps.Map('map_3', {
        center: [54.913468, 37.416843],
        zoom: 9
    }, {
        searchControlProvider: 'yandex#search'
    });
    myPlacemark3 = new ymaps.Placemark([54.913468, 37.416843], {}, {
        draggable: true,
        preset: 'islands#blueGovernmentIcon'
    });
    myMap_3.geoObjects.add(myPlacemark3);

    //смена координат при нажатии на карту
    myMap_3.events.add('click', function (e) {
      var coords = e.get('coords');
      myPlacemark3.geometry.setCoordinates(coords);
      $("#f-storage-latlong").val(coords);
    });

    //смена координаты при передвижении точки
    myPlacemark3.events.add("dragend", function (e) {
        coords = this.geometry.getCoordinates();
        $("#f-storage-latlong").val(coords);
    }, myPlacemark3);
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

//Удаление склада============================================================================
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

  //отмечаем на карте
  latitude = $($(this)).parents(".storage-row").attr("latitude");
  longitude = $($(this)).parents(".storage-row").attr("longitude");

  myPlacemark2.geometry.setCoordinates([latitude, longitude]);
  myMap_2.setCenter([latitude, longitude]);

	//смена координат при передвижении точки
  myPlacemark2.events.add("dragend", function (e) {
      coords = this.geometry.getCoordinates();
      //alert(coords);
      $("#f-edit-storage-latlong").val(coords);
  }, myPlacemark2);

  //смена координат при нажатии на карту
  myMap_2.events.add('click', function (e) {
    var coords = e.get('coords');
    myPlacemark2.geometry.setCoordinates(coords);
    $("#f-edit-storage-latlong").val(coords);
  });
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
    location.reload();
  }
  else{
    alert("Произошла ошибка");
  }
};
