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

$("#studentSet").click(function(){
	$("#groupSelectSet").show();
	$("#prepodSelectSet").hide();
});

$("#lecturerSet").click(function(){
	$("#groupSelectSet").hide();
	$("#prepodSelectSet").show();
});