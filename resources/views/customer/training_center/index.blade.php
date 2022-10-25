@extends('customer.training_center.layouts.app')

@section('content')
<div class="customer-training-center-header-container">
    <h1>Weight Loss Plan</h1>
    <p>Thursday Sep 22, 2022</p>
</div>

<div class="customer-training-center-plans-container">
    <a href="{{route('training_center.workout_plan')}}" class="customer-training-center-plan-container">
        <div class="customer-training-center-plan-name-container">
            <iconify-icon icon="fluent-emoji:man-lifting-weights" class="customer-training-center-plan-name-icon"></iconify-icon>
            <div class="customer-training-center-plan-name-text">
                <p>Work Out</p>
                <span>Core + Arms Workout</span>
            </div>
        </div>

        <iconify-icon icon="dashicons:arrow-right-alt2" class="customer-training-plan-icon"></iconify-icon>
    </a>
    <a href="{{route('training_center.meal')}}" class="customer-training-center-plan-container">
        <div class="customer-training-center-plan-name-container">
            <iconify-icon icon="emojione:pot-of-food" class="customer-training-center-plan-name-icon"></iconify-icon>
            <div class="customer-training-center-plan-name-text">
                <p>Add Food</p>
                <span>0 of 2,104cal</span>
            </div>
        </div>

        <iconify-icon icon="dashicons:arrow-right-alt2" class="customer-training-plan-icon"></iconify-icon>
    </a>
    <a href="{{route('training_center.water')}}" class="customer-training-center-plan-container">
        <div class="customer-training-center-plan-name-container">
            <iconify-icon icon="fluent-emoji-flat:glass-of-milk" class="customer-training-center-plan-name-icon"></iconify-icon>
            <div class="customer-training-center-plan-name-text">
                <p>Water Tracker</p>
                <span>0 of 92oz</span>
            </div>
        </div>

        <iconify-icon icon="dashicons:arrow-right-alt2" class="customer-training-plan-icon"></iconify-icon>
    </a>
</div>
@endsection
