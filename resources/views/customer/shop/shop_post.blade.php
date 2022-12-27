@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rate this shop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <fieldset>
                  <span class="star-cb-group">
                    <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>
                    <input type="radio" id="rating-4" name="rating" value="4"  /><label for="rating-4">4</label>
                    <input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>
                    <input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>
                    <input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>
                    <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
                  </span>
                </fieldset>
                <button type="button" class="rating-submit-btn">Rate</button>
            </form>

        </div>
      </div>
    </div>
  </div>

<div class="shop-right-container">
    <div class="shop-posts-header-container">
        <p>{{$user->name}}'s Shop</p>
        <button type="button" class="shop-rating-btn" data-bs-toggle="modal" data-bs-target="#ratingModal">
            Rate
          </button>
        <div class="shop-search-container">
            <input type="text" placeholder="Search..." id  = "caption_search">
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
    //rating start
    $('input[name="rating"]').change(function () {
        var me = $(this);
        // log.html(me.attr('value'));
        console.log(me.attr('value'))
    });
    //rating end
    $(document).on('click','.shop-post-header-icon',function(){
                $(this).next().toggle()
            })

    $(document).ready(function() {
        // data=@json($posts);
        // all_posts(data)

        $('#caption_search').on('keyup', function() {
                search();
            });
            search();

            function search() {
                var keyword = $('#caption_search').val();
                var post_id = {{$user->id}};
                var search_url = "{{route('all.shop.post.id') }}";
                $.post(search_url, {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        keyword: keyword,
                        post_id:post_id
                    },
                    function(data) {
                        all_posts(data.posts);
                        console.log(data.posts,"data");
                    });
            }

            function all_posts(data){
                posts=data
                auth_user={{auth()->user()->id}}


                let htmlView = '';
                if(posts.length <= 0){
                    htmlView+= `No Shop Post found.`;
                }else{
                    for(let i=0;i<posts.length;i++){
                        post_id = posts[i].id;
                        var comment_url = "{{ route('post.comment', [':id']) }}";
                            comment_url = comment_url.replace(':id', post_id);
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
                                                                <div class="shop-media-container" data-id="`+posts[i].id+`">
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

                                                            <div class="social-media-post-comment-container">
                                                                <a href = `+comment_url+`>
                                                                <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                                                                <p><span>`+posts[i].total_comments+`</span> Comments</p>
                                                                </a>
                                                            </div>
                                                            <div class="social-media-post-comment-container">
                                                                <iconify-icon icon="ic:outline-remove-red-eye" class="comment-icon"></iconify-icon>
                                                                <p><span>`+posts[i].viewers+`</span> Views</p>
                                                            </div>
                                                            </div>
                                                            </div>
                                                                `
                                            htmlView+=`</div>
                                                        </div>`

                    }
                }

                $('.shop-posts-parent-container').html(htmlView)
                $('.shop-media-slider').hide()


                $.each($(".ul-image-slider"),function(){
                console.log($(this).children('li').length)

                $(this).children('li:first').addClass("active-img")
            })

            $.each($(".img-slider-thumbnails ul"),function(){
                console.log($(this).children('li').length)

                $(this).children('li:first').addClass("active")
            })

            $(document).on('click','.img-slider-thumbnails li',function(){
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

            $(document).on('click','.shop-media-container',function(){
                $(this).siblings(".shop-media-slider").show()
                $(this).hide()
                var post_id=$(this).data('id');
                var add_url = "{{ route('user.view.post') }}";
                $.ajax({
                        method: "GET",
                        url: add_url,
                        data:{ post_id : post_id}
                    })
            })

            $(document).on('click','.slider-close-icon',function(){
                $(this).closest('.shop-media-slider').hide()
                $(this).closest('.shop-media-slider').siblings('.shop-media-container').show()
            })

}

    })

</script>

@endpush
