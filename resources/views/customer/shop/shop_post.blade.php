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
    {{-- <div class="shop-posts-parent-container">
        @forelse ($user->posts->where('shop_status',1) as $shpost)
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
    </div> --}}
    <div class="shop-posts-parent-container">
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).on('click','.shop-post-header-icon',function(){
                $(this).next().toggle()
            })

    $(document).ready(function() {
        data=@json($posts);
        all_posts(data)
    })

    function all_posts(data){

            posts=data
            auth_user={{auth()->user()->id}}
            let htmlView = '';
            if(posts.length <= 0){
                htmlView+= `No Shop Post found.`;
            }else{
                for(let i=0;i<posts.length;i++){
                    htmlView += `<div class="shop-post-container">
                                <div class="shop-post-header">
                                    <div class="shop-post-name-container">`

                    if(posts[i].profile_image===null){
                        htmlView +=`<img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>`

                    }else{
                        htmlView +=`<img class="nav-profile-img" src="{{asset('storage/post/`+posts[i].profile_image+`')}}"/>`
                    }
                    htmlView +=`<div class="shop-post-name">
                                            <p>`+posts[i].name+`</p>
                                            <span>`+posts[i].date+`</span>
                                        </div>
                                        </div>
                                        <iconify-icon icon="bi:three-dots-vertical" class="shop-post-header-icon"></iconify-icon>
                                        <div class="post-actions-container">
                                        <a style="text-decoration:none" class="post_save" id=`+posts[i].id+`>
                                            <div class="post-action">
                                                <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>`
                    if(posts[i].already_saved==1){
                        htmlView +=`<p class="save">Unsave</p>`
                    }else{
                        htmlView +=`<p class="save">Save</p>`
                    }


                    htmlView +=`</div>
                                        </a>`
                                        if(auth_user==posts[i].user_id){
                                        htmlView +=`<a id="edit_post" data-id="`+posts[i].id+`" data-bs-toggle="modal" >
                                                        <div class="post-action">
                                                            <iconify-icon icon="material-symbols:edit" class="post-action-icon"></iconify-icon>
                                                            <p>Edit</p>
                                                        </div>
                                                    </a>
                                                    <a id="delete_post" data-id="`+posts[i].id+`">
                                                        <div class="post-action">
                                                        <iconify-icon icon="material-symbols:delete-forever-outline-rounded" class="post-action-icon"></iconify-icon>
                                                        <p>Delete</p>
                                                        </div>
                                                    </a>`
                                        }else{
                                            htmlView +=``
                                        }
                                        htmlView += `</div>
                                                    </div>
                                                    <div class="shop-content-container">
                                                    `
                                        if(posts[i].media===null){
                                            htmlView +=`<p>`+posts[i].caption+`</p>`
                                        }else{

                                        var caption =posts[i].caption ? posts[i].caption : '';
                                            htmlView +=`<p>`+caption+`</p>
                                                            <div class="shop-media-container">
                                                                `
                                        var imageFile = posts[i].media
                                        var imageArr = jQuery.parseJSON(imageFile);

                                        $.each(imageArr,function(key,val){
                                            var extension = val.substr( (val.lastIndexOf('.') +1) );

                                            switch(extension) {
                                                    case 'jpg':
                                                    case 'png':
                                                    case 'gif':
                                                    case 'jpeg':
                                                    htmlView += ` <div class="shop-media">
                                                            <img src="{{asset('storage/post/`+val+`') }}">
                                                            </div>`
                                                    break;
                                                    case 'mp4':
                                                    htmlView += ` <div class="shop-media">
                                                            <video controls>
                                                            <source src="{{asset('storage/post/`+val+`') }}">
                                                            </video>
                                                            </div>`
                                                    break;

                                                }
                                        });
                                            htmlView +=  `
                                                        </div>
                                                        <div id="slider-wrapper" class="shop-media-slider">
                                                            <iconify-icon icon="akar-icons:cross" class="slider-close-icon"></iconify-icon>

                                                            <div id="image-slider" class="image-slider">
                                                                <ul class="ul-image-slider">`
                                        $.each(imageArr,function(k,v){
                                            var exten = v.substr( (v.lastIndexOf('.') +1) );
                                            switch(exten) {
                                                    case 'jpg':
                                                    case 'png':
                                                    case 'gif':
                                                    case 'jpeg':
                                                    htmlView += `<li>
                                                            <img src="{{asset('storage/post/`+v+`') }}" alt="" />
                                                        </li>`
                                                    break;
                                                    case 'mp4':
                                                    htmlView += `<li><video controls>
                                                                <source src="{{asset('storage/post/`+v+`') }}">
                                                                </video> </li>`
                                                    break;
                                                        }

                                        });
                                            htmlView += `</ul>
                                                            </div>
                                                            <div id="thumbnail" class="img-slider-thumbnails">
                                                                <ul>`
                                        $.each(imageArr,function(k,v){
                                            var exten = v.substr( (v.lastIndexOf('.') +1) );
                                            switch(exten) {
                                                    case 'jpg':
                                                    case 'png':
                                                    case 'gif':
                                                    case 'jpeg':
                                                    htmlView += `<li>
                                                            <img src="{{asset('storage/post/`+v+`') }}" alt="" />
                                                        </li>`
                                                    break;
                                                    case 'mp4':
                                                    htmlView += `<li><video controls>
                                                                <source src="{{asset('storage/post/`+v+`') }}">
                                                                </video> </li>`
                                                    break;
                                                        }
                                        });

                                            htmlView += `</ul></div></div></div>`
                                        }
                                        htmlView += ` <div class="shop-post-footer-container">
                                                        <div class="shop-post-like-container">
                                                        <a class="like" id="`+posts[i].post_id+`">`
                                        if(posts[i].isLike==0){
                                            htmlView+=`
                                            <iconify-icon icon="mdi:cards-heart-outline" class="like-icon"></iconify-icon>`

                                        }else{
                                            htmlView+=`
                                            <iconify-icon icon="mdi:cards-heart" style="color: red;" class="like-icon already-liked"></iconify-icon>`
                                        }
                                            htmlView +=`</a>
                                                        <p>
                                                            <span class="total_likes">
                                                                `+posts[i].total_likes+`
                                                            </span>
                                                            <a class="viewlikes" id="">Likes</a>
                                                        </p>
                                                        </div>
                                                        <div class="shop-post-comment-container">
                                                            <a class="viewcomments" id = "`+posts[i].post_id+`">
                                                                <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                                                                <p id="`+posts[i].post_id+`"><span>`+posts[i].total_comments+`</span> Comments</p>
                                                            </a>
                                                        </div>
                                                        </div>
                                                            `
                                        htmlView+=`</div>
                                                    </div>`

                }
            }
            $('#slider-wrapper').hide()
            $('.shop-posts-parent-container').html(htmlView);

        }
</script>

@endpush
