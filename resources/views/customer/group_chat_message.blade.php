@extends('customer.layouts.app_home')
@section('content')
    <div class="social-media-right-container">


        <input type="text" value="{{ $group->id }}" id="groupId" hidden>
        <div class="group-chat-header">
            <a href="{{ route('socialmedia.group.detail', $group->id) }}" class="group-chat-header-name-container">
                <img src="../imgs/avatar.png" />
                <div class="group-chat-header-name-text-container">
                    <p>{{ $group->group_name }}</p>
                </div>
            </a>
            <div class="chat-header-call-icons-container">
                <iconify-icon icon="ant-design:phone-outlined" class="chat-header-phone-icon"></iconify-icon>
                <iconify-icon icon="eva:video-outline" class="chat-header-video-icon"></iconify-icon>

                <a href="../htmls/trainerTrainingCenterViewMedia.html" class="group-chat-view-midea-link">
                    <p>View Media</p>
                    <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                </a>
            </div>

        </div>

        <div class="group-chat-messages-container">
            @foreach ($gp_messages as $gp_message)
                @if (auth()->user()->id != $gp_message->sender_id)
                    <div class="group-chat-receiver-container">
                        @if ($gp_message->user->user_profile == null)
                            <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                        @else
                            <img src="{{ asset('/storage/post' . $gp_message->user->user_profile->profile_image) }}" />
                        @endif

                        <div class="group-chat-receiver-text-container">
                            <span>{{ $gp_message->user->name }}</span>
                            <p>{{ $gp_message->text }}</p>
                        </div>
                    </div>
                @elseif(auth()->user()->id == $gp_message->sender_id)
                    <div class="group-chat-sender-container">
                        <div class="group-chat-sender-text-container">
                            <p>{{ $gp_message->text }}</p>
                        </div>
                        @if ($gp_message->user->user_profile == null)
                            <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                        @else
                            <img src="{{ asset('/storage/post' . $gp_message->user->user_profile->profile_image) }}" />
                        @endif
                    </div>
                @else
                @endif
            @endforeach

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

            <button type="submit" class="group-chat-send-form-submit-btn">
                <iconify-icon icon="akar-icons:send" class="group-chat-send-form-submit-btn-icon"></iconify-icon>
            </button>
        </form>

        <!-- </div> -->
    </div>
@endsection
@push('scripts')
    <script>
        var messageForm = document.getElementById('message_form')

        var sendMessage = document.querySelector('.group-chat-send-form-submit-btn')
        const groupChatImgPreview = document.querySelector('.groupChatImg')
        const cancelBtn = document.querySelector(".group-chat-img-cancel")
        const emojibutton = document.querySelector('.emoji-trigger')

        var groupId = document.getElementById('groupId').value
        var auth_user_id = {{ auth()->user()->id }}
        var messageContainer = document.querySelector('.group-chat-messages-container')
        var auth_user_data;
        var auth_user_img;

        $(document).ready(function() {
            auth_user_data = @json($auth_user_data);
            auth_user_img = auth_user_data.user_profile;

            var messageInput = document.querySelector('.message_input');

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
            });

        })


        sendMessage.addEventListener('click', function(e) {
            e.preventDefault();

            var messageInput = document.querySelector('.message_input');

            if (messageInput != null) {
                axios.post('/api/group/message/chat/' + groupId, {
                    text: messageInput.value,
                    senderId: auth_user_id,
                    senderImg: auth_user_img ? auth_user_img.profile_image : 'user_default',
                    senderName: auth_user_data.name
                }).then();
                messageInput.value = "";
            }

        })

        Echo.private('groupChatting.' + groupId)
            .listen('GroupChatting', (data) => {
                console.log(data);
                console.log(auth_user_img);
                if (data.message.sender_id == auth_user_id) {
                    if (auth_user_img == null) {
                        messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                        <div class="group-chat-sender-text-container">
                                            <p>${data.message.text}</p>
                                        </div>
                                        <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                    </div>`;
                    } else {
                        messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                            <div class="group-chat-sender-text-container">
                                                <p>${data.message.text}</p>
                                            </div>
                                            <img src="{{ asset('/storage/post/${auth_user_img.profile_image}') }}" />
                                        </div>`;
                    }
                } else {
                    if (data.senderImg == 'user_default') {
                        messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>${data.senderName}</span>
                                    <p>${data.message.text}</p>
                                </div>
                            </div>`;
                    } else {
                        messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                            <img src="{{ asset('/storage/post/${data.senderImg}') }}" />
                            <div class="group-chat-receiver-text-container">
                                <span>${data.senderName}</span>
                                <p>${data.message.text}</p>
                            </div>
                        </div>`;
                    }

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
