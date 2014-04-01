<?php
include_once('MSQL.php');

//
// Менеджер для примера
//
class M_VK
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	public $link;
	public	$token;
 	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_VK();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql   = MSQL::Instance();
		//логинимся
		$this->token = $this->OAuth(LOGIN, PASSWORD);
	}
	
	
	
	
	// Функция авторизации пользователя
    function OAuth($login, $password, $key = "", $sid = "") {
        $link = "https://oauth.vk.com/token?grant_type=password&client_id=2274003&client_secret=hHbZxrka2uZ6jB1inYsH&username=" . $login . "&password=" . $password;
        if ($key != "") {
            $link = $link . "&captcha_key=" . $key . "&captcha_sid=.$sid";
        }
        $res = $this->send($link);
        $decres = json_decode($res);
        if (isset($decres->access_token)) {
            // При успешной авторизации
            return $decres->access_token;
        }
        if (isset($decres->captcha_sid)) {
            // При появлении каптчи
            return $decres->captcha_sid;
        } elseif (isset($decres->error)) {
            // Обработка всех остальных ошибок
            return $decres->error;
        }
    }
    // Функция получения информации по пользователе
    function UserGetInfo($token, $id = "") {
        if ($id == "") {
            $link = "https://api.vk.com/method/users.get?fields=sex,bdate,city,country,photo_50,photo_100,photo_200,photo_400_orig,photo_max_orig,education,universities,schools&access_token=" . $token;
            $res = $this->send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
        if ($id != "") {
            $link = "https://api.vk.com/method/users.get?user_ids=" . $id . "&fields=sex,bdate,city,country,photo_50,photo_100,photo_200,photo_400_orig,photo_max_orig,education,universities,schools&access_token=" . $token;
            $res = $this->send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
    }
    // Получение друзей пользователя
    function FriendGet($token, $id = "") {
        if ($id == "") {
            $link = "https://api.vk.com/method/friends.get?access_token=" . $token;
            $res = $this->send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
        if ($id != "") {
            $link = "https://api.vk.com/method/friends.get?user_ids=" . $id . "&access_token=" . $token;
            $res = $this->send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
    }
    // Получение записей пользователя
    function WallGet($token, $id = "") {
        if ($id == "") {
            $link = "https://api.vk.com/method/wall.get?filter=owner&access_token=" . $token;
            $res = $this->send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
        if ($id != "") {
            $link = "https://api.vk.com/method/wall.get?owner_id=" . $id . "&access_token=" . $token;
            $res = send($link);
            $decres = json_decode($res, TRUE);
            return $decres;
        }
    }
    // Установка статуса
    function StatusSet($token, $text) {
        $link = "https://api.vk.com/method/status.set?text=" . urlencode($text) . "&access_token=" . $token;
        $res = $this->send($link);
        $response = strpos($res, 'response');
        if ($response !== FALSE) {
            return $text;
        } else {
            return 'error';
        }
    }
    // Получение статуса
    function StatusGet($token, $id = "") {
        if ($id == "") {
            $link = "https://api.vk.com/method/status.get?access_token=" . $token;
        }
        if ($id != "") {
            $link = "https://api.vk.com/method/status.get?user_id=" . $id . "&access_token=" . $token;
        }
        $res = $this->send($link);
        $decres = json_decode($res);
		if (isset($decres->response->text)) {
		return $decres->response->text;	
		} else {
			return 'error';
		}
    }
    // Установка онлайна
    function SetOnline($token) {
        $link = "https://api.vk.com/method/account.setOnline?access_token=" . $token;
        $res = $this->send($link);
        $response = strpos($res, 'response');
        if ($response !== FALSE) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    // Функция отправки сообщения
    function MsgToUser($user_id, $message, $attachment = "",$title, $token) {
        $link = "https://api.vk.com/method/messages.send?user_id=" . $user_id . "&message=" . urlencode($message) . "&attachment=" . $attachment . "&access_token=" . $token . "&title=".$title;
        $res = $this->send($link);
        $response = strpos($res, 'response');
        if ($response !== FALSE) {
		print_r($response);
            return 'ok';
        } else {
            return 'error';
        }
    }
    // Функция отправки сообщения в конференцию
    function MsgToConferense($chat_id, $message, $attachment = "", $token) {
        $link = "https://api.vk.com/method/messages.send?chat_id=" . $chat_id . "&message=" . urlencode($message) . "&attachment=" . $attachment . "&access_token=" . $token;
        $res = $this->send($link);
        $response = strpos($res, 'response');
        if ($response !== FALSE) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    // Функция отправки сообщения на стену
    function WallPost($owner_id = "", $friends_only = "0", $from_group = "0", $message, $attachments, $token) {
        if ($owner_id != "") {
            $group = strpos($owner_id, '-');
            if ($group !== FALSE) {
                $link = "https://api.vk.com/method/wall.post?owner_id=" . $owner_id . "&from_group=" . $from_group . "&message=" . urlencode($message) . "&attachments=" . $attachments . "&access_token=" . $token;
            } else {
                $link = "https://api.vk.com/method/wall.post?owner_id=" . $owner_id . "&friends_only=" . $friends_only . "&message=" . urlencode($message) . "&attachment=" . $attachments . "&access_token=" . $token;
            }
        }
        if ($owner_id == "") {
            $link = "https://api.vk.com/method/wall.post?&message=" . urlencode($message) . "&friends_only=" . $friends_only . "&attachment=" . $attachments . "&access_token=" . $token;
        }
        $res = $this->send($link);
        $decres = json_decode($res);
		if (isset($decres->response->post_id)) {
		return $decres->response->post_id;	
		} else {
			return 'error';
		}
        
    }
    // Функция добавления пользователя в друзья
    function FriendsAdd($user_id, $text = "", $token) {
        $link = "https://api.vk.com/method/friends.add?&user_id=" . $user_id . "&text=" . Urlencode($text) . "&access_token=" . $token;
        $res = $this->send($link);
        $response = strpos($res, 'response');
        if ($response !== FALSE) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    // Функция проверки ссылки на забаненость Vk
    function TestLink($vklink) {
        $link = "https://api.vk.com/method/utils.checkLink?url=" . $vklink;
        $res = $this->send($link);
        $recres = json_decode($res);
        return $recres->response->status;
    }
	// Функция для отправки универсального запроса
	function ApiVkSend($method, $params, $result = "response") {
		$link = "https://api.vk.com/method/".$method."?".urlencode($params);
		$res = $this->send($link);
	if ($result == "response") {
		return $res;
	} 
	if ($result == "json_array"){
		return json_decode($res, TRUE);
	}
	}
    // Ф-я отправки запроса
    function send($link, $params = "", $useragent = "VKAndroidApp/3.0.1-10 (Android 4.0.4; SDK 13; armeabi-v7a; HTC Supersonic; ru)") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($params != "") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
	
	
	
	
	
	
	
	
	
	
	 
	
	
	
	
	
	
    

	
    //
    //Получает список подписчиков для рассылки на текущий час 
    //
    public function getMessage()
	{
        $now_hour=date('H');
        $now_day=date('Y-m-d');
		return $this->msql->Select("SELECT * FROM vk_mailing WHERE (time<='$now_hour' AND (status=0 OR status=2))");	
		
    }
	
	 //
    //Функция удаления пользователей из рассылки у которых кончился срок рассылки
    //
    function SetStatusSend($id)
	{
		$vars = array('status'=>1);
		$this->msql->Update('vk_mailing',$vars,"id='$id'");	
	}
	
	
	function SetStatusError($id)
	{
		$vars = array('status'=>2);
		$this->msql->Update('vk_mailing',$vars,"id='$id'");	
	}
	
    
    //
    //Функция разбиения названия предмета на отдельные слова
    //
	public function dali($string){
		$i=1;
		$tok = strtok($string, " ");
		while($tok){
			$mas[$i]=$tok;
			$i++;
			$tok = strtok(" ");
		}
		return $mas;
	}
	//
    //Функция сокращения слова
    //
	public function sokrat($mas){
		$len=4;
		$vowel=array('а','у','о','ы','и','э','я','ю','ё','е','ь','ъ');
		$out_string='';
		foreach($mas as $string){
			$len_str=strlen($string);
			if($len<=$len_str){
				$str=substr($string,0,$len);
				foreach($vowel as $value){
					if($str[$len-1]==$value){
						$str=substr($string,0,$len+1);
					}
						
				}
				$out_string.=$str." ";
			}
			else{
				$out_string.=$string." ";
			}
		}
		return $out_string;
		}	
		
    
}
