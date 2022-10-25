@extends('customer.training_center.layouts.app')

@section('content')
<a class="back-btn margin-top" href="{{ url()->previous() }}">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>

<div class="customer-workout-plan-header-container">
    <h1>Get Lean At Home</h1>
    <div class="customer-workout-plan-header-details-container">


        <div class="customer-workout-plan-header-detail-container">
            <iconify-icon icon="fluent-emoji-flat:fire" class="customer-workout-plan-detail-icon"></iconify-icon>
            <p>Calories : <span>50</span></p>
        </div>
        <div class="customer-workout-plan-header-detail-container">
            <iconify-icon icon="noto:alarm-clock" class="customer-workout-plan-detail-icon"></iconify-icon>
            <p>Minutes : <span>15</span></p>
        </div>
    </div>

    <div class="customer-workout-video-parent-container">
        <div class="customer-workout-video" >
            <video id="workoutVideo" controls>
                <!-- <source src="../imgs/Y2Mate.is - 8 Best Bicep Exercises at Gym for Bigger Arms-3pm_L-H3Th4-720p-1655925997409.mp4" type="video/mp4"> -->
            </video>
        </div>

        <div class="customer-workout-video-progress">
            <!-- <div class="completed-workout"></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div> -->
        </div>

        <button style="display: none;" class="customer-workout-pause-btn">
            <iconify-icon icon="ant-design:pause-circle-outlined" class="customer-workout-pause-icon"></iconify-icon>

        </button>
        <button  class="customer-workout-play-btn">
            <iconify-icon icon="akar-icons:play" class="customer-workout-play-icon"></iconify-icon>
        </button>


        <h1 class="customer-workout-name"></h1>

        <p class="customer-workout-counter">
            <span class="customer-workout-min">00 :</span>
            <span class="customer-workout-sec">00</span></p>
    </div>
</div>
@endsection
