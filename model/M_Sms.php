<?php
include_once('MSQL.php');

//
// Менеджер отправки смс сообщений
//
class M_Sms
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Sms();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct(){
		$this->msql   = MSQL::Instance();
	}
    
	//
	// Функция массива смс
	///
	public function sendArraySms($arraySms){
		$apikey = 'V5MT4Y7HF55N5SJ2QV926QT8JKE7RI02K8SR1U2X1NFAU995JQ345LXJQI1TS89A'; // заменить на свой!
		$send = array(
				'apikey' => $apikey,
				'send' => $arraySms
		);
		$result = file_get_contents('http://smspilot.ru/api2.php', false, stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode( $send ),
		),
		)));
		//$result=iconv("utf-8","cp1251_general_ci",$result);
		$report=json_decode( $result, true );
		//$report=iconv("utf-8","cp1251_general_ci",$report);
		foreach($report[send] as $value){
		//$value=iconv("utf-8","cp1251_general_ci",$value);
		$vars = array('server_id'=>$value[server_id],
							'from_sms'=>$value[from],
							'to_sms'=>$value[to],
							'text'=>iconv("utf-8","cp1251",$value[text]),
							'zone'=>$value[zone],
							'parts'=>$value[parts],
							'credits'=>$value[credits],
							'status'=>$value[status],
							'error'=>$value[error],
							'server_packet_id'=>$report[server_packet_id],
							'balance'=>$report[balance],
							'send_date'=>date("H-m-d"),
							'country'=>$value[country]);
							
				$this->addReport($vars);
				
		}
		if ($report[send][status]==0)
			return true;
		else
			return false;
		
	}
	
	//
	// Функция возвращает количество переданных смс на дату
	//
	
	public function getCountSmsDate($date, $phone_number){

		return count($this->msql->Select("SELECT * FROM sms_report WHERE send_date='$date' AND to_sms='$phone_number'"));
	
	}
   
   
	
	
	//
	// Функция добавления ответа сервера в БД.
	//
	private function addReport($object){

		$this->msql->Insert('sms_report',$object);	
	}
   
   }
		
    
?>
