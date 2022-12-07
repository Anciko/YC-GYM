@extends('layouts.app')
@section('social-report-active', 'active')

@section('content')


<div class="container d-flex justify-content-center">
    <div class="social-media-right-container">
        <div class="social-media-posts-parent-container">

            @forelse ($report_posts as $report_post)

                <div class="social-media-post-container">
                    <div class="social-media-post-header">
                        <div class="social-media-post-name-container">
                            <a href="/socialmedia_profile">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            </a>
                            <div class="social-media-post-name">
                                <p>{{$report_post->user->name}}</p>
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
                                <p>Ban post</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-media-content-container">
                        <span class="text-danger">Report status :
                            {{$report_post->reports->description}}
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab saepe tempora aspernatur consectetur corrupti doloribus vitae aliquid omnis officiis adipisci expedita quis et, sequi itaque cumque quam harum, rerum maxime.
                        </span>
                        <p>{{$report_post->caption}}</p>

                        @if ($report_post->media == null || $report_post->media == 0)

                        @else
                            <div class="social-media-media-container">
                                <div class="social-media-media">
                                    <img src="https://images.pexels.com/photos/3813491/pexels-photo-3813491.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <hr>

                @empty
                <div class="social-media-post-container">
                    <h3>Not Have Any Report!</h3>
                </div>

            @endforelse
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
     $('.social-media-post-header-icon').click(function(){
            $(this).next().toggle()
        })
</script>
@endpush
