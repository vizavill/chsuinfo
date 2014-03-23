/*Раздел рассылки новостей*/



function def_Group1 (){
    
     if ($('#Group1 :radio:checked').val()== 'lecturer'){
        $('#sel_grup').fadeOut();
        $('#sel_lecturer').fadeIn();
    }
    else{
        $('#sel_grup').show();
        $('#sel_lecturer').hide();
    }  
}
function def_Group2 (){
    
    if ($('#Group2 :radio:checked').val()== 'date'){
        $('#sel_week').hide();
        $('#sel_date').show();
    }
    else{
        $('#sel_date').hide();
        $('#sel_week').show();
    }   
}
/*Профиль пользователя*/




$(document).ready(function(){
    def_Group1 ();
    def_Group2 ()
    

   
    
 $('#Group1').click(function(){
    if ($('#Group1 :radio:checked').val()== 'lecturer'){
        $('#sel_grup').hide();
        $('#sel_lecturer').show();
    }
    else{
        $('#sel_grup').fadeIn();
        $('#sel_lecturer').fadeOut(0);
    }
 })
 
  $('#Group2').click(function(){
    if ($('#Group2 :radio:checked').val()== 'date'){
        $('#sel_week').hide();
        $('#sel_date').show();
    }
    else{
        $('#sel_week').fadeIn();
        $('#sel_date').fadeOut(0);
    }
 })
 
 
  $('#settings').click(function(){
     $('#mailing').hide();
 })
 
 $('#settings').click(function(){
     $('#mailing').hide();
 })

   
})