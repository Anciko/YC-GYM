@extends('customer.training_center.layouts.app')

@section('content')

<a class="back-btn margin-top" href="{{ url()->previous() }}">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>

{{-- <div class="card-chart">
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

<button class="customer-primary-btn customer-water-track-btn">Drink 5 oz</button> --}}
<div class="customer-water-tracker-container">
    <div class="customer-water-tracker-total-container">
        <h1>0</h1>
        <p>of 3000 ml</p>
    </div>

    <div class="glass">
        <span class="top"></span>
        <span class="left"></span>
        <span class="right"></span>
        <span class="bottom"></span>
        <span class="water"></span>
        <span class="handle"></span>
    </div>

    <div class="customer-water-track-text-container">
        <p>You didn't drink water today</p>
        <h1>Let's drink</h1>
    </div>

    <button class="customer-water-add-btn">
        {{-- <iconify-icon icon="akar-icons:plus" class="customer-water-add-icon"></iconify-icon> --}}
        +
    </button>

    <div class="customer-water-add-text">
        <p>250ml</p>
        <span>(1000ml = 1 litre)</span>
    </div>
</div>

<script>
    $(document).ready(function(){
        var total = 3000
            var taken = 0
        $(".customer-water-add-btn").click(function(){
            // console.log("water add")

            taken = taken + 250
            var fill = (taken / total) * 100
            console.log(fill)

            if(fill > 100){
                alert("cant drink anymore")
                return
            }
            $('.water').animate({height:`${fill}%`}, 300)

        })
    })
</script>

@endsection
