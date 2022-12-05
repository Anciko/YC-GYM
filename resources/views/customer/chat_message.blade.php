@extends('customer.layouts.app_home')
@section('content')
    <div class="social-media-right-container">
        <!-- <div class="social-media-chat-container"> -->
        <div class="group-chat-header">
            <div class="group-chat-header-name-container">
                <img src="{{asset('/storage/post'.$receiver_user->profile_image)}}" />
                <div class="group-chat-header-name-text-container">
                    <p>{{ $receiver_user->name }}</p>

                </div>
            </div>
            <div class="chat-header-call-icons-container">
                <iconify-icon icon="ant-design:phone-outlined" class="chat-header-phone-icon"></iconify-icon>
                <iconify-icon icon="eva:video-outline" class="chat-header-video-icon"></iconify-icon>

                <a href="{{route('message.viewmedia',$receiver_user->id)}}" class="group-chat-view-midea-link">
                    <p>View Media</p>
                    <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                </a>
            </div>


        </div>
        <input type="hidden" value="{{ $id }}" id="recieveUser">

        <div class="group-chat-messages-container">


            @forelse ($messages as $send_message)
                @if (auth()->user()->id == $send_message->from_user_id)
                    @if ($send_message->media == null)
                        <div class="group-chat-sender-container">
                            <div class="group-chat-sender-text-container">
                                <p>{{ $send_message->text }}</p>
                            </div>
                            <img src="../imgs/avatar.png" />
                        </div>
                    @else
                        @if (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpg' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpeg')

                            {{-- modal --}}
                            <div class="modal fade" id="exampleModalToggle{{$send_message->id}}" aria-hidden="true"
                                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}"
                                                alt="test" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end modal --}}

                            <div class="group-chat-sender-container" id="trainer_message_el">
                                <div class="group-chat-sender-text-container">
                                    <a data-bs-toggle="modal" href="#exampleModalToggle{{$send_message->id}}" role="button">
                                        <img
                                            src="{{ asset('storage/customer_message_media/' . $send_message->media) }}">
                                    </a>
                                </div>
                                <img src="../imgs/avatar.png" />
                            </div>

                            @elseif(pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')

                                <div class="group-chat-sender-container" id="trainer_message_el">
                                    <div class="group-chat-sender-text-container">
                                        <video width="100%" height="100%" controls>
                                            <source
                                                src="{{ asset('storage/customer_message_media/' . $send_message->media) }}"
                                                type="video/mp4">
                                        </video>
                                    </div>
                                    <img src="../imgs/avatar.png" />
                                </div>

                        @endif
                    @endif

                @elseif(auth()->user()->id != $send_message->from_user_id)
                    @if ($send_message->media == null)
                        <div class="group-chat-receiver-container">
                            <img src="{{asset('/storage/post'.$receiver_user->profile_image)}}" />
                            <div class="group-chat-receiver-text-container">
                                <span>{{ $send_message->from_user->name }}</span>
                                <p>{{ $send_message->text }}</p>
                            </div>
                        </div>
                    @else
                        @if (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpg' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpeg')

                            {{-- modal --}}
                            <div class="modal fade" id="exampleModalToggle{{$send_message->id}}" aria-hidden="true"
                                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}"
                                                alt="test" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end modal --}}

                            <div class="group-chat-receiver-container" id="trainer_message_el">
                                <img src="{{asset('/storage/post'.$receiver_user->profile_image)}}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>{{ $send_message->from_user->name }}</span>
                                    <a data-bs-toggle="modal" href="#exampleModalToggle{{$send_message->id}}" role="button">
                                        <img src="{{ asset('storage/customer_message_media/' . $send_message->media) }}">
                                    </a>
                                </div>
                            </div>
                        @elseif(pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                                pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                                pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')

                                    <div class="group-chat-receiver-container" id="trainer_message_el">
                                        <img src="{{asset('/storage/post'.$receiver_user->profile_image)}}" />
                                        <div class="group-chat-receiver-text-container">
                                            <span>{{ $send_message->from_user->name }}</span>
                                            <video width="100%" height="100%" controls>
                                                <source
                                                    src="{{ asset('storage/customer_message_media/' . $send_message->media) }}"
                                                    type="video/mp4">
                                            </video>
                                        </div>
                                    </div>

                        @endif

                    @endif

                @endif
            @empty
            @endforelse

        </div>

        <form class="group-chat-send-form-container" id="message_form" enctype="multipart/form-data">
            <div class="group-chat-send-form-message-parent-container">
                <div class="group-chat-send-form-img-emoji-container">
                    <label class="group-chat-send-form-img-contaier">
                        <iconify-icon icon="bi:images" class="group-chat-send-form-img-icon">

                        </iconify-icon>
                        <input type="file" id="groupChatImg" name="fileInput">
                    </label>
                    <button type="button" id="emoji-button" class="emoji-trigger">
                        <iconify-icon icon="bi:emoji-smile" class="group-chat-send-form-emoji-icon"></iconify-icon>
                    </button>

                </div>

                <textarea id="mytextarea" class="group-chat-send-form-input message_input" placeholder="Message..." required></textarea>
                <img class="group-chat-img-preview groupChatImg">
                <div style="display: none;" class='video-prev'>
                    <video height="200" width="300" class="video-preview" controls="controls"></video>
                </div>
                <button type="reset" class="group-chat-img-cancel" onclick="clearGroupChatImg()">
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
        var recieveUser = document.getElementById('recieveUser');

        var messageContainer = document.querySelector('.group-chat-messages-container');


        var auth_user_id = {{ auth()->user()->id }};
        var auth_user_name = "{{ auth()->user()->name }}";
        var recieveUserId = recieveUser.value;
        var fileName;
        var receive_user_img;

        $(document).ready(function() {
                    $('.group-chat-messages-container').scrollTop($('.group-chat-messages-container')[0].scrollHeight);
        });

        $(document).ready(function() {

            var messageInput = document.querySelector('.message_input');

            ///start
            receive_user_img = @json($receiver_user->profile_image)



            var groupChatImgInput = document.querySelector('#groupChatImg');

            const groupChatImgPreview = document.querySelector('.groupChatImg');
            const cancelBtn = document.querySelector(".group-chat-img-cancel");
            const emojibutton = document.querySelector('.emoji-trigger');

            const picker = new EmojiButton();

            emojibutton.addEventListener('click', () => {
                picker.togglePicker(emojibutton);

            });

            picker.on('emoji', emoji => {
                messageInput.value += emoji;
            });


            if (groupChatImgPreview != null) {
                if (!groupChatImgPreview.hasAttribute("src")) {
                    groupChatImgPreview.remove()
                    //$('.video-prev').remove();
                    cancelBtn.remove()
                }
            }


            groupChatImgInput.addEventListener('change', (e) => {
                console.log('lahsdjk');
                fileName = groupChatImgInput.files[0];
                console.log(fileName);
                var fileExtension;

                fileExtension = e.target.value.replace(/^.*\./, '');
                console.log(fileExtension)
                if (fileExtension === "jpg" || fileExtension === "jpeg" || fileExtension ===
                    "png" || fileExtension ===
                    "gif") {
                    const reader = new FileReader();
                    reader.onloadend = e => groupChatImgPreview.setAttribute('src', e.target
                        .result);
                    reader.readAsDataURL(groupChatImgInput.files[0]);
                    groupChatImgInput.value = ""
                    $('.video-preview').removeAttr("src")
                    $('.video-prev').hide();
                    // if(groupChatImgPreview.hasAttribute("src")){
                    console.log(reader)
                    messageInput.remove()
                    document.querySelector(".group-chat-send-form-message-parent-container")
                        .append(groupChatImgPreview)
                    document.querySelector(".group-chat-send-form-message-parent-container")
                        .append(cancelBtn)
                    // }
                }

                if (fileExtension === "mp4") {
                    var fileUrl = window.URL.createObjectURL(groupChatImgInput.files[0]);
                    $(".video-preview").attr("src", fileUrl)
                    groupChatImgInput.value = ""
                    groupChatImgPreview.removeAttribute("src")
                    groupChatImgPreview.remove()
                    messageInput.remove()
                    document.querySelector(".group-chat-send-form-message-parent-container")
                        .append(cancelBtn)
                    // document.querySelector(".group-chat-send-form-message-parent-container").append($(".video-prev"))
                    $(".video-prev").show()
                }
            }); // //

        })



        sendMessage.addEventListener('click', function(e) {
            e.preventDefault();

            var messageInput = document.querySelector('.message_input');
            console.log('reciever ', recieveUserId);
            console.log('sender auth user ', auth_user_id);

            var formdata = new FormData(messageForm);
            formdata.append('fileInput', fileName);
            formdata.append('sender',auth_user_name);

            if (messageInput != null) {
                axios.post('/api/message/chat/' + recieveUserId, {
                    text: messageInput.value,
                    sender: auth_user_name
                }).then();
                messageInput.value = "";
            }else{
                axios.post('/api/message/chat/' + recieveUserId, formdata
                ).then();
                clearGroupChatImg();
            }

        })

        Echo.private('chatting.'+auth_user_id+'.'+recieveUserId)
            .listen('Chatting', (data) => {
                console.log(data);
                if (data.message.from_user_id == recieveUserId) {

                                messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                        <img src="{{asset('/storage/post/receive_user_img')}}" />
                        <div class="group-chat-receiver-text-container">
                            <span>${data.sender}</span>
                            <p>${data.message.text}</p>
                        </div>
                    </div>`;

                } else {
                    if (data.message.media == null && data.message.text == null) {}else{
                        if(data.message.media != null){
                            if (data.message.media.split('.').pop() === 'png' || data.message.media
                            .split('.').pop() ===
                            'jpg' || data.message.media.split('.').pop() === 'jpeg' || data
                            .message.media.split('.').pop() === 'gif'){
                                messageContainer.innerHTML += `<div class="modal fade" id="exampleModalToggle${data.message.id}" aria-hidden="true"
                                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('/storage/customer_message_media/${data.message.media}') }}"
                                                        alt="test" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="group-chat-sender-container" id="trainer_message_el">
                                        <div class="group-chat-sender-text-container">
                                            <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}" role="button">
                                                <img
                                                    src="{{ asset('storage/customer_message_media/${data.message.media}') }}">
                                            </a>
                                        </div>
                                        <img src="{{ asset('img/avatar.png') }}" />
                                    </div>`;

                            }else if (data.message.media.split('.').pop() === 'mp4' || data.message.media.split('.').pop() ===
                                        'mov' || data.message.media.split('.').pop() === 'webm'){
                                            messageContainer.innerHTML += `<div class="group-chat-sender-container" id="trainer_message_el">
                                                            <div class="group-chat-sender-text-container">
                                                                <video width="100%" height="100%" controls>
                                                                    <source src="{{ asset('storage/customer_message_media/${data.message.media}') }}" type="video/mp4">
                                                                </video>
                                                            </div>
                                                            <img src="{{ asset('img/avatar.png') }}" />
                                                        </div>`;
                            }
                        } else{
                                messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                    <div class="group-chat-sender-text-container">
                                        <p>${data.message.text}</p>
                                    </div>
                                    <img src="../imgs/avatar.png"/>
                                </div>`;
                            }
                    }
                }
            })

            Echo.private('chatting.'+ recieveUserId+'.'+ auth_user_id)
            .listen('Chatting', (data) => {
                console.log(data);
                if (data.message.from_user_id == recieveUserId) {
                    if (data.message.media == null && data.message.text == null) {}else{
                        if(data.message.media !=null){
                            if (data.message.media.split('.').pop() === 'png' || data.message.media
                            .split('.').pop() ===
                            'jpg' || data.message.media.split('.').pop() === 'jpeg' || data
                            .message.media.split('.').pop() === 'gif'){
                                messageContainer.innerHTML += `<div class="modal fade" id="exampleModalToggle${data.message.id}" aria-hidden="true"
                                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('/storage/customer_message_media/${data.message.media}') }}"
                                                        alt="test" class="w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="group-chat-receiver-container" id="trainer_message_el">
                                        <img src="{{asset('/storage/post/receive_user_img')}}" />
                                        <div class="group-chat-receiver-text-container">
                                            <span>${data.sender}</span>
                                            <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}" role="button">
                                                <img
                                                    src="{{ asset('storage/customer_message_media/${data.message.media}') }}">
                                            </a>
                                        </div>
                                    </div>`;

                            }else if (data.message.media.split('.').pop() === 'mp4' || data.message.media.split('.').pop() ===
                                        'mov' || data.message.media.split('.').pop() === 'webm'){
                                            messageContainer.innerHTML += `<div class="group-chat-receiver-container" id="trainer_message_el">
                                                <img src="{{asset('/storage/post/receive_user_img')}}" />
                                                <div class="group-chat-receiver-text-container">
                                                                <span>${data.sender}</span>
                                                                <video width="100%" height="100%" controls>
                                                                    <source src="{{ asset('storage/customer_message_media/${data.message.media}') }}" type="video/mp4">
                                                                </video>
                                                            </div>
                                                        </div>`;
                            }
                        }else{
                                messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    <img src="{{asset('/storage/post/receive_user_img')}}" />
                                    <div class="group-chat-receiver-text-container">
                                        <span>${data.sender}</span>
                                        <p>${data.message.text}</p>
                                    </div>
                                </div>`;
                            }
                    }
                } else {
                    // if(data.message.from_user_id == recieveUserId && data.message.to_user_id == auth_user_id){
                    messageContainer.innerHTML += `<div class="group-chat-sender-container">
                            <div class="group-chat-sender-text-container">
                                <p>${data.message.text}</p>
                            </div>
                            <img src="../imgs/avatar.png"/>
                        </div>`;
                    // }

                }
            })




        var messageInput = document.querySelector('.message_input');

        var groupChatImgInput = document.querySelector('#groupChatImg');

        function clearGroupChatImg() {
            console.log("clear img preview")
            groupChatImgPreview.removeAttribute("src")
            groupChatImgPreview.remove()
            cancelBtn.remove()
            $('.video-preview').removeAttr("src")
            $('.video-prev').hide();
            document.querySelector(".group-chat-send-form-message-parent-container").append(messageInput)
            groupChatImgInput.value = ""

        }
    </script>
@endpush
