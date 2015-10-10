<?phpinclude_once('MSQL.php');//// Менеджер для примера//class M_Rasp{	private static $instance; 	// ссылка на экземпляр класса	public $msql; 				// драйвер БД		public $grup;			// массив групп	public $_year;		// текущий год	public $_month;		// текущий месяц	public $num_week_1sept;	// номер недели 1 сентября относительно начала года    public $num_week;	// номер текущей недели относительно начала года	public $count_week_year; //кол-во нед. в году начала обучения    	//	// Получение единственного экземпляра (одиночка)	//	public static function Instance()	{		if (self::$instance == null)			self::$instance = new M_Rasp();				return self::$instance;	}	//	// Конструктор	//	public function __construct()	{		$this->msql = MSQL::Instance();		$this->_year=date("Y");		$this->_month=date("n");	}		//	// Функция получения массива всех групп.	//	public function all_grup()	{		return $this->msql->Select("SELECT * FROM `grup`");	}		//	// Функция получения массива всех преподавателей.	//	public function all_lecturer()	{		return $this->msql->Select("SELECT name_lecturer FROM `lecturer`");	}		//	// Функция получения массива комментариев.	//	public function get_comments()	{		return $this->msql->Select("SELECT * FROM `comments` order by `id` DESC");	}        	//	// Функция определения номера дня недели	//    public function get_num_day($date)	{        switch(date("D", strtotime("$date")))		{            case 'Mon': return 1; break;            case 'Tue': return 2; break;            case 'Wed': return 3; break;			case 'Thu': return 4; break;            case 'Fri': return 5; break;            case 'Sat': return 6; break;            case 'Sun': return 7; break;        }    }			//	// Функция определения названия дня по номеру дня	//    public function name_day($num_day)	{        switch($num_day)		{             case 1: return "Понедельник"; break;            case 2: return "Вторник"; 	break;            case 3: return "Среда";		break;            case 4: return "Четверг";	 	break;	        case 5: return "Пятница";		break;	        case 6: return "Суббота";	break;	        case 7: return "Воскресение" ;break;        }    }    	//	// Функция определения четности недели	//	public function get_parity($num_week)	{	   if (fmod($num_week,2))	       return "нечет";	   else	       return "чет";	}		//	// Функция определения номера пары по времени	//	public function para($time)	{		switch($time)		{			case "08-30 - 10-00": $par=1; 	break;			case "08-30 - 10-30": $par=1;	break;			case "10-10 - 11-40": $par=2; 	break;			case "10-40 - 12-40": $par=2; 	break;// пара физ-культуры			case "12-50 - 14-50": $par=3; 	break;//пара физра 			case "11-50 - 13-20": $par=3; 	break;			case "13-30 - 15-00": $par=4; 	break;			case "15-00 - 17-00": $par=4; 	break;			case "15-10 - 16-40": $par=5; 	break;			case "17-10 - 19-10": $par=5; 	break;			case "16-50 - 18-20": $par=6; 	break;			case "18-30 - 20-00": $par=7; 	break;			case "18-00 - 19-30": $par=7; 	break;	//заочники 				case "19-40 - 21-10": $par=8; 	break;				case "19-20 - 21-20": $par=8; 	break;						}		return $par;	}		//	// Функция определения даты по номеру недели и названию дня(понедельник, вторник....)	//	public function date_of_week($num_of_week, $num_of_day)	{		if ($this->_month<=8)		{					$year=$this->_year;			 $year."</br>";		}		else		{			$year=$this->_year-1;		}							if($this->get_count_week_year($year)-$this->num_week_1sept<$num_of_week)		{			$num_of_week-=$this->get_num_edu_week("1 January $year");			 "1 January ";		}		else		{			$num_of_week+=$this->get_num_edu_week("1 September $year");			$year=$this->_year-1;		}						strftime('%d.%m.%Y',strtotime($year."-W".$num_of_week."-".$num_of_day));	}				//	// Функция определения количества недель в году 	//	public function get_count_week_year($year)	{		$day_31Dec=date("D", strtotime("31 December $year"));				if (($day_31Dec=="Mon") || ($day_31Dec=="Sun") ||($day_31Dec=="Sat") ||($day_31Dec=="Tue") ||($day_31Dec=="Wed"))		 {			return 52;		 }		 else		 {			return 53;		 }	}			//	// Функция определения номера УЧЕБНОЙ недели по дате	//	public function get_num_edu_week($date)	{		if ($this->month<=8)		{			$year=$this->_year-1;		}		else		{			$year=$this->_year;		}		         $this->num_week_1sept=date("W", strtotime("1 September $year"));				$day_1sept=date("D", strtotime("1 September $year"));        		if ($day_1sept=="Mon"){            $numb_1sept=1;         }         else{            $numb_1sept=0;         }                  if (date("n", strtotime("$date"))<=8)		{			return $this->get_count_week_year($year)-$this->num_week_1sept+$numb_1sept+date("W", strtotime("$date"));		}		else		{			return date("W", strtotime("$date"))-$this->num_week_1sept+$numb_1sept;		}	}		//    //Функция разбиения названия предмета на отдельные слова    //	public function dali($string)	{		$i=1;		$tok = strtok($string, " ");				while($tok){			$mas[$i]=$tok;			$i++;			$tok = strtok(" ");		}		return $mas;	}		//    //Функция сокращения слова    //	public function sokrat($mas)	{		$len=6;		$vowel=array('а','у','о','ы','и','э','я','ю','ё','е','ь','ъ');		$out_string='';		foreach($mas as $string){			//танцы с бубном, типа можно и закомментить если че			$string = iconv("UTF-8","WINDOWS-1251",$string);						$len_str=strlen($string);			if($len<=$len_str){				$str=substr($string,0,$len);				foreach($vowel as $value){					$value = iconv("UTF-8","WINDOWS-1251", $value);					if($str[$len-1]==$value){						$str=substr($string,0,$len+1);					}										}				$out_string.=$str." ";			}			else{				$out_string.=$string." ";			}		}		return iconv("WINDOWS-1251","UTF-8",$out_string);	}	//	// Функция выборки расписания на конкретный месяц	//	function getMonthTimetable($month, $person){	}		//	// Функция выборки расписания	//    function rasp($sel_date, $param, $person, $type)	{		//определяем для преподавателя или студента выбирать расписание		if ($person=='lecturer')			$table='schedule_pr';		else			$table='schedule_gr';				//выбираем расписание на определенную дату		if ($param == 'd')		{			//Определяем номер учебной недели			$week=$this->get_num_edu_week($sel_date);			//Определяем четность			$parity=$this->get_parity($week);			//Определяем день недели			$day=$this->get_num_day($sel_date);			//Запрос к базе			$mas=$this->msql->Select("SElECT * FROM  $table WHERE day='$day' and grup='$type' and (parity='$parity' or parity='ежен') and n_week<='$week' and k_week>='$week'");						}		elseif($param == 'w') 		{			//Определяем номер учебной недели			$week=$this->get_num_edu_week($sel_date);			//Определяем четность			$parity=$this->get_parity($week);			//Запрос к базе			$mas=$this->msql->Select("SElECT * FROM  $table WHERE grup='$type' and (parity='$parity' or parity='ежен') and n_week<='$week' and k_week>='$week'");		}		elseif($param == 'm')		{			//На месяц			#Определяем учебные недели, 			#которые принадлежат выбранному календарному месяцу			#отображаем эти недели в спец. таблицу		}                //Формируем окончательный массив        for ($i=0;$i<count($mas);$i++)		{			$k=$this->para($mas[$i][time]);			if($k>$f)			{				$f=$k;							}						### Начинаем считать дату дня ###			$ch_y = date('Y');			if (date('n') < 9) $ch_y--;			$date_num_e = $this->get_num_edu_week($sel_date);			$date = new DateTime();				$date->setDate($ch_y, 9, 1);			$b_nw = date("w", strtotime("1 september ".strval($ch_y)));			if ($b_nw == 0) $b_nw = 7;			$date->modify('+'.(intval($date_num_e)*7-$b_nw-7+intval($mas[$i][day])).' day');			$date = $date->format('d.m.Y');			### Посчитали дату дня ###						if($mas[$i][day]==1)			{				$ponedelnik[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])), 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date' => $date,								);				ksort($ponedelnik);				#$ponedelnik[date] = $date;								}			if($mas[$i][day]==2)			{				$vtornik[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date' => $date,								);				ksort($vtornik);				#$vtornik[date] = $date;			}			if($mas[$i][day]==3)			{				$sreda[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date' => $date,								);				ksort($sreda);				#$sreda[date] = $date;			}			if($mas[$i][day]==4)			{				$chetverg[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])), 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup],								'date' => $date, 								);				ksort($chetverg);				#$chetverg[date] = $date;			}			if($mas[$i][day]==5)			{					$pyatnica[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])), 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date' => $date,								);				ksort($pyatnica);				#$pyatnica[date] = $date;			}			if($mas[$i][day]==6)			{				$subbota[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])), 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date' => $date,								);				ksort($subbota);				#$subbota[date] = $date;			}					}		        $mas_rasp2 = array( '1'=>$ponedelnik, 							'2'=>$vtornik, 							'3'=>$sreda, 							'4'=>$chetverg, 							'5'=>$pyatnica, 							'6'=>$subbota,							'max'=>$f							);																					//echo "<pre>";				//print_r($mas_rasp2);	//echo "</pre>";		        return $mas_rasp2;        }						//	// Функция выборки расписания	//    function get_rasp_day($dt, $person, $type)	{		//определяем для преподавателя или студента выбирать расписание		if ($person=='lecturer')			$table='schedule_pr';		else			$table='schedule_gr';				//Определяем номер учебной недели		$week=$this->get_num_edu_week($dt);		//Определяем четность		$parity=$this->get_parity($week);		//Определяем день недели		$day=$this->get_num_day($dt);		//Выбираем из какой таблицы будем выбирать					//Запрос к базе		$mas=$this->msql->Select("SElECT * FROM  $table WHERE day='$day' and grup='$type' and (parity='$parity' or parity='ежен') and n_week<='$week' and k_week>='$week'");						//Формируем окончательный массив        for ($i=0;$i<count($mas);$i++)		{				$rasp_day[$i]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$mas[$i][discip], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $mas[$i][grup], 								);				sort($rasp_day);        		}		        return $rasp_day;                	}}