@extends('customer.training_center.layouts.app')

@section('content')

    <a class="back-btn margin-top">
        <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
    </a>

   <div class="customer-workout-completed-container">
    <div class="customer-workout-completed-header">
        <h1>Completed</h1>
        <span>You Rock!</span>
    </div>

    <div class="customer-workout-completed-details-container">
        <div class="customer-workout-completed-detail">
            <h1>{{$total_calories}}</h1>
            <span>Calories</span>
        </div>
        <div class="customer-workout-completed-detail">
            <h1>{{$total_time}}</h1>
            <span>Minutes</span>
        </div>
        <div class="customer-workout-completed-detail">
            <h1>{{$total_video}}</h1>
            <span>Exercises</span>
        </div>
    </div>

    <button class="customer-primary-btn customer-workout-completed-save-btn">Save And Continue</button>
   </div>

@endsection
