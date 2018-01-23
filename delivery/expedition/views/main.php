<style>
    th {
        height: 30px;
        text-align: center;
        font-weight: 700;
    }
    td {
        height: 90px;
    }
    .today {
      background: #545486;
      color: #fff;
    }
    th:nth-of-type(7),td:nth-of-type(7),th:nth-of-type(6),td:nth-of-type(6)  {
        color: red;
    }

    th:nth-of-type(7),td:nth-of-type(7),th:nth-of-type(1),td:nth-of-type(1)  {
        background: #efefef;
    }
</style>




<div uk-grid>
  <div class="uk-width-3-5">
    <div>
      <h3 class="uk-margin-remove">
        <a href="?ym=<?php echo $prev; ?>"><span uk-icon="icon: chevron-left"></span></a>
          <?php echo $html_title; ?>
        <a href="?ym=<?php echo $next; ?>"><span uk-icon="icon: chevron-right"></span></a>
      </h3>
      <table class="uk-table table-bordered">
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
  <div class="uk-width-2-5">

  </div>
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
