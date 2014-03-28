<?php

function startup()
{
	// Настройки подключения к БД.
	$hostname = 'localhost';	
	$username = 'a53069_study'; 
	$password = '';
	$dbName   = 'a53069_study';
	
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
	define("CLIENT_ID", "4242336");
	// защищенный ключ
	define("SECRET", "s8AbTjmmbw7vostF77v4");
	// куда перенаправим пользователя после авторизации
	define("OAUTH_CALLBACK", "index.php?c=login");
	// настройки доступа
	define("SCOPE", "friends");
	// путь к папке со скриптами
	define("PATH", "http://new.chsuinfo.ru/");
	
	
	define("THEME", "/red2014");
	
	

	// Открытие сессии.
	
	session_start();		
}
