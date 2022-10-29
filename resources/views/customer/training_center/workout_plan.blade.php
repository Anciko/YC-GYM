@extends('customer.training_center.layouts.app')

@section('content')

<a class="back-btn margin-top" href="{{route('training_center.index')}}">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>
<div class="customer-workout-plan-place-container">
    <p class="customer-workout-plan-place-btn customer-workout-plan-home-btn" >
        Home
    </p>
    <p class="customer-workout-plan-place-btn customer-workout-plan-gym-btn">
        Gym
    </p>
</div>
<div class="customer-workout-plan-home">
    <div class="customer-workout-plan-header-container">
        <h1>Get Lean At Home</h1>
        <div class="customer-workout-plan-header-details-container">


            <div class="customer-workout-plan-header-detail-container">
                <iconify-icon icon="fluent-emoji-flat:fire" class="customer-workout-plan-detail-icon"></iconify-icon>
                <p>Calories : <span>{{$c_sum_home}}</span></p>
            </div>
            <div class="customer-workout-plan-header-detail-container">
                <iconify-icon icon="noto:alarm-clock" class="customer-workout-plan-detail-icon"></iconify-icon>
                <p>Minutes :
                    @if ($time_sum_home < 60)
                    <span>0:{{$sec_home}}</span>
                    @elseif ($time_sum_home >= 60)
                    <span>{{$duration_home}}:{{$sec}}</span>
                    @endif
                </p>
            </div>
        </div>

        <a href="{{url('customer/training_center/workout/home')}}" class="customer-primary-btn customer-workout-letsgo-btn">
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
                @forelse ($tc_home_workoutplans as $workout)
                    <div class="customer-workout-plan-workout-container">
                        <div class="customer-workout-plan-video-container">
                            <video>
                                <source src="{{asset('/storage/upload/'.$workout->video)}}" type="video/mp4">
                            </video>
                        </div>

                        <div class="customer-workout-plan-name">
                            <p>{{$workout->workout_name}}</p>
                            <?php
                            if ($workout->time < 60) {
                                $sec=$workout->time;
                            }else {
                                $duration=floor($workout->time/60);
                                $sec=$workout->time%60;
                            }
                            ?>
                            @if ($workout->time < 60)
                            <span>0:{{$sec}}</span>
                            @else
                            <span>{{$duration}}:{{$sec}}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-secondary p-1">No Video Found</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="customer-workout-plan-gym">
    <div class="customer-workout-plan-header-container">
        <h1>Get Lean At Gym</h1>
        <div class="customer-workout-plan-header-details-container">


            <div class="customer-workout-plan-header-detail-container">
                <iconify-icon icon="fluent-emoji-flat:fire" class="customer-workout-plan-detail-icon"></iconify-icon>
                <p>Calories : <span>{{$c_sum}}</span></p>
            </div>
            <div class="customer-workout-plan-header-detail-container">
                <iconify-icon icon="noto:alarm-clock" class="customer-workout-plan-detail-icon"></iconify-icon>
                <p>Minutes :
                    @if ($time_sum < 60)
                    <span>0:{{$sec}}</span>
                    @elseif ($time_sum >= 60)
                    <span>{{$duration}}:{{$sec}}</span>
                    @endif
                </p>
            </div>
        </div>

        <a href="{{route('training_center.workout.gym')}}" class="customer-primary-btn customer-workout-letsgo-btn">
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
                @forelse ($tc_gym_workoutplans as $workout)
                <div class="customer-workout-plan-workout-container">
                    <div class="customer-workout-plan-video-container">
                        <video>
                            <source src="{{asset('/storage/upload/'.$workout->video)}}" type="video/mp4">
                        </video>
                    </div>

                    <div class="customer-workout-plan-name">
                        <p>{{$workout->workout_name}}</p>
                        <?php
                            if ($workout->time < 60) {
                                $sec=$workout->time;
                            }else {
                                $duration=floor($workout->time/60);
                                $sec=$workout->time%60;
                            }
                        ?>
                        @if ($workout->time < 60)
                        <span>0:{{$sec}}</span>
                        @else
                        <span>{{$duration}}:{{$sec}}</span>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-secondary p-1">No Video Found</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(".customer-workout-plan-home").show()
    $(".customer-workout-plan-gym").hide()

    $(".customer-workout-plan-home-btn").click(function(){
        $(".customer-workout-plan-home").show()
        $(".customer-workout-plan-gym").hide()
    })

    $(".customer-workout-plan-gym-btn").click(function(){
        $(".customer-workout-plan-gym").show()
        $(".customer-workout-plan-home").hide()
    })

</script>
@endpush
