@extends('customer.layouts.app_home')
@section('content')
    <div class="social-media-right-container">

        <div class="group-chat-header">
            <a href="javascript:history.back()" class="group-chat-header-name-container">
                @if ($receiver_user->user_profile != null)
                    <img src="{{asset('storage/post/'.$receiver_user->user_profile->profile_image)}}" />
                @else
                    <img src="{{asset('img/customer/imgs/avatar.png')}}" />
                @endif

                <div class="group-chat-header-name-text-container">
                    <p>{{ $receiver_user->name }}</p>
                </div>
            </a>
        </div>

        <div class="social-media-chat-media-container">
            @foreach ($messages as $message)
                @forelse (json_decode($message->media) as $key =>$media)

                    <div class="modal fade" id="exampleModalToggle{{ $message->id }}{{$key}}" aria-hidden="true"
                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @if (pathinfo($media, PATHINFO_EXTENSION) == 'mp4' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'mov' ||
                                        pathinfo($media, PATHINFO_EXTENSION) == 'webm')
                                        <video class="w-100" controls>
                                            <source src="{{ asset('/storage/customer_message_media/' . $media) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif (pathinfo($media, PATHINFO_EXTENSION) == 'png' ||
                                            pathinfo($media, PATHINFO_EXTENSION) == 'jpg' ||
                                            pathinfo($media, PATHINFO_EXTENSION) == 'jpeg')
                                        <img src="{{ asset('/storage/customer_message_media/' . $media) }}" alt="test"
                                            class="w-100">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (pathinfo($media, PATHINFO_EXTENSION) == 'mp4' ||
                        pathinfo($media, PATHINFO_EXTENSION) == 'mov' ||
                        pathinfo($media, PATHINFO_EXTENSION) == 'webm')
                        <div class="social-media-chat-media">
                            <a data-bs-toggle="modal" href="#exampleModalToggle{{ $message->id }}{{$key}}" role="button">
                                <video style="z-index: -1;">
                                    <source src="{{ asset('/storage/customer_message_media/' . $media) }}" type="video/mp4">
                                </video>
                            </a>
                        </div>
                    @elseif (pathinfo($media, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($media, PATHINFO_EXTENSION) == 'jpg' ||
                            pathinfo($media, PATHINFO_EXTENSION) == 'jpeg')
                        <div class="social-media-chat-media">
                            <a data-bs-toggle="modal" href="#exampleModalToggle{{ $message->id }}{{$key}}" role="button">
                                <img src="{{ asset('/storage/customer_message_media/' . $media) }}" alt="test">
                            </a>
                        </div>
                    @endif

                @empty
                @endforelse
            @endforeach

        </div>
    </div>
@endsection
