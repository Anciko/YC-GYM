<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--iconify-->
    <script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--global css-->
    {{-- <link href={{ asset('css/customer/css/globals.css')}} rel="stylesheet"/> --}}
    <link href={{ asset('css/globals.css')}} rel="stylesheet"/>

    <link href={{ asset('css/home.css')}} rel="stylesheet"/>
     <!--customer registeration-->
    <link href={{ asset('css/customer/css/customerRegisteration.css')}} rel="stylesheet"/>

    <!--customer login-->
    <link href="{{ asset('css/customer/css/customerLogin.css')}}" rel="stylesheet"/>

    <link href="{{ asset('css/customer/css/transactionChoice.css')}}" rel="stylesheet"/>
     <!--social media -->
     <link href="{{ asset('css/socialMedia.css')}}" rel="stylesheet"/>

    <!--social media -->
    <link href="{{ asset('css/socialMedia.css')}}" rel="stylesheet"/>

    <title>YC-fitness</title>
  </head>
  <body class="customer-loggedin-bg">
    <!-- <div class="customer-registeration-bgimg"> -->
        <script>
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        </script>

        @include('customer.training_center.layouts.header')
        <!--theme-->


        <script src="{{asset('js/theme.js')}}"></script>

        <div class="nav-overlay">
        </div>

    <!-- </div> -->
        {{-- <div style="margin-top:300px;"> @foreach($infos as $user )
            {{$user->name}}
            @endforeach </div> --}}
            <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Create A Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- <form method="post" class="modal-body" enctype= multipart/form-data>
                        @csrf --}}
                    <form class="modal-body" method="POST" action="{{route('post.store')}}" enctype= multipart/form-data>
                        @csrf
                        @method('POST')
                      <div class="addpost-caption">
                        <p>Post Caption</p>
                        <textarea placeholder="Caption goes here..." name="caption" id="addPostCaption" class="addpost-caption-input"></textarea>
                      </div>

                      <div class="addpost-photovideo">

                        <span class="selectImage">

                            <div class="addpost-photovideo-btn">
                                <iconify-icon icon="akar-icons:circle-plus" class="addpst-photovideo-btn-icon"></iconify-icon>
                                <p>Photo/Video</p>
                                <input type="file" id="addPostInput" name="addPostInput[]" multiple enctype="multipart/form-data">
                            </div>

                            <button class="addpost-photovideo-clear-btn" type="button" onclick="clearAddPost()">Clear</button>

                        </span>

                        <div class="addpost-photo-video-imgpreview-container">
                        </div>


                        </div>
                        <button type="submit" class="customer-primary-btn">Post</button>
                        {{-- <button type="submit" class="customer-primary-btn addpost-submit-btn">Post</button> --}}
                    </form>

                  </div>
                </div>
            </div>
            <div class="customer-main-content-container">
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
                        <input type="text" id ="search">
                        <iconify-icon icon="akar-icons:search" class="search-icon"></iconify-icon>
                    </div>
                    <div class="cancel">
                        <a href="#" class="customer-secondary-btn cancel" >Cancel</a>
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

                    </div>
                </div>

                @yield('content')
            </div>
            </div>
        {{-- <div class="customer-main-content-container"> --}}



        {{-- </div> --}}



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- Sweet Alert -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script src={{ asset('js/customer/js/customerRegisteration.js')}}></script>

    <!--nav bar-->
    <script src={{asset('js/navBar.js')}}></script>
    <script src={{asset('js/notify.js')}}></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        // $(document).ready(function(){
            $( document ).ready(function() {
                $('.nav-icon').click(function(){
                        $('.notis-box-container').toggle()
                    })


            // })
                console.log("ready");
                var user_id = {{auth()->user()->id}};
                console.log(user_id);
                var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
                cluster: '{{env("PUSHER_APP_CLUSTER")}}',
                encrypted: true
                });

                var channel = pusher.subscribe('friend_request.'+user_id);
                channel.bind('friendRequest', function(data) {
                console.log(data);
                $.notify(data, "success",{ position:"left" });
                });
         })
    </script>
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
                $('.social-media-left-searched-items-container').empty();
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
    @stack('scripts')

    @push('scripts')

        <script>
             $(document).ready(function(){
                console.log("ready");


            $(window).scroll(function(){
                var scroll = $(window).scrollTop()
                if(scroll>50){
                    $('.index-page-header').addClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#ffffff")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#ffffff")
                    // $(".index-page-header select").css("color","#ffffff")
                    // $(".index-page-header select option").css("color","#000000")
                }else{
                    $('.index-page-header').removeClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#000000")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#000000")
                    // $(".index-page-header select").css("color","#000000")
                }
            })
        })


        </script>
    @endpush

  </body>
</html>
