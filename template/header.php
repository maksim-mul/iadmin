<?
include_once $_SERVER['DOCUMENT_ROOT']."/application/bootstrap.php";
?>

<html>
<head>
    <title><?=$SetTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div uk-grid class="uk-grid-collapse">
        <div class="uk-width-auto left-panel">
            <div class="logo">
                <img width="50" src="https://cdn.worldvectorlogo.com/logos/slack-1.svg"> Рабочее место 1
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
                            <li><a href="/delivery/expedition/"><span class="uk-margin-small-right" uk-icon="icon: social"></span> Экспедиция</a></li>
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
                    <div class="uk-float-left">
                        <a style="font-size: 18px; text-decoration: none; color: #666;"> Муллаев М.В.</a>
                    </div>

                    <div class="uk-float-right">
                      <form class="uk-margin-remove" action="" method="post">
                          <button name="logout" class="uk-button uk-button-default">Выйти</button>
                      </form>
                      <?php
                          //выйти из аккаунта
                          if(isset($_POST['logout'])){
                              unset($_SESSION['admin']);
                              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0'>";
                          }
                      ?>
                    </div>
                </div>
            </div>


            <div class="uk-container uk-margin-top">
