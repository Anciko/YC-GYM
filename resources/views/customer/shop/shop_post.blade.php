@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-posts-header-container">
        <p>{{$user->name}}'s Shop</p>
        <div class="shop-search-container">
            <input type="text" placeholder="Search...">
            <iconify-icon icon="akar-icons:search" class="shop-search-icon"></iconify-icon>
        </div>
    </div>
    <div class="shop-posts-parent-container">
        @forelse ($user->shopposts as $shpost)
            <div class="shop-post-container">
                <div class="shop-post-header">
                    <div class="shop-post-name-container">
                        <img src="../imgs/trainer2.jpg">
                        <div class="shop-post-name">
                            <p>{{$shpost->user->name}}</p>
                            <span>{{ \Carbon\Carbon::parse($shpost->created_at)->format('d M Y , g:i A')}}</span>
                        </div>
                    </div>

                    <iconify-icon icon="bi:three-dots-vertical" class="shop-post-header-icon"></iconify-icon>

                    <div class="post-actions-container" >
                        <a href="#" style="text-decoration:none" class="post_save" id="{{$shpost->id}}">
                            <div class="post-action">
                                <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                @php
                                    $already_save=auth()->user()->user_saved_shopposts->where('post_id',$shpost->id)->first();
                                @endphp

                                @if ($already_save)
                                    <p class="save">Unsave</p>
                                @else
                                    <p class="save">Save</p>
                                    @endif
                            </div>
                        </a>
                        {{-- <div class="post-action">
                            <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                            <p>Save</p>
                        </div> --}}
                    @if ($shpost->user_id == auth()->user()->id)

                        <a id="edit_post" data-id="{{$shpost->id}}" data-bs-toggle="modal" >
                            <div class="post-action">
                                <iconify-icon icon="material-symbols:edit" class="post-action-icon"></iconify-icon>
                                <p>Edit</p>
                            </div>
                        </a>
                        <a id="delete_post" data-id="{{$shpost->id}}">
                            <div class="post-action">
                            <iconify-icon icon="material-symbols:delete-forever-outline-rounded" class="post-action-icon"></iconify-icon>
                            <p>Delete</p>
                            </div>
                        </a>
                    @else
                    {{-- <div class="post-action" id="report" data-id="{{$shpost->id}}">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div> --}}
                    @endif
                    </div>
                </div>

                <div class="shop-content-container">
                    @if ($shpost->media==null)
                    <p>{{$shpost->caption}}</p>
                    @else
                    <p>{{$shpost->caption}}</p>
                    <div class="shop-media-container">
                        <?php foreach (json_decode($shpost->media)as $m){?>
                        <div class="shop-media">
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

                    <div id="slider-wrapper" class="shop-media-slider">
                        <iconify-icon icon="akar-icons:cross" class="slider-close-icon"></iconify-icon>

                        <div id="image-slider" class="image-slider">
                            <ul class="ul-image-slider">

                                <?php foreach (json_decode($shpost->media)as $m){?>
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
                                <?php foreach (json_decode($shpost->media)as $m){?>
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
                        <a href="#" class="customer-primary-btn">Message the seller</a>

                    </div>

                    @endif
                </div>

                <div class="shop-post-footer-container">
                    <div class="shop-post-like-container">
                        <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                        <p><span>1.1k</span> Likes</p>
                    </div>
                    <div class="shop-post-comment-container">
                        <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                        <p><span>50</span> Comments</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary p-1">No Shop Post</p>
        @endforelse
        <div class="shop-post-container">
            <div class="shop-post-header">
                <div class="shop-post-name-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="shop-post-name">
                        <p>User Name</p>
                        <span>19 Sep 2022, 11:02 AM</span>
                    </div>


                </div>

                <iconify-icon icon="bi:three-dots-vertical" class="shop-post-header-icon"></iconify-icon>
                <div class="post-actions-container">
                    <div class="post-action">
                        <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                        <p>Save</p>
                    </div>

                    {{-- <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div> --}}
                </div>
            </div>

            <div class="shop-content-container">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                <div class="shop-media-container">
                    <div class="shop-media">
                        <img src="../imgs/trainer3.jpg">
                    </div>
                    <div class="shop-media">
                        <img src="../imgs/trainer3.jpg">
                    </div>
                    <div class="shop-media">
                        <img src="../imgs/trainer3.jpg">
                    </div>
                    <div class="shop-media">
                        <img src="../imgs/trainer3.jpg">
                    </div>
                    <div class="shop-media">
                        <img src="../imgs/trainer3.jpg">
                    </div>
                </div>

                <div id="slider-wrapper" class="shop-media-slider">
                    <iconify-icon icon="akar-icons:cross" class="slider-close-icon"></iconify-icon>

                    <div id="image-slider">
                        <!-- <iconify-icon icon="dashicons:arrow-left-alt2" class="image-slider-left-icon"></iconify-icon>
                        <iconify-icon icon="dashicons:arrow-right-alt2" class="image-slider-right-icon"></iconify-icon> -->
                        <ul>
                            <li class="active-img">
                                <img src="https://40.media.tumblr.com/tumblr_m92vwz7XLZ1qf4jqio1_540.jpg" alt="" />
                            </li>
                            <li>
                                <img src="https://36.media.tumblr.com/0eb59d5c5bc5cde7737bb99d527247ca/tumblr_nxi8jzk8OS1rwfs76o1_540.jpg" alt="" />
                            </li>
                            <li>
                                <img src="https://40.media.tumblr.com/d4e261711a84707195d8fb9b0a94dccb/tumblr_o05avp3WSh1rn52wlo1_540.jpg" alt="" />
                            </li>
                            <li>
                                <img src="https://40.media.tumblr.com/817bd6a18d9ca6877c9d5a1b7d33c198/tumblr_mx1cizinbl1qljihqo1_540.jpg" alt="" />
                            </li>
                            <li>
                                <img src="https://40.media.tumblr.com/6fbf40647afad248b55af46361aea7f9/tumblr_nvdl4xGcxB1r3zwc2o1_540.jpg" alt="" />
                            </li>

                        </ul>

                    </div>

                    <div id="thumbnail" class="img-slider-thumbnails">
                        <ul>
                            <li class="active"><img src="https://40.media.tumblr.com/tumblr_m92vwz7XLZ1qf4jqio1_540.jpg" alt="" /></li>
                            <li><img src="https://36.media.tumblr.com/0eb59d5c5bc5cde7737bb99d527247ca/tumblr_nxi8jzk8OS1rwfs76o1_540.jpg" alt="" /></li>
                            <li><img src="https://40.media.tumblr.com/d4e261711a84707195d8fb9b0a94dccb/tumblr_o05avp3WSh1rn52wlo1_540.jpg" alt="" /></li>
                            <li><img src="https://40.media.tumblr.com/817bd6a18d9ca6877c9d5a1b7d33c198/tumblr_mx1cizinbl1qljihqo1_540.jpg" alt="" /></li>
                            <li><img src="https://40.media.tumblr.com/6fbf40647afad248b55af46361aea7f9/tumblr_nvdl4xGcxB1r3zwc2o1_540.jpg" alt="" /></li>

                        </ul>
                    </div>

                    <a href="#" class="customer-primary-btn">Message the seller</a>

                </div>
            </div>

            <div class="shop-post-footer-container">
                <div class="shop-post-like-container">
                    <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                    <p><span>1.1k</span> Likes</p>
                </div>
                <div class="shop-post-comment-container">
                    <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                    <p><span>50</span> Comments</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

    })
</script>

@endpush
