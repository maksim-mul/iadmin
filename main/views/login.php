<!DOCTYPE html>
<html lang="ru">
  <head>
    <? include_once $_SERVER['DOCUMENT_ROOT']."/application/bootstrap.php" ?>
  </head>
  <body class="tm-login-backgr">
      <div uk-height-viewport class="uk-flex uk-flex-middle uk-flex-center">
          <div>
              <h3 class="uk-text-center">Здравствуйте!</h3>
              <form action="" method="post"  autocomplete="on">
                  <div class="uk-margin">
                      <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon" uk-icon="icon: user"></span>
                          <input class="uk-input" type="text" placeholder="Логин" name="login" autocomplete="on">
                      </div>
                  </div>
                  <div class="uk-margin">
                      <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon" uk-icon="icon: lock"></span>
                          <input class="uk-input" type="password" placeholder="Пароль" name="password" autocomplete="on">
                      </div>
                  </div>
                  <button class="uk-margin-remove-top uk-button uk-button-default uk-button-large uk-width-1-1 uk-margin-small-bottom" name="submit_enter">Войти</button>
          	</form>
          </div>
      </div>
  </body>
</html>


<?
if(isset($_POST['submit_enter'])){

  echo 'yyyyyyyyyyyyyyyyyyyyy';

  if( $_POST['login'] == 'admin'){
		$_SESSION['admin'] = 'admin';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0'>";
	}
  elseif($_POST['login'] == 'test'){
    $_SESSION['admin'] = 'test';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0'>";
  }
}
?>
