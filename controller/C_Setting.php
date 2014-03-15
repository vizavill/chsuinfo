<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы управления профилем.
//
class C_Setting extends C_Base {
	
	protected $mReg;  
    protected $mSms;
    protected $mRasp;    	

	//
    // Конструктор.
    //
    function __construct() {
		parent::__construct();
		$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
		// Менеджеры.
		$this->mUsers = M_Users::Instance();	
		$this->mReg = M_Reg::Instance();
		$this->mSms = M_Sms::Instance();
		$this->mRasp = M_Rasp::Instance();
	    //$this->mVer = M_Verify::Instance();
		 $this->mSet = M_Setting::Instance();
    }

	
    //
    // Виртуальный обработчик запроса.
    //	
    protected function OnInput(){
        
		// C_Base.
		parent::OnInput();
		
		if ($this->IsGet())
		{
		
			if($_REQUEST['code'])
			{
			
				// получаем access_token
				$resp = file_get_contents('https://oauth.vk.com/access_token?client_id='.CLIENT_ID.'&code='.$_REQUEST['code'].'&client_secret='.SECRET.'&redirect_uri='.PATH."index.php?c=setting");
				$data = json_decode($resp, true);echo $resp;
				if($data['access_token'])
				{
					
					$this->mSet->getProfileVk($data['user_id'], $data['access_token'],$this->user[id_user]);
					header('Location: index.php?c=setting');
					die();					
				}
			}
		}
        // Обработка отправки формы.
		if ($this->IsPost())
		{
		
			$type = $_POST['type'];
			$phoneNumber = $_POST['phoneNumber'];
			
			if ($_POST['type']=='grup')
			{
				$person=$_POST['grup'];
				$firstName=$_POST['firstName'];
				$lastName=$_POST['lastName'];
				
			}
			elseif($_POST['type']=='lecturer')
			{
				$person=$_POST['lecturer'];
				$firstName=$_POST['lecturer'];
				$lastName='';
			}
			
			
			
			$var = array(
						'type'=>$type,
						'person'=>$person,
						'first_name'=>$firstName,
						'last_name'=>$lastName,
						'phone_number'=>$phoneNumber
						);
						
			$this->mSet->edit_person($var, $this->user[id_user]);
			$this->user = $this->mUsers->Get();
	
		}
		 
	}

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput(){
			
        // Генерация содержимого страницы
    	$vars = array('alert'=>$this->alert,
							'user'=>$this->user,
							'grup'=>$this->mRasp->all_grup(),
							'lecturer'=>$this->mRasp->all_lecturer(),
							'linkAuthVk'=>"https://oauth.vk.com/authorize?client_id=".CLIENT_ID."&scope=".SCOPE."&redirect_uri=".PATH."index.php?c=setting"."&response_type=code&v=5.0"); 
    	 
    	$this->content = $this->View(THEME.'/tpl_setting.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
		
}