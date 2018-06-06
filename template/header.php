<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
?>
<html>
<head>
    <title><?=$SetTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?
    //Подключаем стили и js по умолчанию
		add_default_css_js();
    ?>
</head>

<body>
    <div uk-grid class="uk-grid-collapse">
        <div class="uk-width-auto left-panel">
            <a class="uk-logo" href="/">
              <div class="logo">
                  <img width="50" src="/images/logo.svg"> Рабочее место 1
              </div>
            </a>
            <div class="left-menu">
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true;">
                    <li class="uk-parent uk-open">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: delivery"></span> Служба доставки</a>
                        <ul class="uk-nav-sub">
                            <li><a href="/delivery/expedition/"><span class="uk-margin-small-right" uk-icon="icon: social"></span> Экспедиция</a></li>
                            <li><a href=""><span class="uk-margin-small-right" uk-icon="icon: location"></span> Доставка клиентам</a></li>
                            <li><a href="/delivery/storage/"><span class="uk-margin-small-right" uk-icon="icon: list"></span> Список складов</a></li>
                            <!--<li><a href="/delivery/auto/"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Состояние авто</a></li>-->
                        </ul>
                    </li>
                    <li class="uk-parent uk-open">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: folder"></span> Сервис</a>
                        <ul class="uk-nav-sub">
                            <li><a href="/service/cameras/"><span class="uk-margin-small-right" uk-icon="icon: video_cam"></span> Камеры</a></li>
                            <li><a href="/service/import/"><span class="uk-margin-small-right" uk-icon="icon: import"></span> Импорт</a></li>
                        </ul>
                    </li>
                    <li class="uk-nav-divider"></li>
                </ul>
            </div>

        </div>
        <div class="uk-width-expand">
            <div class="top-panel">
                <div class="uk-container">
                    <a href="https://lcab.sms-uslugi.ru/" target="_blank">
                      <div class="uk-float-left uk-flex uk-flex-middle" style="font-size: 18px; margin-top: 7px; color: #333;">
                          SMS: <?=round($sms_balance)?>&thinsp;<img src="/images/icons/ruble.svg" width="25">
                      </div>
                    </a>

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
            <div uk-height-viewport="offset-top: true; offset-bottom: true">
              <div class="uk-container uk-margin-top uk-margin-large-bottom">
