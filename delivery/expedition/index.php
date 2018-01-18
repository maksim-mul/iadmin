<?
$SetTitle = "Экспедиция";
include_once $_SERVER['DOCUMENT_ROOT']."/template/header.php";
?>


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


<div width="800" height="500" id="map" style="width: 500px; height: 400px;"></div>







<div class="h1-blc">
    <h1>Формирование экспедиции</h1>
</div>
<div uk-grid>
    <div class="uk-width-1-3">
        <h3>Список складов</h3>
        <div class="uk-panel uk-panel-scrollable uk-resize-vertical" style="height: 700px;">
            <div class="uk-card uk-card-default uk-margin-small-bottom card-stock">
              <div>
                <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Бау Подольск
                <div class="uk-float-right">
                    <a class="list-add-stock">Добавить</a>
                </div>
              </div>
            </div>
            <div class="uk-card uk-card-default uk-margin-small-bottom card-stock">
              <div>
                <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Реал Керамика
                <div class="uk-float-right">
                    <a class="list-add-stock">Добавить</a>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="uk-width-1-2">
        <h3>Список точек</h3>

        <div class="uk-margin-bottom">
            <div class="uk-margin-small">
                <div class="uk-card uk-card-default card-stock">
                    <div class="card-stock-title">
                        <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Старт - Серпухов
                        <div class="uk-float-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div uk-sortable="group: sortable-group" id="test">
            <div class="uk-margin-small">
                <div class="uk-card uk-card-default card-stock">
                    <div class="card-stock-title">
                        <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Бау Подольск
                        <div class="uk-float-right">
                            <span uk-icon="icon: menu; ratio: 1.3"></span>
                        </div>
                    </div>
                    <div>
                        <label>Комментарий:</label>
                        <textarea class="uk-textarea uk-margin-remove" rows="3"></textarea>
                        <div class="uk-margin-small-top">
                            <div uk-grid class="uk-grid-small">
                                <div class="uk-width-1-3">
                                    <select class="uk-select" id="form-stacked-select">
                                        <option>Безнал</option>
                                        <option>Наличные</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-3">
                                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="Сумма">
                                </div>
                                <div class="uk-width-1-3 uk-text-right">
                                    <a class="card-stock-delit">Удалить из списка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-top">
            <div class="uk-margin-small">
                <div class="uk-card uk-card-default card-stock">
                    <div class="card-stock-title">
                        <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Финишь - Серпухов
                        <div class="uk-float-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="uk-width-1-6">
        <img class="uk-margin-top" src="/images/service/arrow.png" width="60">
    </div>
</div>
<!--00000000000000000000-->
<script src="/delivery/expedition/static/template.js"></script>

<? include_once $_SERVER['DOCUMENT_ROOT']."/template/footer.php"; ?>