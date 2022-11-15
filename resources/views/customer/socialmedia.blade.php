@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create A Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="modal-body" method="POST" action="{{route('post.store')}}" enctype= multipart/form-data>
            @csrf
            @method('POST')
          <div class="addpost-caption">
            <p>Post Caption</p>
            <textarea placeholder="Caption goes here..." name="caption"></textarea>
          </div>

          <div class="addpost-photovideo">

            <span class="selectImage">

                <div class="addpost-photovideo-btn">
                    <iconify-icon icon="akar-icons:circle-plus" class="addpst-photovideo-btn-icon"></iconify-icon>
                    <p>Photo/Video</p>
                    <input type="file" id="addPostInput" name="addPostInput[]" multiple>
                </div>

                <button class="addpost-photovideo-clear-btn" type="button" onclick="clearAddPost()">Clear</button>

            </span>

            <div class="addpost-photo-video-imgpreview-container">
            </div>


            </div>
            <button type="submit" class="customer-primary-btn addpost-submit-btn">Post</button>
        </form>

      </div>
    </div>
</div>

    <button class="social-media-addpost-btn customer-primary-btn margin-top" data-bs-toggle="modal" data-bs-target="#addPostModal">
        <iconify-icon icon="akar-icons:circle-plus" class="addpost-icon"></iconify-icon>
        <p>Add Post</p>
    </button>

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

        <div class="social-media-right-container">
            <div class="social-media-posts-parent-container">
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
                                <video controls>
                                    <source src="../imgs/movie.mp4">
                                </video>
                            </div>
                            <div class="social-media-media">
                                <img src="https://images.pexels.com/photos/136404/pexels-photo-136404.jpeg?auto=compress&cs=tinysrgb&w=1600">
                            </div>
                            <div class="social-media-media">
                                <img src="https://images.pexels.com/photos/949126/pexels-photo-949126.jpeg?auto=compress&cs=tinysrgb&w=1600">
                            </div>
                            <div class="social-media-media">
                                <img src="https://images.pexels.com/photos/260447/pexels-photo-260447.jpeg?auto=compress&cs=tinysrgb&w=1600">
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
                                <img src="https://images.pexels.com/photos/116079/pexels-photo-116079.jpeg?auto=compress&cs=tinysrgb&w=1600">
                            </div>
                            <div class="social-media-media">
                                <img src="https://images.pexels.com/photos/4752861/pexels-photo-4752861.jpeg?auto=compress&cs=tinysrgb&w=1600">
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
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
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

        $('.addpost-submit-btn').click(function(){
            var $fileUpload = $("#addPostInput");
            if (parseInt($fileUpload.get(0).files.length)>5){
                alert("You can only upload a maximum of 5 files");s
            }
        })

        $("#addPostInput").on("change", handleFileSelect);

        selDiv = $(".addpost-photo-video-imgpreview-container");


        $("body").on("click", ".delete-preview-icon", removeFile);


        console.log($("#selectFilesM").length);
    });


    var selDiv = "";
    var storedFiles = [];
    const dt = new DataTransfer();

    function handleFileSelect(e) {

        var files = e.target.files;
        console.log(files)

        var filesArr = Array.prototype.slice.call(files);
        var device = $(e.target).data("device");
        filesArr.forEach(function(f) {
            console.log(f)
            if (f.type.match("image.*")) {
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-icon'></iconify-icon><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'></div>";

                if (device == "mobile") {
                    $("#selectedFilesM").append(html);
                } else {
                    $(".addpost-photo-video-imgpreview-container").append(html);
                }
                }
                reader.readAsDataURL(f);
                dt.items.add(f);
            }else if(f.type.match("video.*")){
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-icon'></iconify-icon><video controls><source src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/><video></div>";

                if (device == "mobile") {
                    $("#selectedFilesM").append(html);
                } else {
                    $(".addpost-photo-video-imgpreview-container").append(html);
                }
                }
                reader.readAsDataURL(f);
                dt.items.add(f);
            }


        });

        document.getElementById('addPostInput').files = dt.files;
        console.log(document.getElementById('addPostInput').files)

    }

    function removeFile(e) {
        var file = $(this).data("file");
        var names = [];
        for(let i = 0; i < dt.items.length; i++){
            if(file === dt.items[i].getAsFile().name){
                dt.items.remove(i);
            }
        }
        document.getElementById('addPostInput').files = dt.files;

        for (var i = 0; i < storedFiles.length; i++) {
            if (storedFiles[i].name === file) {
            storedFiles.splice(i, 1);
            break;
            }
        }
        $(this).parent().remove();
    }

    function clearAddPost(){
        storedFiles = []
        dt.clearData()
        document.getElementById('addPostInput').files = dt.files;
        $(".addpost-photo-video-imgpreview-container").empty();
    }
</script>
@endpush
