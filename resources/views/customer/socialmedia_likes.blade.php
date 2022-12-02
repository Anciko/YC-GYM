@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="social-media-right-container">
    <div class="social-media-all-likes-parent-container">
        <div class="social-media-post-container">
            <div class="social-media-post-header">
                <div class="social-media-post-name-container">
                <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                    <?php $profile=$post->user->profiles->where('cover_photo',null)->sortByDesc('created_at')->first() ?>
                    @if ($profile==null)
                        <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                    @else
                        <img class="nav-profile-img" src="{{asset('storage/post/'.$profile->profile_image)}}"/>
                    @endif
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
                    <a href="#" style="text-decoration:none" class="post_save" id="{{$post->id}}">
                        <div class="post-action">
                            <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                            @php
                                $already_save=auth()->user()->user_saved_posts->where('post_id',$post->id)->first();
                            @endphp

                            @if ($already_save)
                                <p class="save">Unsave</p>
                            @else
                                <p class="save">Save</p>
                             @endif
                        </div>
                    </a>
                    @if ($post->user->id == auth()->user()->id)

                        <a id="edit_post" data-id="{{$post->id}}" data-bs-toggle="modal" >
                            <div class="post-action">
                                <iconify-icon icon="material-symbols:edit" class="post-action-icon"></iconify-icon>
                                <p>Edit</p>
                            </div>
                        </a>
                        <a id="delete_post" data-id="{{$post->id}}">
                            <div class="post-action">
                            <iconify-icon icon="material-symbols:delete-forever-outline-rounded" class="post-action-icon"></iconify-icon>
                            <p>Delete</p>
                            </div>
                        </a>
                    @else
                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
                    @endif
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

                <div id="slider-wrapper" class="social-media-media-slider">
                    <iconify-icon icon="akar-icons:cross" class="slider-close-icon"></iconify-icon>

                    <div id="image-slider" class="image-slider">
                        <ul class="ul-image-slider">

                            <?php foreach (json_decode($post->media)as $m){?>
                                @if (pathinfo($m, PATHINFO_EXTENSION) == 'mp4')
                                <li>
                                    <video controls>
                                        <source src="{{asset('storage/post/'.$m) }}">
                                    </video>
                                </li>
                                @else
                                    <li>
                                        <img src="{{asset('storage/post/'.$m) }}" alt="" />
                                    </li>
                                @endif

                            <?php }?>
                        </ul>

                    </div>

                    <div id="thumbnail" class="img-slider-thumbnails">
                        <ul>
                            {{-- <li class="active"><img src="https://40.media.tumblr.com/tumblr_m92vwz7XLZ1qf4jqio1_540.jpg" alt="" /></li> --}}
                            <?php foreach (json_decode($post->media)as $m){?>
                                @if (pathinfo($m, PATHINFO_EXTENSION) == 'mp4')
                                <li>
                                    <video>
                                        <source src="{{asset('storage/post/'.$m) }}">
                                    </video>
                                </li>
                                @else
                                    <li>
                                        <img src="{{asset('storage/post/'.$m) }}" alt="" />
                                    </li>
                                @endif

                            <?php }?>

                        </ul>
                    </div>

                </div>

                @endif
            </div>

            <div class="social-media-post-footer-container">
                <div class="social-media-post-like-container">
                    <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                    <p><span>{{$post_likes->count()}}</span> Likes</p>
                </div>
                <div class="social-media-post-comment-container">
                    <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                    <p><span>50</span> Comments</p>
                </div>
            </div>
        </div>

        <div class="social-media-all-likes-container">
                @forelse ($post_likes as $user_like_post)
                <div class="social-media-all-likes-row">
                    <div class="social-media-all-likes-row-img">
                        <?php $image=$user_like_post->user->profiles()->where('cover_photo',null)->orderBy('created_at','desc')->first() ?>
                        @if($image==null)
                        <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                        <p>{{$user_like_post->user->name}}</p>
                        </a>
                        @else
                        <img src="{{asset('storage/post/'.$image->profile_image)}}">
                        <p>{{$user_like_post->user->name}}</p>
                        </a>
                        @endif
                    </div>
                    <div class="social-media-all-likes-row-btns">
                        @if($user_like_post->friend_status=='myself')
                        @elseif($user_like_post->friend_status=='friend')
                        @elseif($user_like_post->friend_status=='Response')
                        <a class="customer-secondary-btn" href="{{route('socialmedia.profile',$user_like_post->user_id)}}" user_like_post>Response</a>
                        @else
                        <a class="customer-secondary-btn" href="{{route('socialmedia.profile',$user_like_post->user_id)}}" user_like_post>Add</a>
                        @endif

                        {{-- @elseif($user_like_post->friend_status=='cancelRequest')
                            <button class="customer-primary-btn">Requested</button>
                            <a class="customer-secondary-btn" href="{{route('socialmedia.profile',$user_like_post->user_id)}}" style="text-decoration:none">
                                View Profile
                            </a>

                        @elseif($user_like_post->friend_status=='Response')
                            <button class="customer-primary-btn">Accept</button>
                            <a class="customer-secondary-btn" href="{{route('socialmedia.profile',$user_like_post->user_id)}}" style="text-decoration:none">
                                Decline
                            </a>
                        @endif --}}
                    </div>
                </div>
                @empty
                    <p class="text-secondary p-1">No Like</p>
                @endforelse
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

</script>
@endpush
