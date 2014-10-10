<?php
include_once('controller/Controller.php');
include_once('model/M_Users.php');
//include_once('model/M_Reg.php');
include_once('model/M_Sms.php');
include_once('model/M_SmsRasp.php');
include_once('model/M_Rasp.php');
include_once('model/M_Example.php');
include_once('model/M_Setting.php');
include_once('model/M_Sender.php');
include_once('model/M_VK.php');
include_once('model/M_Comment.php');
include_once('lib/parsernews.class.php');
//
// Базовый контроллер сайта.
//
abstract class C_Base extends Controller
{
	protected $needLogin;	// необходимость авторизации 
	protected $user;		// авторизованный пользователь
	protected $alertOk;		// оповещение пользователя
	protected $alertFail;		// оповещение пользователя
	protected $alertNotif;		// оповещение пользователя
	protected $mStar;		// оповещение пользователя
	private $start_time;	// время начала генерации страницы
	protected $mUsers;
	protected $title;
	protected $mVKSender;
	protected $_VKMailing;
	
	//
	// Конструктор.
	//
	function __construct() 
	{
		$this->needLogin = false;
		$this->user = null;	
		$this->mUsers = M_Users::Instance();	
		$this->mVK = M_VK::Instance();
		$this->mUsers = M_Users::Instance();	
		$this->mSmsRasp= M_SmsRasp::Instance();
	}
	
	//
	// Виртуальный обработчик запроса.
	//
	protected function OnInput()
	{
		// Очистка старых сессий и определение текущего пользователя.
				
		$this->mUsers->ClearSessions();		
		$this->user = $this->mUsers->Get();  
	
		// Перенаправление на страницу авторизации, если это необходимо.
		if ($this->user == null && $this->needLogin)
		{       	
			header("Location: index.php");
			die();
		}
		
		
		// Засекаем время начала обработки запроса.
		$this->start_time = microtime(true);
	}
	
	//
	// Виртуальный генератор HTML.
	//	
	protected function OnOutput()
	{
		$parser = new parser();
		$chsu_news = $parser->parseNews();
	    // Основной шаблон всех страниц.
		$vars = array('content' => $this->content,
					'user'=>$this->user,
					'chsu_news'=>$chsu_news,
					'title'=>$this->title,
					'_VKMailing'=>$this->mSmsRasp->verVKMailing($user[id_user]),
					'linkAuthVk'=>"https://oauth.vk.com/authorize?client_id=".CLIENT_ID."&scope=".SCOPE."&redirect_uri=".PATH.OAUTH_CALLBACK."&response_type=code&v=5.24");						
			
		$page = $this->View(THEME.'/tpl_main.php', $vars);
						
		// Время обработки запроса.
        $time = microtime(true) - $this->start_time;        
        $page .= "<!-- Время генерации страницы: $time сек.-->";
        
		// Вывод HTML.
        echo $page;
	}
}
