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
	private $now_week;				//текущая учебная неделя
	private $mas_rasp;	           // результат
	protected $mRasp;              // функции расписания
	protected $mSmsRasp;
	protected $view;

	//
    // Конструктор.
    //
    function __construct()
	{        
        parent::__construct();
		// Подключаем менеджер работы с расписанием.
        $this->mRasp = M_Rasp::Instance();
		$this->mUsers = M_Users::Instance();
		$this->mSmsRasp= M_SmsRasp::Instance();
		//Получаем текущую неделю
		$this->now_week = $this->mRasp->get_num_edu_week(date("d-m-Y"));
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput()
	{		
		// C_Base.
		parent::OnInput();
		$this->user = $this->mUsers->Get(); 
		$expire = time() + 3600 * 24 * 100;
		
        // Обработка отправки формы.
		if (($this->IsGet()))
		{	
			$expire = time() + 3600 * 24 * 100;
			
			
			
			if(isset($_GET['view']))
			{
				$this->view = $_GET['view'];
				$_COOKIE['view']=$this->view;
				setcookie("view",$this->view,time()+$expire);
			}
			else
			{
				$this->view = $_COOKIE['view'];
			}
			 
			
			//Обработка основных параметров формы
			//Группа...
			if(isset($_GET['g']))
			{
				$this->sel_grup = $_GET['g'];
				$_COOKIE['sel_grup']=$this->sel_grup;
				setcookie("sel_grup",$this->sel_grup,time()+$expire);
			}
			else
			{
				$this->sel_grup = $_COOKIE['sel_grup'];
			}
			
			//Преподаватель
			if(isset($_GET['l']))
			{
				$this->sel_lecturer = $_GET['l'];
				$_COOKIE['sel_lecturer']=$this->sel_lecturer;
				setcookie("sel_lecturer",$this->sel_lecturer,time()+$expire);
			}
			else
			{
			
				$this->sel_lecturer = $_COOKIE['sel_lecturer'];
			}
			//Неделя
			if(isset($_GET['w']))
			{
				$this->sel_week = $_GET['w'];
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);
			}
			else
			{
				//Ели кука пустая то устанавливаем выбранную неделю в селекте на текущую
				if($_COOKIE['sel_week']==NULL)
				{
					$this->sel_week = $this->now_week;
				}
				else
				{
					$this->sel_week = $_COOKIE['sel_week'];
				}				
			}
			
			if(isset($_GET[p]))
			{
				$this->person = $_GET[p];
				$_COOKIE['person'] = $this->person;
				setcookie("person", $this->person, time()+$expire);
			}
			else
			{
				if(isset($_COOKIE['person']))
					$this->person = $_COOKIE['person'];
				else
				{
					$this->person = "group";
					$_COOKIE['person'] = $this->person;
					setcookie("person", $this->person, time()+$expire);
				}
			}		
		}
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput()
	{
		if($this->person=='lecturer')
		{
			$sel_person=$this->sel_lecturer;
		}
		else
		{
			$sel_person=$this->sel_grup;
		}
		 
		//Получаем массив с расписанием
		$this->mas_rasp=$this->mRasp->rasp($this->sel_week, 'week', $this->person, $sel_person);
		
		//Заголовок страницы
		$this->title = "Расписание ".$sel_person." на ".$this->sel_week." неделю. Череповецкий государственный университет";
		
		$masVK=$this->mSmsRasp->verVKMailing($this->user);
		if(count($masVK)!=0)
			$vk=$masVK[0];
		
		
		// Генерация содержимого страницы Rasp.
      
    	$vars = array(
			'sel_grup'=>$this->sel_grup,
			'sel_lecturer'=>$this->sel_lecturer,
			'sel_week'=>$this->sel_week,			
			'person'=>$this->person,
			'grup'=>$this->mRasp->all_grup(),
			'lecturer'=>$this->mRasp->all_lecturer(),
			'rasp'=>$this->mas_rasp,
            'day1'=>$this->day1,            
			'week'=>52,
			'now_week'=>$this->now_week,
			'vk'=>$vk,
			'user'=>$this->user
            );
			
			if ($_GET['view'] == "block" || $_COOKIE['view'] == "block")
			{
				$this->content = $this->View(THEME.'/tpl_rasp_block.php', $vars);
			}
			else
			{
				$this->content = $this->View(THEME.'/tpl_rasp.php', $vars);
			}
			

		
	
		parent::OnOutput();
    }
}