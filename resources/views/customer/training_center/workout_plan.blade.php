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

    <a href="{{route('training_center.workout')}}" class="customer-primary-btn customer-workout-letsgo-btn">
        Let's Go
    </a>

</div>
<div class="customer-workout-plan-details-parent-container">
    <div class="customer-workout-plan-details-equipment-container">
        <h1>Equipment</h1>
        <div class="customer-workout-plan-equipments-container">
            <div class="customer-workout-plan-equipment-container">
                <img src="../icons/icons8-yoga-mat-96.png">
                <p>yoga mat</p>
            </div>
            <div class="customer-workout-plan-equipment-container">
                <img src="../icons/icons8-bench-press-96.png">
                <p>Bench Press</p>
            </div>
            <div class="customer-workout-plan-equipment-container">
                <img src="../icons/icons8-dumbbell-64.png">
                <p>Dumbbells</p>
            </div>
        </div>
    </div>

    <div class="customer-workout-plan-details-workouts-container">
        <h1>Workouts</h1>
        <div class="customer-workout-plan-workouts-container">
            @forelse ($tc_workouts as $workout)
                <div class="customer-workout-plan-workout-container">
                    <div class="customer-workout-plan-video-container">
                        <video controls>
                            <source src="{{asset('/storage/upload/'.$workout->video)}}" type="video/mp4">
                        </video>
                    </div>

                    <div class="customer-workout-plan-name">
                        <p>{{$workout->workout_name}}</p>
                        <span>{{$workout->time}}</span>
                    </div>
                </div>
                @empty
                <p class="text-secondary p-1">No Video Found</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
