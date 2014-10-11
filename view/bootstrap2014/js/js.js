$("[name='select-rasp']").bootstrapSwitch();
function checkAddress(checkbox)
{   
	if(checkbox.checked) $('#saveFollow').removeAttr('disabled');
	else $('#saveFollow').attr({disabled:'disabled'});
}

$('#saveFollow').click(function(){
	var btn = $('#saveFollow');
	btn.button('loading');
	$.post("index.php?c=vk_rasp", {time: $('#time').val(), vk: 'true'}, function(data){
		btn.button('reset');
		var response = JSON.parse(data);
		$('.followmodal').modal('hide');
		$('#msg').html(response.html);
		if(response.err == 0)
			$('.followbtn')
			.html('Отписаться от рассылки')
			.removeAttr('data-toggle')
			.removeAttr('data-target')
			.removeClass('btn-primary')
			.addClass('btn-danger')
			.attr({href:'index.php?c=vk_rasp&mailing=delete&id_mailing='+response.vk_mailing});
	});
});