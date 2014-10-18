<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>

    <!-- Bootstrap -->
    <link href="/view/bootstrap2014/css/bootstrap.min.css" rel="stylesheet">
    <link href="/view/bootstrap2014/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/view/bootstrap2014/css/bootstrap-switch.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="http://vk.com/js/api/openapi.js"></script>
	<script type="text/javascript">
	  VK.init({apiId: 4330846, onlyWidgets: true});
	</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">ChsuInfo</a>
        </div>
		
        <div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<? if (isset($user)): ?>
					<li><div class="ava-head img-circle"><img src="<?=$user[photo_200]?>"></div></li>
					<li><a href="index.php?c=login">Выйти</a></li>			
				<?else:?>
					<li><a href="<?=$linkAuthVk?>">Войти в профиль</a></li>
				
				<?endif?>				
			</ul>
		
          <ul class="nav navbar-nav navbar-right">
			<?php
				if((strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false) || ( (strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) && ($_COOKIE['person'] == 'lecturer')))
					$menuHtml = '<li><a href="index.php?c=rasp&p=group">Расписание для студентов</a></li>
								<li class="active"><a href="index.php?c=rasp&p=lecturer" >Расписание для преподавателей</a> </li>';
				else
					$menuHtml = '<li class="active"><a href="index.php?c=rasp&p=group">Расписание для студентов</a></li>  
								<li><a href="index.php?c=rasp&p=lecturer">Расписание для преподавателей</a></li>';
				echo $menuHtml;
			?>
			<li class="visible-lg-inline"><a href="http://m.chsuinfo.ru/" target="_blank">Мобильная версия</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
		<?=$content?>
	
	<div class="footer">
	  <div class="container">
		<p class="text inline-block pull-left">ChsuInfo.ru - Расписание Череповецкого Государственного Университета</p> <p class="pull-right inline-block text"><a href="#">Алексей Дурягин</a> / <a href="#">Вадим Осюков</a></p>   
	  </div>
	</div>
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/view/bootstrap2014/js/bootstrap.min.js"></script>
    <script src="/view/bootstrap2014/js/bootstrap-select.min.js"></script>	
    <script src="/view/bootstrap2014/js/bootstrap-switch.min.js"></script>	
    <script src="/view/bootstrap2014/js/js.js"></script>	
  </body>
</html>