<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы управления блогом.
//
class C_Blog extends C_Base 
{
	private $title;		// текст для преобразования
	private $text;		// текст для преобразования
	private $author;		// текст для преобразования
	private $date_post;		// текст для преобразования
	private $allPost;
	private $mBlog;
	

	//
    // Конструктор.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
		// Менеджеры.
	
		$this->mBlog = M_Blog::Instance();
		
	}

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		
		
		
		
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {   	
		$this->allPost=$this->mBlog->getAllPost();
		
		if(!count($this->allPost)){
			$this->alert="Пока записей в блоге нет";
		}
	
        // Генерация содержимого страницы Welcome.
    	$vars = array(
			'allPost' => $this->allPost,
			'alert' => $this->alert, 
			);
    	
    	$this->content = $this->View('tpl_blog.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}