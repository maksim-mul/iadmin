<?php
	include_once "application/bootstrap.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/application/bootstrap.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/main/index.php";
?>






<!--






<html>
<head>
    <title>Плитка на дом</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="uikit/css/uikit.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js" type=""></script>
    <script src="uikit/js/uikit.min.js" type=""></script>
    <script src="uikit/js/uikit-icons.js" type=""></script>
    <link href="css/theme.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div uk-grid class="uk-grid-collapse">
        <div class="uk-width-auto left-panel">
            <div class="logo">
                <img width="50" src="images/logo.svg"> Рабочее место 1
            </div>

            <div class="left-menu">
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true;">
                    <li class="uk-parent uk-open">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: folder"></span> Проекты</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: folder"></span> Проекты и смета</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: work"></span> Работы и цены</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: statistika"></span> Статистика</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: video_cam"></span> Камеры</a></li>
                        </ul>
                    </li>
                    <li class="uk-parent uk-open">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Пользователи</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: folder"></span> Клиенты</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: folder"></span> Работники</a></li>
                        </ul>
                    </li>
                    <li class="uk-parent uk-open">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: delivery"></span> Служба доставки</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: social"></span> Экспедиция</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: list"></span> Список складов</a></li>
                            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Состояние авто</a></li>
                        </ul>
                    </li>
                    <li class="uk-nav-divider"></li>
                </ul>
            </div>

        </div>
        <div class="uk-width-expand">
            <div class="top-panel">
                <div class="uk-container">
                    <div class="uk-float-right">
                        <a style="font-size: 18px; text-decoration: none; color: #666;"><img width="45" src="images/ava_default.png" class="uk-border-circle"> Муллаев М.В.</a>
                    </div>
                </div>
            </div>


            <div class="uk-container uk-margin-top">


                <div class="h1-blc">
                    <h1>Формирование экспедиции</h1>
                </div>

                <div uk-grid>
                    <div class="uk-width-1-3">
                        <h3>Список складов</h3>
                        <div class="uk-panel uk-panel-scrollable uk-resize-vertical" style="height: 700px;">
                            <div class="uk-card uk-card-default uk-margin-small-bottom">
                                <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Бау Подольск
                                <div class="uk-float-right">
                                    <a class="list-add-stock">Добавить</a>
                                </div>
                            </div>
                            <div class="uk-card uk-card-default uk-margin-small-bottom">
                                <a style="color: #df405a;" href="https://yandex.ru/maps" target="_blank"><span uk-icon="icon: location; ratio: 1.3"></span></a> Реал Керамика
                                <div class="uk-float-right">
                                    <a class="list-add-stock">Добавить</a>
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
                                    <div class="uk-card">
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
                        <img class="uk-margin-top" src="images/service/arrow.png" width="60">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        /*Удаление пунктов доставки*/
        $('body').on('click', '.card-stock-delit', function(e) {
            $(this).closest('.card-stock').remove();
        });

        $('body').on('click', '.list-add-stock', function(e) {
            $ttt="<div class='uk-margin-small'><div class='uk-card uk-card-default card-stock'><div class='card-stock-title'><a style='color: #df405a;' href='https://yandex.ru/maps' target='_blank'><span uk-icon='icon: location; ratio: 1.3'></span></a> Бау Подольск<div class='uk-float-right'><span uk-icon='icon: menu; ratio: 1.3'></span></div></div><div class='uk-card'><label>Комментарий:</label><textarea class='uk-textarea uk-margin-remove' rows='3'></textarea><div class='uk-margin-small-top'><div uk-grid class='uk-grid-small'><div class='uk-width-1-3'><select class='uk-select' id='form-stacked-select'><option>Безнал</option><option>Наличные</option></select></div><div class='uk-width-1-3'><input class='uk-input' id='form-stacked-text' type='text' placeholder='Сумма'></div><div class='uk-width-1-3 uk-text-right'><a class=\card-stock-delit\>Удалить из списка</a></div></div></div></div></div></div>";
            $("#test").append($ttt);

        });

    </script>
</body>

</html>

<style>
    body {
        background: #f6fafd;
    }


    /*Универсальные*/
    .h1-blc{
        margin-bottom: 20px;
        border-bottom: 2px solid #df405a;
        position: relative;
    }

    .h1-blc:after {
        content: '';
        position: absolute;
        background: #df405a;
        width: 45px;
        height: 7px;
        bottom: -7px;
        right: 0px;
    }


    .h1-blc>h1{
        font-size: 35px;
        display: inline-block;
        margin-bottom: 5px;
    }

    /*Раздел доставка*/
    .card-stock{
        padding: 0px;
    }
    .card-stock>.card-stock-title{
        background: #efefef;
        padding: 5px 15px;
        border-bottom: 1px solid #e8e8e8;
        font-size: 20px;
    }
    .card-stock>.uk-card{
        padding-top: 3px;
        padding-bottom: 10px;
    }
    .card-stock-delit{
        text-decoration: underline;
        color: #df405a;
        font-size: 14px;
        text-align: right;
        top: 18px;
        position: relative;
    }

    .list-add-stock{
        font-size: 14px;
        line-height: 30px;
        color: #df405a;
        text-decoration: underline;
    }



    /*Разметка страниц*/

    /*Топ*/
    .top-panel {
        background: #f6f6f6;
        border-bottom: 1px solid #ebeaef;
        padding: 10px 0;
    }


    /*Панель слева*/
    .left-menu .uk-nav-default>li>a:focus, .left-menu .uk-nav-default>li>a:hover {
        color: #fff;
    }
    .left-panel {
        background: #2e2e48;
        width: 300px;
        min-height: 100%;
    }
    .left-menu{
        padding: 30px;
    }
    .logo {
        background: #2a293b;
        width: 100%;
        padding: 15px;
        box-sizing: border-box;
        font-size: 18px;
        color: #fff;
    }

</style>
-->
