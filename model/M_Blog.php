<?php
include_once('MSQL.php');


//
// Менеджер для управления блогом
//
class M_Blog
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД	
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Blog();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql   = MSQL::Instance();
		$this->mUsers = M_Users::Instance();
	}
	
	//
	// Функция добавления статьи в БД.
	//
	public function addPost($object){

		$this->msql->Insert('blog',$object);	
	}
	//
	// Некая функция для всех.
	//
	public function MakeMagic($text)
	{
		return strtolower($text);
	}
	
	//
	// Функция выборки всех статей
	//
	public function getAllPost(){
		return $this->msql->Select("SELECT * FROM blog");
	}
	
	//
	// А эта функция доступна тем, у кого есть привилегия USE_SECRET_FUNCTIONS.
	//
	public function MakeSecretMagic($text)
	{
	    if (!$this->mUsers->Can('USE_SECRET_FUNCTIONS'))
		    return null;
	
		return strtoupper($text);
	}
}
