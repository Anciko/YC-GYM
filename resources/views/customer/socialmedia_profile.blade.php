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
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>Friend Name</p>
                        </a>
                        <a href="#" class="social-media-left-friends-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>Friend Name</p>
                        </a>
                        <a href="#" class="social-media-left-friends-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>Friend Name</p>
                        </a>
                        <a href="#" class="social-media-left-friends-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
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
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Friend Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-messages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Friend Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-messages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Friend Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-messages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
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
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Group Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-gpmessages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Group Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-gpmessages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                            <p>
                                Group Name<br>
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis. </span>
                            </p>
                        </a>
                        <a href="#" class="social-media-left-gpmessages-row">
                            <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
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

        <div class="social-media-right-container social-media-right-container-nopadding">
            <div class="social-media-profile-parent-container">
                <div class="social-media-profile-bgimg-container">
                    <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&w=1600">
                    <div class="social-media-profile-profileimg-container">
                        <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                    </div>
                </div>


                <div class="social-media-profile-content-container">
                    <button class="customer-primary-btn add-friend-btn">
                        <iconify-icon icon="akar-icons:circle-plus" class="add-friend-icon"></iconify-icon>
                        <p>Add Friend</p>
                    </button>

                    <div class="social-media-profile-username-container">
                        <span class="social-media-profile-username">User Name</span>
                        <span class="social-media-profile-userID">(User ID: 1234567890)</span><br>
                        <span class="social-media-profile-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </div>

                    <div class="social-media-profile-friends-parent-container">
                        <div class="social-media-profile-friends-header">
                            <p>1200 Friends</p>
                            <a href="#">
                                See All
                                <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
                            </a>
                        </div>

                        <div class="social-media-profile-friends-container">
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                            <div class="social-media-profile-friend">
                                <img src="{{asset('img/customer/imgs/user_default.jpg')}}">
                                <p>User Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-media-profile-posts-parent-container">
                        <p>Post & Activities</p>
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

                            <div class="social-media-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                                <div class="social-media-media-container">
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/3813491/pexels-photo-3813491.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/14190098/pexels-photo-14190098.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/6033962/pexels-photo-6033962.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/9452717/pexels-photo-9452717.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/13920607/pexels-photo-13920607.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load">
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

                            <div class="social-media-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                                <div class="social-media-media-container">
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg?auto=compress&cs=tinysrgb&w=1600">
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

                            <div class="social-media-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                                <div class="social-media-media-container">
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&w=1600">
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

                            <div class="social-media-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                                <div class="social-media-media-container">
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/136404/pexels-photo-136404.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/949126/pexels-photo-949126.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/260447/pexels-photo-260447.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/949126/pexels-photo-949126.jpeg?auto=compress&cs=tinysrgb&w=1600">
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

                            <div class="social-media-content-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                                <div class="social-media-media-container">
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&w=1600">
                                    </div>
                                    <div class="social-media-media">
                                        <img src="https://images.pexels.com/photos/949131/pexels-photo-949131.jpeg?auto=compress&cs=tinysrgb&w=1600">
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
                </div>
            </div>
        </div>
    </div>
@endsection
