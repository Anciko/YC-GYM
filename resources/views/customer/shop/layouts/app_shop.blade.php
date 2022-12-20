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
    <link href={{ asset('css/aos.css')}} rel="stylesheet"/>
    <link href={{ asset('css/home.css')}} rel="stylesheet"/>
     <!--customer registeration-->
    <link href={{ asset('css/customer/css/customerRegisteration.css')}} rel="stylesheet"/>

    <!--customer login-->
    <link href="{{ asset('css/customer/css/customerLogin.css')}}" rel="stylesheet"/>

    <link href="{{ asset('css/customer/css/transactionChoice.css')}}" rel="stylesheet"/>
     <!--social media -->
     <link href="{{ asset('css/shop.css')}}" rel="stylesheet"/>
    <!--social media -->
    <link href="{{ asset('css/socialMedia.css')}}" rel="stylesheet"/>

    <!--comment mention--->
    <link href="{{asset('css/customer/jquery.mentiony.css')}}" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--comment emoji-->
    <link href="{{asset('css/customer/emojis.css')}}" rel="stylesheet"/>

    @yield('styles')

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
        <script src="{{asset('js/aos.js')}}"></script>


        <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Create A Shop Post</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" id="form" enctype= multipart/form-data>
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
                    <button type="submit" class="customer-primary-btn addpost-submit-btn">Post</button>
                </form>

              </div>
            </div>
        </div>

        <div class="nav-overlay">
        </div>

            <div class="customer-main-content-container">
                <div class="social-media-header-btns-container margin-top">
                    {{-- <a class="back-btn" href="{{route("socialmedia")}}"> --}}
                    <a class="back-btn" href="javascript:history.back()">
                        <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
                    </a>

                    @if (auth()->user()->shop_request==2)
                    <button class="social-media-addpost-btn customer-primary-btn margin-top" data-bs-toggle="modal" data-bs-target="#addPostModal">
                        <iconify-icon icon="akar-icons:circle-plus" class="addpost-icon"></iconify-icon>
                        <p>Add Post</p>
                    </button>
                    @else
                    <a href="{{route('shoprequest')}}" class="social-media-addpost-btn customer-primary-btn margin-top">
                        <iconify-icon icon="akar-icons:circle-plus" class="addpost-icon"></iconify-icon>
                        <p>Rent a shop</p>
                    </a>
                    @endif
                </div>

                <div class="social-media-left-container-trigger">
                    Friends
                    <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
                </div>

                <div class="social-media-overlay"></div>

                <div class="social-media-parent-container">
                    <div class="social-media-left-container">
                        <div class="social-media-left-search-cancel-container">
                            <div class="social-media-left-search-container">
                                <input type="text" id ="search">
                                <iconify-icon icon="akar-icons:search" class="search-icon"></iconify-icon>
                            </div>
                            <div class="cancel">
                            <p class="customer-secondary-btn cancel" >Cancel</p>
                            </div>
                        </div>
                        <div class="social-media-left-infos-container">
                            <div class="social-media-left-friends-container">
                                <div class="social-media-left-container-header">
                                    <p>Friends</p>
                                    <a href="{{route('friendsList',auth()->user()->id)}}">See All <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon></a>
                                </div>
                                <div class="social-media-left-friends-rows-container">

                                    @forelse ($left_friends as $friend)
                                    <a  href="{{route('socialmedia.profile',$friend->id)}}" class="social-media-left-friends-row">
                                        <?php $profile=$friend->profiles->first();
                                        $profile_id=$friend->profile_id;
                                         $img=$friend->profiles->where('id',$profile_id)->first();
                                        ?>

                                        @if ($img==null)
                            <img  class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                                        @else
                            <img  class="nav-profile-img" src="{{asset('storage/post/'.$img->profile_image)}}"/>
                                        @endif
                                        <p>{{$friend->name}}</p>
                                    </a>
                                    @empty
                                    <p class="text-secondary p-1">No Friend</p>
                                    @endforelse
                                </div>

                            </div>


                            <div class="social-media-left-messages-container">
                                <div class="social-media-left-container-header">
                                    <p id = "messages">Messages</p>
                                    <a href="{{route('message.seeall')}}">See All <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon></a>
                                </div>

                                <div class="social-media-left-messages-rows-container">

                                </div>
                            </div>

                        </div>

                        <div class="shop-left-searched-items-container">
                            <a href="#" class="shop-searched-item">
                                <p>Name</p>
                                <iconify-icon icon="bi:arrow-right-short" class="arrow-icon"></iconify-icon>
                            </a>
                            <a href="#" class="shop-searched-item">
                                <p>Name</p>
                                <iconify-icon icon="bi:arrow-right-short" class="arrow-icon"></iconify-icon>
                            </a>
                        </div>

                    </div>

                    @yield('content')
                </div>
            </div>

    <script src="{{asset('js/AgoraRTCSDK.js')}}"></script>

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


    {{-- axios && Echo --}}
    <script src={{asset('js/app.js')}}></script>
    {{-- pusher --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    {{-- emoji --}}
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- comment emoji --}}
    <script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/customer/DisMojiPicker.js')}}"></script>



    <script src="{{asset('js/customer/jquery.mentiony.js')}}"></script>

    <script>
        $(document).ready(function() {

            $('#form').submit(function(e){

                e.preventDefault();
                var caption=$('#addPostCaption').val();

                var url="{{route('post.store')}}";
                var $fileUpload=$('#addPostInput');

                if(!$('.addpost-caption-input').val() && parseInt($fileUpload.get(0).files.length) === 0){
                    alert("Cannot post!!")
                }
                else{
                    if (parseInt($fileUpload.get(0).files.length)>5){
                        Swal.fire({
                            text: "You can only upload a maximum of 5 files",
                            timerProgressBar: true,
                            timer: 5000,
                            icon: 'warning',
                        });
                    }
                    else{
                        e.preventDefault();
                        let formData = new FormData(form);

                        const totalImages = $("#addPostInput")[0].files.length;
                        let images = $("#addPostInput")[0];

                        for (let i = 0; i < totalImages; i++) {
                            formData.append('images' + i, images.files[i]);
                        }
                        formData.append('totalImages', totalImages);

                        var caption=$('#addPostCaption').val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                                type:'POST',
                                url:"{{route('shoppost.store')}}",
                                data: formData,
                                    processData: false,
                                    cache: false,
                                    contentType: false,
                                success:function(data){
                                if(data.message){
                                    Swal.fire({
                                                text: data.message,
                                                timerProgressBar: true,
                                                timer: 5000,
                                                icon: 'success',
                                            }).then(() => {
                                                window.location.reload()
                                            })
                                }else{
                                    Swal.fire({
                                                text: data.ban,
                                                timerProgressBar: true,
                                                timer: 5000,
                                                icon: 'error',
                                            }).then(() => {
                                                window.location.reload()
                                            })
                                }

                                }
                        });

                    }
                }

            })

            $('.nav-icon').click(function(){
                $('.notis-box-container').toggle()
            })

            $(function(){

                $('.img-slider-thumbnails li').click(function(){
                    var thisIndex = $(this).index()
                    // console.log(thisIndex,$(this).siblings("li.active").index())
                    if($(this).siblings(".active").index() === -1){
                        return
                    }


                    if(thisIndex < $(this).siblings(".active").index()){
                        prevImage(thisIndex, $(this).parents(".img-slider-thumbnails").prev("#image-slider"));
                    }else if(thisIndex > $(this).siblings(".active").index()){
                        nextImage(thisIndex, $(this).parents(".img-slider-thumbnails").prev("#image-slider"));
                    }


                    $(this).siblings('.active').removeClass('active');
                    $(this).addClass('active');

                    });

            });

            var width = $('#image-slider').width();
            console.log(width)

            function nextImage(newIndex, parent){
                parent.find('li').eq(newIndex).addClass('next-img').css('left', width).animate({left: 0},600);
                parent.find('li.active-img').removeClass('active-img').css('left', '0').animate({left: '-100%'},600);
                parent.find('li.next-img').attr('class', 'active-img');
            }
            function prevImage(newIndex, parent){
                parent.find('li').eq(newIndex).addClass('next-img').css('left', -width).animate({left: 0},600);
                parent.find('li.active-img').removeClass('active-img').css('left', '0').animate({left: '100%'},600);
                parent.find('li.next-img').attr('class', 'active-img');
            }

            $('.shop-media-slider').hide()

            $(".shop-media-container").click(function(){

                $(this).siblings(".shop-media-slider").show()
                $(this).hide()
            })

            $(".slider-close-icon").click(function(){
                $(this).closest('.shop-media-slider').hide()
                $(this).closest('.shop-media-slider').siblings('.shop-media-container').show()
            })

            $( ".shop-left-search-container input" ).focus(function() {
                // alert( "Handler for .focus() called." );
                $( ".shop-left-infos-container" ).hide()
                $(".shop-left-searched-items-container").show()
            });

            $( ".shop-left-search-container input" ).focusout(function() {
                // alert( "Handler for .focus() called." );
                $( ".shop-left-infos-container" ).show()
                $(".shop-left-searched-items-container").hide()
            });


            $('.shop-post-header-icon').click(function(){
                $(this).next().toggle()
            })

            $(".shop-left-container-trigger").click(function(){
                $('.shop-left-container').toggleClass("shop-left-container-open")
                $('.shop-overlay').toggle()
                $(".shop-left-container-trigger .arrow-icon").toggleClass("rotate-arrow")
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

@stack('scripts')

  </body>
</html>
