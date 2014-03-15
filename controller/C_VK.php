<?php
include_once('controller/C_Base.php');

class C_VK extends C_Base {
	
	public $mVK;
	public $token;
	
	
	//
    // Конструктор.
    //
    function __construct()
	{
		parent::__construct();
		// Менеджеры.
        $this->mVK = M_VK::Instance();
		$this->token = $this->mVK->OAuth(LOGIN, PASSWORD);
		
    }

	
    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput()
	{	
		//получаем друзей учика
		$friend=$this->mVK->FriendGet($this->token);
		
		$message=$this->mVK->getMessage();
		
		for ($i=0;$i<count($message);$i++)
		{$f=false;
		
		foreach($friend[response] as $value)
		{	
			if($value==$message[$i][id_vk])
			{
				$f=true;
			}
			else
			{
				
			}
		}
	
		
		if ($f)
			{
			
				//отправляем сообщение
				 echo $response = $this->mVK->MsgToUser($message[$i][id_vk], $message[$i][message].  $this->mVK->link, '',"Расписание_на_завтра", $this->token);
				if ($response == "ok")
				{
					$this->mVK->SetStatusSend($message[$i][id]);
				
				} 
				else 
				{
					
					$this->mVK->SetStatusError($message[$i][id]);
			
				}
				
			}
			else
			{
				$response = $this->mVK->MsgToUser($message[$i][id_vk], "Что бы получать расписание в сообщение добавте меня в друзья, это связано с тем что ВКонтакте ограничило число сообщений отправляемых людям, которые не находятся в списке друзей".  $this->mVK->link, '',"Ошибка_рассылки", $this->token);
				
				if ($response == "ok")
				{
					$this->mVK->SetStatusSend($message[$i][id]);
	
				} 
				else 
				{
					
					$this->mVK->SetStatusError($message[$i][id]);
					echo "error";
	
				}
			}
		
		
		
	sleep(5);
	}

		// C_Base.
        //parent::OnOutput();
	
    }
}