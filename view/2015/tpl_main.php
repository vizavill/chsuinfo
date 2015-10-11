<!DOCTYPE html>
<html>
<head>
  <title>Расписание ЧГУ</title>

  <meta charset="utf-8">

	<link rel="apple-touch-icon" sizes="57x57" href="/view/2015/icons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/view/2015/icons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/view/2015/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/view/2015/icons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/view/2015/icons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/view/2015/icons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/view/2015/icons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/view/2015/icons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/view/2015/icons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/view/2015/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/view/2015/icons/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="/view/2015/icons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/view/2015/icons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/view/2015/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/view/2015/icons/manifest.json">
	<link rel="shortcut icon" href="/view/2015/icons/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="Расписание">
	<meta name="application-name" content="Расписание">
	<meta name="msapplication-TileColor" content="#ffc40d">
	<meta name="msapplication-TileImage" content="/view/2015/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="/view/2015/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="view/2015/lib/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="view/2015/lib/bselect/css/bootstrap-select.css">
  <link rel="stylesheet" href="view/2015/lib/datapicker/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="view/2015/css/main.css">
  <!--<link rel="stylesheet" href="css/media.css">-->

</head>
<body>
<div class="container-fluid">
		<div class="row">
			<header>
				<a class="logo" href=""><h1><span>расписание<br />университета</span></h1></a>
				<div class="top-menu">
					<div class="btn-group nav" role="group">
					<?php
						if((strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false) || ( (strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) && ($_COOKIE['person'] == 'lecturer')))
							$menuHtml = '<button id="link_stud" type="button" class="btn btn-default">Студенты</button>
	  					<button id="link_prep" type="button" class="btn btn-default active">Преподаватели</button>';
						else $menuHtml = '<button id="link_stud" type="button" class="btn btn-default active">Студенты</button>
	  					<button id="link_prep" type="button" class="btn btn-default">Преподаватели</button>';
						echo $menuHtml;
					?>
					</div>	
				</div>
			</header>
		</div>
		<?=$content?>
		<div class="row">
			<footer>
				<ul>
					<li>
						<span><strong>Проверяйте</strong> расписание на <a href="https://rasp.chsu.ru/">официальном сайте</a>.</span>
						<span>Если вы обнаружили <strong>ошибку</strong>, то помогите другим, <a href="https://vk.com/topic-43257191_32650248">сообщив нам</a>.</span>
					</li>
					<li>
						<span><em>Будет здорово, если вы поможете сделать ресурс ещё удобнее и функциональнее,</em></span>
						<span><em>предложив нам свою <a href="https://vk.com/topic-43257191_32650237">идею</a> или <a href="https://vk.com/topic-43257191_32650244">помощь</a>.</em></span>
					</li>
				</ul>
			</footer>
		</div>
	</div>
</div>
  	<script src="view/2015/lib/jquery/jquery.js"></script>
  	<script src="view/2015/lib/bootstrap/bootstrap.js"></script>
  	<script src="view/2015/lib/bselect/js/bootstrap-select.min.js"></script>
  	<script src="view/2015/lib/datapicker/js/bootstrap-datepicker.js"></script>
  	<script src="view/2015/lib/jquery.cookie/jquery.cookie.js"></script>
  	<script>

  	$.fn.datepicker.dates['ru'] = {
	    days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
	    daysShort: ["Вос", "Пон", "Вто", "Сре", "Чет", "Пят", "Суб"],
	    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
	    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
	    monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
	    today: "Сегодня",
	    clear: "Сбросить",
	    format: "dd.mm.yyyy",
	    titleFormat: "MM yyyy",
	    weekStart: 1
	};

	$('#datepicker').datepicker({
	    language: "ru",
	    forceParse: false,
	    daysOfWeekDisabled: "0",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    startDate: "01.09.2015",
    	endDate: "30.06.2016",
	});


	$("#btn-side-hide").click( function(){
		$("#sidebar1").toggleClass("side-hide");
		$("#workplace1").toggleClass("workplace-full-width");
		$("#btn-side-hide").toggleClass("side-btn-re");
	});

	$("#close-informer1").click(function(){
		set_cookie("informer1","close");
	});

	$(document).ready(function () {
		$('.datepicker').datepicker('setDate', get_cookie('sel_date'));
	});

	$("#link_stud").click(function(){
		$(location).attr('href','index.php?c=rasp&p=group');
	});

	$("#link_prep").click(function(){
		$(location).attr('href','index.php?c=rasp&p=lecturer');
	});

	//Кнопка показать
	$("#go_day").click(function(){
		var sel_date = $('.datepicker').datepicker('getDate');
		var str_sel_date = ('0'+sel_date.getDate()).slice(-2)+'.'+('0'+(sel_date.getMonth()+1)).slice(-2)+'.'+sel_date.getFullYear();
		//Добавляем выбранную дату в печеньку
		set_cookie('sel_date',str_sel_date);
		//Определяем группа или препод, по дефолту группа
		var type_person = 'g';
		if($("select[name~='l']").length>0) { type_person = 'l'	}
		//Формируем запрос		
		var go_url = 'index.php?d='+str_sel_date+'&'+type_person+'='+$(".selectpicker option:selected").val();
		//Отправляем
		$(location).attr('href', go_url);
	});
	$("#go_week").click(function(){
		var sel_date = $('.datepicker').datepicker('getDate');
		var str_sel_date = ('0'+sel_date.getDate()).slice(-2)+'.'+('0'+(sel_date.getMonth()+1)).slice(-2)+'.'+sel_date.getFullYear();
		//Добавляем выбранную дату в печеньку
		set_cookie('sel_date',str_sel_date);
		//Определяем группа или препод, по дефолту группа
		var type_person = 'g';
		if($("select[name~='l']").length>0) { type_person = 'l'	}	
		//Формируем запрос
		var go_url = 'index.php?d='+str_sel_date+'&v=w&'+type_person+'='+$(".selectpicker option:selected").val();
		//Отправляем
		$(location).attr('href', go_url);
	});

	//
	//Функция установки печеньки
	// set_cookie ( "username", "Вася Пупкин" );
	// set_cookie ( "username", "Вася Пупкин", 2011, 01, 15 );
	// set_cookie ( "username", "Вася Пупкин", 2003, 01, 15, "","domain.com", "secure" );
	function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
		{
		  var cookie_string = name + "=" + escape ( value );
		 
		  if ( exp_y )
		  {
		    var expires = new Date ( exp_y, exp_m, exp_d );
		    cookie_string += "; expires=" + expires.toGMTString();
		  }
		 
		  if ( path )
		        cookie_string += "; path=" + escape ( path );
		 
		  if ( domain )
		        cookie_string += "; domain=" + escape ( domain );
		  
		  if ( secure )
		        cookie_string += "; secure";
		  
		  document.cookie = cookie_string;
		}

	//
	//Функция удаления печеньки
	// delete_cookie ( "username" );
	function delete_cookie ( cookie_name )
		{
		  var cookie_date = new Date ( );  // Текущая дата и время
		  cookie_date.setTime ( cookie_date.getTime() - 1 );
		  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
		}

	//
	//Функция получения значения печеньки
	// var x = get_cookie ( "username" );
	function get_cookie ( cookie_name )
		{
		  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
		 
		  if ( results )
		    return ( unescape ( results[2] ) );
		  else
		    return null;
		}
	</script>
</body>
</html>
