<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы показа расписания.
//
class C_Rasp extends C_Base {
	private $sel_week;             // выбранная неделя
	private $sel_grup;             // выбранная группа
	private $sel_lecturer;         // выбранный преподаватель
	private $person;           		// (преподаватель или группа)
	private $mas_rasp;	           // результат
	protected $mRasp;              //

	//
    // Конструктор.
    //
    function __construct()
	{        
        parent::__construct();
		// Подключаем менеджер работы с расписанием.
        $this->mRasp = M_Rasp::Instance();
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput()
	{
        
		// C_Base.
		parent::OnInput();
		
        // Обработка отправки формы.
		if (($this->IsGet()))
		{
			if($_GET[week]=='forward')
			{		
				$expire = time() + 3600 * 24 * 100;
				$this->sel_week = $_COOKIE['sel_week']+1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);
			}
			if ($_GET[week]=='back')
			{
				$expire = time() + 3600 * 24 * 100;
				$this->sel_week = $_COOKIE['sel_week']-1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);			
			}
			
		}
		
		
		if (($this->IsPost()))
		{
			$expire = time() + 3600 * 24 * 100;
			$this->sel_grup = $_POST['sel_grup'];
			$this->sel_lecturer = $_POST['sel_lecturer'];
			$this->sel_week = $_POST['sel_week'];
			$this->person = $_POST['person'];
    

			$_COOKIE['person']=$this->person;
			$_COOKIE['sel_week']=$this->sel_week;
			$_COOKIE['sel_grup']=$this->sel_grup;
			$_COOKIE['sel_lecturer']=$this->sel_lecturer;
		  
			setcookie("sel_grup",$this->sel_grup,time()+$expire);
			setcookie("sel_lecturer",$this->sel_lecturer,time()+$expire);
			setcookie("sel_week",$this->sel_week,time()+$expire);
			setcookie("person",$this->person,time()+$expire);
		}
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput()
	{
		if($_COOKIE['person']=='lecturer')
		{
			$type=$_COOKIE['sel_lecturer'];
		}
		else
		{
			$type=$_COOKIE['sel_grup'];
		}
		 
		$this->mas_rasp=$this->mRasp->rasp($_COOKIE['sel_week'], 'week', $_COOKIE['person'], $type);
   
		// Генерация содержимого страницы Rasp.
      
    	$vars = array(
			'grup'=>$this->mRasp->all_grup(),
			'lecturer'=>$this->mRasp->all_lecturer(),
			'rasp'=>$this->mas_rasp,
            'day1'=>$this->day1,            
			'week'=>52,
			'now_week'=>$this->mRasp->get_num_edu_week(date("d-m-Y"))          
            );
		
			$this->content = $this->View(THEME.'/tpl_rasp.php', $vars);

		
	
		parent::OnOutput();
    }
}