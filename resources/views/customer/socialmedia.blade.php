@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')


    {{-- <button class="social-media-addpost-btn customer-primary-btn margin-top" data-bs-toggle="modal" data-bs-target="#addPostModal">
        <iconify-icon icon="akar-icons:circle-plus" class="addpost-icon"></iconify-icon>
        <p>Add Post</p>
    </button> --}}

    {{-- <div class="social-media-left-container-trigger">
        Friends
        <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
    </div>

    <div class="social-media-overlay"></div> --}}

    {{-- <div class="social-media-parent-container"> --}}


        <div class="social-media-right-container">
            <div class="social-media-posts-parent-container">
                @foreach ($posts as $post)
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
                            {{-- <form action="{{ route('category.destroy',$post->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit">Delete</button>
                            </form> --}}
                        @if ($post->user->id == auth()->user()->id)

                            <a id="edit_post" data-id="{{$post->id}}" data-bs-toggle="modal" >
                                <div class="post-action">
                                    <iconify-icon icon="bi:edit" class="post-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>
                            </a>
                            <a id="delete_post" data-id="{{$post->id}}">
                                <div class="post-action">
                                <iconify-icon icon="bi:delete" class="post-action-icon"></iconify-icon>
                                <p>Delete</p>
                                </div>
                            </a>
                        @endif
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
                @endforeach
                <div class="social-media-post-container">
                    <div class="social-media-post-header">
                        <div class="social-media-post-name-container">
                            <a href="/socialmedia_profile">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            </a>
                            <div class="social-media-post-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>
                        </div>

                        <iconify-icon icon="bi:three-dots-vertical" class="social-media-post-header-icon"></iconify-icon>

                        <div class="post-actions-container" >
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>

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
                <div class="social-media-post-container">
                    <div class="social-media-post-header">
                        <div class="social-media-post-name-container">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <div class="social-media-post-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
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

            </div>
        {{-- </div> --}}

@endsection
@push('scripts')
@endpush
