@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="social-media-header-btns-container margin-top">
    <a class="back-btn">
        <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
    </a>

</div>


<div class="social-media-left-container-trigger">
    Friends
    <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
</div>

<div class="social-media-overlay"></div>

<div class="social-media-parent-container">
    <div class="social-media-left-container">
        <div class="social-media-left-search-container">
            <input type="text">
            <iconify-icon icon="akar-icons:search" class="search-icon"></iconify-icon>
        </div>
        <div class="social-media-left-infos-container">
            <div class="social-media-left-friends-container">
                <div class="social-media-left-container-header">
                    <p>Friends</p>
                    <a href="#">See All <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon></a>
                </div>

                <div class="social-media-left-friends-rows-container">
                    <a href="#" class="social-media-left-friends-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>Friend Name</p>
                    </a>
                    <a href="#" class="social-media-left-friends-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>Friend Name</p>
                    </a>
                    <a href="#" class="social-media-left-friends-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>Friend Name</p>
                    </a>
                    <a href="#" class="social-media-left-friends-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>Friend Name</p>
                    </a>
                </div>
            </div>

            <div class="social-media-left-messages-container">
                <div class="social-media-left-container-header">
                    <p>Messages</p>
                    <a href="#">See All <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon></a>
                </div>

                <div class="social-media-left-messages-rows-container">
                    <a href="#" class="social-media-left-messages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Friend Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-messages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Friend Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-messages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Friend Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-messages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Friend Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                </div>
            </div>

            <div class="social-media-left-gpmessages-container">
                <div class="social-media-left-container-header">
                    <p>Group Messages</p>
                    <a href="#">See All <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon></a>
                </div>

                <div class="social-media-left-gpmessages-rows-container">
                    <a href="#" class="social-media-left-gpmessages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Group Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-gpmessages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Group Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-gpmessages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Group Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                    <a href="#" class="social-media-left-gpmessages-row">
                        <img src="../imgs/trainer1.jpg">
                        <p>
                            Group Name<br>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <div class="social-media-left-searched-items-container">
            <a href="#" class="social-media-searched-item">
                <p>Name</p>
                <iconify-icon icon="bi:arrow-right-short" class="arrow-icon"></iconify-icon>
            </a>
            <a href="#" class="social-media-searched-item">
                <p>Name</p>
                <iconify-icon icon="bi:arrow-right-short" class="arrow-icon"></iconify-icon>
            </a>
        </div>

    </div>

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
                            <p>{{$requests->id}}</p>
                            <p>{{$requests->name}}</p>
                        </div>

                        <div class="social-media-btns-container">
                            <a href = {{route('confirmRequest',$requests->id)}} class="customer-primary-btn">
                                Accept
                            </a>
                            <button class="customer-red-btn">Decline</button>
                        </div>

                </div>
                @endforeach
            </div>
            <div class="social-media-requests-earlier-container">
                <p>Earlier</p>
                <div class="social-media-request-row">
                    <div class="social-media-request-name">
                        <img src="../imgs/trainer3.jpg">
                        <p>User Name</p>
                    </div>

                    <div class="social-media-btns-container">
                        <button class="customer-primary-btn">Accept</button>
                        <button class="customer-red-btn">Decline</button>
                    </div>
                </div>
                <div class="social-media-request-row">
                    <div class="social-media-request-name">
                        <img src="../imgs/trainer3.jpg">
                        <p>User Name</p>
                    </div>

                    <div class="social-media-btns-container">
                        <button class="customer-primary-btn">Accept</button>
                        <button class="customer-red-btn">Decline</button>
                    </div>
                </div>
            </div>
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
