@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

{{-- <div class="social-media-header-btns-container margin-top">
    <a class="back-btn">
        <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
    </a>

</div> --}}


    <div class="social-media-right-container">
        <div class="social-media-noti-tabs-container">
            <p class="social-media-noti-likes-tab ">
                Likes & Comments
            </p>
            <p class="social-media-noti-requests-tab">
                Friend Requests
            </p>
        </div>

        <div class="social-media-likes-container">
            <div class="social-media-likes-today-container">
                <p>Today</p>

                <div class="social-media-likes-row">
                    <div class="social-media-likes-name">
                        <img src="../imgs/trainer1.jpg">
                        <p>User Name Liked Your Post.</p>
                    </div>

                    <iconify-icon icon="ant-design:heart-filled" class="social-media-likes-icon"></iconify-icon>
                </div>

            </div>
            <div class="social-media-likes-earlier-container">
                <p>Earlier</p>
                <div class="social-media-likes-row">
                    <div class="social-media-likes-name">
                        <img src="../imgs/trainer1.jpg">
                        <p>User Name Liked Your Post.</p>
                    </div>

                    <iconify-icon icon="ant-design:heart-filled" class="social-media-likes-icon"></iconify-icon>
                </div>
                <div class="social-media-likes-row">
                    <div class="social-media-likes-name">
                        <img src="../imgs/trainer1.jpg">
                        <p>User Name Commented Your Post.</p>
                    </div>

                    <iconify-icon icon="bi:chat-left-dots-fill" class="social-media-likes-icon"></iconify-icon>
                </div>
                <div class="social-media-likes-row">
                    <div class="social-media-likes-name">
                        <img src="../imgs/trainer1.jpg">
                        <p>User Name Liked Your Post.</p>
                    </div>

                    <iconify-icon icon="ant-design:heart-filled" class="social-media-likes-icon"></iconify-icon>
                </div>
                <div class="social-media-likes-row">
                    <div class="social-media-likes-name">
                        <img src="../imgs/trainer1.jpg">
                        <p>User Name Liked Your Post.</p>
                    </div>

                    <iconify-icon icon="ant-design:heart-filled" class="social-media-likes-icon"></iconify-icon>
                </div>
            </div>


        </div>

        <div class="social-media-requests-container">
            <div class="social-media-requests-today-container">
                <p>Today</p>
                @foreach($friend_requests as $requests)
                <div class="social-media-request-row">

                        <div class="social-media-request-name">
                            <img src="../imgs/trainer3.jpg">
                            <p>{{$requests->name}}</p>
                        </div>

                        <div class="social-media-btns-container">
                            <a href = {{route('confirmRequest',$requests->id)}} class="customer-primary-btn">
                                Accept
                            </a>
                            <a href = {{route('declineRequest',$requests->id)}} class="customer-red-btn">
                                Decline</a>
                        </div>

                </div>
                @endforeach
            </div>
            <div class="social-media-requests-earlier-container">
                <p>Earlier</p>
                @foreach($friend_requests_earlier as $earlier)
                <div class="social-media-request-row">
                    <div class="social-media-request-name">
                        <img src="../imgs/trainer3.jpg">
                        <p>{{$earlier->name}}</p>
                    </div>
                    <div class="social-media-btns-container">
                        <a href = {{route('confirmRequest',$earlier->id)}} class="customer-primary-btn">
                            Accept
                        </a>
                        <a href = {{route('declineRequest',$earlier->id)}} class="customer-red-btn">
                            Decline</a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/theme.js"></script>
<script>
    $(document).ready(function() {
        $(".social-media-noti-likes-tab").addClass("social-media-noti-active-tab")
        $(".social-media-likes-container").show()
        $(".social-media-requests-container").hide()

        $(".social-media-noti-likes-tab").click(function(){
            $(".social-media-noti-likes-tab").addClass("social-media-noti-active-tab")
            $(".social-media-noti-requests-tab").removeClass("social-media-noti-active-tab")

            $(".social-media-likes-container").show()
            $(".social-media-requests-container").hide()
        })
        $(".social-media-noti-requests-tab").click(function(){
            $(".social-media-noti-likes-tab").removeClass("social-media-noti-active-tab")
            $(".social-media-noti-requests-tab").addClass("social-media-noti-active-tab")

            $(".social-media-likes-container").hide()
            $(".social-media-requests-container").show()
        })

        $( ".social-media-left-search-container input" ).focus(function() {
            // alert( "Handler for .focus() called." );
            $( ".social-media-left-infos-container" ).hide()
            $(".social-media-left-searched-items-container").show()
        });

        $( ".social-media-left-search-container input" ).focusout(function() {
            // alert( "Handler for .focus() called." );
            $( ".social-media-left-infos-container" ).show()
            $(".social-media-left-searched-items-container").hide()
        });
        $('.social-media-post-header-icon').click(function(){
            $(this).next().toggle()
        })

        $(".social-media-left-container-trigger").click(function(){
            $('.social-media-left-container').toggleClass("social-media-left-container-open")
            $('.social-media-overlay').toggle()
            $(".social-media-left-container-trigger .arrow-icon").toggleClass("rotate-arrow")
        })

    })
</script>
@endsection
