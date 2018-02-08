<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?
      //Подключаем стили и js по умолчанию
  		add_default_css_js();
      add_template_css_js();
      ?>
  </head>
  <body>
    <div class="uk-container uk-margin-top uk-margin-large-bottom">
      <h1 style="font-size: 30px; text-align: center;">
        <a href="?ymd=<?php echo $prev; ?>"><span uk-icon="icon: chevron-left"></span></a>
        Доставки
        <?
        $today = date('Y-m-d');
        if( $today == $ym ){
          echo "сегодня";
        }
        else{
          echo date("d.m.y", strtotime($ym));
        }
        ?>
        <a href="?ymd=<?php echo $next; ?>"><span uk-icon="icon: chevron-right"></span></a>
      </h1>
      <div class="uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
        <?
          foreach ($expeditions as $key => $value) {
          ?>
            <div>
                <div class="uk-card uk-card-default uk-card-body mob-info-blc">
                    <ul uk-accordion class="uk-margin-remove">
                        <li>
                            <a class="uk-accordion-title" href="#"><?=$key+1?>. <?=$value["name"]?></a>
                            <div class="uk-accordion-content" style="margin: 0 0 10px 0;">
                                <p class="uk-margin-remove-top uk-margin-small uk-text-justify"><span>Адрес:</span> <?=$value["address"]?></p>
                                <p class="uk-margin-remove-top uk-margin-small uk-text-justify"><span>Подробности:</span> <?=$value["description"]?></p>
                                <p class="uk-margin-remove-top uk-margin-remove uk-text-justify"><span>Время работы:</span> <?=date("H:i", strtotime($value['time_opening']))?> - <?=date("H:i", strtotime($value['time_closing']))?></p>
                            </div>
                        </li>
                    </ul>

                    <p class="uk-margin-small" style="font-size: 18px;line-height: 20px;">
                    <span style="font-weight: 600;">Оплата:</span>
                    <?
                    if( $value["payment_type"]==0 ){
                      echo "Наличные ".$value["payment_sum"]." р.";
                    }
                    elseif( $value["payment_type"]==1 ){
                      echo "Безнал";
                    }
                    ?>
                    </p>

                    <p class="uk-margin-remove-top" style="font-size: 18px;line-height: 20px;">
                    <?
                    if( $value["comment"] == "" ){
                      echo "Поробностей нет";
                    }
                    else{
                      echo nl2br($value["comment"]);
                    }
                    ?>
                  </p>
                  <div uk-grid>
                    <div class="uk-width-expand">
                      <a class="uk-width-1-1 uk-button uk-button-secondary" href="yandexmaps://maps.yandex.ru/?pt=<?=$value['longitude']?>,<?=$value['latitude']?>&z=18&l=map">Поехали</a>
                    </div>
                  </div>
                </div>
            </div>
          <?
          }
        ?>
      </div>
    </div>
  </body>
</html>
