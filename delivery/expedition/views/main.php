<style>
th {
    height: 30px;
    text-align: center;
    font-weight: 700;
}
td {
    text-align: center
}
th:nth-of-type(7),td:nth-of-type(7),th:nth-of-type(6),td:nth-of-type(6)  {
    color: red;
}

th:nth-of-type(7),td:nth-of-type(7),th:nth-of-type(1),td:nth-of-type(1)  {
    background: #efefef;
}


.today {
  background: #fff;
}

.tab-calendar .active{
  background: #545486;
  color: #fff;
}
</style>

<?
$date = "2018-01-6";
date("d.m.Y", strtotime($date));
?>

<div uk-grid class="uk-grid-small">
  <div class="uk-width-1-3">
    <div>
      <h3 class="uk-margin-remove">
        <a href="?ym=<?php echo $prev; ?>"><span uk-icon="icon: chevron-left"></span></a>
          <?php echo $html_title; ?>
        <a href="?ym=<?php echo $next; ?>"><span uk-icon="icon: chevron-right"></span></a>
      </h3>
      <table class="uk-table tab-calendar">
          <tr>
              <th>Пн</th>
              <th>Вт</th>
              <th>Ср</th>
              <th>Чт</th>
              <th>Пт</th>
              <th>Сб</th>
              <th>Вс</th>
          </tr>
          <?php
            foreach ($weeks as $week) {
                echo $week;
            }
          ?>
      </table>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
  $('.tab-calendar td').click(function(e) {
      $('.tab-calendar .active').removeClass('active');

      //Отправка в БД
    	$('#content>div').each(function(){
        id = $(this).attr('id_exp');
        id_warehouses = $(this).attr('storage-id');
        comment = $(this).find("textarea").val();
        sum = $(this).find("input").val();
        day = $(this).attr("day");
        //oplata = $(this).find("select").val();
        oplata = 1;
        $.ajax({
          type: "POST",
          url: "/delivery/expedition/controllers/day_edit.php",
          data: {
            id: id,
            id_warehouses: id_warehouses,
            day: day,
            comment: comment,
            oplata: oplata,
            sum: sum
            },
            success: sucEdit
        });
    	});


      $(this).addClass('active');
      day = $(this).attr("day");

      //Получение информации из БД
      $.ajax({
        type: "POST",
        url: "/delivery/expedition/controllers/day_info.php",
        data: {
          day: day
          },
          success: sucPull
      });
  });
});

function sucPull(data){
  if(data){
    $("#content").html(data);
  }
  else{
    alert("Произошла ошибка");
  }
};

function sucEdit(data){
  if(data){

  }
  else{
    alert("Произошла ошибка");
  }
};
</script>


<div class="uk-grid" class="uk-grid-small">
  <div class="uk-width-1-3">
      <h3>Список складов</h3>
      <ul class="uk-list uk-list-striped  uk-panel-scrollable uk-resize-vertical" id="storage-list" style="height: 300px; border: 1px solid #e2e2e2; padding: 0px;">
        <? foreach ($storage as &$value) { ?>
          <li>
              <?=$value['name']?>
              <div class="uk-float-right">
                <a href="#delit-str" class="btn-delit list-add-stock">Добавить</a>
                <a class="" style="color: #2f008a;" href="https://yandex.ru/maps/213/moscow/?mode=search&text=<?=$value['latitude']?>%2C<?=$value['longitude']?>&sll=37.489376%2C54.902805" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
              </div>
          </li>
        <? } ?>
      </ul>
  </div>

  <div class="uk-width-1-2">
      <h3>Список точек</h3>
      <div uk-sortable="group: sortable-group" id="content">
          <div class="uk-margin-small">
            <!--
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
                                  <a class="card-stock-delit">Удалить</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            -->
          </div>
      </div>
  </div>
</div>





<!--
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

        <ul class="uk-list uk-list-striped  uk-panel-scrollable uk-resize-vertical" id="storage-list" style="height: 300px; border: 1px solid #e2e2e2;">
          <? foreach ($storage as &$value) { ?>
            <li class="">
                <?=$value['name']?>
                <div class="uk-float-right">
                  <a href="#delit-str" class="btn-delit list-add-stock">Добавить</a>
                  <a class="" style="color: #2f008a;" href="https://yandex.ru/maps/213/moscow/?mode=search&text=<?=$value['latitude']?>%2C<?=$value['longitude']?>&sll=37.489376%2C54.902805" target="_blank"><span uk-icon="icon: location; ratio: 1"></span></a>
                </div>
            </li>
          <? } ?>
        </ul>
    </div>

    <div class="uk-width-1-3">
        <h3>Список точек</h3>
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
                                    <a class="card-stock-delit">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
