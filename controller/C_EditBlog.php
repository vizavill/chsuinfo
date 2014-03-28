<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы управления блогом.
//
class C_EditBlog extends C_Base 
{
	private $title1;		// текст для преобразования
	private $text;		// текст для преобразования
	private $author;		// текст для преобразования
	private $date_post;		// текст для преобразования
	
	private $mEditBlog;
	

	//
    // Конструктор.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
		// Менеджеры.
		$this->mEditBlog = M_EditBlog::Instance();
		$this->mUsers = M_Users::Instance();	
	}

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		
		
		
		// Обработка отправки формы.
		if ($this->IsPost())
		{
			$this->title1 = $_POST['title'];
			$this->text = $_POST['text'];
			$this->author = $_POST['author'];
			$this->date_post = $_POST['date_post'];
			
			//Проверяем привилегию пользователя
			if (!$this->mUsers->Can('edit_blog')){
				return false;
			}
			
			// Добавляем пользователя в базу
			$vars = array('title'=>$this->title1,
						'text'=>$this->text,
						'author'=>$this->author,
						'date_post'=>$this->date_post);
						
			if ($this->mEditBlog->addPost($vars)){
				$this->alert="Запись успешно добавлена.";
			}
			else{
				$this->alert="Запись не добавлена.";
			}
		}
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {   	
	
        // Генерация содержимого страницы Welcome.
    	$vars = array(
			'alert' => $this->alert);
    	
    	$this->content = $this->View('tpl_edit_blog.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}