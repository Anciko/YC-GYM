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
                        <p>{{$post->name}}</p>
                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y , g:i A')}}</span>
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
                <textarea placeholder="Write a comment" id="textarea"></textarea>
                <div id="menu" class="menu" role="listbox"></div>
                <button class="social-media-all-comments-send-btn">
                    <iconify-icon icon="akar-icons:send" class="social-media-all-comments-send-icon"></iconify-icon>
                </button>

            </form>

            <div class="social-media-all-comments">
                @forelse ($comments as $comment)
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

                        <p>{{$comment->comment}}</p>
                    </div>
                </div>
                @empty
                    <p class="text-secondary p-1">No comment</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // $('#textarea').mentiony({
        //             onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {

        //                 // var data = [
        //                 //     { id:1, name:'Nguyen Luat', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:2, name:'Dinh Luat', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:3, name:'Max Luat', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:4, name:'John Neo', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:5, name:'John Dinh', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:6, name:'Test User', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:7, name:'Test User 2', 'avatar':'https://goo.gl/WXAP1U'},
        //                 //     { id:8, name:'No Test', 'avatar':'https://goo.gl/WXAP1U'},
        //                 // ];
        //                 var data = []
        //                 var search_url = "{{ route('users.mention') }}";
        //                     $.post(search_url,
        //                     {
        //                         _token: $('meta[name="csrf-token"]').attr('content'),
        //                         keyword:keyword
        //                     },
        //                     function(response){
        //                         var data = response.data;
        //                         console.log(data)
        //                         data = jQuery.grep(data, function( item ) {
        //                     return item.name.toLowerCase().indexOf(keyword.toLowerCase()) > -1;
        //                     });
        //                     });

        //                 // Call this to populate mention.
        //                 onDataRequestCompleteCallback.call(this, data);
        //             },
        //             timeOut: 0,
        //             debug: 1,
        //         });

                $('#textarea').mentiony({
                onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {
                    var search_url = "{{ route('users.mention') }}";
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        method: "POST",
                        url:search_url,
                        data : keyword,
                        dataType: "json",
                        success: function (response) {
                            var data = response.data;
                            console.log(data)

                            // NOTE: Assuming this filter process was done on server-side
                            data = jQuery.grep(data, function( item ) {
                                return item.name.toLowerCase().indexOf(keyword.toLowerCase()) > -1;
                            });
                            // End server-side

                            // Call this to populate mention.
                            onDataRequestCompleteCallback.call(this, data);
                        }
                    });

                },
                timeOut: 500, // Timeout to show mention after press @
                debug: 1, // show debug info
            });

            $(".mentiony-container").attr('style','')
            $(".mentiony-content").attr('style','')


            $(".social-media-all-comments-input").on('submit',function(e){
                e.preventDefault()
                console.log($('.mentiony-content').text())
                var comment = $('.mentiony-content').text()

                var arr = []
                $.each($('.mentiony-link'),function(){
                    arr.push($(this).data('item-id'))
                })
                console.log(arr)

                var search_url = "{{ route('post.comment.store') }}";
                var post_id = "{{$post->id}}"
                console.log(post_id)
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    $.ajax({
                        method: "POST",
                        url:search_url,
                        data : {'post_id':post_id,'mention' : arr , 'comment' : comment},
                        dataType: "json",
                        success: function (response) {
                            console.log("comment")
                            window.location.reload();
                        }
                    });

            })

            $('.mentiony-content').on('keydown', function(event) {
                console.log(event.which)
                if (event.which == 8 || event.which == 46) {
                    s = window.getSelection();
                    r = s.getRangeAt(0)
                    el = r.startContainer.parentElement

                    console.log(el.classList.contains('mentiony-link') || el.classList.contains('mention-area') || el.classList.contains('highlight'))
                    console.log(el)
                    if (el.classList.contains('mentiony-link') || el.classList.contains('mention-area') || el.classList.contains('highlight')) {
                        console.log('delete mention')


                                el.remove();

                            return;

                    }
                }
                event.target.querySelectorAll('delete-highlight').forEach(function(el) { el.classList.remove('delete-highlight');})
            });
    })
</script>


@endpush
