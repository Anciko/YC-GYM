@extends('trainer.layouts.app')

@section('content')
    @include('sweetalert::alert')
    {{-- @include('trainer.trainer_groups') --}}

    <!--add member modal-->
    @foreach ($groups as $group)
        <div class="modal fade" id="addMemberModal{{ $group->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header  customer-transaction-modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Add Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-member-form" action="">
                            <input type="text" class="form-control mb-3"   placeholder="Search member" id="search">
                            <div class="add-member-rows-container">
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <div class="trainer-two-columns-container">
        <div class="trainer-group-chats-parent-container">
            <p>Groups</p>
            <div class="trainer-group-chats-container">
                @forelse ($groups as $group)
                    <button class="tainer-group-chat-name-container" id="group-chat" value="{{ $group->id }}"
                        data-id="{{ $group->id }}"
                        style=" background-color: transparent;background-repeat: no-repeat;border: none;cursor: pointer;overflow: hidden;outline: none;">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <p>{{ $group->group_name }}</p>
                    </button>
                @empty
                    <p class="text-secondary p-1">No Group</p>
                @endforelse
            </div>
        </div>
        <div id="content-container">
            <div class="group-chat-container">
                <div class="group-chat-header">

                </div>
                <div class="trainer-group-chat-view-members-header">

                </div>

                <p id="p" class="text-secondary p-1" style="text-align:center; margin: auto;">
                    Choose group and start chatting</p>
                <div class="group-chat-messages-container ">
                    <div class="group-chat-sender-container" id="trainer_message_el">


                        <div class="group-chat-sender-text-container" id="send_message">

                        </div>
                        <img src="{{ asset('image/default.jpg') }}" id="image"/>
                    </div>
                </div>
                    <div id="send_form">
                    </div>
            </div>
        </div>
    </div>
@endsection
    @push('scripts')
    <script>
        $(document).ready(function() {

            $('.trainer-group-chat-view-members-header').hide();
            $('.trainer-group-chat-members-container').hide();
            $('.trainer-group-chat-media-container').hide();
            //$('.group-chat-header').hide();
            $('#image').hide();
            $('.group-chat-messages-container').hide();
            $(window).on("load", function() {
                $('.group-chat-messages-container').scrollTop($('.group-chat-messages-container')[0]
                    .scrollHeight);
            });
                    if(localStorage.getItem('selectGroup')){
                        $('#p').hide();
                    var selectGroupID = localStorage.getItem('selectGroup')
                    console.log(selectGroupID);
                    localStorage.setItem('group_id', selectGroupID);
                $.ajax({
                    type: "GET",
                    url: "trainer/group/show/" + selectGroupID,
                    datatype: "json",
                    success: function(data) {
                        var view_member_url = '{{ route('trainer/view_member', ':id') }}';
                        view_member_url = view_member_url.replace(':id', data.group_chat.id);
                        var view_media_url = '{{ route('trainer/view_media', ':id') }}';
                        view_media_url = view_media_url.replace(':id', data.group_chat.id);
                        var htmlView = `<a href="`+ view_member_url + `" class="group-chat-header-name-container" id="add_member">
                                        <img src=" "/>
                                        <div class="group-chat-header-name-text-container">` + data.group_chat.group_name + `<p id="group_name">
                                        </p><span id="group_member">group member, group member</span>
                                        </div></a>
                                        <a href="`+ view_media_url + `" class="group-chat-view-midea-link" id="view_media">
                                        <p>View Media</p>
                                        <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                                        </a>
                                        `;
                        var sender = `<form class="group-chat-send-form-container" id="trainer_message_form" method="POST">
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

                                        <textarea id="mytextarea" name="text" class="group-chat-send-form-input trainer_message_input" placeholder="Message..." required ></textarea>
                                        <img class="group-chat-img-preview groupChatImg">
                                        <div style="display: none;" class='video-prev'>
                                            <video height="200" width="300" class="video-preview" controls="controls"></video>
                                        </div>
                                        <button type="reset"  class="group-chat-img-cancel" onclick="clearGroupChatImg()">
                                            <iconify-icon icon="charm:cross" class="group-chat-img-cancel-icon"></iconify-icon>
                                        </button>
                                    </div>

                                    <button type="submit" class="group-chat-send-form-submit-btn" id="sendd">
                                        <iconify-icon icon="akar-icons:send" class="group-chat-send-form-submit-btn-icon"></iconify-icon>
                                    </button>
                                </form>`;
                        $('.group-chat-header').html(htmlView);
                        $('#send_form').html(sender);
                        $.each(data.chat_messages, function(key, value) {
                            console.log(value.text);
                                 $('#send_message').append('<p>'+value.text+'</p>');
                            });
                }
                 })
                }

                $(document).on('click', '#group-chat', function(e) {
                e.preventDefault();

                localStorage.removeItem('selectGroup')
                $("#send_message").empty();
                $(".trainer-group-chat-media-container").empty();
                $('#p').hide();
                //$('.group-chat-header').show();
                $('.trainer-group-chat-members-container').hide();
                $('.trainer-group-chat-media-container').hide();
                $('.trainer-group-chat-view-members-header').hide();
                $('.group-chat-messages-container ').show();
                $('#send_form').show();
                $('#image').show();
                // var id=$(this).val();
                var id = $(this).data('id');
                localStorage.setItem('group_id', id);
                $.ajax({
                    type: "GET",
                    url: "trainer/group/show/" + id,
                    datatype: "json",
                    success: function(data) {
                        var view_member_url = '{{ route('trainer/view_member', ':id') }}';
                        view_member_url = view_member_url.replace(':id', data.group_chat.id);
                        var view_media_url = '{{ route('trainer/view_media', ':id') }}';
                        view_media_url = view_media_url.replace(':id', data.group_chat.id);
                        var htmlView = `<a href="`+ view_member_url + `" class="group-chat-header-name-container" id="add_member">
                                        <img src=" "/>
                                        <div class="group-chat-header-name-text-container">` + data.group_chat.group_name + `<p id="group_name">
                                        </p><span id="group_member">group member, group member</span>
                                        </div></a>
                                        <a href="`+ view_media_url + `" class="group-chat-view-midea-link" id="view_media">
                                        <p>View Media</p>
                                        <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                                        </a>
                                        `;
                        var sender = `<form class="group-chat-send-form-container" id="trainer_message_form" method="POST">
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

                                        <textarea id="mytextarea" name="text" class="group-chat-send-form-input trainer_message_input" placeholder="Message..." required ></textarea>
                                        <img class="group-chat-img-preview groupChatImg">
                                        <div style="display: none;" class='video-prev'>
                                            <video height="200" width="300" class="video-preview" controls="controls"></video>
                                        </div>
                                        <button type="reset"  class="group-chat-img-cancel" onclick="clearGroupChatImg()">
                                            <iconify-icon icon="charm:cross" class="group-chat-img-cancel-icon"></iconify-icon>
                                        </button>
                                    </div>

                                    <button type="submit" class="group-chat-send-form-submit-btn" id="sendd">
                                        <iconify-icon icon="akar-icons:send" class="group-chat-send-form-submit-btn-icon"></iconify-icon>
                                    </button>
                                </form>`;
                        $('.group-chat-header').html(htmlView);
                        $('#send_form').html(sender);
                        $.each(data.chat_messages, function(key, value) {

                                $('#send_message').append('<p>'+value.text+'</p>');
                            });
                }
                 })

        });
        $(document).on('submit','#trainer_message_form', function (e){

                            e.preventDefault();

                            let trainer_message_input=document.querySelector(".trainer_message_input");
                            let group_chat_messages_container = document.querySelector(".group-chat-messages-container");
                            let id = localStorage.getItem('group_id');
                            // console.log(id,"id");
                            const options = {
                                method: "POST",
                                url: "trainer/send/"+id,
                                data: {
                                    text: trainer_message_input.value
                                }
                            }
                            axios(options);
                            trainer_message_input.value='';

                            Pusher.logToConsole = true;
                            var pusher = new Pusher('6c07a0a51a0f074bcdf0', {
                                cluster: 'us2'
                            });

                            var channel = pusher.subscribe('trainer-message');
                            channel.bind('training_message_event', function(data) {
                                group_chat_messages_container.innerHTML += `
                            <div class="group-chat-sender-container" id="trainer_message_el">
                                    <div class="group-chat-sender-text-container">
                                        <p>${data.message}</p>
                                    </div>
                                    <img src="{{ asset('image/default.jpg') }}" />
                                </div>`;
                            });
        });
        });
    </script>

@endpush
