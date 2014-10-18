var switchtpl = $("[name='select-rasp']").bootstrapSwitch();
$("[name='select-rasp']").on('switchChange.bootstrapSwitch', function(event, state) {
	$("[name='select-rasp']").bootstrapSwitch('disabled', true);
	if(state)
		$.get("index.php?view=block",function(data){location.reload();});
	else
		$.get("index.php?view=line",function(data){location.reload();});
});


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