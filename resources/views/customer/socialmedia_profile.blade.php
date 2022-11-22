@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

    {{-- <div class="social-media-header-btns-container margin-top">
        <a class="back-btn">
            <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
        </a>
    </div> --}}


        <div class="social-media-right-container social-media-right-container-nopadding">
            <div class="social-media-profile-parent-container">
                <div class="social-media-profile-bgimg-container">
                    <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&w=1600">
                    <div class="social-media-profile-profileimg-container">
                        <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                    </div>
                </div>


                <div class="social-media-profile-content-container">

                    <div id = "addFriclass">
                        @if (count($friend) < 1)
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>Add friend</p>
                        </button>
                    @elseif($user->id == auth()->user()->id)
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>My self </p>

                        </button>
                    @else @foreach ($friend as $friend_status)
                    @if($friend_status->friend_status == 2  )
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>Message</p>
                        </button>
                        <button class="customer-primary-btn add-friend-btn unfriend"  data-id = {{$user->id}}>
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>Unfriend</p>
                        </button>
                        @elseif ($friend_status->friend_status == 1 AND $friend_status->sender_id  === auth()->user()->id )
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>Cancel Request</p>
                        </button>
                        @elseif ($friend_status->friend_status == 1 AND $friend_status->receiver_id  === auth()->user()->id)
                        <div class="" style = "margin-top:10px; display:flex; justify-content:right">
                        <div class="social-media-btns-container">
                            <a href = {{route('confirmRequest',$user->id)}} class="customer-primary-btn">
                                Accept
                            </a>
                            {{-- <button class="customer-red-btn">Decline</button> --}}
                            <a href = {{route('declineRequest',$user->id)}} class="customer-red-btn">
                                Decline
                            </a>
                        </div>
                        </div>


                    @endif
                    @endforeach
                    @endif

                    <div>
                    <div class="social-media-profile-username-container">
                        <span class="social-media-profile-username">{{$user->name}}</span><br>
                        {{-- <span class="social-media-profile-userID">(User ID: 1234567890)</span><br> --}}
                        <span class="social-media-profile-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </div>

                    <div class="social-media-profile-friends-parent-container">
                        <div class="social-media-profile-friends-header">
                            @if (count($friends)>1)
                            <p>{{count($friends)}} Friends</p>
                            @else
                            <p>{{count($friends)}} Friend</p>
                            @endif
                            <a href="#">
                                See All
                                <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
                            </a>
                        </div>

                        <div class="social-media-profile-friends-container">
                            @forelse ($friends as $friend)
                            <div class="social-media-profile-friend">
                                <a href="{{route('socialmedia.profile',$friend->id)}}" style="text-decoration:none">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">

                                <p>{{$friend->name}}</p>
                            </a>
                            </div>
                            @empty
                            <p class="text-secondary p-1">No Friend</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="social-media-profile-posts-parent-container">
                        <p>Post & Activities</p>

                        @forelse ($posts as $post)
                            <div class="social-media-post-container">
                                <div class="social-media-post-header">
                                    <div class="social-media-post-name-container">
                                        <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                                        <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                        </a>
                                        <div class="social-media-post-name">
                                            <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                                                <p>{{$post->user->name}}</p>
                                            </a>
                                            <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y , g:i A')}}</span>
                                        </div>


                                    </div>

                                    <iconify-icon icon="bi:three-dots-vertical" class="social-media-post-header-icon"></iconify-icon>
                                    <div class="post-actions-container">
                                        <div class="post-action">
                                            <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                            <p>Save</p>
                                        </div>

                                        <div class="post-action">
                                            <iconify-icon icon="bi:delete" class="post-action-icon"></iconify-icon>
                                            <p>Delete</p>
                                        </div>


                                        <div class="post-action">
                                            <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                                            <p>Report</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="social-media-content-container">
                                    @if ($post->media==null)
                                    <p>{{$post->caption}}</p>
                                    @else
                                    <p>{{$post->caption}}</p>
                                    <div class="social-media-media-container">
                                        <?php foreach (json_decode($post->media)as $m){?>
                                        <div class="social-media-media">
                                            @if (pathinfo($m, PATHINFO_EXTENSION) == 'mp4')
                                                <video controls>
                                                    <source src="{{asset('storage/post/'.$m) }}">
                                                </video>
                                            @else
                                                <img src="{{asset('storage/post/'.$m) }}">
                                            @endif
                                        </div>
                                        <?php }?>
                                    </div>

                                    @endif
                                </div>

                                <div class="social-media-post-footer-container">
                                    <div class="social-media-post-like-container">
                                        <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                                        <p><span>1.1k</span> Likes</p>
                                    </div>
                                    <div class="social-media-post-comment-container">
                                        <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                                        <p><span>50</span> Comments</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-secondary p-1">No Post And Activity</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // $(document).on('click', '#AddFriend', function(e) {
        //         e.preventDefault();
        //         $('.social-media-left-searched-items-container').empty();
        //         var url = new URL(this.href);

        //         var id = url.searchParams.get("id");
        //         var group_id = $(this).attr("id");

        //         var add_url = "{{ route('addUser', [':id']) }}";
        //         add_url = add_url.replace(':id', id);
        //         $(".add-member-btn").attr('href','');
        //         $.ajax({
        //             type: "GET",
        //             url: add_url,
        //             datatype: "json",
        //             success: function(data) {
        //                 console.log(data)
        //                 search();
        //             }
        //         })
        //         });


                $(document).on('click', '.unfriend', function(e) {
                e.preventDefault();
                alert("ok");
                var id = $(this).data('id');;
                console.log(id,"ddd")

                var unfriend_url = "{{ route('unfriend', [':id']) }}";
                unfriend_url = unfriend_url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: unfriend_url,
                    datatype: "json",
                    success: function(data) {
                        console.log(data)
                        alert("ok");
                    }
                })
                });
    });

    $( document ).ready(function() {
    $('.social-media-post-header-icon').click(function(){
            $(this).next().toggle()
        })
    })
</script>

@endpush
