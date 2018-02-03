<?
include_once $_SERVER['DOCUMENT_ROOT']."/core/bootstrap.php";
?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?
      //Подключаем стили и js по умолчанию
  		add_default_css_js();
      ?>
  </head>
  <body>
    <div class="uk-container uk-margin-top">
      <h1 style="font-size: 30px; text-align: center;">Доставки на сегодня</h1>

      <div class="uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-primary uk-card-body">
                <h3 class="uk-card-title">Primary</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-primary uk-card-body">
                <h3 class="uk-card-title">Primary</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-primary uk-card-body">
                <h3 class="uk-card-title">Primary</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-primary uk-card-body">
                <h3 class="uk-card-title">Primary</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
    </div>
  </body>
</html>
