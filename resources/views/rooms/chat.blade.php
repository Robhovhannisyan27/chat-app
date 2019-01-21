<div class="container">
	<h3 class=" text-center">Messaging</h3>
	<div class="messaging">
		<div class="inbox_msg">
			<div class="inbox_people">
				<div class="headind_srch">
					<div class="recent_heading">
						<h4>Recent</h4>
					</div>
				</div>
				<div class="inbox_chat" data-auth-id="{{ Auth::id() }}">
					@foreach($rooms as $room)
					<div class="chat_list" id="{{ $room->id }}">
						<div class="chat_people">
						<div class="chat_img"> <img src="{{ asset('images/'.$room->image) }}" alt="sunil"> </div>
						<div class="chat_ib">
							<p>{{ $room->name }}</p>
						</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="mesgs">
				<div class="msg_history">
					
				</div>
				<div class="type_msg">
					<div class="input_msg_write">
						<input type="text" name='message' class="write_msg" placeholder="Type a message" />
						<button class="msg_send_btn" id="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
	});
	function sendMessage() {
		let room_id = $('.active_chat').attr('id'),
			message = $('.write_msg').val();
		if(message) {
			$.ajax({
		        type:'POST',
		        url:'/messages',
		        data: {
		        	room_id: room_id,
	        		message: message
		        },
		        success:function(data) {
		          	$('.write_msg').val('');
		       	}
		    });	
		}	
	}
	$(document).on('click', '#msg_send_btn', sendMessage);
	$(".write_msg").on("keydown", function(e) {
        if(e.keyCode === 13) {
            sendMessage();
        }
    });
    sendMessage();

</script>
