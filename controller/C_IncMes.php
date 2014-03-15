<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы-примера.
//
class C_IncMes extends C_Base {
	private $num;		       // сервисный номер
	private $phoneNumber;            // номер абонента
	protected $mRasp;          // собственно сообшение (в кодировке UTF-8)
	private $message; 
	

	             //

	//
    // Конструктор.
    //
    function __construct() {
        
        parent::__construct();
		// Менеджеры.
        $this->mIncMes = M_IncMes::Instance();
		$this->mStar = M_Starosta::Instance();
		$this->mSms = M_Sms::Instance();
		$this->mRasp = M_Rasp::Instance();
		$this->mSender = M_Sender::Instance();
		
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
			if (!$this->mIncMes->getRegisterPhone($this->phoneNumber)){
				return;
			}
			
			//Смотрим что хочет пользователь
			$day=$this->mIncMes->verifySms($this->message);
			
			if($day=="sg"){
				$date=date("d-m-Y");
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1ПИ-311");
			}
			if($day=="zv"){
				$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1ПИ-311");
			}
			if($day="pz"){
				$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+2, date("Y")));
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1ПИ-311");
			}
			
			if(count($mas_rasp)!=0){
				$sms="Занятия на ".$date." число, ".$value[person]."\n"; 
				foreach($mas_rasp as $value2){
					$mas_word=$this->mSender->dali($value2[discip]);
					$discip=$this->mSender->sokrat($mas_word);
					$address=implode("",$this->mSender->dali($value2[address]));
					$time=implode("",$this->mSender->dali($value2[time]));
					$sms=$sms."$time\n $discip\n $address\n ";
				}
			}
			else{
				
				//$sms= "Занятий на ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." число не найдено\n";
			}
			$arr[] = array( 'to' => "7".$this->phoneNumber, 'text' =>iconv("CP1251","utf8",$sms));
			//Отправляем СМС сообщение
			$this->mSms->sendArraySms( $arr);
			
		}
		//if($this->mInc_mes->phone_starosta($_POST['phone']))
		
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() {
	
		print_r($this->mRasp->rasp(date("d-m-Y"), "date", "grup", "1ПИ-311"));
			
    
    // Генерация содержимого страницы Rasp.
      
    	
//parent::OnOutput();
		
    }
}