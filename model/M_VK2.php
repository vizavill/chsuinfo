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
		if ( file_exists( $link ) )
		{
			// ���� ���������� � ���� �� ������, �� ��������� ��� ����
			if( filesize( $link ) )
			{
				$handle = fopen( $link, "r" );
				$contents = fread( $handle, filesize( $link ) );
				fclose($handle);
			}
			else
			{
				return '';
			}
		}
		else
		{
			// ��������� ��� ������ Curl
			// � ����������� ����
			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $curl, CURLOPT_TIMEOUT, 30 );
			curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1' );
			curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt( $curl, CURLOPT_REFERER, 'http://google.com/' );
			curl_setopt( $curl, CURLOPT_URL, $link );
			$contents = curl_exec( $curl );
			curl_close($curl); // ������ ��������� ����
		}
		return $contents;
	}


}
