<?php
include_once('controller/C_Base.php');

//
// Контроллер страницы авторизации
//
class C_Login extends C_Base
{
	
	
	//
	// Конструктор.
	//
	public function __construct() 
	{
		parent::__construct();			
		
		//Менеджеры
		$this->mReg = M_Reg::Instance(); 
		$this->mVK = M_VK::Instance();
	}
	
	//
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// Выход из системы пользователя.        
		$this->mUsers->Logout();
		
        
		// C_Base.
        parent::OnInput();
        
		// Обработка отправки формы.
		if ($this->IsGet())
		{	
			
			// получили параметр code, значит вход через Вконтакте
			if($_GET['code'])
			{	
				
				// получаем access_token
				$resp = file_get_contents('https://oauth.vk.com/access_token?client_id='.CLIENT_ID.'&code='.$_GET['code'].
				'&client_secret='.SECRET.
				'&redirect_uri='.PATH.OAUTH_CALLBACK);
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
					//Если пользователя нет 
					else
					{
						$uf = $this->mVK->UserGetInfo($data['access_token'],"");
						$user_info = $uf['response'][0];
						// Добавляем пользователя в базу
						$vars = array('id_vk'=>$data['user_id'],
									  'sex'=>$user_info['sex'],
									  'first_name'=>$user_info['first_name'],
									  'last_name'=>$user_info['last_name'],
									  'photo_200'=>$user_info['photo_200_orig'],
									  'id_role'=>'1');
						//var_dump($user_info);
						$this->mReg->regVkUser($vars);
						if ($this->mUsers->LoginVk($data['user_id'], $data['access_token'],true))
						{
							header('Location: index.php');
							die();
						}	
					}
				}
			}
		}
		else
		{
			header('Location: index.php');								
			die();
		}
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {    
		// Генерация содержимого формы входа.
        $vars = array('alert' =>$this->alert);        
    	$this->content = $this->View('tpl_restore.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}