<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы регистрации.
//
class C_Reg extends C_Base 
{

	private $phone_number;		// логин пользователя
	private $mReg;				// менеджер регистрации
	private $mSms;
	

	//
    // Конструктор.
    //
    function __construct() 
    {
    	parent::__construct();
		//Менеджеры
			$this->mReg = M_Reg::Instance();
			$this->mSms = M_Sms::Instance();
			//$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput(){
	
		// C_Base.
		parent::OnInput();
		
		
		// Обработка отправки формы.
		if ($this->IsPost()){	
		
			//Заносим данные в переменные обрезая пробелы
			$this->phone_number = trim($_POST['phone_number']);
			
			
			//Проверяем есть ли пустые поля
			if($this->phone_number==''){
				$this->alert="Пожалуйста, укажите ваш номер мобильного телефона";
				return;
			}
			
			//Проверяем правильно ли пользователь ввел номер
			if ($this->mReg->verPhone($this->phone_number)){
				$this->alert="Вы неправильно указали номер телефона. Укажите свой номер в соответствии с примером. <b>Пример: 9115148679</b>";
				return;
			}
			
			//Проверяем может пользователь с этим номером уже зарегестрирован
			if($this->mReg->verUser($this->phone_number)){
				$this->alert="Извините, но пользователь с номером $this->phone_number уже зарегистрирован! Если вы забыли пароль вы можете воспользоваться формой востановления пароля";
				return;
			}
			
			//Генерируем пароль		  
			$password=$this->mReg->getCode();
			
		$arr[] = array( 'to' => "7".$this->phone_number, 'text' => iconv("CP1251","utf8","Вы зарегистрировались на сайте chsuinfo.ru Ваш новый пароль ".$password));
			//Отправляем СМС сообщение
			if($this->mSms->sendArraySms( $arr)) {  
	
				// Добавляем пользователя в базу
				$vars = array('phone_number'=>$this->phone_number,
							'password'=>md5($password),
							'id_role'=>'1');
				$this->mReg->addUser($vars);
			
				$this->alert="Вы успешно зарегистрированы. В течении 1-2 минут на ваш номер $this->number прийдет СМС сообщение с паролем.";
			 } 
			else{
				$this->alert="Произошла ошибка попробуйте еще раз.";
			}
		}
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {

        // Генерация содержимого страницы Rasp.
    	$vars = array('alert'=>$this->alert);
							
			                	
    	$this->content = $this->View('tpl_reg.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}