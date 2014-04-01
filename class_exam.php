<?php

class Parsesr_html
{

	public  function Parsesr_html($host,$user,$pas)
		{
			$id=mysql_connect($host,$user,$pas);
			mysql_select_db($user,$id);
			mysql_query("SET NAMES cp1251") or die( mysql_error());
			//mysql_query("SET SESSION wait_timeout = 1800") or die( mysql_error());
		}

	public function download_html($http,$post,$post_param)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$http);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, $post);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post_param);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_USERAGENT, '[');
			return curl_exec($ch);
			curl_close($ch);	
		}
		
		public function delete($type,$person)
		{
			$query="DELETE FROM $type WHERE person = '$person'";
					mysql_query($query) or die( mysql_error());
			
		}
	
	public function pars_html($html,$table,$pole){
		do{
			$nc=strpos($html,'<option value="')+15;
			$kc=strpos($html,'</option>')-1;
			$str=substr($html, $nc, $kc-$nc);
			$str=(substr($str, strpos($str,'> ')+2,$kc));
			$html=substr($html, $kc+10, strlen($html)-$kc+10);	
			$query="INSERT INTO $table ($pole) VALUES ('$str')";
			mysql_query($query) or die( mysql_error());
		}
		while ((strpos($html,'<option value="'))==true);	
	}
		
	public function pr_gr($table,$pole)
		{
			$result = mysql_query("SELECT $pole FROM $table");
			$i=0;
			while($row =  mysql_fetch_row($result))
			{
				$mas[$i]= $row[0];
				$i++;
			}
			return $mas;		
		}
		
		
	public function parser_exam($html,$table,$person)	
		{	
		do
		{
			
			$n_str='<td bgcolor=#ddddee>&nbsp;';
			$k_str='&nbsp;</td><td />';
			
			//Находим дату экзамена
			$ns=strpos($html,$n_str)+strlen($n_str);
			$ks=(strpos($html,$k_str));
			$str_date_exam= substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));
			 
				
			//Находим день экзамена
			$ns=strpos($html,$n_str)+strlen($n_str);
			$ks=(strpos($html,$k_str));
			if(($ns)&&($ks)){
			$str_day=substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));
			
			//переводим дату в число для удобства хранения и дальнейшего использования
			if ($str_day=='понедельник') {$str_day=1;}
			if ($str_day=='вторник') {$str_day=2;}
         	if ($str_day=='среда') {$str_day=3;}
         	if ($str_day=='четверг') {$str_day=4;}
         	if ($str_day=='пятница') {$str_day=5;}
         	if ($str_day=='суббота') {$str_day=6;}
         	if ($str_day=='воскресение') {$str_day=7;}    
		
			
			//Находим время экзамена
			$ns=strpos($html,$n_str)+strlen($n_str);
			$ks=(strpos($html,$k_str));
			$str_time= substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));
			
			//Находим название дисциплины
			$ns=strpos($html,$n_str)+strlen($n_str);
			$ks=(strpos($html,$k_str));
			$str_discip= substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));
		
				
			$ns=strpos($html,$n_str)+strlen($n_str);;
			$ks=(strpos($html,$k_str));
			$str_person2= substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));

			$ns=strpos($html,$n_str)+strlen($n_str);
			$ks=(strpos($html,$k_str));
			$str_address= substr($html, $ns, $ks-$ns);
			$html=substr($html,$ks+strlen($k_str),strlen($html));


			
			$query="INSERT INTO $table (person,date_exam,day,time,discip,person2,address) VALUES ('$person','$str_date_exam','$str_day','$str_time','$str_discip','$str_person2','$str_address')";
			mysql_query($query) or die( mysql_error());
			}
			}
		while (strpos($html,$n_str)==true);
		}	
	
	
	
      
	public function truncate($table)
		{
			$query="TRUNCATE $table";
			mysql_query($query) or die( mysql_error());
		}
        
		
		
	function __destruct() 
		{
			mysql_close();
		}	
}


?>