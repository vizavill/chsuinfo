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
	
	
	public function getProfileVk($idVk,$accessToken, $id_user)
	{	
		 // получим профиль пользователя
		 //https://api.vk.com/method/users.get?fields=sex,bdate,city,country,photo_50,photo_100,photo_200_orig,photo_400_orig,photo_max_orig,education,universities,schools&access_token=
		$resp = file_get_contents('https://api.vkontakte.ru/method/users.get?fields=sex,bdate,city,country,photo_50,photo_100,photo_200_orig,photo_400_orig,photo_max_orig,education,universities,schools&access_token='.$accessToken);
		$data = json_decode($resp, true);
		$vars = array('id_vk'=>$data[response][0][id],
						'first_name'=>$data[response][0][first_name],
						'last_name'=>$data[response][0][last_name],
						'bdate'=>$data[response][0][bdate],
						'photo_200'=>$data[response][0][photo_200_orig],
						'sex'=>$data[response][0][sex]);
		$this->msql->Update('users',$vars,"id_user='$id_user'");
		
	}
	
	
	//
    //Функция редактирования профиля пользователя
    //
    function edit_person($object, $id_user){
	
		
		$this->msql->Update('users',$object, "id_user='$id_user'");
		
	}
}
