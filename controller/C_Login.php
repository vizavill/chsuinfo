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
		$this->mVK = M_VK::Instance();
		$this->mVK2 = M_VK2::Instance();
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
				$token = $this->mVK2->GetAccessTokenVK($_GET['code']);

				if($token){
					$userInfo = $this->mVK2->UserGetInfo($token);

					//Проверяем есть ли базе пользователь если нет то заполняем , подумать а зачем?
					if(!$this->mUsers->GetByidVk($userInfo[uid]))
					{
						// Добавляем пользователя в базу
						$vars = array('id_vk'=>$userInfo[uid],
									  'sex'=>$userInfo[sex],
									  'first_name'=>$userInfo[first_name],
									  'last_name'=>$userInfo[last_name],
									  'photo_200'=>$userInfo[photo_200_orig],
									  'id_role'=>'1');
						//var_dump($user_info);
						$this->mUsers->regVkUser($vars);
					}
					$this->mUsers->LoginVk($userInfo[uid], $token,true);
				}
			}
		}

		header('Location: index.php');
		die();
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {
		//TODO Убрать это наверн
		// Генерация содержимого формы входа.
        $vars = array('alert' =>$this->alert);        
    	$this->content = $this->View('tpl_restore.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}