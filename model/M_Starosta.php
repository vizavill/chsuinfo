<?php
include_once('MSQL.php');


//
// Менеджер управления кабинетом старосты
//
class M_Starosta
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД	
		
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Starosta();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql   = MSQL::Instance();
	}
	
	//
	// Функция выборки одногруппников
	//
	public function all_odnogrup($starosta){
		return  $this->msql->Select("SELECT * FROM users WHERE person='$starosta'");
	}
	
	//
	// Функция подсчета количества отправленных оповещений
	//
	public function count_not($grup){
		return  count($this->msql->Select("SELECT * FROM starosta_notification WHERE grup='$grup'"));
	}
  
	//
	// Функция выборки всеx отправленных сообщений
	//
	public function all_notif($grup){
		return  $this->msql->Select("SELECT * FROM starosta_notification WHERE grup='$grup'");
 
	}
	
    //
	// Функция добавления рассылки в БД.
	//
	public function add_notif($object) {
	  
		if($this->msql->Insert('starosta_notification',$object)){
			return true;
		}
		else{
			return false;
		};
	}

	
}
