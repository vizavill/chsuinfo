<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы востановления пароля.
//
class C_Restore extends C_Base {
	
	protected $mReg;  
    protected $mSms;
  	

	//
    // Конструктор.
    //
    function __construct() {
		parent::__construct();
		// Менеджеры.
		$this->mReg = M_Reg::Instance();
		$this->mSms = M_Sms::Instance();

    }

	
    //
    // Виртуальный обработчик запроса.
    //	
    protected function OnInput(){
        
		// C_Base.
		parent::OnInput();

        // Обработка отправки формы.
		if ($this->IsPost())
		{
			//Заносим параметры ПОСТ в переменные
			$this->phone_number = $_POST['phone_number'];
			
			
			//Проверяем а зарегестрирован ли пользователь вообще
			if(!($this->mReg->verUser($this->phone_number))){
				$this->alert="Извините, но пользователь с номером <b>$this->phone_number</b> еще не зарегестрирован! Пройдите процедуру регистрации";
				return;
			}
			//Проверяем сколько сообщений уже отправлено пользователю
			if(($this->mSms->getCountSmsDate(date("H-m-d"), "7".$this->phone_number))==2){
				$this->alert="Извините, но сегодня вы исчерпали лимит входящих SMS от chsu, попробуйте востановить пароль завтра.";
				return;
			}
		
			//Генерируем новый пароль		  
			$password=$this->mReg->getCode();
			
			//Отправляем СМС сообщение
			$arr[] = array( 'to' => "7".$this->phone_number, 'text' =>iconv("CP1251","utf8","Ваш новый пароль на сайте chsuinfo.ru ".$password));
			if($this->mSms->sendArraySms( $arr)){
				//Добавляем пользователя в базу
				$vars = array('password'=>md5($password));
				$this->mReg->recovUser($vars, $this->phone_number);
					
				$this->alert="Пароль успешно восстановлен. В течении 1-2 минут на ваш номер $this->phone_number прийдет СМС сообщение с паролем.";
			}
			else{
				$this->alert="Произошла ошибка попробуйте еще раз.";
			}	
		}
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput(){
		
        // Генерация содержимого страницы
    	$vars = array('alert'=>$this->alert);
    	
    	$this->content = $this->View('tpl_restore.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
		
}