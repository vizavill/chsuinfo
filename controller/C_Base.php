<?php


include_once('controller/Controller.php');
include_once('model/M_Users.php');
include_once('model/M_Reg.php');
include_once('model/M_Sms.php');
include_once('model/M_SmsRasp.php');
include_once('model/M_Rasp.php');
include_once('model/M_Example.php');
include_once('model/M_Setting.php');
include_once('model/M_EditBlog.php');
include_once('model/M_Blog.php');
include_once('model/M_Starosta.php');
include_once('model/M_Sender.php');
include_once('model/M_IncMes.php');
include_once('model/M_NotifAll.php');
include_once('model/M_Events.php');
include_once('model/M_Upload.php');
include_once('model/M_VK.php');
//
// ������� ���������� �����.
//
abstract class C_Base extends Controller
{
	protected $needLogin;	// ������������� ����������� 
	protected $user;		// �������������� ������������
	protected $alertOk;		// ���������� ������������
	protected $alertFail;		// ���������� ������������
	protected $alertNotif;		// ���������� ������������
	protected $mStar;		// ���������� ������������
	private $start_time;	// ����� ������ ��������� ��������
	protected $mUsers;
	protected $mVKSender;
	protected $_VKMailing;
	
	//
	// �����������.
	//
	function __construct() 
	{
		$this->needLogin = false;
		$this->user = null;	
		$this->mUsers = M_Users::Instance();	
		$this->mVK = M_VK::Instance();
		$this->mUsers = M_Users::Instance();	
		$this->mSmsRasp= M_SmsRasp::Instance();
	}
	
	//
	// ����������� ���������� �������.
	//
	protected function OnInput()
	{
		// ������� ������ ������ � ����������� �������� ������������.
				
		$this->mUsers->ClearSessions();		
		$this->user = $this->mUsers->Get();  
	
		// ��������������� �� �������� �����������, ���� ��� ����������.
		if ($this->user == null && $this->needLogin)
		{       	
			header("Location: index.php");
			die();
		}
		else
		{
			$this->mStar = M_Starosta::Instance();
		}
		
		// �������� ����� ������ ��������� �������.
		$this->start_time = microtime(true);
	}
	
	//
	// ����������� ��������� HTML.
	//	
	protected function OnOutput()
	{
	    // �������� ������ ���� �������.
		$vars = array('content' => $this->content,
					'user'=>$this->user,
					'_VKMailing'=>$this->mSmsRasp->verVKMailing($user[id_user]),
					'linkAuthVk'=>"https://oauth.vk.com/authorize?client_id=".CLIENT_ID."&scope=".SCOPE."&redirect_uri=".PATH.OAUTH_CALLBACK."&response_type=code&v=5.0");						
			
		$page = $this->View(THEME.'/tpl_main.php', $vars);
						
		// ����� ��������� �������.
        $time = microtime(true) - $this->start_time;        
        $page .= "<!-- ����� ��������� ��������: $time ���.-->";
        
		// ����� HTML.
        echo $page;
	}
}
