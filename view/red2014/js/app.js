function loadData(page){
	$.ajax
	({
		type: "POST",
		url: "index.php?c=comment",
		data: "page="+page,
		success: function(msg)
		{
			$(".htmlcomments").ajaxComplete(function(event, request, settings){
				$(".htmlcomments").html(msg);
			});
		}
	});
}

//Развернуть комментарий
function extComment(obj){
	var heightComment = $(obj).parents('.commVk').find('.commentVk').height();
	if(heightComment > 46){
		$(obj).parents('.commVk').find('.comm-text').animate( { height:heightComment+17 }, { queue:false, duration:500 } );
		$(obj).hide();
		$(obj).next().show();
	}
}

//Свернуть комментарий
function extCommentHide(obj){
	$(obj).parents('.commVk').find('.comm-text').animate( { height:51 }, { queue:false, duration:500 } );
	$(obj).hide();
	$(obj).prev().show();
}

//Удалить комментарий
function delComment(obj,id){
	if(confirm("Удалить комментарий?")){
		$.post('index.php?c=comment',{delete:id},function(msg){
			loadData($('.htmlcomments span').text());
		});
	}
}



//Загрузить первую страницу комментариев
loadData(1); 

$('.paginationComms a.active').live('click',function(){
	var page = $(this).attr('p');
	loadData(page);
	return false;
}); 
//ajax pagination comments end


//ajax отправка комментария
var working = false;
$('#commFieldSubmit').click(function(e){
 	e.preventDefault();
	if(working) return false;
	working = true;
	$("#commFieldSubmit").val("Загрузка...");
	$.post('index.php?c=comment',{comment:$('#commFieldText').val()},function(msg){
		working = false;
		$("#commFieldSubmit").val("Отправить");	
		if(msg.status){
			loadData(1); 
			$('#commFieldText').val('');
		} else {			
				$.each(msg.errors,function(k,v){
					alert(v);
				});
		}
	},'json');

});

//анимация слайдера последних новостей
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

//Инициализация селектов
$('#group').ikSelect();
$('#week').ikSelect({
	customClass: 'week_select_link'
});

$('#prepod').ikSelect({
	customClass: 'prepod_select_link'
});

//Высота чата
var hhtable = $('.rasp td').css("height");
$('.htmlcomments').css("height", parseInt(hhtable) - 65);