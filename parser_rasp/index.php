<?php
include_once("class.php");
include_once("config.php");

//объявляем экзэмпляр класса
$pars=new Parsesr_html($dbhost,$dbuser,$dbname,$dbpas);

//Cкачиваем страницу со списком аудиторий и если все ОК, заносим ее в базу
if ($html=$pars->download_html($http_classroom, false, ''))
{
	if($pars->verify_html($html))
	{
		$pars->truncate('classroom');
		$pars->pars_html($html, 'classroom', 'classroom');
	}
}
else
{
	echo "Ошибка загрузки списка аудиторий<br/>";
}

//Cкачиваем страницу со списком преподов и если все ОК, заносим ее в базу
if ($html=$pars->download_html($http_prepod, false, ''))
{
	if($pars->verify_html($html))
	{
		$pars->truncate('lecturer');
		$pars->pars_html($html, 'lecturer', 'name_lecturer');
	}
}
else
{
	echo "Ошибка загрузки списка преподов<br/>";
}

//Cкачиваем страницу со списком груп и если все ОК, заносим ее в базу
if ($html=$pars->download_html($http_rasp, false, ''))
{
	if($pars->verify_html($html))
	{
		$pars->truncate('grup');
		$pars->pars_html($html ,'grup','title_grup');
	}
}
else
{
	echo "Ошибка загрузки списка групп<br/>";
}


$array_pr=$pars->pr_gr('lecturer','name_lecturer');
$array_gr=$pars->pr_gr('grup','title_grup');
$array_cr=$pars->pr_gr('classroom','classroom');

//Семестр
for ($semestr=1;$semestr<=1;$semestr++)
{


foreach($array_cr as $value)
{
	$html=$pars->download_html($http_classroom, true, "&au=$value&ssss=$semestr&mode=Занятия");

	$vh=$pars->verify_html($html);	
	if ($html && $vh)
	{
		$pars->delete('schedule_cr',$value,$semestr);
		$pars->parser_rasp($html,'schedule_cr',$value,$semestr);
		
	}
	else
	{
		echo "Не удалось загрузить расписание для ".$value."<br/>";
	}
}
/*
foreach($array_gr as $value) 
{
	//Загружаем страницу если не загрузилась то содержит false
	$html=$pars->download_html($http_rasp, true, "&gr=$value&ss=$semestr&mode=Расписание занятий");
	$vh=$pars->verify_html($html);	
	if ($html && $vh)
	{
		echo"ffffffffffffffffffffff";
		$pars->delete('schedule_gr',$value,$semestr);
		$pars->parser_rasp($html,'schedule_gr',$value,$semestr);
		
	}
	else
	{
		echo "Не удалось загрузить расписание для ".$value."<br/>";
	}
}
	
foreach($array_pr as $value)
{
	$html=$pars->download_html($http_prepod, true, "&pr=$value&sss=$semestr&mode=Расписание занятий");
	$vh=$pars->verify_html($html);	
	if ($html && $vh)
	{
		$pars->delete('schedule_pr',$value,$semestr);
		$pars->parser_rasp($html,'schedule_pr',$value,$semestr);
		
	}
	else
	{
		echo "Не удалось загрузить расписание для ".$value."<br/>";
	}
}
*/
}

	echo "End....";
?>