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
     <div class="social-media-fris-fri-row">
         <div class="social-media-fris-fri-img">
             <img src="../imgs/trainer2.jpg">
             <p>Friend Name</p>
         </div>

         <div class="social-media-fris-fri-btns-container">
             <a href="#" class="customer-primary-btn">Message</a>
             <button class="customer-red-btn">Remove</button>
         </div>
     </div>

    </div>
 </div>

@endsection
@push('scripts')
<script>
        $(document).ready(function() {
            
        })
</script>
@endpush
