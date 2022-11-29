@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="social-media-right-container">
    <div class="social-media-all-likes-parent-container">
        <div class="social-media-post-container">
            <div class="social-media-post-header">
                <div class="social-media-post-name-container">
                    <img src="../imgs/trainer2.jpg">
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

        <div class="social-media-all-comments-container">
            <form class="social-media-all-comments-input">
                <textarea placeholder="Write a comment"></textarea>
                <button class="social-media-all-comments-send-btn">
                    <iconify-icon icon="akar-icons:send" class="social-media-all-comments-send-icon"></iconify-icon>
                </button>

            </form>

            <div class="social-media-all-comments">
                <div class="social-media-comment-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>
                <div class="social-media-comment-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>
                <div class="social-media-comment-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>
                <div class="social-media-comment-container post-owner-comment">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>

                <div class="social-media-comment-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>
                <div class="social-media-comment-container">
                    <img src="../imgs/trainer2.jpg">
                    <div class="social-media-comment-box">
                        <div class="social-media-comment-box-header">
                            <div class="social-media-comment-box-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>

                            <iconify-icon icon="bx:dots-vertical-rounded" class="social-media-comment-icon"></iconify-icon>
                            <div class="comment-actions-container" >
                                <div class="comment-action">
                                    <iconify-icon icon="akar-icons:edit" class="comment-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>

                                <div class="comment-action">
                                    <iconify-icon icon="fluent:delete-12-regular" class="comment-action-icon"></iconify-icon>
                                    <p>Delete</p>
                                </div>
                            </div>
                        </div>

                        <p>When can you send them ? I would like to get them ASAP.When can you send them ? I would like to get them ASAP.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush
