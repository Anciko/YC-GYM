@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')
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

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $(".cancel").hide();
        $( ".social-media-left-search-container input" ).focus(function() {
            // alert( "Handler for .focus() called." );
            $( ".social-media-left-infos-container" ).hide()
            $(".social-media-left-searched-items-container").show()
            $(".cancel").show();
        });

        $(document).on('click', '.cancel', function(e) {
            // alert( "Handler for .focus() called." );
            $( ".social-media-left-infos-container" ).show()
            $(".social-media-left-searched-items-container").hide()
            $(".cancel").hide()
            $('.social-media-left-search-container input').val('')
        });


                $(document).on('click', '#AddFriend', function(e) {
                e.preventDefault();
                $('.social-media-left-searched-items-container').empty();
                var url = new URL(this.href);

                var id = url.searchParams.get("id");
                var group_id = $(this).attr("id");

                var add_url = "{{ route('addUser', [':id']) }}";
                add_url = add_url.replace(':id', id);
                $(".add-member-btn").attr('href','');
                $.ajax({
                    type: "GET",
                    url: add_url,
                    datatype: "json",
                    success: function(data) {
                        console.log(data)
                        search();
                    }
                })
                });

                $(document).on('click', '#cancelRequest', function(e) {
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
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',

                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                             var url = new URL(this.href);
                             var id = url.searchParams.get("id");
                             var url = "{{ route('cancelRequest', [':id']) }}";
                             url = url.replace(':id', id);
                             $(".cancel-request-btn").attr('href','');
                                $.ajax({
                                    type: "GET",
                                    url: url,
                                    datatype: "json",
                                    success: function(data) {
                                        console.log(data)
                                        search();
                                    }
                                })
                            Swal.fire('Canceled Request!', '', 'success')
                        }
                        })
                $('.social-media-left-searched-items-container').empty();
                });


                    $('.social-media-left-search-container input').on('keyup', function(){
                            search();
                    });

                        function search(){

                            var keyword = $('#search').val();
                            //console.log(keyword);
                            var search_url = "{{ route('search_users') }}";
                            $.post(search_url,
                            {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                keyword:keyword
                            },
                            function(data){
                                table_post_row(data);
                                console.log(data);
                            });
                        }
                        // table row with ajax
                        function table_post_row(res){
                        var auth_id = {{auth()->user()->id}}
                        let htmlView = '';
                            if(res.users.length <= 0){
                                htmlView+= `
                                No data found.
                                `;
                            }

                                for(let i = 0; i < res.users.length; i++){
                                    var status = ''
                                for(let f = 0; f < res.friends.length; f++){

                                    console.log(auth_id)
                                    if(status === "profile"){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                 htmlView += `
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class="customer-secondary-btn "
                                            >View Profile</a>
                                            `
                                    }
                                    else if(res.users[i].id === res.friends[f].receiver_id &&
                                    res.friends[f].sender_id === auth_id &&
                                    res.friends[f].friend_status === 1 ){
                                        console.log(res.users[i].name,'sender request')
                                        status = 'sender request'
                                        break

                                    }
                                    else if(
                                    res.users[i].id === res.friends[f].sender_id &&
                                    res.friends[f].receiver_id === auth_id &&
                                    res.friends[f].friend_status === 1
                                    ){
                                        console.log(res.users[i].name,'receiver request')
                                        status = 'receiver request'
                                        break

                                    }
                                    else if (res.users[i].id === auth_id){
                                        console.log(res.users[i].name,'profile')
                                        status = "profile"
                                        break

                                    }
                                    else if (res.users[i].id === res.friends[f].receiver_id &&
                                    res.friends[f].sender_id === auth_id &&
                                    res.friends[f].friend_status === 2
                                    ){
                                        console.log(res.users[i].name,'sender view profile')
                                        status = "sender view profile"
                                        break

                                    }
                                    else if (
                                    res.users[i].id === res.friends[f].sender_id &&
                                    res.friends[f].receiver_id === auth_id &&
                                    res.friends[f].friend_status === 2
                                    ){
                                        console.log(res.users[i].name,'receiver view profile')
                                        status = "receiver view profile"
                                        break

                                    }
                                    else{
                                        status="add fri"
                                        console.log(res.users[i].name,'add fri')
                                    }
                            }

                            if(status === 'profile'){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                htmlView += `
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class="customer-secondary-btn"
                                            >View Profile</a>
                                            `
                            }

                            else if(status === 'sender request'){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                htmlView += `
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn cancel-request-btn"
                                            id = "cancelRequest">Cancel Request</a>
                                            `
                            }

                            else if(status === 'receiver request'){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                               htmlView += `
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class="customer-secondary-btn">Response</a>
                                            `
                            }
                            else if(status === "sender view profile"){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                htmlView += `
                                            <a href= `+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class="customer-secondary-btn add-friend-btn">Friend</a>
                                          `
                            }
                            else if(status === "receiver view profile"){
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                htmlView += `
                                            <a href= `+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class="customer-secondary-btn add-friend-btn">Friend</a>
                                          `
                            }
                            else{
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                    htmlView += `
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn add-friend-btn" id = "AddFriend">Add</a>
                                    `
                            }
                            }


                            $('.social-media-left-searched-items-container').html(htmlView);
                        }



        $('.social-media-post-header-icon').click(function(){
            $(this).next().toggle()
        })

        $(".social-media-left-container-trigger").click(function(){
            $('.social-media-left-container').toggleClass("social-media-left-container-open")
            $('.social-media-overlay').toggle()
            $(".social-media-left-container-trigger .arrow-icon").toggleClass("rotate-arrow")
        })

        $('.addpost-submit-btn').click(function(e){
            e.preventDefault();
            var caption=$('#addPostCaption').val();

            var url="{{route('post.store')}}";
            var $fileUpload=$('#addPostInput').val();

            // if(!$('.addpost-caption-input').val() && parseInt($fileUpload.get(0).files.length) === 0){
            //     alert("Cannot post!!")
            // }else{
            //     // console.log(parseInt($fileUpload.get(0).files.length))
            //     if (parseInt($fileUpload.get(0).files.length)>5){
            //         alert("You can only upload a maximum of 5 files");
            //     }else{
                let image_upload = new FormData();
                let TotalImages = $('#addPostInput')[0].files.length;  //Total Images
                let images = $('#addPostInput')[0].files;

                for (let i = 0; i < TotalImages; i++) {
                    image_upload.append('images' + i, images[i]);
                }
                image_upload.append('TotalImages', TotalImages);
                console.log(image_upload);

                            //
                    // $.ajaxSetup({
                    //                 headers: {
                    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //                 }
                    //             });
                    //  $.ajax({
                    //         type: "POST",
                    //         _token: $('meta[name="csrf-token"]').attr('content'),
                    //         url: url,
                    //         data:image_upload,
                    //         contentType: false,
                    //         processData: false,
                    //         success: function(data) {

                    //         }
                    //     });
                //}
            //}


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
