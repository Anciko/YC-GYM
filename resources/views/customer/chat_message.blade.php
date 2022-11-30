@extends('customer.layouts.app_home')
@section('content')

<div class="social-media-right-container">
    <!-- <div class="social-media-chat-container"> -->
        <div class="group-chat-header">
            <div class="group-chat-header-name-container">
                <img src="../imgs/avatar.png"/>
                <div class="group-chat-header-name-text-container">
                    <p>Friend Name</p>

                </div>
            </div>
            <div class="chat-header-call-icons-container">
                <iconify-icon icon="ant-design:phone-outlined" class="chat-header-phone-icon"></iconify-icon>
                <iconify-icon icon="eva:video-outline" class="chat-header-video-icon"></iconify-icon>

                <a href="../htmls/trainerTrainingCenterViewMedia.html" class="group-chat-view-midea-link">
                    <p>View Media</p>
                    <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                </a>
            </div>


        </div>
        <input type="hidden" value="{{$id}}" id="recieveUser">

        <div class="group-chat-messages-container">


                @forelse ($messages as $send_message)
                @if (auth()->user()->id == $send_message->from_user_id)

                    <div class="group-chat-sender-container">
                        <div class="group-chat-sender-text-container">
                            <p>{{$send_message->text}}</p>
                        </div>
                        <img src="../imgs/avatar.png"/>
                    </div>
                @elseif(auth()->user()->id != $send_message->from_user_id)
                <div class="group-chat-receiver-container">
                    <img src="../imgs/avatar.png"/>
                    <div class="group-chat-receiver-text-container">
                        <span>{{$send_message->from_user->name}}</span>
                        <p>{{$send_message->text}}</p>
                    </div>
                </div>
                @endif
            @empty
            @endforelse
            {{-- @foreach ($reciever_message as $recieve_message)
            <div class="group-chat-receiver-container">
                <img src="../imgs/avatar.png"/>
                <div class="group-chat-receiver-text-container">
                    <span>{{$recieve_message->from_user->name}}</span>
                    <p>{{$recieve_message->text}}</p>
                </div>
            </div>
            @endforeach --}}

        </div>

        <form class="group-chat-send-form-container" id="message_form" enctype="multipart/form-data">
            <div class="group-chat-send-form-message-parent-container">
                <div class="group-chat-send-form-img-emoji-container">
                    <label class="group-chat-send-form-img-contaier">
                        <iconify-icon icon="bi:images" class="group-chat-send-form-img-icon">

                        </iconify-icon>
                        <input type="file" id="groupChatImg" name="groupChatImg">
                    </label>
                    <button type="button" id="emoji-button" class="emoji-trigger">
                        <iconify-icon icon="bi:emoji-smile" class="group-chat-send-form-emoji-icon"></iconify-icon>
                    </button>

                </div>

                <textarea id="mytextarea" class="group-chat-send-form-input message_input" placeholder="Message..." required ></textarea>
                <img class="group-chat-img-preview groupChatImg">
                <div style="display: none;" class='video-prev'>
                    <video height="200" width="300" class="video-preview" controls="controls"></video>
                </div>
                <button type="reset"  class="group-chat-img-cancel" onclick="clearGroupChatImg()">
                    <iconify-icon icon="charm:cross" class="group-chat-img-cancel-icon"></iconify-icon>
                </button>
            </div>

            <button type="button" class="group-chat-send-form-submit-btn">
                <iconify-icon icon="akar-icons:send" class="group-chat-send-form-submit-btn-icon"></iconify-icon>
            </button>
        </form>

</div>
@endsection

@push('scripts')
<script>
    var messageForm = document.getElementById('message_form');

    var sendMessage = document.querySelector('.group-chat-send-form-submit-btn')

    var groupChatImgInput = document.querySelector('#groupChatImg');

    const groupChatImgPreview = document.querySelector('.groupChatImg');
    const cancelBtn = document.querySelector(".group-chat-img-cancel");
    const emojibutton = document.querySelector('.emoji-trigger');
    var recieveUser_id = document.getElementById('recieveUser');

    var messageContainer = document.querySelector('.group-chat-messages-container');

    if (groupChatImgPreview != null) {
        if (!groupChatImgPreview.hasAttribute("src")) {
            groupChatImgPreview.remove()
            //$('.video-prev').remove();
            cancelBtn.remove()
        }
    }


    var auth_user_id = {{auth()->user()->id}};
    var auth_user_name = "{{auth()->user()->name}}";

    sendMessage.addEventListener('click', function(e){
        e.preventDefault();

        var messageInput = document.querySelector('.message_input');
        var recieveUserId = recieveUser_id.value;

        console.log('reciever ',recieveUserId);
        console.log('sender auth user ',auth_user_id);
        if (messageInput != null) {
                axios.post('/api/message/chat/'+recieveUserId, {
                    text: messageInput.value,
                    sender: auth_user_name
                }).then();
                messageInput.value = "";
            }



    })

    var pusher = new Pusher('576dc7f4f561e15a42ef', {
            cluster: 'eu',
            encrypted: true
        });
    var channel = pusher.subscribe('chatting');
    channel.bind('chatting-event', function(data){
            console.log(data);
            if(data.message.to_user_id == auth_user_id){
                messageContainer.innerHTML +=`<div class="group-chat-receiver-container">
                        <img src="../imgs/avatar.png"/>
                        <div class="group-chat-receiver-text-container">
                            <span>${data.sender}</span>
                            <p>${data.message.text}</p>
                        </div>
                    </div>`;
            }else{
                if(data.message.to_user_id == auth_user_id || data.message.from_user_id == auth_user_id)
                messageContainer.innerHTML +=`<div class="group-chat-sender-container">
                            <div class="group-chat-sender-text-container">
                                <p>${data.message.text}</p>
                            </div>
                            <img src="../imgs/avatar.png"/>
                        </div>`;
            }
        })

</script>
@endpush
