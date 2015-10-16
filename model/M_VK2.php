<?php
include_once('MSQL.php');


//
// �������� ��� ������ � ��
//
class M_VK2
{
    private static $instance; 	// ������ �� ��������� ������
    private $msql; 				// ������� ��


    //
    // ��������� ������������� ���������� (��������)
    //
    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new M_VK2();

        return self::$instance;
    }

    //
    // �����������
    //
    public function __construct()
    {
        $this->msql   = MSQL::Instance();
    }

    //
    // ��
    //
    public function GetAccessTokenVK($code)
    {
        $link = 'https://oauth.vk.com/access_token?client_id='.CLIENT_ID.'&code='.$code.
            '&client_secret='.SECRET.
            '&redirect_uri='.PATH.OAUTH_CALLBACK;
        $resp = $this->send($link);
        $decres = json_decode($resp);
        if (isset($decres->access_token)) {
            // ��� �������� �����������
            return $decres->access_token;
        }
        elseif (isset($decres->error)){
            // ��������� ���� ��������� ������
            return $decres->error;
        }
    }

    // ������� ��������� ���������� � ������������
    function UserGetInfo($token, $id = "") {
        if ($id == "") {
            $link = "https://api.vk.com/method/users.get?fields=sex,bdate,city,country,photo_50,photo_100,photo_200_orig,photo_400_orig,photo_max_orig,education,universities,schools&access_token=" . $token;
            $res = $this->send($link);
        }
        else {
            $link = "https://api.vk.com/method/users.get?user_ids=" . $id . "&fields=sex,bdate,city,country,photo_50,photo_100,photo_200,photo_400_orig,photo_max_orig,education,universities,schools&access_token=" . $token;
            $res = $this->send($link);
        }
        $decres = json_decode($res, TRUE);
        return $decres[response][0];
    }
    //
    // � ��� ������� �������� ���, � ���� ���� ���������� USE_SECRET_FUNCTIONS.
    //
    public function send($link)
    {
        return file_get_contents($link);
    }


}
