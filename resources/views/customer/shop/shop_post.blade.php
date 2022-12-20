@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-posts-parent-container">
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

            <div class="shop-content-container">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>

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

                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
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

                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
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

                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
                </div>
            </div>

            <div class="shop-content-container">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                <div class="shop-media-container">
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

                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
                </div>
            </div>

            <div class="shop-content-container">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                <div class="shop-media-container">
                    <div class="shop-media">

                            <video controls>
                                <source src="../imgs/movie.mp4">
                            </video>

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

                                    <video controls>
                                        <source src="../imgs/movie.mp4">
                                    </video>

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
                            <li><video>
                                <source src="../imgs/movie.mp4">
                            </video></li>
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

                    <div class="post-action">
                        <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                        <p>Report</p>
                    </div>
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
                                <img src="../imgs/portrait.jpeg" alt="" />
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
