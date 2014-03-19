<?php
include_once('MSQL.php');


//
// Менеджер для примера
//
class M_Comment
{
	
	
	
	
    private static $instance; 	// ссылка на экземпляр класса
	public $msql;
	//
	// Получение единственного экземпляра (одиночка)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Comment();
		
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = MSQL::Instance();  

	}
	
	//
	// Новый комментарий
	//
	public function addComment($id, $body)
	{
	  
		mysql_query("INSERT INTO comments(author_id,body)
									VALUES (
										'{$id}',
										'{$body}'
									)");
		
	}
	
	//
	// Удалить комментарий
	//
	public function removeComment($id)
	{
	  
		mysql_query("DELETE FROM comments WHERE `id` = '{$id}'");
		
	}
	
	//
	// Удалить все комментарии
	//
	public function removeAllComments()
	{
	  
		mysql_query("DELETE FROM comments");
		
	}
}
