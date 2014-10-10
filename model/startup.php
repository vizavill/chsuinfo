<?php

function startup()
{
	// Настройки подключения к БД.
	$hostname = 'a112970.mysql.mchost.ru';	
	$username = 'a112970_chsuinfo'; 
	$password = '8uEiJ4SR7f';
	$dbName   = 'a112970_chsuinfo';
	
	// Языковая настройка.
	setlocale(LC_ALL, 'ru_RU.utf8');	
	
	// Подключение к БД.
	mysql_connect($hostname, $username, $password) or die('No connect with data base'); 
	mysql_query('SET NAMES utf8');
	mysql_select_db($dbName) or die('No data base');
	
	
	
	//Параметры авторизации в контакте
	// id приложения
	define("LOGIN", "79517498329");
	// защищенный ключ
	define("PASSWORD", "4780sd");
	
	
	
	
	// id приложения
	define("CLIENT_ID", "4554015");
	// защищенный ключ
	define("SECRET", "cXjxZQZUhlsPUdfoUaqS");
	// куда перенаправим пользователя после авторизации
	define("OAUTH_CALLBACK", "index.php?c=login");
	// настройки доступа
	define("SCOPE", "friends");
	// путь к папке со скриптами
	define("PATH", "http://chsuinfo.ru/");
	
	
	define("THEME", "/bootstrap2014");
	
	
	

	// Открытие сессии.
	
	
	session_start();		
}
