<?php
include_once("class_exam.php");
include_once("config.php");

//объявляем экзэмпляр класса
$pars=new Parsesr_html($dbhost,$dbuser,$dbpas);



//Cкачиваем страницу со списком преподов и если все ОК, заносим ее в базу
if ($html=$pars->download_html($http_prepod, false, '')){
	$pars->truncate('lecturer');
	$pars->pars_html($html, 'lecturer', 'name_lecturer');
}
else{
	echo "Ошибка загрузки списка преподов<br/>";
}

//Cкачиваем страницу со списком груп и если все ОК, заносим ее в базу
if ($html=$pars->download_html($http_rasp, false, '')){
	$pars->truncate('grup');
	$pars->pars_html($html ,'grup','title_grup');
}
else{
	echo "Ошибка загрузки списка групп<br/>";
}
$array_pr=$pars->pr_gr('lecturer','name_lecturer');
$array_gr=$pars->pr_gr('grup','title_grup');

//Семестр
$i=1;
$r=0;


foreach($array_pr as $value) 
	{

		if ($html=$pars->download_html($http_prepod, true, "&pr=$value&sss=$i&mode=Расписание экзаменов"))
		{
			$pars->delete('exam_lecturer',$value);
			$pars->parser_exam($html,'exam_lecturer',$value);
		}
		else
		{
			echo "Не удалось загрузить расписание для ".$value."<br/>";
		}
		
	}

foreach($array_gr as $value) 
	{
		
		if ($html=$pars->download_html($http_rasp, true, "&gr=$value&ss=$i&mode=Расписание экзаменов"))
		{
			$pars->delete('exam_students',$value);
			$pars->parser_exam($html,'exam_students',$value);
		}
		else
		{
			echo "Не удалось загрузить расписание для ".$value."<br/>";
		}
		
	}





	

	




	echo "End1....";
?>