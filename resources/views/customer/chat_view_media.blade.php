@extends('customer.layouts.app_home')
@section('content')
    <div class="social-media-right-container">
        <div class="social-media-chat-media-container">
            @forelse ($messages as $send_message)
                <div class="modal fade" id="exampleModalToggle{{ $send_message->id }}" aria-hidden="true"
                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                @if (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')
                                    <video class="w-100" controls>
                                        <source src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @elseif (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'png' ||
                                        pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpg' ||
                                        pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpeg')
                                    <img src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}" alt="test"
                                        class="w-100">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mp4' ||
                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'mov' ||
                    pathinfo($send_message->media, PATHINFO_EXTENSION) == 'webm')
                    <div class="social-media-chat-media">
                        <a data-bs-toggle="modal" href="#exampleModalToggle{{ $send_message->id }}" role="button">
                            <video style="z-index: -1;">
                                <source src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}" type="video/mp4">
                            </video>
                        </a>
                    </div>
                @elseif (pathinfo($send_message->media, PATHINFO_EXTENSION) == 'png' ||
                        pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpg' ||
                        pathinfo($send_message->media, PATHINFO_EXTENSION) == 'jpeg')
                    <div class="social-media-chat-media">
                        <a data-bs-toggle="modal" href="#exampleModalToggle{{ $send_message->id }}" role="button">
                            <img src="{{ asset('/storage/customer_message_media/' . $send_message->media) }}" alt="test">
                        </a>
                    </div>
                @endif
            @empty

            @endforelse

        </div>
    </div>
@endsection
