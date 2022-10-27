@extends('customer.training_center.layouts.app')

@section('content')
    <div class="customer-training-center-header-container">
        <h1>Weight Loss Plan</h1>
        <p>Thursday Sep 22, 2022</p>
    </div>

    <div class="group-chat-container customer-trainingcenter-group-chat-container">
        <div class="group-chat-header">
            <a href="../htmls/customerTrainingCenterViewMembers.html" class="group-chat-header-name-container">
                <img src="{{ asset('image/default.jpg') }}" />
                <div class="group-chat-header-name-text-container">
                    <p>Group Name</p>
                    <span>group member, group member,group member,group member,group member,</span>
                </div>
            </a>

            <a href="../htmls/customerTrainingCenterViewMedia.html" class="group-chat-view-midea-link">
                <p>View Media</p>
                <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
            </a>
        </div>

        <div class="group-chat-messages-container">
            @foreach ($chats as $chat)
                @if ($chat->media == null)
                    <div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <p>{{ $chat->text }}</p>
                        </div>
                    </div>
                @elseif (pathinfo($chat->media, PATHINFO_EXTENSION) == 'mp4' ||
                    pathinfo($chat->media, PATHINFO_EXTENSION) == 'mov' ||
                    pathinfo($chat->media, PATHINFO_EXTENSION) == 'webm')
                    <div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <video width="100%" height="100%" controls>
                                <source src="{{ asset('storage/trainer_message_media/' . $chat->media) }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                @elseif (pathinfo($chat->media, PATHINFO_EXTENSION) == 'png' ||
                    pathinfo($chat->media, PATHINFO_EXTENSION) == 'jpg' ||
                    pathinfo($chat->media, PATHINFO_EXTENSION) == 'jpeg')
                    <div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <img src="{{ asset('storage/trainer_message_media/' . $chat->media) }}" alt="">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
<script>
 var groupchatcontainer = document.querySelector('.group-chat-messages-container');
var pusher = new Pusher('576dc7f4f561e15a42ef', {
            cluster: 'eu'
        });
var channel = pusher.subscribe('trainer-message');
channel.bind('training_message_event', (data) => {
  console.log(data.message.text);
  if (data.message.media ==null || data.media ==null) {
    groupchatcontainer.innerHTML += `<div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <p>${data.message.text}</p>
                        </div>
                    </div>`;
  } else {
        if (data.message.media.split('.').pop() === 'png' || data.message.media.split('.').pop() ===
                    'jpg' || data.message.media.split('.').pop() === 'jpeg') {
                        groupchatcontainer.innerHTML +=`<div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <img src="{{ asset('storage/trainer_message_media/${data.message.media}') }}" />
                        </div>
                    </div>`;
        } else if(data.message.media.split('.').pop() === 'mp4' || data.message.media.split('.').pop() ===
                    'mov' || data.message.media.split('.').pop() === 'webm') {
                        groupchatcontainer.innerHTML +=`<div class="group-chat-receiver-container">
                        <img src="{{ asset('image/default.jpg') }}" />
                        <div class="group-chat-receiver-text-container">
                            <span>Group Member</span>
                            <video width="100%" height="100%" controls>
                                <source src="{{ asset('storage/trainer_message_media/${data.message.media}') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>`;
        }
  }
});
</script>
@endpush
