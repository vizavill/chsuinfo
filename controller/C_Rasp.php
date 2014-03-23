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
		$this->mUsers = M_Users::Instance();	
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
			
			if(isset($_GET[person]))
			{
				$this->person = $_GET[person];
				$_COOKIE['person'] = $this->person;
				setcookie("person", $this->person, time()+$expire);
			}
			
			if($_GET[week]=='forward')
			{	
				$this->sel_week = $_COOKIE['sel_week']+1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);
			}
			if ($_GET[week]=='back')
			{

				$this->sel_week = $_COOKIE['sel_week']-1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);			
			}
			
		}
		
		
		if (($this->IsPost()))
		{	
			if(isset($_POST['sel_grup']))
			{
				$this->sel_grup = $_POST['sel_grup'];
				$_COOKIE['sel_grup']=$this->sel_grup;
				setcookie("sel_grup",$this->sel_grup,time()+$expire);
				
			}
			
			if(isset($_POST['sel_lecturer']))
			{
				$this->sel_lecturer = $_POST['sel_lecturer'];
			   

		
			
			$_COOKIE['sel_lecturer']=$this->sel_lecturer;
		  
			setcookie("sel_lecturer",$this->sel_lecturer,time()+$expire);
			}

			
			
			
			
			$this->sel_week = $_POST['sel_week'];
				$_COOKIE['sel_week']=$this->sel_week;
			setcookie("sel_week",$this->sel_week,time()+$expire);
		}
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput()
	{
		if($_COOKIE['person']=='lecturer' || $this->person=='lecture')
		{
			$type=$_COOKIE['sel_lecturer'];
		}
		else
		{
			$type=$_COOKIE['sel_grup'];
		}
		 
		$this->mas_rasp=$this->mRasp->rasp($_COOKIE['sel_week'], 'week', $_COOKIE['person'], $type);
		
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
			'person'=>$_COOKIE['person'],
			'grup'=>$this->mRasp->all_grup(),
			'lecturer'=>$this->mRasp->all_lecturer(),
			'rasp'=>$this->mas_rasp,
            'day1'=>$this->day1,            
			'week'=>52,
			'now_week'=>$this->mRasp->get_num_edu_week(date("d-m-Y")),
            );
		
			$this->content = $this->View(THEME.'/tpl_rasp.php', $vars);

		
	
		parent::OnOutput();
    }
}