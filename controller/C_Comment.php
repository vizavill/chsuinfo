<?php
include_once('controller/C_Base.php');
include_once('lib/comment.class.php');

class C_Comment extends C_Base {
	private $arr;
	private $validates;
	private $code_msg;
	
    function __construct()
	{        
        parent::__construct();
        $this->needLogin = true;
        $this->mUsers = M_Users::Instance();	
		$this->mComm = M_Comment::Instance();
    }

    protected function OnInput()
	{	
		
		$this->user = $this->mUsers->Get();
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
					$this->arr['full_name'] = iconv("WINDOWS-1251", "UTF-8", $this->user['first_name'].' '.$this->user['last_name']);
					/*
					/	Данные в $arr подготовлены для запроса mysql,
					/	но нам нужно делать вывод на экран, поэтому 
					/	готовим все элементы в массиве:
					/*/
					
					$this->arr = array_map('stripslashes',$this->arr);
					
					//$insertedComment = new Comment($this->arr);
					//$htmlComment = $insertedComment->markup();
					$htmlComment = '
						<div class="commVk">
							<div class="img-comm"><img width="50" src="'.$this->arr['photo'].'"></div>
							<div class="comm-text">
								<div class="comm-name">'.$this->arr['full_name'].'</div>
								<div class="commentVk">'.$this->arr['body'].'<a href="#"></a></div>
							</div>
							<div class="commentPanel">
								<a href="#" id="panLink"><img src="./images/del.png"></a><br>
								<a href="#" id="panLink"><img src="./images/vk_c.png"></a><br>
								<a href="#" id="panLink"><img src="./images/ext.png"></a>
							</div>
						</div>
					';
					/* Вывод разметки только-что вставленного комментария: */
					$this->code_msg = json_encode(array('status'=>1,'html'=>$htmlComment));

				}
				else
				{
					/* Вывод сообщений об ошибке */
					$this->code_msg =  '{"status":0,"errors":'.json_encode($this->arr).'}';
				}
			}else{
				if (isset($_GET['delete']) and $_GET['delete'] !== 'all'){
					$this->mComm->removeComment($_GET['delete']);
				}else if(isset($_GET['delete']) and $_GET['delete'] == 'all'){
					$this->mComm->removeAllComments();
				}
				//$this->code_msg = '{"status":0,"errors":{"body":"Not post"}}';
			}
		}else{
			$this->code_msg = '{"status":0,"errors":{"body":"'.iconv("WINDOWS-1251", "UTF-8",'Авторизируйтесь, чтобы добавлять комментарии.').'"}}';
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