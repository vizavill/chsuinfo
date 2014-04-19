<?php
include_once('controller/C_Base.php');
include_once('lib/comment.class.php');

class C_Comment extends C_Base {
	private $arr;
	private $validates;
	private $code_msg;
	protected $mRasp;
	
    function __construct()
	{        
        parent::__construct();
        $this->needLogin = true;
		$this->mRasp = M_Rasp::Instance();
        $this->mUsers = M_Users::Instance();	
		$this->mComm = M_Comment::Instance();
    }

    protected function OnInput()
	{	
		
		$this->user = $this->mUsers->Get();
		
		if(isset($_POST['page'])){
			$page = addslashes($_POST['page']);
			//Настройки
			$cur_page = $page;
			$page -= 1;
			$per_page = 5;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;
			
			//Вывод 5ти комментариев
			$arrComments = $this->mRasp->get_comments();
			$insertedComment = new Comment();
			foreach($arrComments as $comment){
				$user = $this->mUsers->Get($comment['author_id']);
				$comment_body = $comment['body'];
				
				$commentData = array(
									"body"=>$comment_body,
									"id"=>$comment['id'],
									"id_role"=>$this->user['id_role'],
									"id_role_a"=>$user['id_role'],
									"id_vk"=>$user['id_vk'],
									"photo"=>$user['photo_200'],
									"full_name"=>$user['first_name'].' '.$user['last_name']
									);
				$insertedComment->setData($commentData);		
				$htmlComments .= $insertedComment->markup();				
			}
				
			//Вывод разметки комментариев с этой страницы
			$this->code_msg = $htmlComments;
		}else{
			if($this->user !== null){
			
				if (isset($_POST['comment'])){
					$this->arr = array();
					$this->arr['body'] = $_POST['comment'];
					$this->validates = Comment::validate($this->arr);
					$this->code_msg = '';
					
					if($this->validates){
						/* Все в порядке, вставляем данные в базу: */
						$this->mComm->addComment($this->user['id_user'], $this->arr['body']);
						
						$this->arr['dt'] = date('r',time());
						$this->arr['id'] = mysql_insert_id();
						$this->arr['photo'] = $this->user['photo_200'];
						$this->arr['full_name'] = $this->user['first_name'].' '.$this->user['last_name'];
						//$this->arr['full_name'] = iconv("WINDOWS-1251", "UTF-8", $this->user['first_name'].' '.$this->user['last_name']);
						/*
						/	Данные в $arr подготовлены для запроса mysql,
						/	но нам нужно делать вывод на экран, поэтому 
						/	готовим все элементы в массиве:
						/*/
						
						$this->arr = array_map('stripslashes',$this->arr);
						$commentData = array(
											"body"=>$this->arr['body'],
											"id"=>$this->arr['id'],
											"id_vk"=>$this->user['id_vk'],
											"id_role"=>$this->user['id_role'],
											"photo"=>$this->arr['photo'],
											"full_name"=>$this->arr['full_name']
											);
						
						$insertedComment = new Comment($commentData);
						$htmlComment = $insertedComment->markup();
						
						//$htmlComment = iconv("WINDOWS-1251","UTF-8", $htmlComment);
						/* Вывод разметки только-что вставленного комментария: */
						$this->code_msg = json_encode(array('status'=>1,'html'=>$htmlComment));

					}
					else
					{
						/* Вывод сообщений об ошибке */
						$this->code_msg =  '{"status":0,"errors":'.json_encode($this->arr).'}';
					}
				}else if(isset($_POST['delete'])){
					if($this->user['id_role'] == 4)
						if ($_POST['delete'] !== 'all'){
							$this->mComm->removeComment($_POST['delete']);
							$this->code_msg = '{"status":1}';
						}else if($_POST['delete'] == 'all'){
							$this->mComm->removeAllComments();
							$this->code_msg = '{"status":1}';
						}
				}
			}else{
				//$this->code_msg = '{"status":0,"errors":{"body":"'.iconv("WINDOWS-1251", "UTF-8",'Авторизируйтесь, чтобы добавлять комментарии.').'"}}';	
				$this->code_msg = '{"status":0,"errors":{"body":"Авторизируйтесь, чтобы добавлять комментарии."}}';	
			}
		}
	}

    //
    // Ae?ooaeuiue aaia?aoi? HTML.
    //
    protected function OnOutput()
	{
		echo $this->code_msg;
    }
}