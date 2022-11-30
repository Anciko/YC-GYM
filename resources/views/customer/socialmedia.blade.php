@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

        <div class="social-media-right-container">
            <div class="social-media-posts-parent-container">
                @foreach ($posts as $post)
                <div class="social-media-post-container">
                    <div class="social-media-post-header">
                        <div class="social-media-post-name-container">
                            <a href="{{route('socialmedia.profile',$post->user_id)}}" style="text-decoration:none">
                                <?php $profile=$post->user->profiles->where('cover_photo',null)->sortByDesc('created_at')->first() ?>
                                @if ($profile==null)
                                    <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                                @else
                                    <img class="nav-profile-img" src="{{asset('storage/post/'.$profile->profile_image)}}"/>
                                @endif
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
                            <a href="#" style="text-decoration:none" class="post_save" id="{{$post->id}}">
                                <div class="post-action">
                                    <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                    @php
                                        $already_save=auth()->user()->user_saved_posts->where('post_id',$post->id)->first();
                                    @endphp

                                    @if ($already_save)
                                        <p class="save">Unsave</p>
                                    @else
                                        <p class="save">Save</p>
                                     @endif
                                </div>
                            </a>
                        @if ($post->user->id == auth()->user()->id)

                            <a id="edit_post" data-id="{{$post->id}}" data-bs-toggle="modal" >
                                <div class="post-action">
                                    <iconify-icon icon="material-symbols:edit" class="post-action-icon"></iconify-icon>
                                    <p>Edit</p>
                                </div>
                            </a>
                            <a id="delete_post" data-id="{{$post->id}}">
                                <div class="post-action">
                                <iconify-icon icon="material-symbols:delete-forever-outline-rounded" class="post-action-icon"></iconify-icon>
                                <p>Delete</p>
                                </div>
                            </a>
                        @else
                        <div class="post-action">
                            <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                            <p>Report</p>
                        </div>
                        @endif

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

                        <div id="slider-wrapper" class="social-media-media-slider">
                            <iconify-icon icon="akar-icons:cross" class="slider-close-icon"></iconify-icon>

                            <div id="image-slider" class="image-slider">
                                <ul class="ul-image-slider">

                                    <?php foreach (json_decode($post->media)as $m){?>
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
                                    {{-- <li class="active"><img src="https://40.media.tumblr.com/tumblr_m92vwz7XLZ1qf4jqio1_540.jpg" alt="" /></li> --}}
                                    <?php foreach (json_decode($post->media)as $m){?>
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

                        </div>

                        @endif
                    </div>

                    <div class="social-media-post-footer-container">
                        <div class="social-media-post-like-container">
                            @php
                                $total_likes=$post->user_reacted_posts->count();
                                $user=auth()->user();
                                $already_liked=$user->user_reacted_posts->where('post_id',$post->id)->count();
                            @endphp

                            <a class="like" href="#" id="{{$post->id}}">

                            @if($already_liked==0)
                            <iconify-icon icon="mdi:cards-heart-outline" class="like-icon">
                            </iconify-icon>
                            @else
                            <iconify-icon icon="mdi:cards-heart" style="color: red;" class="like-icon already-liked">
                            </iconify-icon>
                            @endif

                            </a>
                            <p>
                                <span class="total_likes">

                                {{$total_likes}}
                                </span>
                                Likes
                            </p>
                        </div>
                        <div class="social-media-post-comment-container">
                            <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                            <p><span>50</span> Comments</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('.like').click(function(e){
            e.preventDefault();
            var isLike=e.target.previousElementSibiling == null ? true : false;
            var post_id=$(this).attr('id');
            console.log(post_id)
            var add_url = "{{ route('user.react.post', [':post_id']) }}";
            add_url = add_url.replace(':post_id', post_id);
            var that = $(this)
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        method: "POST",
                        url: add_url,
                        data:{ isLike : isLike , post_id: post_id },
                        success:function(data){
                            that.siblings('p').children('.total_likes').html(data.total_likes)

                            if(that.children('.like-icon').hasClass("already-liked")){
                                that.children('.like-icon').attr('style','')
                                that.children('.like-icon').attr('class','like-icon')
                                that.children(".like-icon").attr('icon','mdi:cards-heart-outline')
                            }else{
                                that.children('.like-icon').attr('style','color : red')
                                that.children('.like-icon').attr('class','like-icon already-liked')
                                that.children(".like-icon").attr('icon','mdi:cards-heart')
                            }

                        }
                    })


        })

        $('.post_save').click(function(e){
            e.preventDefault();

            var post_id=$(this).attr('id');
            var add_url = "{{ route('socialmedia.post.save', [':post_id']) }}";
            add_url = add_url.replace(':post_id', post_id);
                    $.ajax({
                        method: "GET",
                        url: add_url,
                        data:{
                                post_id : post_id
                            },
                            success: function(data) {
                                // window.location.reload();
                                if(data.save){
                                    Swal.fire({
                                        text: data.save,
                                        timerProgressBar: true,
                                        timer: 5000,
                                        icon: 'success',
                                    }).then((result) => {
                                        e.target.innerHTML = "Unsave";
                                    })
                                }else{
                                    Swal.fire({
                                            text: data.unsave,
                                            timerProgressBar: true,
                                            timer: 5000,
                                            icon: 'success',
                                        }).then((result) => {
                                            e.target.innerHTML="Save";

                                    })
                                }

                            }
                    })


        })
    });
</script>
{{-- <script>
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

        $(document).on('click', '#delete_post', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                        text: "Are you sure to delete post?",
                        showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',

                        }).then((willDelete) => {
                            var add_url = "{{ route('post.destroy', [':id']) }}";
                            add_url = add_url.replace(':id', id);

                            $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                            $.ajax({
                                method: "POST",
                                url: add_url,
                                datatype: "json",
                                success: function(data) {
                                    window.location.reload();
                                    // Swal.fire({
                                    //             text: data.success,
                                    //             showClass: {
                                    //                     popup: 'animate__animated animate__fadeInDown'
                                    //                 },
                                    //                 hideClass: {
                                    //                     popup: 'animate__animated animate__fadeOutUp'
                                    //                 },
                                    //             }).then(() => {
                                    //     window.location.reload()
                                    // })
                                }
                                })
                        })
        })

        $(document).on('click','#edit_post',function(e){
            e.preventDefault();
            $(".editpost-photo-video-imgpreview-container").empty();

            dtEdit.clearData()
            document.getElementById('editPostInput').files = dtEdit.files;
            var id = $(this).data('id');

            $('#editPostModal').modal('show');
            var add_url = "{{ route('post.edit', [':id']) }}";
            add_url = add_url.replace(':id', id);

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                    method: "POST",
                    url: add_url,
                    datatype: "json",
                    success: function(data) {
                        if(data.status==400){
                            alert(data.message)
                        }else{
                            $('#editPostCaption').val(data.post.caption);
                            $('#edit_post_id').val(data.post.id);

                            var filesdb =JSON.parse(data.post.media);
                            // var filesAmount=files.length;
                            var storedFilesdb = filesdb;
                            // console.log(storedFilesdb)


                            filesdb.forEach(function(f) {
                                fileExtension = f.replace(/^.*\./, '');
                                console.log(fileExtension);
                                if(fileExtension=='mp4') {
                                    var html="<div class='addpost-preview'>\
                                        <iconify-icon icon='akar-icons:cross' data-file='" + f + "' class='delete-preview-edit-input-icon'></iconify-icon>\
                                        <video controls><source src='storage/post/" + f + "' data-file='" + f+ "' class='selFile' title='Click to remove'>" + f + "<br clear=\"left\"/>\
                                        <video>\
                                    </div>"
                                    $(".editpost-photo-video-imgpreview-container").append(html);

                                }else{
                                    var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f + "' class='delete-preview-db-icon'></iconify-icon><img src='storage/post/"+f+"' data-file='" + f + "' class='selFile' title='Click to remove'></div>";
                                    $(".editpost-photo-video-imgpreview-container").append(html);
                                }

                            });

                            $("body").on("click", ".delete-preview-db-icon", removeFiledb);

                            function removeFiledb(){
                                var file = $(this).data('file')
                                storedFilesdb = storedFilesdb.filter((item) => {
                                    return file !== item
                                })
                                console.log(storedFilesdb)


                                $(this).parent().remove();
                            }

                            $('#edit_form').submit(function(e){
                                e.preventDefault();
                                $('#editPostModal'). modal('hide');

                            var fileUpload=$('#editPostInput');
                            console.log(storedFilesdb.length );
                            console.log(parseInt(fileUpload.get(0).files.length) );
                            console.log(storedFilesdb);
                            console.log(fileUpload.get(0).files);

                            if(!$('#editPostCaption').val() && (parseInt(fileUpload.get(0).files.length) + storedFilesdb.length) === 0){
                                alert("Cannot post!!")
                            }else{
                                if((parseInt(fileUpload.get(0).files.length))+storedFilesdb.length > 5){
                                    Swal.fire({
                                                text: "You can only upload a maximum of 5 files",
                                                confirmButtonColor: '#3CDD57',
                                                timer: 5000
                                            });
                                }else{
                                    e.preventDefault();

                                    var url="{{route('post.update')}}";
                                    let formData = new FormData(edit_form);
                                    var oldimg=storedFilesdb;
                                    var edit_post_id=$('#edit_post_id').val();
                                    var caption=$('#editPostCaption').val();

                                    const totalImages = $("#editPostInput")[0].files.length;
                                    let images = $("#editPostInput")[0];

                                    // for (let i = 0; i < totalImages; i++) {
                                        formData.append('images', images);
                                    // }
                                    formData.append('totalImages', totalImages);
                                    formData.append('caption', caption);
                                    formData.append('oldimg', storedFilesdb);
                                    formData.append('edit_post_id', edit_post_id);

                                    for (const value of formData.values()) {
                                        console.log(value);
                                    }

                                    $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });

                                    $.ajax({
                                            type:'POST',
                                            url:url,
                                            data: formData,
                                            processData: false,
                                            cache: false,
                                            contentType: false,
                                            success:function(data){
                                            Swal.fire({
                                                        text: data.success,
                                                        confirmButtonColor: '#3CDD57',
                                                        timer: 5000
                                                    }).then(() => {
                                                        window.location.reload()
                                        })
                                                    }
                                        });
                                }

                            }
                            // var data={
                            //             'caption':$('#editPostCaption').val(),
                            //             'post_id':$('#edit_post_id').val()
                            //         }
                            // $.ajax({
                            //                 type:'POST',
                            //                 url:url,
                            //                 data: data,
                            //                 success:function(data){
                            //                    Swal.fire({
                            //                             text: data.success,
                            //                             confirmButtonColor: '#3CDD57',
                            //                             timer: 5000
                            //                         }).then(() => {
                            //                             window.location.reload()
                            //             })
                            //                 }
                            //     });
                        })

                        }

                    }
                })

        })

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
                                    id = res.users[i].id;
                                    var url = "{{ route('socialmedia_profile', [':id']) }}";
                                    url = url.replace(':id', id);
                                    console.log(auth_id)

                                    if(res.users[i].id === res.friends[f].receiver_id &&
                                    res.friends[f].sender_id === auth_id &&
                                    res.friends[f].friend_status === 1 ){
                                        console.log(res.users[i].name,'sender request')
                                        status = 'sender request'
                                        break
                                        // return
                                        // htmlView += `
                                        //     <a href=`+url+` class = "profiles">
                                        //         <p>`+res.users[i].name+`</p>
                                        //     </a>
                                        //     <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn cancel-request-btn"
                                        //     id = "cancelRequest">Cancel Request</a>
                                        //     `
                                    }
                                    else if(
                                    res.users[i].id === res.friends[f].sender_id &&
                                    res.friends[f].receiver_id === auth_id &&
                                    res.friends[f].friend_status === 1
                                    ){
                                        console.log(res.users[i].name,'receiver request')
                                        status = 'receiver request'
                                        break
                                        // return
                                        // htmlView += `
                                        //     <a href=`+url+` class = "profiles">
                                        //         <p>`+res.users[i].name+`</p>
                                        //     </a>
                                        //     <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn cancel-request-btn"
                                        //     id = "cancelRequest">Response</a>
                                        //     `
                                    }
                                    else if (res.users[i].id === auth_id){
                                        console.log(res.users[i].name,'profile')
                                        status = "profile"
                                        break
                                        // return
                                        // htmlView += `
                                        //     <a href=`+url+` class = "profiles">
                                        //         <p>`+res.users[i].name+`</p>
                                        //     </a>
                                        //     <a href=`+url+` class="customer-secondary-btn "
                                        //     >View Profile</a>
                                        //     `
                                    }
                                    else if (res.users[i].id === res.friends[f].receiver_id &&
                                    res.friends[f].sender_id === auth_id &&
                                    res.friends[f].friend_status === 2
                                    ){
                                        console.log(res.users[i].name,'sender view profile')
                                        status = "sender view profile"
                                        break
                                        // return
                                        // htmlView += `
                                        //     <a href= `+url+` class = "profiles">
                                        //         <p>`+res.users[i].name+`</p>
                                        //     </a>
                                        //     <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn ">Friend</a>
                                        //     `
                                    }
                                    else if (
                                    res.users[i].id === res.friends[f].sender_id &&
                                    res.friends[f].receiver_id === auth_id &&
                                    res.friends[f].friend_status === 2
                                    ){
                                        console.log(res.users[i].name,'receiver view profile')
                                        status = "receiver view profile"
                                        break
                                        // return
                                        // htmlView += `
                                        //     <a href= `+url+` class = "profiles">
                                        //         <p>`+res.users[i].name+`</p>
                                        //     </a>
                                        //     <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn ">Friend</a>
                                        //   `
                                    }
                                    else{
                                        status="add fri"
                                        console.log(res.users[i].name,'add fri')
                                    //     htmlView += `
                                    //         <a href=`+url+` class = "profiles">
                                    //             <p>`+res.users[i].name+`</p>
                                    //         </a>
                                    //         <a href="?id=` + res.users[i].id+`" class="customer-secondary-btn " id = "AddFriend">Add</a>
                                    // `
                                    }

                            }

                            if(status === 'sender request'){
                                htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href="?id=` + res.users[i].id+`" class=" cancel-request-btn"
                                            id = "cancelRequest"><iconify-icon icon="material-symbols:cancel-schedule-send-rounded" class="search-item-icon"></iconify-icon></a>
                                            </div>
                                            `
                            }

                            else if(status === 'receiver request'){
                               htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class=""><iconify-icon icon="bi:person-check" class="search-item-icon"></iconify-icon></a>
                                            </div>
                                            `
                            }

                            else if(status === "profile"){
                                 htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class=""
                                            ><iconify-icon icon="bi:people-fill" class="search-item-icon"></iconify-icon></a>
                                            </div>
                                            `
                            }

                            else if(status === "sender view profile"){
                                htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href= `+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class=""><iconify-icon icon="bi:people-fill" class="search-item-icon"></iconify-icon></a>
                                            </div>
                                          `
                            }
                            else if(status === "receiver view profile"){
                                htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href= `+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href=`+url+` class=""><iconify-icon icon="bi:people-fill" class="search-item-icon"></iconify-icon></a>
                                            </div>
                                          `
                            }
                            else{
                                    htmlView += `
                                            <div class="social-media-left-searched-item">
                                            <a href=`+url+` class = "profiles">
                                                <p>`+res.users[i].name+`</p>
                                            </a>
                                            <a href="?id=` + res.users[i].id+`" class="" id = "AddFriend"><iconify-icon icon="bi:person-add" class="search-item-icon"></iconify-icon></a>
                                            </div>
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

        $('#form').submit(function(e){
            e.preventDefault();
            $('#addPostModal'). modal('hide');
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
                        confirmButtonColor: '#3CDD57',
                        timer: 5000
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
                            url:"{{route('post.store')}}",
                            data: formData,
                                processData: false,
                                cache: false,
                                contentType: false,
                            success:function(data){

                               Swal.fire({
                                        text: data.message,
                                        confirmButtonColor: '#3CDD57',
                                        timer: 5000
                                    }).then(() => {
                                        window.location.reload()
                        })
                            }
                    });

                }
            }

        })



        $("#addPostInput").on("change", handleFileSelect);
        $("#editPostInput").on("change", handleFileSelectEdit);

        selDiv = $(".addpost-photo-video-imgpreview-container");

        console.log(selDiv);

        $("body").on("click", ".delete-preview-icon", removeFile);
        $("body").on("click", ".delete-preview-edit-input-icon", removeFileFromEditInput);



        console.log($("#selectFilesM").length);
    });


    var selDiv = "";

    var storedFiles = [];
    var storedFilesEdit = [];
    const dt = new DataTransfer();
    const dtEdit = new DataTransfer();

    function handleFileSelect(e) {

        var files = e.target.files;
        console.log(files)

        var filesArr = Array.prototype.slice.call(files);

        var device = $(e.target).data("device");

        filesArr.forEach(function(f) {
            console.log(f);
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
        console.log(document.getElementById('addPostInput').files+" Add Post Input")

    }
    function handleFileSelectEdit(e) {

        var files = e.target.files;
        console.log(files)

        var filesArr = Array.prototype.slice.call(files);

        var device = $(e.target).data("device");

        filesArr.forEach(function(f) {

            if (f.type.match("image.*")) {
                storedFilesEdit.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-edit-input-icon'></iconify-icon><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'></div>";

                if (device == "mobile") {
                    $("#selectedFilesM").append(html);
                } else {
                    $(".editpost-photo-video-imgpreview-container").append(html);
                }
                }
                reader.readAsDataURL(f);
                dtEdit.items.add(f);
            }else if(f.type.match("video.*")){
                storedFilesEdit.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                var html = "<div class='addpost-preview'><iconify-icon icon='akar-icons:cross' data-file='" + f.name + "' class='delete-preview-edit-input-icon'></iconify-icon><video controls><source src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/><video></div>";

                if (device == "mobile") {
                    $("#selectedFilesM").append(html);
                } else {
                    $(".editpost-photo-video-imgpreview-container").append(html);
                }
                }
                reader.readAsDataURL(f);
                dtEdit.items.add(f);
            }


        });

        document.getElementById('editPostInput').files = dtEdit.files;
        console.log(document.getElementById('editPostInput').files+" Edit Post Input")

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
    function removeFileFromEditInput(e) {
        var file = $(this).data("file");
        var names = [];
        for(let i = 0; i < dtEdit.items.length; i++){
            if(file === dtEdit.items[i].getAsFile().name){
                dtEdit.items.remove(i);
            }
        }
        document.getElementById('editPostInput').files = dtEdit.files;

        for (var i = 0; i < storedFilesEdit.length; i++) {
            if (storedFilesEdit[i].name === file) {
            storedFilesEdit.splice(i, 1);
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
</script> --}}
@endpush
