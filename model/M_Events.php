<?php
include_once('MSQL.php');


//
// Менеджер для управления блогом
//
class M_Events
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД	
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Events();
		
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
	// Функция добавления мероприятия в базу.
	//
	public function addEvent($object){
		if($this->msql->Insert('events',$object))
			return true;	
	}
	
	//
	// Функция выборки всех событий прошедшие модерацию, кроме событий которые добавил пользователь
	//
	public function getAllEvents($id_user){
		return $this->msql->Select("SELECT * FROM events WHERE status='1' AND id_user<>'$id_user'");
	}
	
	//
	// Функция выборки событий определенного пользователя
	//
	public function getUserEvents($id_user){
		return $this->msql->Select("SELECT * FROM events WHERE  id_user='$id_user'");
	}
	
	//
	// Функция выборки определенного события
	//
	public function getEvent($id_event){
		return $this->msql->Select("SELECT * FROM events WHERE id='$id_event'");
	}
	
	//
    //Функция редактирования события
    //
    function updEvent($object, $id_event, $id_user){
		if($this->msql->Update('events',$object, "id='$id_event' AND id_user='$id_user'"))
			return true;
		else
			return false;
	}
	
	//
    //Функция удаления события
    //
    function delEvent( $id_event, $id_user){
		return  $this->msql->Delete('events',"id='$id_event' AND id_user='$id_user'");
	}
	
	
}
