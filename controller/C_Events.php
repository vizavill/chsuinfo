<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы мероприятий.
//
class C_Events extends C_Base 
{
	private $title;		// текст для преобразования
	private $text;		// текст для преобразования
	private $author;		// текст для преобразования
	private $date_post;		// текст для преобразования
	private $event;
	private $mEvents;
	

	//
    // Конструктор.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
		// Менеджеры.
	
		$this->mEvents = M_Events::Instance();
		
	}

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		if ($this->IsPost()){
			$id_user=	$this->user[id_user];
				$title=		trim($_POST[title]);
				$text=		trim($_POST[text]);
				$url_event=	trim($_POST[url_event]);
				$date_event=trim($_POST[date_event]);
				$time_event=trim($_POST[time_event]);
				$inst=		trim($_POST[inst]);
				$picture=	trim($_FILES[picture]);
				$id_event=	trim($_POST[id_event]);
				$handle = new Upload($_FILES[picture]);
				$handle->image_resize        = true;
				$handle->image_x             = 130;
				$handle->image_y             = 130;
				$handle->image_ratio         = true;
				$handle->image_resize            = true;
				$handle->image_ratio_fill        = true;
				$handle->image_ratio             = true;
				$handle->image_background_color  = "#FFFFFF";
				$savepath = "img_event";
				$handle->Process($savepath);
				
				
				$picture=$handle->file_dst_name; 
				
				
				$handle->Clean();
		
		
		
			if(isset($_POST[add_event])){
				
				$vars = array('id_user'=>$id_user,
							'title'=>$title,
							'text'=>$text,
							'url_event'=>$url_event,
							'date_event'=>$date_event,
							'time_event'=>$time_event,
							'picture'=>$picture,
							'inst'=>$inst,
							'status'=>0);
				if (!$this->mEvents->addEvent($vars)){
					$this->alert="Ошибка при добавлении в базу.";
					return;
				}
			}
			
			if(isset($_POST[edit_event]) && ($id_user==$this->user[id_user])){
				
				
				$vars = array('id_user'=>$id_user,
							'title'=>$title,
							'text'=>$text,
							'url_event'=>$url_event,
							'date_event'=>$date_event,
							'time_event'=>$time_event,
							'picture'=>$picture,
							'inst'=>$inst,
							'status'=>0);
				if (!$this->mEvents->updEvent($vars, $id_event, $id_user)){
					$this->alert="Ошибка при добавлении в базу.";
					return;
				}
			}
			
			
		}
		if ($this->IsGet()){
			if(isset($_GET[id]) && ($_GET[act]=='edit')){
				$this->event=$this->mEvents->getEvent(($_GET[id]));
				
			}
		}
		if ($this->IsGet()){
			if(isset($_GET[id]) && ($_GET[act]=='delete')){
				$this->mEvents->delEvent($_GET[id], $this->user[id_user]);
				echo "ddd";
			}
		}
		
		
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {   	
		$allEvent=$this->mEvents->getAllEvents($this->user[id_user]);
		$userEvent=$this->mEvents->getUserEvents($this->user[id_user]);
		$i=0;
		foreach ($userEvent as $value){
			switch($value[status]){
				case 0: $userEvent[$i][status]='проверяется, показы пока не идут'; break;
				case 1: $userEvent[$i][status]='одобренно, идут показы'; 	break;
				case 2: $userEvent[$i][status]='отклонено'; 	break;
				}
			$i++;
		}
		
		
	
        // Генерация содержимого страницы Welcome.
    	$vars = array(
			'allEvent' => $allEvent,
			'userEvent' => $userEvent,
			'event'=>$this->event[0],
			
			
			
			'alert' => $this->alert, 
			);
    	
    	$this->content = $this->View('tpl_events.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}