@extends('customer.layouts.app_home')

@section('content')

<div class="social-media-right-container ">
    <div class="social-media-allchats-header">
        <p>Messages</p>
        <div class="social-media-allchats-header-btn-container">
            <button class="social-media-allchats-header-search-btn customer-primary-btn">
                <iconify-icon icon="akar-icons:search" class="social-media-allchats-header-search-icon"></iconify-icon>
            </button>
            <button type="button" class="social-media-allchats-header-add-btn customer-primary-btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                <iconify-icon icon="akar-icons:circle-plus" class="social-media-allchats-header-plus-icon"></iconify-icon>
                <p>Group</p>
            </button>
        </div>
    </div>
  
    <div class="social-media-allchats-messages-container">
        @forelse ($chat_lists as $list)

            @if (auth()->user()->id == $list->to_user->id)
                    <a href="{{route('message.chat',$list->from_user->id)}}" class="social-media-allchats-message-row">
                        <div class="social-media-allchats-message-img">
                            @if ($list->from_user->profiles->profile_image != null)
                                <img src="{{asset('storage/post'.$list->from_user->profiles->profile_image)}}">
                            @else
                                <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                            @endif

                            <p>{{$list->from_user->name}}</p>
                        </div>

                        <p>{{$list->text}}</p>

                        <span>03:04 pm</span>
                    </a>
                    @else
                    <a href="{{route('message.chat',$list->to_user->id)}}" class="social-media-allchats-message-row">
                        <div class="social-media-allchats-message-img">
                            @if ($list->to_user->profile_image != null)
                                <img src="{{asset('storage/post'.$list->to_user->profile_image)}}">
                            @else
                                <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                            @endif
                            <p>{{$list->to_user->name}}</p>
                        </div>

                        @foreach ($messages as $message)
                            @if ($message->from_user_id == $list->to_user_id)
                                <p>{{$message->text}}</p>
                            @endif
                        @endforeach
                        <span>03:04 pm</span>
                    </a>

            @endif
        @empty

        @endforelse


    </div>
</div>

@endsection
