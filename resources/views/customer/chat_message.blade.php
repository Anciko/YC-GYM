@extends('customer.layouts.app_home')
@section('styles')
    <style>
        .chat-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 20;
            display: none
        }

        .modal2 {
            width: 400px;
            padding: 20px;
            margin: 100px auto;
            background: white;
            border-radius: 10px;
        }

        .backdrop {
            top: 0;
            position: fixed;
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            z-index: 999999 !important;
        }

        #video-container, #audio-container {
            width: 100%;
            height: 100%;
            /* max-width: 90vw;
                                        max-height: 50vh; */
            margin: 0 auto;
            border-radius: 0.25rem;
            position: relative;
            box-shadow: 1px 1px 11px #9e9e9e;
            background-color: #fff;
        }

        #audio-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }


        #local-video {
            width: 30%;
            height: 30%;
            position: absolute;
            left: 10px;
            bottom: 10px;
            border: 1px solid #fff;
            border-radius: 6px;
            z-index: 5;
            cursor: pointer;
        }

        #local-audio {
            width: 30%;
            height: 30%;
            position: absolute;
            left: 10px;
            bottom: 10px;
            border: 1px solid #fff;
            border-radius: 6px;
            z-index: 5;
            cursor: pointer;
        }

        #video-main-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 90%;
            max-width: 700px;
            height: 500px;
            z-index: 21;
            display: none;
        }

        #remote-video {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            z-index: 3;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }
        #remote-audio {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            z-index: 3;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        .action-btns {
            position: absolute;
            bottom: 20px;
            left: 50%;
            margin-left: -50px;
            z-index: 4;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        #incomingCallContainer {
            position: absolute;
            top: 100px;
        }

        #incoming_call {
            position: relative;
            z-index: 99;
        }
    </style>
@endsection
@section('content')
    <div class="chat-backdrop"></div>

    <div class="social-media-right-container">


        <div class="group-chat-header">
            <div class="group-chat-header-name-container">
                <img src="{{ asset('/storage/post' . $receiver_user->profile_image) }}" />
                <div class="group-chat-header-name-text-container">
                    <p>{{ $receiver_user->name }}</p>
                    <small class="active-now" style="color:#3CDD57;"></small>
                </div>
            </div>

            <div class="chat-header-call-icons-container">
                <a onclick="placeCallAudio('{{ $receiver_user->id }}','{{ $receiver_user->name }}')">
                    <iconify-icon icon="ant-design:phone-outlined" class="chat-header-phone-icon"></iconify-icon>
                </a>
                <a onclick="placeCall('{{ $receiver_user->id }}','{{ $receiver_user->name }}')">
                    <iconify-icon icon="eva:video-outline" class="chat-header-video-icon"></iconify-icon>
                </a>
                <a href="{{ route('message.viewmedia', $receiver_user->id) }}" class="group-chat-view-midea-link">
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
                            <img src="{{ asset('/storage/post' . $sender_user->profile_image) }}" />
                        </div>
                    @else
                        @if (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpg' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpeg')
                            {{-- modal --}}
                            <div class="modal fade" id="exampleModalToggle{{ $send_message->id }}" aria-hidden="true"
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
                                    <a data-bs-toggle="modal" href="#exampleModalToggle{{ $send_message->id }}"
                                        role="button">
                                        <img src="{{ asset('storage/customer_message_media/' . $send_message->media) }}">
                                    </a>
                                </div>
                                <img src="{{ asset('/storage/post' . $sender_user->profile_image) }}" />
                            </div>
                        @elseif(pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')
                            <div class="group-chat-sender-container" id="trainer_message_el">
                                <div class="group-chat-sender-text-container">
                                    <video width="100%" height="100%" controls>
                                        <source src="{{ asset('storage/customer_message_media/' . $send_message->media) }}"
                                            type="video/mp4">
                                    </video>
                                </div>
                                <img src="{{ asset('/storage/post' . $sender_user->profile_image) }}" />
                            </div>
                        @endif
                    @endif
                @elseif(auth()->user()->id != $send_message->from_user_id)
                    @if ($send_message->media == null)
                        <div class="group-chat-receiver-container">
                            <img src="{{ asset('/storage/post' . $receiver_user->profile_image) }}" />
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
                            <div class="modal fade" id="exampleModalToggle{{ $send_message->id }}" aria-hidden="true"
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
                                <img src="{{ asset('/storage/post' . $receiver_user->profile_image) }}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>{{ $send_message->from_user->name }}</span>
                                    <a data-bs-toggle="modal" href="#exampleModalToggle{{ $send_message->id }}"
                                        role="button">
                                        <img src="{{ asset('storage/customer_message_media/' . $send_message->media) }}">
                                    </a>
                                </div>
                            </div>
                        @elseif(pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                            pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')
                            <div class="group-chat-receiver-container" id="trainer_message_el">
                                <img src="{{ asset('/storage/post' . $receiver_user->profile_image) }}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>{{ $send_message->from_user->name }}</span>
                                    <video width="100%" height="100%" controls>
                                        <source src="{{ asset('storage/customer_message_media/' . $send_message->media) }}"
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

        <!-- Incoming Call  -->


        <!-- End of Incoming Call  -->

        <div id="incomingCallContainer">

        </div>

        <div id="video-main-container">

        </div>

        <form class="group-chat-send-form-container" id="message_form" enctype="multipart/form-data">
            <div class="group-chat-send-form-message-parent-container">
                <div class="group-chat-send-form-img-emoji-container">
                    <label class="group-chat-send-form-img-contaier">
                        <iconify-icon icon="bi:images" class="group-chat-send-form-img-icon">

                        </iconify-icon>
                        <input type="file" id="groupChatImg_message" name="fileInput" multiple="multiple">
                    </label>
                    <button type="button" id="emoji-button" class="emoji-trigger">
                        <iconify-icon icon="bi:emoji-smile" class="group-chat-send-form-emoji-icon"></iconify-icon>
                    </button>

                </div>

                <textarea id="mytextarea" class="group-chat-send-form-input message_input" placeholder="Message..." required></textarea>
                <div class="group-chat-img-preview-container"></div>
                {{-- <img class="group-chat-img-preview groupChatImg">
                <div style="display: none;" class='video-prev'>
                    <video height="200" width="300" class="video-preview" controls="controls"></video>
                </div>
                <button type="reset" class="group-chat-img-cancel" onclick="clearGroupChatImg()">
                    <iconify-icon icon="charm:cross" class="group-chat-img-cancel-icon"></iconify-icon>
                </button> --}}
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

        // var groupChatImgInput = document.querySelector('#groupChatImg');

        // const groupChatImgPreview = document.querySelector('.groupChatImg');
        // const cancelBtn = document.querySelector(".group-chat-img-cancel");
        const emojibutton = document.querySelector('.emoji-trigger');
        var recieveUser = document.getElementById('recieveUser');

        var messageContainer = document.querySelector('.group-chat-messages-container');


        var auth_user_id = {{ auth()->user()->id }};
        var auth_user_name = "{{ auth()->user()->name }}";
        var recieveUserId = recieveUser.value;
        var fileName;
        var receive_user_img;
        var sender_user_img;

        var messageInput_message = document.querySelector('.message_input');


        $(document).ready(function() {
            $('.group-chat-messages-container').scrollTop($('.group-chat-messages-container')[0].scrollHeight);
        });

        $(document).ready(function() {
            // console.log("image preview")
            //image and video select start
            $("#groupChatImg_message").on("change",handleFileSelect_message);

            // $("#editPostInput").on("change", handleFileSelectEdit);

            selDiv = $(".group-chat-img-preview-container");

            console.log(selDiv);

            $("body").on("click", ".delete-preview-icon", removeFile_message);
            // $("body").on("click", ".delete-preview-edit-input-icon", removeFileFromEditInput);

            console.log($("#selectFilesM").length);
            //image and video select end



            ///start
            receive_user_img = @json($receiver_user->profile_image);
            sender_user_img = @json($sender_user->profile_image);


            // var groupChatImgInput = document.querySelector('#groupChatImg');

            // const groupChatImgPreview = document.querySelector('.groupChatImg');
            // const cancelBtn = document.querySelector(".group-chat-img-cancel");
            const emojibutton = document.querySelector('.emoji-trigger');

            const picker = new EmojiButton();

            emojibutton.addEventListener('click', () => {
                picker.togglePicker(emojibutton);

            });

            picker.on('emoji', emoji => {
                messageInput_message.value += emoji;
            });


            // if (groupChatImgPreview != null) {
            //     if (!groupChatImgPreview.hasAttribute("src")) {
            //         groupChatImgPreview.remove()
            //         //$('.video-prev').remove();
            //         cancelBtn.remove()
            //     }
            // }


            // groupChatImgInput.addEventListener('change', (e) => {
            //     console.log('lahsdjk');
            //     fileName = groupChatImgInput.files[0];
            //     console.log(fileName);
            //     var fileExtension;

            //     fileExtension = e.target.value.replace(/^.*\./, '');
            //     console.log(fileExtension)
            //     if (fileExtension === "jpg" || fileExtension === "jpeg" || fileExtension ===
            //         "png" || fileExtension ===
            //         "gif") {
            //         const reader = new FileReader();
            //         reader.onloadend = e => groupChatImgPreview.setAttribute('src', e.target
            //             .result);
            //         reader.readAsDataURL(groupChatImgInput.files[0]);
            //         groupChatImgInput.value = ""
            //         $('.video-preview').removeAttr("src")
            //         $('.video-prev').hide();
            //         // if(groupChatImgPreview.hasAttribute("src")){
            //         console.log(reader)
            //         messageInput_message.remove()
            //         document.querySelector(".group-chat-send-form-message-parent-container")
            //             .append(groupChatImgPreview)
            //         document.querySelector(".group-chat-send-form-message-parent-container")
            //             .append(cancelBtn)
            //         // }
            //     }

            //     if (fileExtension === "mp4") {
            //         var fileUrl = window.URL.createObjectURL(groupChatImgInput.files[0]);
            //         $(".video-preview").attr("src", fileUrl)
            //         groupChatImgInput.value = ""
            //         groupChatImgPreview.removeAttribute("src")
            //         groupChatImgPreview.remove()
            //         messageInput_message.remove()
            //         document.querySelector(".group-chat-send-form-message-parent-container")
            //             .append(cancelBtn)
            //         // document.querySelector(".group-chat-send-form-message-parent-container").append($(".video-prev"))
            //         $(".video-prev").show()
            //     }
            // }); // //

        })

        //image and video select start
        var selDiv = "";

        var storedFiles_message = [];
        // var storedFiles_messageEdit = [];
        const dt_message = new DataTransfer();
        // const dtEdit = new DataTransfer();

        function handleFileSelect_message(e) {

            var files = e.target.files;
            console.log(files)

            var filesArr = Array.prototype.slice.call(files);

            var device = $(e.target).data("device");

            filesArr.forEach(function(f) {
                // console.log(f);
                if (f.type.match("image.*")) {
                    storedFiles_message.push(f);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                    var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-icon'></iconify-icon><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'></div>";

                    if (device == "mobile") {
                        $("#selectedFilesM").append(html);
                    } else {
                        $(".group-chat-img-preview-container").append(html);
                    }
                    }
                    reader.readAsDataURL(f);
                    dt_message.items.add(f);
                }else if(f.type.match("video.*")){
                    storedFiles_message.push(f);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                    var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-icon'></iconify-icon><video controls><source src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/><video></div>";

                    if (device == "mobile") {
                        $("#selectedFilesM").append(html);
                    } else {
                        $(".group-chat-img-preview-container").append(html);
                    }
                    }
                    reader.readAsDataURL(f);
                    dt_message.items.add(f);
                }


            });

            document.getElementById('groupChatImg_message').files = dt_message.files;
            console.log(document.getElementById('groupChatImg_message').files+" Add Post Input")
            console.log(storedFiles_message.length,"stored files")

            if(storedFiles_message.length === 0){
                $('.group-chat-send-form-message-parent-container').append(messageInput_message)

            }else{
                messageInput_message.remove()
            }

        }

        // function handleFileSelectEdit(e) {

        //     var files = e.target.files;
        //     console.log(files)

        //     var filesArr = Array.prototype.slice.call(files);

        //     var device = $(e.target).data("device");

        //     filesArr.forEach(function(f) {

        //         if (f.type.match("image.*")) {
        //             storedFiles_messageEdit.push(f);

        //             var reader = new FileReader();
        //             reader.onload = function(e) {
        //             var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-edit-input-icon'></iconify-icon><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'></div>";

        //             if (device == "mobile") {
        //                 $("#selectedFilesM").append(html);
        //             } else {
        //                 $(".editpost-photo-video-imgpreview-container").append(html);
        //             }
        //             }
        //             reader.readAsDataURL(f);
        //             // dtEdit.items.add(f);
        //         }else if(f.type.match("video.*")){
        //             storedFiles_messageEdit.push(f);

        //             var reader = new FileReader();
        //             reader.onload = function(e) {
        //             var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-edit-input-icon'></iconify-icon><video controls><source src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/><video></div>";

        //             if (device == "mobile") {
        //                 $("#selectedFilesM").append(html);
        //             } else {
        //                 $(".editpost-photo-video-imgpreview-container").append(html);
        //             }
        //             }
        //             reader.readAsDataURL(f);
        //             // dtEdit.items.add(f);
        //         }

        //     });

        //     document.getElementById('editPostInput').files = dtEdit.files;
        //     console.log(document.getElementById('editPostInput').files+" Edit Post Input")

        // }

        function removeFile_message(e) {
            var file = $(this).data("file");
            var names = [];
            for(let i = 0; i < dt_message.items.length; i++){
                if(file === dt_message.items[i].getAsFile().name){
                    dt_message.items.remove(i);
                }
            }
            document.getElementById('groupChatImg_message').files = dt_message.files;

            for (var i = 0; i < storedFiles_message.length; i++) {
                if (storedFiles_message[i].name === file) {
                storedFiles_message.splice(i, 1);
                break;
                }
            }
            $(this).parent().remove();

            console.log(storedFiles_message.length)

            if(storedFiles_message.length === 0){
                console.log($('.group-chat-send-form-message-parent-container'))
                $('.group-chat-send-form-message-parent-container').append(messageInput_message)

            }else{
                messageInput_message.remove()
            }
        }
        // function removeFileFromEditInput(e) {
        //     var file = $(this).data("file");
        //     var names = [];
        //     for(let i = 0; i < dtEdit.items.length; i++){
        //         if(file === dtEdit.items[i].getAsFile().name){
        //             dtEdit.items.remove(i);
        //         }
        //     }
        //     document.getElementById('editPostInput').files = dtEdit.files;

        //     for (var i = 0; i < storedFiles_messageEdit.length; i++) {
        //         if (storedFiles_messageEdit[i].name === file) {
        //         storedFiles_messageEdit.splice(i, 1);
        //         break;
        //         }
        //     }
        //     $(this).parent().remove();
        // }


        function clearAddPost(){
            storedFiles_message = []
            dt_message.clearData()
            document.getElementById('groupChatImg_message').files = dt_message.files;
            $(".group-chat-img-preview-container").empty();
        }



        //image and video select end



        sendMessage.addEventListener('click', function(e) {
            e.preventDefault();

            var messageInput = document.querySelector('.message_input');
            console.log('reciever ', recieveUserId);
            console.log('sender auth user ', auth_user_id);

            var formdata = new FormData(messageForm);
            formdata.append('fileInput', fileName);
            formdata.append('sender', auth_user_name);

            if (messageInput != null) {
                axios.post('/api/message/chat/' + recieveUserId, {
                    text: messageInput.value,
                    sender: auth_user_name
                }).then();
                messageInput.value = "";
            } else {
                axios.post('/api/message/chat/' + recieveUserId, formdata).then();
                clearGroupChatImg();
            }

        })

        Echo.private('chatting.' + auth_user_id + '.' + recieveUserId)
            .listen('Chatting', (data) => {
                console.log(data);
                if (data.message.from_user_id == recieveUserId) {

                    messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                        <img src="{{ asset('/storage/post/receive_user_img') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>${data.sender}</span>
                            <p>${data.message.text}</p>
                        </div>
                    </div>`;

                } else {
                    if (data.message.media == null && data.message.text == null) {} else {
                        if (data.message.media != null) {
                            if (data.message.media.split('.').pop() === 'png' || data.message.media
                                .split('.').pop() ===
                                'jpg' || data.message.media.split('.').pop() === 'jpeg' || data
                                .message.media.split('.').pop() === 'gif') {
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
                                        <img src="{{ asset('/storage/post/sender_user_img') }}" />
                                    </div>`;

                            } else if (data.message.media.split('.').pop() === 'mp4' || data.message.media.split('.')
                                .pop() ===
                                'mov' || data.message.media.split('.').pop() === 'webm') {
                                messageContainer.innerHTML += `<div class="group-chat-sender-container" id="trainer_message_el">
                                                            <div class="group-chat-sender-text-container">
                                                                <video width="100%" height="100%" controls>
                                                                    <source src="{{ asset('storage/customer_message_media/${data.message.media}') }}" type="video/mp4">
                                                                </video>
                                                            </div>
                                                            <img src="{{ asset('/storage/post/sender_user_img') }}" />
                                                        </div>`;
                            }
                        } else {
                            messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                    <div class="group-chat-sender-text-container">
                                        <p>${data.message.text}</p>
                                    </div>
                                    <img src="{{ asset('/storage/post/sender_user_img') }}" />
                                </div>`;
                        }
                    }
                }
            })

        Echo.private('chatting.' + recieveUserId + '.' + auth_user_id)
            .listen('Chatting', (data) => {
                console.log(data);
                if (data.message.from_user_id == recieveUserId) {
                    if (data.message.media == null && data.message.text == null) {} else {
                        if (data.message.media != null) {
                            if (data.message.media.split('.').pop() === 'png' || data.message.media
                                .split('.').pop() ===
                                'jpg' || data.message.media.split('.').pop() === 'jpeg' || data
                                .message.media.split('.').pop() === 'gif') {
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
                                        <img src="{{ asset('/storage/post/receive_user_img') }}" />
                                        <div class="group-chat-receiver-text-container">
                                            <span>${data.sender}</span>
                                            <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}" role="button">
                                                <img
                                                    src="{{ asset('storage/customer_message_media/${data.message.media}') }}">
                                            </a>
                                        </div>
                                    </div>`;

                            } else if (data.message.media.split('.').pop() === 'mp4' || data.message.media.split('.')
                                .pop() ===
                                'mov' || data.message.media.split('.').pop() === 'webm') {
                                messageContainer.innerHTML += `<div class="group-chat-receiver-container" id="trainer_message_el">
                                                <img src="{{ asset('/storage/post/receive_user_img') }}" />
                                                <div class="group-chat-receiver-text-container">
                                                                <span>${data.sender}</span>
                                                                <video width="100%" height="100%" controls>
                                                                    <source src="{{ asset('storage/customer_message_media/${data.message.media}') }}" type="video/mp4">
                                                                </video>
                                                            </div>
                                                        </div>`;
                            }
                        } else {
                            messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    <img src="{{ asset('/storage/post/receive_user_img') }}" />
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
                            <img src="{{ asset('/storage/post/sender_user_img') }}" />
                        </div>`;
                    // }

                }
            })




        // var messageInput = document.querySelector('.message_input');

        // var groupChatImgInput = document.querySelector('#groupChatImg');

        // function clearGroupChatImg() {
        //     console.log("clear img preview")
        //     groupChatImgPreview.removeAttribute("src")
        //     groupChatImgPreview.remove()
        //     cancelBtn.remove()
        //     $('.video-preview').removeAttr("src")
        //     $('.video-prev').hide();
        //     document.querySelector(".group-chat-send-form-message-parent-container").append(messageInput)
        //     groupChatImgInput.value = ""

        // }
    </script>

    <script>
        $(".chat-backdrop").hide();
         let voice_receive_user_img = @json($receiver_user->profile_image);
        console.log("ferer", voice_receive_user_img);
        let onlineUsers = []
        let client = null
        let callPlaced = false
        let localStream = null
        let incomingCaller = "";
        let agoraChannel = null
        let incomingCall = false;
        let incomingAudioCall = false;
        let videoCallEvent = false;
        let audioCallEvent = false;
        let mutedVideo = false
        let mutedAudio = false
        const agora_id = 'e8d6696cc7dc449dbd78ebbd1e15ee13'

        let authuser = "{{ auth()->user()->name }}"
        let authuserId = "{{ auth()->id() }}"

        let incoming_call = document.getElementById('incoming_call')
        let video_container = document.getElementById('video-main-container')
        let incomingCallContainer = document.querySelector('#incomingCallContainer')

        let friends = @json($friends);


        // ////////////////////////
        Echo.join('agora-videocall')
            .here((users) => {
                console.log('onlineuser', users);
                onlineUsers = users
                console.log(onlineUsers, 'onlineuser');

                users.forEach((user, index) => {
                    friends.forEach(friend =>{
                        if(user.id == friend.id){
                            let element = document.querySelector('.active-now')
                            element.innerText = 'Active Now'
                        }
                    })
                })

            })
            .joining((user) => {
                const joiningUserIndex = onlineUsers.findIndex(
                    (data) => data.id === user.id
                )
                if (joiningUserIndex < 0) {
                    onlineUsers.push(user);
                }
            })
            .leaving((user) => {
                const leavingUserIndex = onlineUsers.findIndex(
                    (data) => data.id === user.id
                );
                onlineUsers.splice(leavingUserIndex, 1);
                console.log('leeeving');
            })
            .listen("MakeAgoraCall", ({
                data
            }) => {
                console.log('listening-------------------------', data);
                if (parseInt(data.userToCall) === parseInt(authuserId)) {
                    const callerIndex = onlineUsers.findIndex(
                        (user) => user.id === data.from
                    )
                    console.log('caller index', callerIndex);
                    incomingCaller = onlineUsers[callerIndex]["name"]
                    incomingCall = true


                    console.log('incomingcaller', incomingCaller);

                    console.log('llllllrweer', incomingCall);

                    console.log('incoming audio calll checkkkkk', incomingAudioCall);
                    if (incomingCall) {
                        $(".chat-backdrop").show();

                        incomingCallContainer.innerHTML += `<div class="row my-5" id="incoming_call">

                                <div class="card shadow p-4 col-12">
                                    <p>
                                        Video Call From <span>${incomingCaller}</span>
                                    </p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <button type="button" class="btn btn-sm btn-danger"  id="" onclick="declineCall()">
                                            Decline
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success ml-5" onclick="acceptCall()">
                                            Accept
                                        </button>
                                    </div>
                                </div>
                            </div>`;


                    }
                    agoraChannel = data.channelName
                }
            }).listen("MakeAgoraAudioCall", ({
                data
            }) => {
                console.log('listening-------------------------', data);
                if (parseInt(data.userToCall) === parseInt(authuserId)) {
                    const callerIndex = onlineUsers.findIndex(
                        (user) => user.id === data.from
                    )
                    console.log('caller index', callerIndex);
                    incomingCaller = onlineUsers[callerIndex]["name"]
                    incomingCall = true
                    incomingAudioCall = true


                    console.log('incomingcaller', incomingCaller);

                    console.log('llllllrweer', incomingCall);

                    console.log('incoming audio calll checkkkkk', incomingAudioCall);
                    if (incomingCall) {
                        $(".chat-backdrop").show();
                        if (incomingAudioCall) {
                            incomingCallContainer.innerHTML += `<div class="row my-5" id="incoming_call">

                                <div class="card shadow p-4 col-12">
                                    <p>
                                        Audio Call From <span>${incomingCaller}</span>
                                    </p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <button type="button" class="btn btn-sm btn-danger"  id="" onclick="declineCall()">
                                            Decline
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success ml-5" onclick="acceptCall()">
                                            Accept
                                        </button>
                                    </div>
                                </div>
                            </div>`;

                        }


                    }
                    agoraChannel = data.channelName
                }
            })

        // /////////////////////////

        async function placeCall(id, call_name) {
            try {
                const channelName = `${authuser}_${call_name}`;
                const tokenRes = await generateToken(channelName)

                console.log(tokenRes.data);

                axios.post("/agora/call-user", {
                    user_to_call: id,
                    username: authuser,
                    channel_name: channelName,
                });
                initializeAgora()
                joinRoom(tokenRes.data, channelName)
                callPlaced = true

                videoCallEvent = true;

                // if(callPlaced){
                //     video_container.classList.remove('hide')
                // }
            } catch (error) {
                console.log(error);
            }
        }

        async function placeCallAudio(id, call_name) {
            try {
                const channelName = `${authuser}_${call_name}`;
                const tokenRes = await generateToken(channelName);

                console.log(tokenRes.data);

                axios.post("/agora/call-audio-user", {
                    user_to_call: id,
                    username: authuser,
                    channel_name: channelName,
                });
                initializeAgora()
                joinRoom(tokenRes.data, channelName)
                callPlaced = true;
                incomingAudioCall = true;

                audioCallEvent = true;
                // if(callPlaced){
                //     video_container.classList.remove('hide')
                // }
            } catch (error) {
                console.log(error);
            }
        }


        function generateToken(channelName) {
            return axios.post("/agora/token", {
                channelName,
            });
        }

        function initializeAgora() {
            client = AgoraRTC.createClient({
                mode: "rtc",
                codec: "h264"
            });
            client.init(
                agora_id,
                () => {
                    console.log("AgoraRTC client initialized");
                },
                (err) => {
                    console.log("AgoraRTC client init failed", err);
                }
            );
        }

        async function acceptCall() {
            console.log('call accept');
            initializeAgora();
            const tokenRes = await generateToken(agoraChannel);
            joinRoom(tokenRes.data, agoraChannel);
            incomingCall = false;
            callPlaced = true;
            videoCallEvent = true;
            incomingCallContainer.innerHTML = ""

        }

        function declineCall() {
            incomingCall = false;
            incomingCallContainer.innerHTML = "";
            $(".chat-backdrop").hide()
        }

        async function joinRoom(token, channel) {
            console.log('leeeeeee', channel);
            client.join(
                token,
                channel,
                authuser,
                (uid) => {
                    console.log("User " + uid + " join channel successfully");
                    callPlaced = true

                    console.log("incoming audio call lay pr", incomingAudioCall);

                    if (callPlaced) {
                        // parent.document.body.classList.add('backdrop')
                        $("#video-main-container").show()
                        $(".chat-backdrop").show();
                        if (incomingAudioCall) {
                            video_container.innerHTML += `
                                                    <div id="audio-container">
                                                       <div id="local-audio"></div>
                                                        <div id="remote-audio"></div>
                                                    <div class="text-center ">
                                                        <img src="{{ asset('storage/payments/636cb4795561d_kpay.png' ) }}" class="rounded-circle img-thumbnail img-fluid shadow" width="200" height="200" />
                                                        <p class="mb-0 mt-3" style="color:#3CDD57;">Username</p>
                                                    </div>
                                                    <div class="action-btns">
                                                        <button type="button" class="btn btn-info p-2 me-3" id="muteAudio" onclick="handleAudioToggle(this)">
                                                            <i class="fa-solid fa-microphone-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger p-2" onclick="endCall()">
                                                            <i class="fa-solid fa-phone-slash" style="width:30px"></i>
                                                        </button>
                                                    </div></div>
                                        `;

                            createAudioLocalStream();
                            initializedAgoraListeners();
                        } else {
                            video_container.innerHTML += `
                                                    <div id="video-container">
                                                        <div id="local-video"></div>
                                                    <div id="remote-video"></div>
                                                    <div class="action-btns">
                                                        <button type="button" class="btn btn-info p-2" id="muteAudio" onclick="handleAudioToggle(this)">
                                                            <i class="fa-solid fa-microphone-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary mx-4 p-2" id="muteVideo" onclick="handleVideoToggle(this)">
                                                            <i class="fa-solid fa-video-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger p-2" onclick="endCall()">
                                                            <i class="fa-solid fa-phone-slash" style="width:30px"></i>
                                                        </button>
                                                    </div></div>
                                        `;
                            createLocalStream();
                            initializedAgoraListeners();
                        }

                    }

                },
                (err) => {
                    console.log("Join channel failed", err);
                }
            );
        }

        function initializedAgoraListeners() {
            //   Register event listeners
            client.on("stream-published", function(evt) {
                console.log("Publish local stream successfully");
                console.log(evt);
            });
            //subscribe remote stream
            client.on("stream-added", ({
                stream
            }) => {
                console.log("New stream added: " + stream.getId());
                client.subscribe(stream, function(err) {
                    console.log("Subscribe stream failed", err);
                });
            });
            client.on("stream-subscribed", (evt) => {
                // Attach remote stream to the remote-video div
                // evt.stream.play("remote-video");
                //     client.publish(evt.stream);
                if(videoCallEvent) {
                    evt.stream.play("remote-video");
                    client.publish(evt.stream);
                }

                if(audioCallEvent) {
                    evt.stream.play("remote-audio");
                    client.publish(evt.stream);
                }



            });
            client.on("stream-removed", ({
                stream
            }) => {
                console.log(String(stream.getId()));
                stream.close();
            });
            client.on("peer-online", (evt) => {
                console.log("peer-online", evt.uid);
            });
            client.on("peer-leave", (evt) => {
                var uid = evt.uid;
                var reason = evt.reason;
                console.log("remote user left ", uid, "reason: ", reason);
            });
            client.on("stream-unpublished", (evt) => {
                console.log(evt);
            });
        }


        function createLocalStream() {
            localStream = AgoraRTC.createStream({
                audio: true,
                video: true,
            });
            // Initialize the local stream
            localStream.init(
                () => {
                    // Play the local stream
                    localStream.play("local-video");
                    // Publish the local stream
                    client.publish(localStream, (data) => {
                        console.log("publish local stream", data);
                    });
                },
                (err) => {
                    console.log(err);
                }
            );
        }

        function createAudioLocalStream() {
            localStream = AgoraRTC.createStream({
                audio: true,
                video: false,
            });
            // Initialize the local stream
            localStream.init(
                () => {
                    // Play the local stream
                    localStream.play("local-audio");
                    // Publish the local stream
                    client.publish(localStream, (data) => {
                        console.log("publish local stream", data);
                    });
                },
                (err) => {
                    console.log(err);
                }
            );
        }

        function endCall() {
            localStream.close();
            client.leave(
                () => {
                    console.log("Leave channel successfully");
                    callPlaced = false;
                },
                (err) => {
                    console.log("Leave channel failed");
                }
            );
            video_container.innerHTML = "";
            $(".chat-backdrop").hide()
            location.reload(true)
        }

        function handleAudioToggle(e) {
            if (mutedAudio) {
                localStream.unmuteAudio();
                mutedAudio = false;
                e.innerHTML = `<i class="fa-solid fa-microphone-slash" style="width:30px"></i>`;
            } else {
                localStream.muteAudio();
                mutedAudio = true;
                e.innerHTML = `<i class="fa-solid fa-microphone" style="width:30px"></i>`;
            }
        }

        function handleVideoToggle(e) {
            if (mutedVideo) {
                localStream.unmuteVideo();
                mutedVideo = false;
                e.innerHTML = ` <i class="fa-solid fa-video-slash" style="width:30px"></i>`;
            } else {
                localStream.muteVideo();
                mutedVideo = true;
                e.innerHTML = `<i class="fa-solid fa-video" style="width:30px"></i>`;
            }
        }
    </script>
@endpush
