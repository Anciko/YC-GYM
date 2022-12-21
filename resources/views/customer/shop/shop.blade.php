@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-main-search-container">
        <input type="text" placeholder="Search..." id = "shop_search">
        <iconify-icon icon="akar-icons:search" class="shop-main-search-icon"></iconify-icon>
    </div>

    <div  class="shop-main-shops-container">
        {{-- @forelse ($shops as $shop)
            <a  href = {{route('shoppost',$shop->id)}} class="shop-main-shop-container">
                <div class="shop-main-shop-details-container">
                    <img src="https://www.hussle.com/blog/wp-content/uploads/2020/12/Gym-structure-1080x675.png">
                    <div class="shop-main-shop-name">
                        <p>{{$shop->name}}'s Shop</p>
                    </div>
                </div>
                <div class="shop-noofposts-container">
                    <p>Number of posts</p>
                    <span>10</span>
                </div>

                <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" class="shop-main-shop-icon"></iconify-icon>
            </a>
        @empty
        <p class="text-secondary p-1">No Shop Post</p>
        @endforelse --}}
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $(document).ready(function () {
          $('#shop_search').on('keyup', function(){
              shop_search();
          });

          shop_search();
          function shop_search(){
              var keyword = $('#shop_search').val();
              var search_url = "{{ route('shop.list') }}";
              $.post(search_url,
              {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  keyword:keyword
              },
              function(data){
                  table_post_row_shop(data);
                  console.log(data, "data");
              });
          }
          // table row with ajax
          function table_post_row_shop(res){
          let htmlView = '';
              if(res.data.length <= 0){
                  htmlView+= `
                  No data found.
                  `;
              }
              for(let i = 0; i < res.data.length; i++){
                  id = res.data[i].id;
                  var url = "{{ route('shoppost',[':id']) }}";
                  url = url.replace(':id', id);
                  htmlView += `
                      <a  href = `+url+` class="shop-main-shop-container">
                          <div class="shop-main-shop-details-container">
                              <img src="https://www.hussle.com/blog/wp-content/uploads/2020/12/Gym-structure-1080x675.png">
                              <div class="shop-main-shop-name">
                                  <p>`+res.data[i].name+`'s Shop</p>
                              </div>
                          </div>
                          <div class="shop-noofposts-container">
                              <p>Number of posts</p>
                              <span>`+res.data[i].total_post+`</span>
                          </div>
                          <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" class="shop-main-shop-icon"></iconify-icon>
                      </a>
                      `
              }
              $('.shop-main-shops-container').html(htmlView);
          }
      });
</script>
