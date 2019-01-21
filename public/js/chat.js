function addToList(data, append = true) {
	let auth_id = $('.chat_list').parent().attr('data-auth-id'),
		row = '';

	if(data.user) {
		name = data.user.name
	} else {
		name = 'Guest';
	}
	if(auth_id == data.user_id) {
		row += '<div class="outgoing_msg">'
		row += '<div class="sent_msg">';
		row += '  	<p>' + data.message + '</p>';
		row += '</div>';
	} else {
		row += '<div class="incoming_msg">'
		row += '<div class="incoming_msg_img">' + name + '</div>';
		row += '<div class="received_msg">';
		row += '  <div class="received_withd_msg">';
		row += '  	<p>' + data.message + '</p>';
		row += '  </div>';
		row += '</div>';
		row += '</div>';
	}

	$('.msg_history').append(row);
}

$(document).ready(function() {
	$(document).on('click', '.chat_list', function(){
		let room_id = $(this).attr('id'),
			_this = this;
		$.ajax({
	        type:'GET',
	        url:'/messages?room='+room_id,
	        success:function(data) {
	          	$('.msg_history').empty();
	          	data.forEach(function(item) {
        			addToList(item, true);
	        	})
	        	$('.mesgs').show();
    			$('.chat_list').removeClass('active_chat');
	    		$(_this).addClass('active_chat');
	       	}
	    });
	});
    // pusher js client
    var pusher = new Pusher("8520d90e6cd450626505", {
    	cluster: 'ap2',
    });
    var channel = pusher.subscribe('chat');
    channel.bind('message.added', function(data) {
    	addToList(data.message, false);
    });
})