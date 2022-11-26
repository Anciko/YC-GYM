@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="social-media-right-container ">
    <h3 style = "text-align: center"><b>{{$user->name}}'s</b> Friends </h3>
    <div class="social-media-fris-search">
         <input type="text" placeholder="Search your friends" id = "search">
         <iconify-icon icon="akar-icons:search" class="search-icon"></iconify-icon>
    </div>

    <div class="social-media-fris-list-container">


    </div>
 </div>

@endsection
@push('scripts')
<script>
        $(document).ready(function() {
            $('#search').on('keyup', function(){
                            search();
                        });
                        search();
                        function search(){
                            var keyword = $('#search').val();
                            // console.log(keyword);
                            var user_id = {{$user->id}};
                            console.log();
                            var search_url = "{{ route('friend_search',':id') }}";
                            search_url = search_url.replace(':id', user_id);
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
                            console.log(res.friends.data)
                        let htmlView = '';
                            if(res.friends.data.length <= 0){
                                htmlView+= `
                                No data found.
                                `;
                            }
                            for(let i = 0; i < res.friends.data.length; i++){
                                id = res.friends.data[i].id;

                                htmlView += `
                                    <div class="social-media-fris-fri-row">
                                        <div class="social-media-fris-fri-img">
                                            <img src="../imgs/trainer2.jpg">
                                            <p>`+res.friends.data[i].name+`</p>
                                        </div>

                                        <div class="social-media-fris-fri-btns-container">
                                            <a href="#" class="customer-primary-btn">Message</a>
                                            <button class="customer-red-btn">Remove</button>
                                        </div>
                                    </div>
                                    `
                            }
                            $('.social-media-fris-list-container').html(htmlView);
                        }




        })
</script>
@endpush
