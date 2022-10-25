@extends('customer.training_center.layouts.app')

@section('content')

<a class="back-btn margin-top" href="{{ url()->previous() }}">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>

<div class="card-chart">
    <div class="card-donut card-goalchart" data-size="300" data-thickness="18"></div>
    <div class="card-center">
      <span class="card-value">0</span>
      <div class="card-label">of 92 oz</div>
    </div>

</div>

<div class="customer-water-track-details-container">
    <div class="customer-water-track-intake-container">
        <span>Total Water Intake</span>
        <p>5 oz</p>
    </div>
    <div class="customer-water-track-days-container">
        <span>Days that reached goal</span>
        <p>0</p>
    </div>
</div>

<button class="customer-primary-btn customer-water-track-btn">Drink 5 oz</button>

@endsection
