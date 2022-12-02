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
                    <?php $profile_cover=$user->profiles->where('profile_image',null)->sortByDesc('created_at')->first() ?>
                    @if ($profile_cover==null)
                        <img src="{{asset('image/cover.jpg')}}">
                    @else
                        <img class="nav-profile-img" src="{{asset('storage/post/'.$profile_cover->cover_photo)}}"/>
                    @endif
                    <div class="social-media-profile-profileimg-container">
                        <?php
                        $profile=$user->profiles->where('cover_photo',null)->sortByDesc('created_at')->first();?>
                        @if ($profile==null)
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                        @else
                            <img class="nav-profile-img" src="{{asset('storage/post/'.$profile->profile_image)}}"/>
                        @endif

                    </div>
                </div>

                <div class="social-media-profile-content-container">

                    <div id = "addFriclass" class="social-media-profile-btns-container">
                        @if (count($friend) < 1)
                        <a href ="?id={{$user->id}}" class="customer-primary-btn add-friend-btn" id = "Add">
                            <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                            <p>Add friend</p>
                        </a>
                        @elseif($user->id == auth()->user()->id)
                            <button class="customer-primary-btn add-friend-btn">
                                <iconify-icon icon="material-symbols:person-outline" class="add-friend-icon"></iconify-icon>
                                <p>My self </p>

                            </button>
                        @else
                    @foreach ($friend as $friend_status)
                    @if($friend_status->friend_status == 2  )
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="mdi:message-reply-outline" class="add-friend-icon"></iconify-icon>
                            <p>Message</p>
                        </button>
                        <a href ="?id={{$user->id}}" class="customer-red-btn add-friend-btn unfriend "  data-id = {{$user->id}}>
                            <iconify-icon icon="mdi:account-minus-outline" class="add-friend-icon"></iconify-icon>
                            <p>Unfriend</p>
                        </a>
                        @elseif ($friend_status->friend_status == 1 AND $friend_status->sender_id  === auth()->user()->id )
                        <button class="customer-primary-btn add-friend-btn">
                            <iconify-icon icon="material-symbols:cancel-schedule-send-outline-rounded" class="add-friend-icon"></iconify-icon>
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

                    </div>
                    <div class="social-media-profile-username-container">
                        <span class="social-media-profile-username">{{$user->name}}</span><br>
                        {{-- <span class="social-media-profile-userID">(User ID: 1234567890)</span><br> --}}
                        <span class="social-media-profile-description">
                            {{$user->bio}}
                        </span>
                    </div>

                    <div class="social-media-profile-friends-parent-container">
                        <div class="social-media-profile-friends-header">
                            @if (count($friends)>1)
                            <p>{{count($friends)}} Friends</p>
                            @else
                            <p>{{count($friends)}} Friend</p>
                            @endif
                            <a href="{{route('friendsList',$user->id)}}">
                                See All
                                <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
                            </a>
                        </div>

                        <div class="social-media-profile-friends-container">
                            @forelse ($friends as $friend)
                            <div class="social-media-profile-friend">
                                <?php $image=$friend->profiles()->where('cover_photo',null)->orderBy('created_at','desc')->first() ?>
                                @if($image==null)
                                <a href="{{route('socialmedia.profile',$friend->id)}}" style="text-decoration:none">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                @else
                                <a href="{{route('socialmedia.profile',$friend->id)}}" style="text-decoration:none">
                                <img src="{{asset('storage/post/'.$image->profile_image)}}">
                                </a>
                                @endif
                                <p>{{$friend->name}}</p>
                            </a>
                            </div>
                            @empty
                            <p class="text-secondary p-1">No Friend</p>
                            @endforelse

                        </div>
                    </div>
                    <form action="{{route('socialmedia_profile_photos')}}" method="POST">
                        @csrf
                        <input type="hidden" value={{$user->id}} name="user_id">
                        <button type="submit" class="social-media-profile-photos-link">Photos</button>
                        {{-- <a href="{{route('socialmedia_profile_photos')}}" class="social-media-profile-photos-link">Photos</a> --}}
                    </form>
                    <div class="social-media-profile-posts-parent-container">
                        <p>Post & Activities</p>

                        @forelse ($posts as $post)
                            <div class="social-media-post-container">
                                <div class="social-media-post-header">
                                    <div class="social-media-post-name-container">
                                        <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                                        @if ($profile==null)
                                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                        @else
                                            <img class="nav-profile-img" src="{{asset('storage/post/'.$profile->profile_image)}}"/>
                                        @endif
                                        </a>
                                        <div class="social-media-post-name">
                                            <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                                                <p>{{$post->user->name}}</p>
                                            </a>
                                            <span>{{\Carbon\Carbon::parse($post->created_at)->format('d M Y , g:i A')}}</span>
                                        </div>


                                    </div>

                                    <iconify-icon icon="bi:three-dots-vertical" class="social-media-post-header-icon"></iconify-icon>
                                    <div class="post-actions-container">
                                        <div class="post-action">
                                            <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                            <p>Save</p>
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
                                        @php
                                            $total_likes=$post->user_reacted_posts->count();
                                            $user=auth()->user();
                                            $already_liked=$user->user_reacted_posts->where('post_id',$post->id)->count();
                                        @endphp

                                        <a class="like" href="#" id="{{$post->id}}">

                                        @if($already_liked==0)
                                        <iconify-icon icon="mdi:cards-heart-outline" class="like-icon">
                                        </iconify-icon>
                                        @else
                                        <iconify-icon icon="mdi:cards-heart" style="color: red;" class="like-icon already-liked">
                                        </iconify-icon>
                                        @endif

                                        </a>
                                        <p><span class="total_likes">{{$total_likes}}</span>
                                            <a href="{{route('social_media_likes',$post->id)}}">Likes</a>
                                        </p>
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
        $('.like').click(function(e){
            e.preventDefault();
            var isLike=e.target.previousElementSibiling == null ? true : false;
            var post_id=$(this).attr('id');
            console.log(post_id)
            var add_url = "{{ route('user.react.post', [':post_id']) }}";
            add_url = add_url.replace(':post_id', post_id);
            var that = $(this)
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        method: "POST",
                        url: add_url,
                        data:{ isLike : isLike , post_id: post_id },
                        success:function(data){
                            that.siblings('p').children('.total_likes').html(data.total_likes)

                            if(that.children('.like-icon').hasClass("already-liked")){
                                that.children('.like-icon').attr('style','')
                                that.children('.like-icon').attr('class','like-icon')
                                that.children(".like-icon").attr('icon','mdi:cards-heart-outline')
                            }else{
                                that.children('.like-icon').attr('style','color : red')
                                that.children('.like-icon').attr('class','like-icon already-liked')
                                that.children(".like-icon").attr('icon','mdi:cards-heart')
                            }

                        }
                    })


        })

        $(document).on('click', '#Add', function(e) {
                e.preventDefault();
                $('.social-media-left-searched-items-container').empty();
                var url = new URL(this.href);

                var id = url.searchParams.get("id");

                var add_url = "{{ route('addUser', [':id']) }}";
                add_url = add_url.replace(':id', id);
                $(".add-member-btn").attr('href','');
                $.ajax({
                    type: "GET",
                    url: add_url,
                    datatype: "json",
                    success: function(data) {
                        console.log(data)
                        window.location.reload();
                    }
                })
        });

                $(document).on('click', '.unfriend', function(e) {
                e.preventDefault();
                Swal.fire({
                        text: "Are you sure?",
                        showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                        showCancelButton: true,
                        timerProgressBar: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',

                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                             var url = new URL(this.href);
                             var id = url.searchParams.get("id");
                             var url = "{{ route('unfriend', [':id']) }}";
                             url = url.replace(':id', id);
                             $(".cancel-request-btn").attr('href','');
                                $.ajax({
                                    type: "GET",
                                    url: url,
                                    datatype: "json",
                                    success: function(data) {
                                        console.log(data)
                                        window.location.reload();
                                    }
                                })
                        }
                        })
                });
    });

</script>

@endpush
