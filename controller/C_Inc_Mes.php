<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы-примера.
//
class C_Inc_mes extends C_Base {
	private $num;		       // сервисный номер
	private $phoneNumber;            // номер абонента
	private $message;          // собственно сообшение (в кодировке UTF-8)

	protected $mRasp;              //

	//
    // Конструктор.
    //
    function __construct() {
        
        parent::__construct();
		// Менеджеры.
        $this->mInc_mes = M_Inc_mes::Instance();
		$this->mStar = M_Starosta::Instance();
		$this->mSms = M_Sms::Instance();
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput(){
        
		// C_Base.
		parent::OnInput();
		
        // Обработка отправки формы.
		if ($this->IsPost()){
		  
			$this->num = $_POST['num'];
			$this->phoneNumber = substr($_POST['phone'],1);
			$this->message = $_POST['message'];
			
			//Проверяем зарегистрирован номер или нет
			if (!$this->mInc_mes->getRegisterPhone($this->phoneNumber)){
				return;
			}
			
			//Смотрим что хочет пользователь
			$this->mSms->send( 9535231282, ($this->mInc_mes->verifySms($this->message)));
		}
		//if($this->mInc_mes->phone_starosta($_POST['phone']))
		
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {
	
	
    
    // Генерация содержимого страницы Rasp.
      
    	
 parent::OnOutput();
		
    }
}