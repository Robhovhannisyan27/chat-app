$(document).on('click', '.chat_list', function(){
	$('.mesgs').show();
    $('.chat_list').removeClass('active_chat');
    $(this).addClass('active_chat');
});