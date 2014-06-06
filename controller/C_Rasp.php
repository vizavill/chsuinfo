<?php
include_once('controller/C_Base.php');
include_once('lib/comment.class.php');
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

	//
    // Конструктор.
    //
    function __construct()
	{        
        parent::__construct();
		// Подключаем менеджер работы с расписанием.
        $this->mRasp = M_Rasp::Instance();
		$this->mUsers = M_Users::Instance();
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
		$expire = time() + 3600 * 24 * 100;
		
        // Обработка отправки формы.
		if (($this->IsGet()))
		{	
			$expire = time() + 3600 * 24 * 100;
			
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
			if(isset($_GET['w'])){
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
				
				$this->person = $_COOKIE['person'];
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
		 
		$this->mas_rasp=$this->mRasp->rasp($this->sel_week, 'week', $this->person, $sel_person);
		$this->title = "Расписание ".$sel_person." на ".$this->sel_week." неделю.";
		
		/* Не требуется так как подгрузка будет осуществляться с помощью ajax
		
		//Последние 5 комментариев
		$arrComments = $this->mRasp->get_comments();
		$this->user =  $this->mUsers->Get();
		$reverseAC = array_reverse($arrComments);
		//$ttest = var_dump($arrComments);
		$insertedComment = new Comment();
		foreach($reverseAC as $comment){
			$user = $this->mUsers->Get($comment['author_id']);
			$comment_body = iconv("UTF-8", "WINDOWS-1251", $comment['body']);
			
			$commentData = array(
								"body"=>$comment_body,
								"id"=>$comment['id'],
								"id_role"=>$this->user['id_role'],
								"id_vk"=>$user['id_vk'],
								"photo"=>$user['photo_200'],
								"full_name"=>$user['first_name'].' '.$user['last_name']
								);
			$insertedComment->setData($commentData);		
			$htmlComments .= $insertedComment->markup();
		}
		*/
		
		// Генерация содержимого страницы Rasp.
      
    	$vars = array(
			//'html_comments'=>$htmlComments,
			//'comments'=>$this->mRasp->get_comments(),
			'sel_grup'=>$this->sel_grup,
			'sel_lecturer'=>$this->sel_lecturer,
			'sel_week'=>$this->sel_week,
			'sel_person'=>$sel_person,
			'person'=>$_COOKIE['person'],
			'grup'=>$this->mRasp->all_grup(),
			'lecturer'=>$this->mRasp->all_lecturer(),
			'rasp'=>$this->mas_rasp,
            'day1'=>$this->day1,            
			'week'=>52,
			'now_week'=>$this->now_week,
            );
		
			$this->content = $this->View(THEME.'/tpl_rasp.php', $vars);

		
	
		parent::OnOutput();
    }
}