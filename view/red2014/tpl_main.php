<!DOCTYPE HTML>
<html lang="ru">
<head>
    <!-- v 2.0 --> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
	
    <title><?= $title;?></title>
    <!-- <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"> -->
    <link href="/view/red2014/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/view/red2014/css/reveal.css" rel="stylesheet" />
	
    <script type="text/javascript" src="/view/red2014/js/jquery.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/view/red2014/js/jquery.ikSelect.min.js"></script>
	<script type="text/javascript" src="/view/red2014/js/jquery.reveal.js"></script>

	<script type="text/javascript" src="//vk.com/js/api/openapi.js?110"></script>	
</head>
<body>
	<div id="header">
		<div id="header_content">
			<a href="/"><img src="/view/red2014/images/logo.png"></a>

			<? if (isset($user)): ?>
				<div class="small-ava" style="margin-left:15px;">
					<img src="<?=$user[photo_200]?>">
				</div>
				<a href="index.php?c=setting" class="red-link" style="margin-left:15px;">Профиль</a>
			
			<?else:?>
				<a href="<?=$linkAuthVk?>" class="vk-link" style="margin-left: 15px;">Войти через<img src="/view/red2014/images/vk.png" width="20px;" style="padding-left:3px;"></a>
			<?endif?>			
			<span>
			<?php
				if((strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false) || ( (strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) && (strpos($_SERVER['REQUEST_URI'], "c=sms_vk_rasp") == false) && ($_COOKIE['person'] == 'lecturer')))
					$menuHtml = '<a href="index.php?c=rasp&p=group">Расписание для студентов</a> / <a href="index.php?c=rasp&p=lecturer" id="active">Расписание для преподавателей</a> / <a href="http://m.chsuinfo.ru/">Mobile</a> / <a href="index.php?c=sms_vk_rasp">VK Informer</a>';
				else if(strpos($_SERVER['REQUEST_URI'], "c=sms_vk_rasp") != false)
					$menuHtml = '<a href="index.php?c=rasp&p=group">Расписание для студентов</a> / <a href="index.php?c=rasp&p=lecturer">Расписание для преподавателей</a> / <a href="http://m.chsuinfo.ru/">Mobile</a> / <a href="index.php?c=sms_vk_rasp" id="active">VK Informer</a>';
				else
					$menuHtml = '<a href="index.php?c=rasp&p=group" id="active">Расписание для студентов</a> / <a href="index.php?c=rasp&p=lecturer">Расписание для преподавателей</a> / <a href="http://m.chsuinfo.ru/">Mobile</a> / <a href="index.php?c=sms_vk_rasp">VK Informer</a>';
				echo $menuHtml;
			?>
			</span>
			<div id="header-shadow"></div>
		</div>
	</div>
	
	
	
	<?=$content?>
	
	
	
	<div id="news">
		<div id="news-content" class="valign-middle">
			<a href="http://vk.com/chsuinfo" target="_blank"><i class="i vk"></i></a>
			<h3 class="inline-block no-margin">vk.com/chsuinfo</h3>
			<div class="posts inline-block">
						<? //echo $chsu_news; ?>
				</div>
		</div>
	</div>
	<div id="footer">
		<div id="footer-content">
			<span class="link">© 2014 ChsuInfo.ru</span> Расписание обновляется ежедневно. 
			<span class="authors" style="float:right;">Есть вопросы или нашли ошибку? 
			<a href="http://vk.com/id52858776" target="_blank">Алексей Дурягин</a> / 
			<a href="http://vk.com/id8416411" target="_blank">Вадим Осюков</a></span>
		</div>
	</div>
	
	
	<script type="text/javascript" src="/view/red2014/js/app.js"></script>
</body>
