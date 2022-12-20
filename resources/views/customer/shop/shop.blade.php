@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-main-search-container">
        <input type="text" placeholder="Search...">
        <iconify-icon icon="akar-icons:search" class="shop-main-search-icon"></iconify-icon>
    </div>

    <div  class="shop-main-shops-container">
        @forelse ($shops as $shop)
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
        @endforelse
    </div>
</div>

@endsection
