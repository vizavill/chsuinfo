<?php
include_once('controller/C_Base.php');

class C_Sender extends C_Base {
	//
    // Конструктор.
    //
    function __construct() 
	{
		parent::__construct();
		// Менеджеры.
        $this->mSender = M_Sender::Instance();
		$this->mSms = M_Sms::Instance();
		$this->mRasp = M_Rasp::Instance();
		$this->mVK = M_VK::Instance();
    }


    protected function OnOutput()
	{
		//Если сегодня суббота то рассылку на воскресение не проризводим
		if (date("D")=="Sat"){
			echo "Завтра выходной</br>";
			return false;
		}
		
		//Получаем завтрашнюю дату
		$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));

		//Получаем список подписок  на текущий час
		$mas=$this->mSender->mailing_list();
		echo "<pre>";
		print_r($mas);
		echo"</pre>";
	
		//Бежим по массиву подписок
		foreach ($mas as $value)
		{
			$user=$this->mUsers->Get($value[id_user]);
			
			//Обнуляем переменную содержащую сообщение
			$sms='';
			
			//Получаем расписание для подписчика на завтра
			$rasp_day=$this->mRasp->get_rasp_day($date,$user['type'],$user['person']);
						
			//Проверяем есть ли пары если есть формируем сообщение
			if(count($rasp_day)!=0)
			{	
				//Начало сообщения
				$sms="Занятия на ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." число, ".$user[person]."\n\n"; 	
				
				foreach($rasp_day as $value2)
				{					
					$sms=$sms."$value2[para] пара $value2[start_time]-$value2[end_time]\n"."    "."$value2[discip]\n $value2[lecturer] $value2[address]\n\n ";
				}
			}
			else //Если пары не найдены
			{			
				$sms= "Занятий на ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." число не найдено\n";
			}			
	
			
			//Если сообщение не пустое то отправляем его
			if($sms!='')
			{
				$arrayVK[] = array('id_vk' =>$user[id_vk], 'message' => $sms, 'time'=>$value['time']);				
			}
		}
		
		if(count($arrayVK))
		{	
			$fr=false;
			//получаем друзей учика
			$friend=$this->mVK->FriendGet($this->mVK->token);
			
			foreach ($arrayVK as $val)
			{
				foreach($friend[response] as $val2)
				{
					if($val[id_vk]==$val2)
					{
						$fr=true;
						break;
					}
					
				}
				
				if(!$fr)
				{	
					$val[message] = "Чтобы получать расписание в сообщении, добавте меня в друзья, это связано с тем, что сайт ВКонтакте ограничил число сообщений, отправляемых людям, которые не находятся в списке друзей.";
				}
				

				$response = $this->mVK->MsgToUser($val[id_vk], $val[message].  $this->mVK->link, '',"", $this->mVK->token);
				sleep(3); 
		
				if($response=="ok") 
				{
					echo "</br>".$val[id_vk]." отправлено</br>";
				}
				else
				{
					$vars = array('id_vk'=>$val[id_vk],
							'message'=>"error",
							'time'=>1);
							
				 
					$this->mSender->AddVKMailing($vars);
					echo "</br>".$val[id_vk]." error</br>";
				}			
			}				
		}
		else
		{
			echo "в массиве нет записей";	
		}
			
		
		

		// C_Base.
        //parent::OnOutput();
	
    }
}