<!DOCTYPE HTML>
<html lang="ru">
<head>
    <!-- v 2.0 -->
    <meta http-equiv="Content-Type" content="text/html; charset=cp1251"/>
    <title>ChsuInfo - Расписание</title>
    <!-- <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"> -->
    <link href="/view/red2014/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/view/red2014/css/reveal.css" rel="stylesheet" />
	
    <script type="text/javascript" src="/view/red2014/js/jquery.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/view/red2014/js/jquery.ikSelect.min.js"></script>
	<script type="text/javascript" src="/view/red2014/js/jquery.reveal.js"></script>

</head>
<body>
	<div id="header">
		<div id="header_content">
			<a href="/"><img src="http://placehold.it/132x60"></a>

			<? if (isset($user)): ?>
				<div class="small-ava" style="margin-left:15px;">
					<img src="<?=$user[photo_200]?>">
				</div>
				<a href="index.php?c=setting" class="red-link" style="margin-left:15px;">Профиль</a>
			
			<?else:?>
				<a href="<?=$linkAuthVk?>" class="vk-link" style="margin-left: 15px;">Войти через<img src="/view/red2014/images/vk.png" width="20px;" style="padding-left:3px;"></a>
			<?endif?>			
			<span>
				<a href="index.php" id="active">Расписание</a> / <a href="#">Расписание для преподавателей</a> / <a href="http://m.chsuinfo.ru/">Mobile</a> / <a href="index.php?c=sms_vk_rasp">SMS & VK</a> / <a href="#">Блог</a> / <a href="#">Мероприятия</a>
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
						<div style="display: none;"><span style="margin-right: 16px">05.03.2014</span> Новостьklllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll</div>
						<div style="display: block;"><span style="margin-right: 16px">03.03.2014</span> Новость 2</div>
						<div style="display: none;"><span style="margin-right: 16px">26.02.2014</span> Новость 3</div>
						<div style="display: none;"><span style="margin-right: 16px">24.02.2014</span> Новость 4</div>
						<div style="display: none;"><span style="margin-right: 16px">20.02.2014</span> Новость 5</div>
				</div>
		</div>
	</div>
	<div id="footer">
		<div id="footer-content">
			<span class="link">© 2014 ChsuInfo.ru</span> Расписание обновляется ежедневно. 
			<span class="authors" style="float:right;">Есть вопросы или нашли ошибку? 
			<a href="http://vk.com/aid123" target="_blank">Алексей Дурягин</a> / 
			<a href="http://vk.com/id8416411" target="_blank">Вадим Осюков</a></span>
		</div>
	</div>
	
	
	<script type="text/javascript" src="/view/red2014/js/app.js"></script>
</body>
