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

                <a href="{{route('socialmedia.group.viewmedia',$group->id)}}" class="group-chat-view-midea-link">
                    <p>View Media</p>
                    <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                </a>
            </div>

        </div>

        <div class="group-chat-messages-container">
            @foreach ($gp_messages as $gp_message)
                @if (auth()->user()->id != $gp_message->sender_id)
                    @if ($gp_message->text != null)
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
                    @else
                        <div class="group-chat-receiver-container">
                            @if ($gp_message->user->user_profile == null)
                                <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                            @else
                                <img src="{{ asset('/storage/post' . $gp_message->user->user_profile->profile_image) }}" />
                            @endif
                            <div class="group-chat-receiver-text-container">
                                <span>{{ $gp_message->user->name }}</span>
                                <div class=" group-chat-imgs-vids-container">
                                @foreach (json_decode($gp_message->media) as $key => $media)

                                    @if (pathinfo($media, PATHINFO_EXTENSION) == 'png' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'jpg' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'jpeg')
                                        <div class="modal fade" id="exampleModalToggle{{ $gp_message->id }}{{ $key }}"
                                            aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                            class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="group-chat-receiver-text-container"> --}}
                                            <a data-bs-toggle="modal"
                                                href="#exampleModalToggle{{ $gp_message->id }}{{ $key }}"
                                                role="button">
                                                <img src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                    title="{{ $key }}">
                                            </a>
                                        {{-- </div> --}}
                                    @elseif(pathinfo($media, PATHINFO_EXTENSION) == 'mp4' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'mov' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'webm')
                                        {{-- <div class="group-chat-receiver-text-container"> --}}

                                            <video width="100%" height="100%" controls>
                                                <source src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                    type="video/mp4">
                                            </video>
                                        {{-- </div> --}}
                                    @endif
                                @endforeach
                                </div>
                            </div>

                        </div>
                    @endif
                @elseif(auth()->user()->id == $gp_message->sender_id)
                    <div class="group-chat-sender-container">
                        <div class="group-chat-sender-text-container">
                            <span>{{ $gp_message->user->name }}</span>
                            @if ($gp_message->text != null)
                                <p>{{ $gp_message->text }}</p>
                            @else
                            <div class="group-chat-imgs-vids-container">
                                @foreach (json_decode($gp_message->media) as $key => $media)
                                    @if (pathinfo($media, PATHINFO_EXTENSION) == 'png' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'jpg' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'jpeg')
                                        <div class="modal fade"
                                            id="exampleModalToggle{{ $gp_message->id }}{{ $key }}"
                                            aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                            class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a data-bs-toggle="modal"
                                            href="#exampleModalToggle{{ $gp_message->id }}{{ $key }}"
                                            role="button">
                                            <img src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                title="{{ $key }}">
                                        </a>
                                    @elseif(pathinfo($media, PATHINFO_EXTENSION) == 'mp4' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'mov' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'webm')
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ asset('storage/customer_message_media/' . $media) }}"
                                                type="video/mp4">
                                        </video>
                                    @endif
                                @endforeach
                                </div>
                            @endif
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
                        <input type="file" name="fileSend[]" id="groupChatImg_message" multiple="multiple">
                    </label>
                    <button type="button" id="emoji-button" class="emoji-trigger">
                        <iconify-icon icon="bi:emoji-smile" class="group-chat-send-form-emoji-icon"></iconify-icon>
                    </button>

                </div>

                <textarea id="mytextarea" class="group-chat-send-form-input message_input" placeholder="Message..." required></textarea>
                <div class="group-chat-img-preview-container-wrapper">
                    <div class="group-chat-img-preview-container"></div>
                </div>
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

        const emojibutton = document.querySelector('.emoji-trigger')

        var groupId = document.getElementById('groupId').value
        var auth_user_id = {{ auth()->user()->id }}
        var messageContainer = document.querySelector('.group-chat-messages-container')

        var auth_user_data;
        var auth_user_img;

        var messageInput_message = document.querySelector('.message_input');


        $(document).ready(function() {
            $('.group-chat-messages-container').scrollTop($('.group-chat-messages-container')[0].scrollHeight);
            //image and video select start
            $("#groupChatImg_message").on("change", handleFileSelect_message);

            // $("#editPostInput").on("change", handleFileSelectEdit);

            selDiv = $(".group-chat-img-preview-container");

            console.log(selDiv);

            $("body").on("click", ".delete-preview-icon", removeFile_message);
            // $("body").on("click", ".delete-preview-edit-input-icon", removeFileFromEditInput);

            console.log($("#selectFilesM").length);
            //image and video select end


            auth_user_data = @json($auth_user_data);
            auth_user_img = auth_user_data.user_profile;

            var messageInput = document.querySelector('.message_input');

            const emojibutton = document.querySelector('.emoji-trigger');

            const picker = new EmojiButton();

            emojibutton.addEventListener('click', () => {
                picker.togglePicker(emojibutton);

            });

            picker.on('emoji', emoji => {
                messageInput.value += emoji;
            });

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
                        var html =
                            "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f
                            .name + "' class='delete-preview-icon'></iconify-icon><img src=\"" + e.target
                            .result + "\" data-file='" + f.name +
                            "' class='selFile' title='Click to remove'></div>";

                        if (device == "mobile") {
                            $("#selectedFilesM").append(html);
                        } else {
                            $(".group-chat-img-preview-container").append(html);
                        }
                    }
                    reader.readAsDataURL(f);
                    dt_message.items.add(f);
                } else if (f.type.match("video.*")) {
                    storedFiles_message.push(f);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var html =
                            "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f
                            .name +
                            "' class='delete-preview-icon'></iconify-icon><video controls><source src=\"" + e
                            .target.result + "\" data-file='" + f.name +
                            "' class='selFile' title='Click to remove'>" + f.name +
                            "<br clear=\"left\"/><video></div>";

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
            console.log(document.getElementById('groupChatImg_message').files + " Add Post Input")
            console.log(storedFiles_message.length, "stored files")

            if (storedFiles_message.length === 0) {
                $('.group-chat-send-form-message-parent-container').append(messageInput_message)
                $(".group-chat-img-preview-container-wrapper").hide()

            } else {
                messageInput_message.remove()
                $(".group-chat-img-preview-container-wrapper").show()
            }

        }


        function removeFile_message(e) {
            var file = $(this).data("file");
            var names = [];
            for (let i = 0; i < dt_message.items.length; i++) {
                if (file === dt_message.items[i].getAsFile().name) {
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

            if (storedFiles_message.length === 0) {
                console.log($('.group-chat-send-form-message-parent-container'))
                $('.group-chat-send-form-message-parent-container').append(messageInput_message)
                $(".group-chat-img-preview-container-wrapper").hide()

            } else {
                messageInput_message.remove()
                $(".group-chat-img-preview-container-wrapper").show()
            }
        }

        function clearAddPost() {
            storedFiles_message = []
            dt_message.clearData()
            document.getElementById('groupChatImg_message').files = dt_message.files;
            $(".group-chat-img-preview-container").empty();
        }



        //image and video select end



        sendMessage.addEventListener('click', function(e) {
            e.preventDefault();

            var messageInput = document.querySelector('.message_input');
            var fileMessage = document.getElementById('groupChatImg_message')

            var formData;
            var fileLength = fileMessage.files.length
            console.log(fileLength);

            if (fileLength > 5) {
                console.log('can not send');
            } else {
                formData = new FormData(messageForm);
                let images = $("#groupChatImg_message")[0];

                for (let i = 0; i < fileLength; i++) {
                    formData.append('images' + i, images.files[i]);
                }

                var default_user = 'user_default';
                formData.append('totalFiles', fileLength);
                formData.append('senderId', auth_user_id);
                formData.append('senderName', auth_user_data.name);
                if (auth_user_img == null) {
                    formData.append('senderImg', default_user)
                } else {
                    formData.append('senderImg', auth_user_img.profile_image)
                }
            }

            if (messageInput != null) {
                axios.post('/api/group/message/chat/' + groupId, {
                    text: messageInput.value,
                    senderId: auth_user_id,
                    senderImg: auth_user_img ? auth_user_img.profile_image : 'user_default',
                    senderName: auth_user_data.name
                }).then();
                messageInput.value = "";
            } else {
                axios.post('/api/group/message/chat/' + groupId, formData)
            }

        })

        Echo.private('groupChatting.' + groupId)
            .listen('GroupChatting', (data) => {
                console.log(data);
                console.log(auth_user_img);

                if (data.message.sender_id == auth_user_id) {
                    if (data.message.text != null) {
                        if (auth_user_img == null) {
                            messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                        <div class="group-chat-sender-text-container">
                                            <span>${data.senderName}</span>
                                            <p>${data.message.text}</p>
                                        </div>
                                        <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                    </div>`;
                        } else {
                            messageContainer.innerHTML += `<div class="group-chat-sender-container">
                                                <div class="group-chat-sender-text-container">
                                                    <span>${data.senderName}</span>
                                                    <p>${data.message.text}</p>
                                                </div>
                                                <img src="{{ asset('/storage/post/${auth_user_img.profile_image}') }}" />
                                            </div>`;
                        }
                    } else {

                        var imageFile = data.message.media
                        var imageArr = JSON.parse(imageFile)
                        var messageMediaContainer

                        var messageMediaContainer = `<div class="group-chat-imgs-vids-container">
                        ${
                            Object.keys(imageArr).map(key => {
                            console.log(key, imageArr[key]);

                            if (imageArr[key].split('.').pop() === 'png' || imageArr[key]
                                .split('.').pop() ===
                                'jpg' || imageArr[key].split('.').pop() === 'jpeg' || imageArr[key].split('.')
                                .pop() === 'gif') {
                                    return `<div class="modal fade" id="exampleModalToggle${data.message.id}${key}" aria-hidden="true"
                                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('/storage/customer_message_media/${imageArr[key]}') }}"
                                                                alt="test" class="w-100">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                    <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}${key}" role="button">
                                        <img src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" title="${key}">
                                    </a>`




                            } else if (imageArr[key].split('.').pop() === 'mp4' || imageArr[key].split('.')
                                .pop() ===
                                'mov' || imageArr[key].split('.').pop() === 'webm') {

                                return `<video width="100%" height="100%" controls>
                                    <source src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" type="video/mp4">
                                </video>`

                            }
                            }).join('')
                        }
                        </div>`
                        if (auth_user_img == null) {
                            messageContainer.innerHTML += `
                                    <div class="group-chat-sender-container">
                                        <div class="group-chat-sender-text-container">
                                            <span>${data.senderName}</span>
                                            ${messageMediaContainer}
                                            </div>
                                        <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                    </div>`;
                        }else{
                            messageContainer.innerHTML += `
                                    <div class="group-chat-sender-container">
                                        <div class="group-chat-sender-text-container">
                                            <span>${data.senderName}</span>
                                            ${messageMediaContainer}
                                            </div>
                                        <img src="{{ asset('/storage/post/${auth_user_img.profile_image}') }}" />
                                    </div>`;
                        }

                    }

                } else {
                    var receiverMessageMedia = ``
                    if (data.senderImg == 'user_default') {
                        if (data.message.text != null) {
                            messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>${data.senderName}</span>
                                    <p>${data.message.text}</p>
                                </div>
                            </div>`;
                        } else {
                            var imageFile = data.message.media
                            var imageArr = JSON.parse(imageFile)

                            receiverMessageMedia = `
                            <div class="group-chat-imgs-vids-container">
                            ${Object.keys(imageArr).map(key => {

                                if (imageArr[key].split('.').pop() === 'png' || imageArr[key]
                                    .split('.').pop() ===
                                    'jpg' || imageArr[key].split('.').pop() === 'jpeg' || imageArr[key].split(
                                        '.')
                                    .pop() === 'gif') {
                                        return `
                                        <div class="modal fade" id="exampleModalToggle${data.message.id}${key}" aria-hidden="true"
                                            aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('/storage/customer_message_media/${imageArr[key]}') }}"
                                                            alt="test" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}${key}" role="button">
                                            <img src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" title="${key}">
                                        </a>
                                        `
                                    // messageContainer.innerHTML += `
                                    // <div class="modal fade" id="exampleModalToggle${data.message.id}${key}" aria-hidden="true"
                                    //     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    //     <div class="modal-dialog modal-dialog-centered">
                                    //         <div class="modal-content">
                                    //             <div class="modal-header">
                                    //                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    //                     aria-label="Close"></button>
                                    //             </div>
                                    //             <div class="modal-body">
                                    //                 <img src="{{ asset('/storage/customer_message_media/${imageArr[key]}') }}"
                                    //                     alt="test" class="w-100">
                                    //             </div>
                                    //         </div>
                                    //     </div>
                                    // </div>

                                    // <div class="group-chat-receiver-container">
                                    //                 <div class="group-chat-receiver-text-container">
                                    //                     <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                    //                     <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}${key}" role="button">
                                    //                     <img src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" title="${key}">
                                    //                     </a>
                                    //                 </div>

                                    //             </div>`;
                                } else if (imageArr[key].split('.').pop() === 'mp4' || imageArr[key].split('.')
                                    .pop() ===
                                    'mov' || imageArr[key].split('.').pop() === 'webm') {
                                        return `
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" type="video/mp4">
                                        </video>
                                        `

                                    // messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    //                     <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                    //                         <div class="group-chat-receiver-text-container">
                                    //                             <video width="100%" height="100%" controls>
                                    //                                 <source src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" type="video/mp4">
                                    //                             </video>
                                    //                         </div>
                                    //                     </div>`;
                                }
                            }).join('')}
                            </div>
                            `
                            messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                                        <img class="nav-profile-img" src="{{ asset('img/customer/imgs/user_default.jpg') }}" />
                                                            <div class="group-chat-receiver-text-container">
                                                                <span>${data.senderName}</span>
                                                                ${receiverMessageMedia}
                                                            </div>
                                                        </div>`;

                        }

                    } else {
                        if (data.message.text != null) {
                            messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                <img src="{{ asset('/storage/post/${data.senderImg}') }}" />
                                <div class="group-chat-receiver-text-container">
                                    <span>${data.senderName}</span>
                                    <p>${data.message.text}</p>
                                </div>
                            </div>`;
                        } else {
                            var imageFile = data.message.media
                            var imageArr = JSON.parse(imageFile)
                            receiverMessageMedia = `
                            <div class = "group-chat-imgs-vids-container">
                            ${Object.keys(imageArr).map(key => {
                                if (imageArr[key].split('.').pop() === 'png' || imageArr[key]
                                    .split('.').pop() ===
                                    'jpg' || imageArr[key].split('.').pop() === 'jpeg' || imageArr[key].split(
                                        '.')
                                    .pop() === 'gif') {
                                        return `
                                        <div class="modal fade" id="exampleModalToggle${data.message.id}${key}" aria-hidden="true"
                                            aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('/storage/customer_message_media/${imageArr[key]}') }}"
                                                            alt="test" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}${key}" role="button">
                                            <img src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" title="${key}">
                                        </a>
                                        `

                                    // messageContainer.innerHTML += `<div class="modal fade" id="exampleModalToggle${data.message.id}${key}" aria-hidden="true"
                                    //     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    //     <div class="modal-dialog modal-dialog-centered">
                                    //         <div class="modal-content">
                                    //             <div class="modal-header">
                                    //                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    //                     aria-label="Close"></button>
                                    //             </div>
                                    //             <div class="modal-body">
                                    //                 <a data-bs-toggle="modal" href="#exampleModalToggle${data.message.id}${key}" role="button">
                                    //                 <img src="{{ asset('/storage/customer_message_media/${imageArr[key]}') }}"
                                    //                     alt="test" class="w-100">
                                    //                 </a>
                                    //             </div>
                                    //         </div>
                                    //     </div>
                                    // </div>

                                    // <div class="group-chat-receiver-container">
                                    //                 <div class="group-chat-receiver-text-container">
                                    //                     <img src="{{ asset('/storage/post/${data.senderImg}') }}" />
                                    //                     <img src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" title="${key}">
                                    //                 </div>
                                    //             </div>`;
                                } else if (imageArr[key].split('.').pop() === 'mp4' || imageArr[key].split('.')
                                    .pop() ===
                                    'mov' || imageArr[key].split('.').pop() === 'webm') {
                                        return `
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" type="video/mp4">
                                        </video>
                                        `
                                    // messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                    //                         <img src="{{ asset('/storage/post/${data.senderImg}') }}" />
                                    //                         <div class="group-chat-receiver-text-container">
                                    //                             <video width="100%" height="100%" controls>
                                    //                                 <source src="{{ asset('storage/customer_message_media/${imageArr[key]}') }}" type="video/mp4">
                                    //                             </video>
                                    //                         </div>
                                    //                     </div>`;
                                }
                            }).join('')}
                            </div>
                            `
                        }

                        messageContainer.innerHTML += `<div class="group-chat-receiver-container">
                                                            <img src="{{ asset('/storage/post/${data.senderImg}') }}" />
                                                            <div class="group-chat-receiver-text-container">
                                                                <span>${data.senderName}</span>
                                                                ${receiverMessageMedia}
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
