	/* Следующий код выполняется только после загрузки DOM */
	
	/* Данный флаг предотвращает отправку нескольких комментариев: */
var working = false;
	
	/* Ловим событие отправки формы: */
$('#commFieldSubmit').click(function(e){

 	e.preventDefault();
	if(working) return false;
		
	working = true;
	$("#commFieldSubmit").val("Загрузка...");
		//$('span.error').remove();
		
		/* Отправляем поля формы в submit.php: */
	$.post('index.php?c=comment',{comment:$('#commFieldText').val()},function(msg){
		working = false;
		$("#commFieldSubmit").val("Отправить");	
		if(msg.status){

				/* 
				/	Если вставка была успешной, добавляем комментарий 
				/	ниже последнего на странице с эффектом slideDown
				/*/

			$(msg.html).hide().insertBefore('.paginationComms').slideDown();
				//$('#body').val('');
		} else {
				/*
				/	Если есть ошибки, проходим циклом по объекту
				/	msg.errors и выводим их на страницу
				/*/
			
				$.each(msg.errors,function(k,v){
				//	$('label[for='+k+']').append('<span class="error">'+v+'</span>');
					alert(v);
				});
		}
	},'json');

});

function animate() {
    $(o).eq(curIndex).show().animate({left: '-=50px', opacity: '0'}, 400, function() {
			$(o).eq(curIndex).attr('style', '').hide();
			curIndex = (curIndex == numberOfTeaser - 1) ? 0 : curIndex + 1;
			$(o).eq(curIndex).show().animate({left: '-=50px', opacity: '1'}, 400);
        });
}
var o = $('.posts > div');
$(o).eq(0).show().css('opacity', 1).css('left', 0);
var numberOfTeaser  = o.length;
var curIndex = 0;
setInterval(animate, 7000);          

$('#group').ikSelect();
$('#week').ikSelect({
	customClass: 'week_select_link'
});

$('#prepod').ikSelect({
	customClass: 'prepod_select_link'
});

