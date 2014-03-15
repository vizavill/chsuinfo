<?php
include_once('MSQL.php');


//
// Менеджер для примера
//
class M_IncMes
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД	
		
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_IncMes();
		
		return self::$instance;
	}

	//
	// Конструктор проверки являетс ли номер с которого отправлена СМС номером старосты
	//
	public function __construct()
	{
		$this->msql   = MSQL::Instance();
	}
	
	
	//
	// Функция проверки что хочет тот кто прислал смс
	//
	public function verifySms($message){
		//Убираем пробелы с начала и конца строки и переводим в нижний регистр и удаляем теги
		$message=strip_tags(strtolower(trim($message)));
				
			if (substr_count("завтр")){
				return "zv";
			}
			if (substr_count("сегод")){
				return "sg";
			}
			if (substr_count("послезавт")){
				return "pz";
			}
		return 0;
	}
	
	//
	// Функция проверки является ли номер с которого отправлена СМС зарегестрированным в системе
	//
	public function getRegisterPhone($phoneNumber){
		if (($this->msql->Select("SELECT * FROM users WHERE phone_number='$phoneNumber'"))!=NULL)
			return true;
		else
			return false;
	}
	
	//
	// Функция проверки является ли номер с которого отправлена СМС номером старосты
	//
	public function phone_starosta($phone){
		$row=$this->msql->Select("SELECT * FROM users WHERE phone_number='$phone'");
		if ($row[starosta]!=NULL)
			return true;
		else
			return false;
	}
	
	//
	// Функция добавления номера в бд на один день
	//
	public function addPhone($grup){
		return  count($this->msql->Select("SELECT * FROM notification_star WHERE grup='$grup'"));
	}
  
	//
	// Функция выборки все отправленных сообщений
	//
	public function all_notif($grup){
		return  $this->msql->Select("SELECT * FROM notification_star WHERE grup='$grup'");
 
	}
	
    //
	// Функция добавления рассылки в БД.
	//
	public function add_notif($object) {
	  
		if($this->msql->Insert('notification_star',$object)){
			return true;
		}
		else{
			return false;
		};
	}

	
}
