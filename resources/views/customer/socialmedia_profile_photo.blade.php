@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')

<div class="social-media-right-container">
    <div class="social-media-photos-tabs-container">
        <p class="social-media-photos-tab social-media-profiles-tab">Profile Photos</p>
        <p class="social-media-photos-tab social-media-covers-tab">Cover Photos</p>
    </div>

    <div class="social-media-photos-container social-media-profiles-container">
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/pexels-andrea-piacquadio-3768916 (1).jpg">
        </div>
    </div>

    <div class="social-media-photos-container social-media-covers-container">

        <div class="social-media-photo">
            <img src="../imgs/trainer1.jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/trainer1.jpg">
        </div>
        <div class="social-media-photo">
            <img src="../imgs/trainer1.jpg">
        </div>

    </div>
</div>
@endsection
@push('scripts')

<script>
    console.log("sdfsdfdf")
    $(document).ready(function() {
        $('.social-media-post-header-icon').click(function(){
            $(this).next().toggle()
        })

        $(".social-media-profiles-tab").addClass("social-media-photos-tab-active")

        $(".social-media-covers-container").hide()

        $(".social-media-profiles-tab").click(function(){
            console.log("sdfsadfsdf")
            $(".social-media-covers-container").hide()
            $(".social-media-profiles-container").show()

            $(".social-media-profiles-tab").addClass("social-media-photos-tab-active")
            $(".social-media-covers-tab").removeClass("social-media-photos-tab-active")

        })

        $(".social-media-covers-tab").click(function(){
            $(".social-media-covers-container").show()
            $(".social-media-profiles-container").hide()

            $(".social-media-profiles-tab").removeClass("social-media-photos-tab-active")
            $(".social-media-covers-tab").addClass("social-media-photos-tab-active")

        })
    })
</script>

@endpush
