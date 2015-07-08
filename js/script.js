$(function(){

	$('#list1').addInputArea({
  maximum : 2
	});

 $(".dropdown-menu li a").click(function(){
    $(this).parents('.dropdown').find('.dropdown-toggle').html($(this).text() + ' <span class="caret"></span>');
    $(this).parents('.dropdown').find('input[name="dropdown-value"]').val($(this).attr("data-value"));
  });

});
