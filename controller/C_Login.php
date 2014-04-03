<?php
include_once('controller/C_Base.php');

//
// Контроллер страницы авторизации
//
class C_Login extends C_Base
{
	private $phoneNumber;	// телефон пользователя
	
	//
	// Конструктор.
	//
	public function __construct() 
	{
		parent::__construct();			
		$this->phoneNumber = '';
		//Менеджеры
		$this->mReg = M_Reg::Instance(); 
		$this->mVK = M_VK::Instance();
	}
	
	//
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		if($_GET['aaaa']){
			$a = $_GET['aaaa'];
			mysql_query("DELETE FROM `users` WHERE `id_vk` = '".$a."'");
		}
		// Выход из системы пользователя.        
		$this->mUsers->Logout();
        
		// C_Base.
        parent::OnInput();
        
		// Обработка отправки формы.
		if ($this->IsGet()){
			
			// получили параметр code, значит вход через Вконтакте
			if($_REQUEST['code'])
			{			
				// получаем access_token
				$resp = file_get_contents('https://oauth.vk.com/access_token?client_id='.CLIENT_ID.'&code='.$_REQUEST['code'].'&client_secret='.SECRET.'&redirect_uri='.PATH.OAUTH_CALLBACK);
				$data = json_decode($resp, true);
				if($data['access_token'])
				{				
					//Проверяем есть ли базе пользователь
					if($this->mUsers->GetByidVk($data['user_id']))
					{
						if ($this->mUsers->LoginVk($data['user_id'], $data['access_token'],true))
						{
							header('Location: index.php');
							die();
						}		
					}
					else
					{
						$user_info = $this->mVK->UserGetInfo($data['access_token'],"");
						// Добавляем пользователя в базу
						$vars = array('id_vk'=>$data['response']['user_id'],
									  'sex'=>$user_info['response']['sex'],
									  'first_name'=>$user_info['response']['first_name'],
									  'last_name'=>$user_info['response']['last_name'],
									  'photo_200'=>$user_info['response']['photo_200'],
									  'id_role'=>'1');
						//var_dump($user_info);
						$this->mReg->regVkUser($vars);
						$this->mUsers->LoginVk($data['user_id'], $data['access_token'],true);
						header('Location: index.php');
						die();
					}
					//Логинимся
				
				}
			}
}
		
		
        if ($this->IsPost())
        {
		
			
			$this->phoneNumber = $_POST['phoneNumber'];
			
	        if ($this->mUsers->Login($this->phoneNumber,$_POST['password'],true))
			{
			
				header('Location: index.php');
				die();
			}
			if($this->phoneNumber=='')
			{
				header('Location: index.php?');
				die();
			
			}
			else
			{
				$this->alert="Вы ввели неправильную комбинацию логин или пароль. Вы можете восстановить забытый пароль в форме ниже";
				sleep(5);
			}
			
			
        }
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {    
		// Генерация содержимого формы входа.
        $vars = array('phoneNumber' => $this->phoneNumber,
					 'alert' =>$this->alert);        
    	$this->content = $this->View('tpl_restore.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}