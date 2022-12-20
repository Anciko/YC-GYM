@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-main-search-container">
        <input type="text" placeholder="Search...">
        <iconify-icon icon="akar-icons:search" class="shop-main-search-icon"></iconify-icon>
    </div>

    <div  class="shop-main-shops-container">
        <a  href = "#" class="shop-main-shop-container">
            <div class="shop-main-shop-details-container">
                <img src="https://www.hussle.com/blog/wp-content/uploads/2020/12/Gym-structure-1080x675.png">
                <div class="shop-main-shop-name">
                    <p>User Name's Shop</p>
                    <span>posted 10 mins ago</span>
                </div>
            </div>
            <div class="shop-noofposts-container">
                <p>Number of posts</p>
                <span>10</span>
            </div>

            <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" class="shop-main-shop-icon"></iconify-icon>
        </a>
        <a  href = "#" class="shop-main-shop-container">
            <div class="shop-main-shop-details-container">
                <img src="https://www.hussle.com/blog/wp-content/uploads/2020/12/Gym-structure-1080x675.png">
                <div class="shop-main-shop-name">
                    <p>User Name's Shop</p>
                    <span>posted 10 mins ago</span>
                </div>
            </div>
            <div class="shop-noofposts-container">
                <p>Number of posts</p>
                <span>10</span>
            </div>

            <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" class="shop-main-shop-icon"></iconify-icon>
        </a>
    </div>
</div>

@endsection
