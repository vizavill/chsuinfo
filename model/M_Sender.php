<?php
include_once('MSQL.php');

//
// Менеджер для примера
//
class M_Sender
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Sender();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct(){
		$this->msql   = MSQL::Instance();
	}
    
	//
	// Функция добавления рассылки расписания в VK 
	//
	public function AddVKMailing($object)
	{
	  
		$this->msql->Insert('vk_mailing',$object);
		
	}
	
	
    //
    //Функция удаления пользователей из SMS рассылки у которых кончился срок рассылки
    //
    function clear()
	{
		$now_day=date('Y-m-d');
		$this->msql->Delete("mailing", "message_type='sms' AND mailing_end<'$now_day'");
		
	}
	
    //
    //Получает список подписчиков для рассылки на текущий час 
    //
    function mailing_list()
	{
        $now_hour=date('H');
        $now_day=date('Y-m-d');
		return $this->msql->Select("SELECT * FROM mailing WHERE (time='$now_hour')");
    }
    
    //
    //Функция разбиения названия предмета на отдельные слова
    //
	public function dali($string)
	{
		$i=1;
		$tok = strtok($string, " ");
		while($tok){
			$mas[$i]=$tok;
			$i++;
			$tok = strtok(" ");
		}
		return $mas;
	}
	//
    //Функция сокращения слова
    //
	public function sokrat($mas)
	{
		$len=4;
		$vowel=array('а','у','о','ы','и','э','я','ю','ё','е','ь','ъ');
		$out_string='';
		foreach($mas as $string){
			$len_str=strlen($string);
			if($len<=$len_str){
				$str=substr($string,0,$len);
				foreach($vowel as $value){
					if($str[$len-1]==$value){
						$str=substr($string,0,$len+1);
					}
						
				}
				$out_string.=$str." ";
			}
			else{
				$out_string.=$string." ";
			}
		}
		return $out_string;
	}	
		

    
}
