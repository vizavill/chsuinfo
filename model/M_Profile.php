<?php
include_once('MSQL.php');


//
// Менеджер для примера
//
class M_Setting
{
	
	
	
	
    private static $instance; 	// ссылка на экземпляр класса
	public $msql;
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Setting();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = MSQL::Instance();  

	}
	
	//
	// Функция добавления пользователя в БД.
	//
	public function add_user($object)
	{
	  
		$this->msql->Insert('users',$object);
		
	}
	
 	    //
    //Функция удаления пользователей из рассылки у которых кончился срок рассылки
    //
    function edit_person($object, $id_user){
	
		
		$this->msql->Update('users',$object, "id_user='$id_user'");
		
	}
}
