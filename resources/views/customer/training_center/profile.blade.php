@extends('customer.training_center.layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="customer-profile-parent-container">
    <div class="customer-cover-photo-container">
        <img class="customer-cover-photo" src="{{asset('storage/post/'.$user_profile_cover->cover_photo)}}">
        {{-- <h1>{{auth()->user()->profiles->id}}</h1> --}}
        {{-- src="{{asset('storage/post/',auth()->user()->profiles->profile_image)}}" --}}
        <div class="customer-cover-change-btns-container">
            <form method="POST" action="{{route('customer-profile-cover.update')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <button type="submit" class="customer-primary-btn">Confirm</button>

            <button type="button" class="customer-secondary-btn customer-cover-change-cancel-btn">Cancel</button>
        </div>
            <label class="customer-cover-img-change-btn">
                <input type="file" class="customer-cover-img-change-input" name="cover">
                <iconify-icon icon="cil:pen" class="customer-cover-img-change-icon"></iconify-icon>
            </label>
            </form>
        <div class="personal_detail customer-personal-details-form">
            <div class="customer-profile-img-name-container">
                <form method="POST" action="{{route('customer-profile-img.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="customer-profile-img-container">
                        @if($user_profile_image->profile_image==null)
                            <img class="customer-profile-img" src="{{asset('img/user.jpg')}}">
                        @else
                        <img class="customer-profile-img" src="{{asset('storage/post/'.$user_profile_image->profile_image)}}">
                        @endif
                        <label class="customer-profile-img-change-btn">
                            <input type="file" name="profile_image" class="customer-profile-img-change-input">
                            <iconify-icon icon="cil:pen" class="customer-profile-img-change-icon"></iconify-icon>
                        </label>
                    </div>
                    <div class="customer-profile-change-btns-container">
                        <button type="submit" class="customer-primary-btn">Confirm</button>
                        <button type="button" class="customer-secondary-btn customer-profile-change-cancel-btn">Cancel</button>
                    </div>
                </form>
                <form class="personal_detail customer-personal-details-form" method="POST" action="{{route('customer-profile-name.update')}}">
                    @csrf
                    @method('POST')
                <div class="customer-profile-name-container">
                    <p id="name">{{auth()->user()->name}}</p>
                    <input type="text" value="{{auth()->user()->name}}" class="name" name="name">

                    <span>(User ID: {{auth()->user()->member_code}})</span>
                    <iconify-icon icon="cil:pen" class="change-name-icon" id="name_edit_pen"></iconify-icon>
                </div>

                <div class="customer-change-name-btns-container">
                    <button type="submit" class="customer-primary-btn customer-name-calculate-btn">Save</button>
                    <button type="button" class="customer-secondary-btn customer-name-calculate-btn" id="customer_name_cancel">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <form class="customer-bio-form">
        <div class="customer-bio-text">
            <p>Here’s a bio to describe you. Here’s a bio to describe you. Here’s a bio to describe you. Here’s a bio to describe you</p>
            <input type="text" >
            <iconify-icon icon="cil:pen" class="customer-bio-change-icon"></iconify-icon>
        </div>
        <div class="customer-bio-btns-container">
            <button type="button" class="customer-primary-btn">Confirm</button>
            <button type="button" class="customer-secondary-btn customer-bio-change-cancel-btn">Cancel</button>
        </div>
    </form>

    <div class="customer-profile-tabs-container">
        <div class="customer-profile-training-center-tab">
            <iconify-icon icon="fa-solid:dumbbell" class="customer-profile-tab-icon"></iconify-icon>
            <p>Training Center</p>
        </div>
        <div class="customer-profile-socialmedia-tab">
            <iconify-icon icon="bi:chat-heart" class="customer-profile-tab-icon"></iconify-icon>
            <p>Social Media</p>
        </div>
        <div class="customer-profile-shop-tab">
            <iconify-icon icon="lucide:shopping-cart" class="customer-profile-tab-icon"></iconify-icon>
            <p>Shop</p>
        </div>
    </div>
    <div class="customer-profile-training-center-container">
        @if(count(auth()->user()->roles)==0)
        {{-- <div class="customer-profile-personaldetails-parent-container"> --}}
        <p class="customer-notraining-message">
            You don't have training center information.Please fill information
            <a href="{{route('customer-personal_infos')}}">Training Center</a>
        </p>
        {{-- </div> --}}
        @endif
        @hasanyrole('Platinum|Diamond|Gym Member|Gold|Ruby|Ruby Premium')
        <form class="personal_detail" method="POST" action="{{route('customer-profile.update')}}">
                @csrf
                @method('POST')
            <div class="customer-profile-personaldetails-parent-container">
                <h1>Your Profile</h1>
                <div style="float:right;padding-right:40px">
                    <iconify-icon icon="cil:pen" class="change-name-icon" id="pen1"></iconify-icon>
                </div>

                <div class="customer-profile-personaldetails-grid">
                    <div class="customer-profile-personaldetails-left">
                        <div class="customer-profile-personaldetail-container">
                            <p>Age:</p>
                            <div>
                                <input type="number" value="{{auth()->user()->age}}" readonly="readonly" class="age" name="age">
                                <span style = "visibility: hidden;">in</span>
                            </div>
                        </div>
                        <?php
                            $height=auth()->user()->height;
                            $height_ft=floor($height/12);
                            $height_in=$height%12;
                            ?>
                        <div class="customer-profile-personaldetail-container customer-profile-personaldetail-height-container">
                            <p>Height:</p>
                            <select name="height_ft" class="height_ft">
                                <option value="3" {{"3" == $height_ft ? 'selected' : ''}}>3</option>
                                <option value="4" {{"4" == $height_ft ? 'selected' : ''}}>4</option>
                                <option value="5" {{"5" == $height_ft ? 'selected' : ''}}>5</option>
                                <option value="6" {{"6" == $height_ft ? 'selected' : ''}}>6</option>
                            </select>
                            <span>ft</span>
                            <select name="height_in" class="height_in">
                                <option value="0" {{"0" == $height_in ? 'selected' : ''}}>0</option>
                                <option value="1" {{"1" == $height_in ? 'selected' : ''}}>1</option>
                                <option value="2" {{"2" == $height_in ? 'selected' : ''}}>2</option>
                                <option value="3" {{"3" == $height_in ? 'selected' : ''}}>3</option>
                                <option value="4" {{"4" == $height_in ? 'selected' : ''}}>4</option>
                                <option value="5" {{"5" == $height_in ? 'selected' : ''}}>5</option>
                                <option value="6" {{"6" == $height_in ? 'selected' : ''}}>6</option>
                                <option value="7" {{"7" == $height_in ? 'selected' : ''}}>7</option>
                                <option value="8" {{"8" == $height_in ? 'selected' : ''}}>8</option>
                                <option value="9" {{"9" == $height_in ? 'selected' : ''}}>9</option>
                                <option value="10" {{"10" == $height_in ? 'selected' : ''}}>10</option>
                                <option value="11" {{"11" == $height_in ? 'selected' : ''}}>11</option>
                            </select>
                            <span>in</span>
                        </div>

                        <div class="customer-profile-personaldetail-container">
                            <p>Weight:</p>
                            <div>
                                <input type="number" value="{{auth()->user()->weight}}" class="weight" name="weight" readonly>
                                <span>lb</span>
                            </div>

                        </div>
                        <div class="customer-profile-personaldetail-container">
                            <p>Neck:</p>
                            <div>
                                <input type="number" value="{{auth()->user()->neck}}" class="neck" name="neck" readonly>
                                <span>in</span>
                            </div>
                        </div>
                    </div>
                    <div class="customer-profile-personaldetails-right">
                        <div class="customer-profile-personaldetail-container">
                            <p>Waist:</p>
                            <div>
                                <input type="number" value="{{auth()->user()->waist}}" name="waist" class="waist" readonly>
                                <span>in</span>
                            </div>
                        </div>

                        <div class="customer-profile-personaldetail-container ">
                            <p>Hip:</p>
                            <div>
                                <input type="number"  value="{{auth()->user()->hip}}" name="hip" class="hip" readonly>
                                <span>in</span>
                            </div>
                        </div>

                        <div class="customer-profile-personaldetail-container">
                            <p>Shoulders:</p>
                            <div>
                                <input type="number"  value="{{auth()->user()->shoulders}}" name="shoulders" class="shoulders" readonly>
                                <span>in</span>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="customer-profile-save-cancel-container">
                    <button type="submit" class="customer-primary-btn customer-bmi-calculate-btn">Save and Calculate BMI</button>
                    <button type="button" class="customer-secondary-btn customer-bmi-calculate-btn" id="customer_cancel">Cancel</button>
                </div>


            </div>
        </form>

        <div class="customer-profile-bmi-container">
            <div class="customer-profile-bmi-gradient">
                <div class="percentage-line"></div>
                <div class="percentage-line"></div>
                <div class="percentage-line"></div>
                <div class="customer-profile-bmi-text">
                    <div class="customer-profile-bmi-indicator">
                        <div class="customer-profile-bmi-indicator-line"></div>
                        <div class="customer-profile-bmi-indicator-ball"></div>
                    </div>

                    <?php $bmi=auth()->user()->bmi;
                        if ($bmi <=18.5) {
                            $plan='Weight Gain';
                        }elseif ($bmi>=25) {
                            $plan='Weight Loss';
                        }else {
                            $plan='Body Beauty';
                        }
                    ?>
                    @if ($bmi <=18.5)
                    <p>Your BMI , {{$bmi}} , is underweight.</p>
                    @elseif ($bmi >18.5 && $bmi<=24.9)
                    <p>Your BMI , {{$bmi}} , is normal.</p>
                    @elseif ($bmi >25 && $bmi<=29.9)
                    <p>Your BMI , {{$bmi}} , is overweight.</p>
                    @else
                    <p>Your BMI , {{$bmi}} , is obesity.</p>
                    @endif
                </div>
            </div>
        </div>
        <?php $currentyear=\Carbon\Carbon::now()->format("Y"); ?>
            <select class="weight-chart-filter" onchange="year_filter(this.value)">
                @for ($i = $currentyear; $i >= $year; $i--)
                <option value={{$i}} name="year">{{$i}}</option>
                @endfor
            </select>
        <div class="weight-chart-container" id="weightchart">
            <p>Your Weight History</p>
            <canvas id="myChart"></canvas>
        </div>

        <div class="no-weight-chart" id="weightreview">
            <p style="text-align:center;margin-top:100px;">You don’t have weight history  to review.
                Keep working out.</p>
        </div>
        @endhasanyrole
        @hasanyrole('Platinum|Diamond|Gym Member')
        <div class="customer-profile-trackers-parent-container">
            <div class="customer-profile-trackers-headers-container">
                <div class="customer-profile-tracker-header" id="workout">
                    Workout
                </div>
                <div class="customer-profile-tracker-header" id="meal">
                    Meal
                </div>
                <div class="customer-profile-tracker-header" id="water">
                    Water
                </div>
            </div>

            <div class="customer-profile-tracker-workout-container">

                <div id="my-calendar"></div>

                <form class="customer-profile-days-container customer-profile-workout-days-container">
                    <div class="customer-profile-days-btn" id="workout-today">
                        Today
                    </div>
                    <div class="customer-profile-days-btn" id = "workout-7days">
                        Last 7 Days
                    </div>

                    <div class="customer-profile-fromto-inputs-container">
                        <div class="customer-profile-from">
                            <p>From:</p>
                            <input type="date" id="from_date">
                        </div>
                        <div class="customer-profile-to">
                            <p>To:</p>
                            <input type="date" id="to_date">
                        </div>
                    </div>

                    <button type="button" class="customer-profile-workout-filter-btn">Filter</button>
                </form>

                <div class="customer-profile-workout-list-parent-container">

                </div>

            </div>
            <div class="customer-profile-tracker-meal-container">
                <div class="customer-profile-days-container">
                    <div class="customer-profile-days-btn" id="meal-today">
                        Today
                    </div>
                    <div class="customer-profile-days-btn" id = "meal-7days">
                        Last 7 Days
                    </div>
                </div>
            </div>
            <div class="customer-post-container">
                <div class="customer-post-header">
                    <div class="customer-post-name-container">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <div class="customer-post-name">
                            <p>User Name</p>
                            <span>19 Sep 2022, 11:02 AM</span>
                        </div>

                <div class="customer-7days-filter-meal-container">

                </div>

                <div class="customer-7days-meal-tables-container"></div>


            </div>
            <div class="customer-profile-tracker-water-container">
                <div class="customer-profile-days-container">
                    <div class="customer-profile-days-btn" id="water-today">
                        Today
                    </div>
                    <div class="customer-profile-days-btn" id = "water-7days">
                        Last 7 Days
                    </div>
                </div>

                <div class="customer-7days-filter-water-container">

                </div>

                <div class="customer-profile-water-track-history-container">
                    <div class="card-chart">
                        <div class="card-donut water-chart" data-size="100" data-thickness="8"></div>
                        <div class="card-center">
                        <span class="card-value"></span>
                        <div class="card-label"></div>
                        </div>
                    </div>

                    <div class="customer-profile-water-track-history-text">
                        <p></p>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        @endhasanyrole
    </div>

    <div class="customer-profile-socialmedia-container">
        <div class="customer-profile-social-media-default-container">
            <div class="customer-profile-friends-parent-container">
                <div class="customer-profile-friends-header">
                    <p>1200 Friends</p>
                    <a href="#">
                        See All
                        <iconify-icon icon="bi:arrow-right" class="arrow-icon"></iconify-icon>
                    </a>
                </div>

                <div class="customer-profile-friends-container">
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                    <div class="customer-profile-friend">
                        <img src="{{asset('image/trainer2.jpg')}}">
                        <p>User Name</p>
                    </div>
                </div>

                <p href="#" class="social-media-profile-photos-link">Photos</p>
            </div>

            <div class="customer-profile-posts-parent-container">
                <p>Post & Activities</p>
                <div class="customer-post-container">
                    <div class="customer-post-header">
                        <div class="customer-post-name-container">
                            <img src="{{asset('image/trainer2.jpg')}}">
                            <div class="customer-post-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>
                        </div>

                        <iconify-icon icon="bi:three-dots-vertical" class="customer-post-header-icon"></iconify-icon>

                        <div class="post-actions-container" >
                            <div class="post-action">
                                <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                <p>Save</p>
                            </div>

                            <div class="post-action">
                                <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                                <p>Report</p>
                            </div>
                        </div>
                    </div>

                    <div class="customer-content-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>

                    </div>

                    <div class="customer-post-footer-container">
                        <div class="customer-post-like-container">
                            <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                            <p><span>1.1k</span> Likes</p>
                        </div>
                        <div class="customer-post-comment-container">
                            <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                            <p><span>50</span> Comments</p>
                        </div>
                    </div>
                </div>
                <div class="customer-post-container">
                    <div class="customer-post-header">
                        <div class="customer-post-name-container">
                            <img src="{{asset('image/trainer2.jpg')}}">
                            <div class="customer-post-name">
                                <p>User Name</p>
                                <span>19 Sep 2022, 11:02 AM</span>
                            </div>


                        </div>

                        <iconify-icon icon="bi:three-dots-vertical" class="customer-post-header-icon"></iconify-icon>
                        <div class="post-actions-container">
                            <div class="post-action">
                                <iconify-icon icon="bi:save" class="post-action-icon"></iconify-icon>
                                <p>Save</p>
                            </div>

                            <div class="post-action">
                                <iconify-icon icon="material-symbols:report-outline" class="post-action-icon"></iconify-icon>
                                <p>Report</p>
                            </div>
                        </div>
                    </div>

                    <div class="customer-content-container">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui hendrerit potenti pellentesque tellus urna bibendum mollis.</p>
                        <div class="customer-media-container">
                            <div class="customer-media">
                                <img src="{{asset('image/trainer2.jpg')}}">
                            </div>
                            <div class="customer-media">
                                <img src="{{asset('image/trainer2.jpg')}}">
                            </div>
                            <div class="customer-media">
                                <img src="{{asset('image/trainer2.jpg')}}">
                            </div>
                            <div class="customer-media">
                                <img src="{{asset('image/trainer2.jpg')}}">
                            </div>
                            <div class="customer-media">
                                <img src="{{asset('image/trainer2.jpg')}}">
                            </div>
                        </div>
                    </div>

                    <div class="customer-post-footer-container">
                        <div class="customer-post-like-container">
                            <iconify-icon icon="akar-icons:heart" class="like-icon"></iconify-icon>
                            <p><span>1.1k</span> Likes</p>
                        </div>
                        <div class="customer-post-comment-container">
                            <iconify-icon icon="bi:chat-right" class="comment-icon"></iconify-icon>
                            <p><span>50</span> Comments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="customer-profile-social-media-photoes-container">
            <p class="customer-profile-social-media-photoes-back">
                <iconify-icon icon="material-symbols:arrow-back"></iconify-icon>
                Go Back</p>
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
                <div class="social-media-photo">
                    <img src="../imgs/trainer1.jpg">
                </div>
                <div class="social-media-photo">
                    <img src="../imgs/trainer1.jpg">
                </div>
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

    </div>

    <div class="customer-profile-shop-container">
        <h1>Coming Soon...</h1>
    </div>

</div>

@endsection
@push('scripts')
@hasanyrole('Platinum|Diamond|Gym Member|Gold|Ruby|Ruby Premium')
<script>


            let myChart=null;
            function linechart(data){
            var weight_history=data;
            if(weight_history.length<2){
                $(".weight-chart-filter").show();
                $("#weightreview").show();
                $("#weightchart").hide();
            }else{
                //$("#weightchart").show();
                $(".weight-chart-filter").show();
                $("#weightreview").hide();
                $("#weightchart").show();

                let weight = [];
                let date = [];
                for(let i = 0; i < weight_history.length; i++){

                    weight.push(

                    weight_history[i].weight
                    );

                    date.push(

                    weight_history[i].date

                    );

                    }

                    const labels = date;

                    console.log(weight);
                    const data = {
                        labels: labels,
                        datasets: [{
                        label: 'Weight(lb)',
                        fill: true,

                        borderColor: "#4D72E8",
                        backgroundColor:"rgba(77,114,232,0.3)",

                        data:weight,

                        }]
                    };

                    const config = {
                        type: 'line',
                        data: data,
                        options: {
                            maintainAspectRatio: false,
                        }
                    };

                    // const myChart = new Chart(
                    //     document.getElementById('myChart'),
                    //     config
                    // );
                    var ctx=document.getElementById('myChart').getContext("2d");

                    if(myChart!=null){
                    myChart.destroy();
                    }
                    myChart = new Chart(ctx,
                        config
                    );

            }


    }


    function year_filter(value) {

        console.log(value);
        var url="profile/year/";
        $.ajax({
                    type: "GET",
                    url: url+value,
                    datatype: "json",
                    success: function(data) {
                        var data=data.weight_history;

                        linechart(data);


                    }
        })
    }

    $( document ).ready(function() {
        //destroyChart();
         var data = @json($weight_history);
        // destroyChart();
         linechart(data);
        var bmi=@json($bmi);
        $('.customer-profile-bmi-text').animate({ left: `+=${bmi}%` }, "slow");
        $(".name").hide();
        $('.customer-name-calculate-btn').hide();
        $(".customer-bmi-calculate-btn").hide();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');

        var yyyy = today.getFullYear();
        var d = String(today.getDate());
        const monthNames = ["January", "Febuary", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];
        var m = monthNames[today.getMonth()];

        today =  yyyy+'-'+mm+'-'+dd;
        tdy =  d+' '+m+', '+yyyy;

        $('select.height_ft').attr('disabled', true);
        $('select.height_in').attr('disabled', true);
        //on clicking one of the butttons of last 7 days (water)
        $("#pen1").on('click', function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(".age").removeAttr("readonly");
            $(".weight").removeAttr("readonly");
            $(".neck").removeAttr("readonly");
            $(".waist").removeAttr("readonly");
            $(".hip").removeAttr("readonly");
            $(".shoulders").removeAttr("readonly");
            $(".customer-bmi-calculate-btn").show();
            $('select.height_ft').attr('disabled', false);
            $('select.height_in').attr('disabled', false);
            $('.change-name-icon').hide();
            $('.customer-name-calculate-btn').hide();
            $("#name").show();
            $(".name").hide();
        });

        $("#customer_cancel").on('click', function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(".age").attr('readonly', true);
            $(".weight").attr('readonly', true);
            $(".neck").attr('readonly', true);
            $(".waist").attr('readonly', true);
            $(".hip").attr('readonly', true);
            $(".shoulders").attr('readonly', true);
            $(".customer-bmi-calculate-btn").hide();
            $('select.height_ft').attr('disabled', true);
            $('select.height_in').attr('disabled', true);
            $('.change-name-icon').show();
            $('.customer-name-calculate-btn').show();
            $("#name").show();
            $(".name").hide();
            $('.customer-name-calculate-btn').hide();
            $('#customer_name_cancel').hide();

        });

        $('#name_edit_pen').on('click',function(){
            $(".name").show();
            $('.customer-name-calculate-btn').show();
            $('#name_edit_pen').hide();
            $("#name").hide();
        })

        $("#customer_name_cancel").on('click',function(event){
            $(".name").hide();
            $('.customer-name-calculate-btn').hide();
            $('#name_edit_pen').show();
            $("#name").show();
        })

        $(".personal_detail").submit(function(){
            $('.customer-bmi-calculate-btn').attr('disabled', true);
        })

        $("#my-calendar").zabuto_calendar({

            data:@json($workout_date)

        });

        const sevenDays = Last7Days()
        // console.log(Last7DaysWithoutformat)

        //adding last 7days buttons
        $.each(sevenDays,function(index,value){
            $(".customer-7days-filter-water-container").append(`
            <div class="customer-7days-day-water-btn">${value}</div>
            `)
            $(".customer-7days-filter-meal-container").append(`
            <div class="customer-7days-day-meal-btn">${value}</div>
            `)
        })

        $(".customer-profile-workout-filter-btn").on('click',function(event){
            to=$('#to_date').val();
            from=$('#from_date').val();
            var url = "{{ route('workout_filter', [':from', ':to']) }}";
            url = url.replace(':from', from);
            url = url.replace(':to', to);
            $.ajax({
                    type: "GET",
                    url: url,
                    datatype: "json",
                    success: function(data) {
                        var workouts= data.workouts;
                        $(".customer-profile-workout-list-parent-container").empty();
                        $(".customer-profile-workout-list-parent-container").append(`
                        <div class="customer-profile-workout-list-header">
                        <p>${data.from} - ${data.to}</p>
                        <div class="customer-profile-workoutdetails-container">
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                <p>${data.time_min}mins ${data.time_sec}sec</p>
                            </div>
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                <p>${data.cal_sum}</p>
                            </div>
                        </div>
                    </div>

                        ${workouts.map((item,index) => (
                            `<div class="customer-profile-workout-row">
                            <div class="customer-profile-workout-row-namedate-container">
                                <p>${item.workout_plan_type}</p>
                                <div class="customer-profile-workout-row-date">
                                    <iconify-icon icon="bx:calendar" class="customer-profile-date-icon"></iconify-icon>
                                    <p>${item.date}</p>
                                </div>
                            </div>

                            <div class="customer-profile-workoutdetails-container">
                                <div class="customer-profile-workoutdetail">
                                    <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                    <p>${Math.floor(item.time/60)}mins ${item.time%60}sec</p>
                                </div>
                                <div class="customer-profile-workoutdetail">
                                    <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                    <p>${item.calories}</p>
                                </div>
                            </div>
                        </div>`
                        ))}


                    `)

                    }
                });

        })

        //on clicking one of the butttons of last 7 days (water)
        $(".customer-7days-day-water-btn").on('click', function(event){
            $(".customer-7days-day-water-btn").removeClass("customer-7days-day-btn-active")
            $(this).addClass("customer-7days-day-btn-active")
            event.stopPropagation();
            event.stopImmediatePropagation();
            console.log($(this).text())
            date = $(this).text();
            $.ajax({
                    type: "GET",
                    url: "/customer/lastsevenDay/"+ date,
                    datatype: "json",
                    success: function(data) {
                        console.log(data);
                        if(data.water == null){
                            renderCircle(3000,0)
                        }
                        else{
                            renderCircle(3000,data.water.update_water)
                        }

                    }
                });
            // renderCircle(3000,600)
        });

        //on clicking one of the butttons of last 7 days (meal)
        $(".customer-7days-day-meal-btn").on('click', function(event){

            $(".customer-7days-day-meal-btn").removeClass("customer-7days-day-btn-active")
            $(this).addClass("customer-7days-day-btn-active")
            $(".customer-7days-meal-tables-container").empty();
            event.stopPropagation();
            event.stopImmediatePropagation();

            console.log($(this).text())
            meal_sevendays($(this).text())

            // renderCircle(3000,600)

        });


        //hide 7days buttons (default)
        $(".customer-7days-filter-water-container").hide()
        $(".customer-7days-filter-meal-container").hide()
        //workout tab active by default
        $('#workout').addClass('customer-profile-tracker-header-active')
        $('.customer-profile-tracker-workout-container').hide()
        $('.customer-profile-tracker-meal-container').hide()
        $('.customer-profile-tracker-water-container').hide()

        //show today's meal by default
        $("#meal-today").addClass("customer-profile-days-btn-active")
        meal_sevendays(today)

        //show today's water by default
        $("#water-today").addClass("customer-profile-days-btn-active")
        todaywater()

        function todaywater(){
            $.ajax({
                    type: "GET",
                    url: "/customer/today",
                    datatype: "json",
                    success: function(data) {
                        console.log(data);
                        if(data.water == null){
                            renderTodayCircle(3000,0)
                        }
                        else{
                            renderTodayCircle(3000,data.water.update_water)
                        }

                    }
                });
        }

        //show today's workout by default
        $("#workout-today").addClass("customer-profile-days-btn-active")
        renderWorkoutList()

        //on clicking workout tab
        $('#workout').click(function(){
            $('#workout').addClass('customer-profile-tracker-header-active')
            $('#meal').removeClass('customer-profile-tracker-header-active')
            $('#water').removeClass('customer-profile-tracker-header-active')

            $('.customer-profile-tracker-workout-container').show()
            $('.customer-profile-tracker-meal-container').hide()
            $('.customer-profile-tracker-water-container').hide()
        })


        //on clicking meal tab
        $('#meal').click(function(){
            $('#workout').removeClass('customer-profile-tracker-header-active')
            $('#meal').addClass('customer-profile-tracker-header-active')
            $('#water').removeClass('customer-profile-tracker-header-active')

            $('.customer-profile-tracker-workout-container').hide()
            $('.customer-profile-tracker-meal-container').show()
            $('.customer-profile-tracker-water-container').hide()
        })


        //on clicking water tab
        $('#water').click(function(){
            $('#workout').removeClass('customer-profile-tracker-header-active')
            $('#meal').removeClass('customer-profile-tracker-header-active')
            $('#water').addClass('customer-profile-tracker-header-active')

            $('.customer-profile-tracker-workout-container').hide()
            $('.customer-profile-tracker-meal-container').hide()
            $('.customer-profile-tracker-water-container').show()
        })

        //on clicking today (meal)
        $("#meal-today").click(function(){

            $("#meal-today").addClass("customer-profile-days-btn-active")
            $("#meal-7days").removeClass("customer-profile-days-btn-active")
            $(".customer-7days-filter-meal-container").hide()
            $(".customer-7days-meal-tables-container").empty();

            meal_sevendays(today)
        })

        function meal_sevendays(date){
            var add_url = "{{ route('meal_sevendays',[':date']) }}";
            add_url = add_url.replace(':date', date);

            $.ajax({
                    type: "GET",
                    url: add_url,
                    datatype: "json",
                    success: function(data) {
                        console.log(data);
                        var breakFast =data.meal_breafast;
                        var lunch =data.meal_lunch;
                        var snack =data.meal_snack;
                        var dinner =data.meal_dinner;
                        $(".customer-7days-meal-tables-container").append(`
        <div class="customer-profile-meal-table-container">
                    <h1>Breakfast</h1>
                    <table class="customer-profile-meal-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cal</th>
                                <th>Carb</th>
                                <th>Protein</th>
                                <th>Fat</th>
                                <th>Servings</th>
                            </tr>
                        </thead>

                        <tbody>
                            ${breakFast.map((item,index) => (
                                `<tr class="meal-table-total">
                                <td></td>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td>${item.calories} </td>
                                <td>${item.carbohydrates}</td>
                                <td>${item.protein}</td>
                                <td>${item.fat}</td>
                                <td>${item.serving}</td>
                            </tr>`
                            ))}
                        </tbody>
                        <tr class="meal-table-total">
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>${data.total_calories_breakfast}</td>
                            <td>${data.total_carbohydrates_breakfast}</td>
                            <td>${data.total_protein_breakfast}</td>
                            <td>${data.total_fat_breakfast}</td>
                            <td>${data.total_serving_breakfast}</td>
                        </tr>
                    </table>
                    <h1>Lunch</h1>
                    <table class="customer-profile-meal-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cal</th>
                                <th>Carb</th>
                                <th>Protein</th>
                                <th>Fat</th>
                                <th>Servings</th>
                            </tr>
                        </thead>

                        <tbody>
                            ${lunch.map((item,index) => (
                                `<tr class="meal-table-total">
                                <td></td>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td>${item.calories}</td>
                                <td>${item.carbohydrates}</td>
                                <td>${item.protein}</td>
                                <td>${item.fat}</td>
                                <td>${item.serving}</td>
                            </tr>`
                            ))}
                        </tbody>
                        <tr class="meal-table-total">
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>${data.total_calories_lunch}</td>
                            <td>${data.total_carbohydrates_lunch}</td>
                            <td>${data.total_protein_lunch}</td>
                            <td>${data.total_fat_lunch}</td>
                            <td>${data.total_serving_lunch}</td>
                        </tr>
                    </table>
                    <h1>Snack</h1>
                    <table class="customer-profile-meal-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cal</th>
                                <th>Carb</th>
                                <th>Protein</th>
                                <th>Fat</th>
                                <th>Servings</th>
                            </tr>
                        </thead>

                        <tbody>
                            ${snack.map((item,index) => (
                                `<tr class="meal-table-total">
                                <td></td>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td id = "cal">${item.calories}</td>
                                <td>${item.carbohydrates}</td>
                                <td>${item.protein}</td>
                                <td>${item.fat}</td>
                                <td>${item.serving}</td>
                            </tr>
                            ` ))}
                        </tbody>
                        <tr class="meal-table-total">
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>${data.total_calories_snack}</td>
                            <td>${data.total_carbohydrates_snack}</td>
                            <td>${data.total_protein_snack}</td>
                            <td>${data.total_fat_snack}</td>
                            <td>${data.total_serving_snack}</td>
                        </tr>
                    </table>
                    <h1>Dinner</h1>
                    <table class="customer-profile-meal-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cal</th>
                                <th>Carb</th>
                                <th>Protein</th>
                                <th>Fat</th>
                                <th>Servings</th>
                            </tr>
                        </thead>

                        <tbody>
                            ${dinner.map((item,index) => (
                                `<tr class="meal-table-total">
                                <td></td>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td>${item.calories}</td>
                                <td>${item.carbohydrates}</td>
                                <td>${item.protein }</td>
                                <td>${item.fat}</td>
                                <td>${item.serving}</td>
                            </tr>`
                            ))}
                        </tbody>
                        <tr class="meal-table-total">
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>${data.total_calories_dinner}</td>
                            <td>${data.total_carbohydrates_dinner}</td>
                            <td>${data.total_protein_dinner}</td>
                            <td>${data.total_fat_dinner}</td>
                            <td>${data.total_serving_dinner}</td>
                        </tr>
                    </table>
                </div>
        `);
                    }
                })
        }

        //on clicking last 7 days (meal)
        $("#meal-7days").click(function(){
            $("#meal-today").removeClass("customer-profile-days-btn-active")
            $("#meal-7days").addClass("customer-profile-days-btn-active")
            $(".customer-7days-filter-meal-container").show()
            $(".customer-7days-day-meal-btn").removeClass("customer-7days-day-btn-active")
            $(".customer-7days-day-meal-btn").last().addClass("customer-7days-day-btn-active");
            $(".customer-7days-meal-tables-container").empty();
            console.log($(".customer-7days-day-meal-btn").last().text())
             meal_sevendays(today)
        })

        //on clicking today (water)
        $("#water-today").click(function(){
            $("#water-today").addClass("customer-profile-days-btn-active")
            $("#water-7days").removeClass("customer-profile-days-btn-active")
            $(".customer-7days-filter-water-container").hide()
            // alert("okk");
            todaywater();
        })

        //on clicking last 7 days (water)
        $("#water-7days").click(function(){
            $("#water-today").removeClass("customer-profile-days-btn-active")
            $("#water-7days").addClass("customer-profile-days-btn-active")
            $(".customer-7days-filter-water-container").show()
            $(".customer-7days-day-water-btn").removeClass("customer-7days-day-btn-active")
            $(".customer-7days-day-water-btn").last().addClass("customer-7days-day-btn-active")
            console.log($(".customer-7days-day-water-btn").last().text())
            todaywater();
        })

         //on clicking today (workout)
         $("#workout-today").click(function(){
            $("#workout-today").addClass("customer-profile-days-btn-active")
            $("#workout-7days").removeClass("customer-profile-days-btn-active")
            renderWorkoutList()
        })

         //on clicking last 7 days (water)
         $("#workout-7days").click(function(){
            $("#workout-today").removeClass("customer-profile-days-btn-active")
            $("#workout-7days").addClass("customer-profile-days-btn-active")
            workout_7days()

        })


    });

    function workout_7days(){

        $.ajax({
                    type: "GET",
                    url: "/customer/workout/lastsevenDay/",
                    datatype: "json",
                    success: function(data) {
                        var workouts= data.workouts;
                        $(".customer-profile-workout-list-parent-container").empty()
                        $(".customer-profile-workout-list-parent-container").append(`
                        <div class="customer-profile-workout-list-header">
                        <p>${data.seven} - ${data.current}</p>
                        <div class="customer-profile-workoutdetails-container">
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                <p>${data.time_min}mins ${data.time_sec}sec</p>
                            </div>
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                <p>${data.cal_sum}</p>
                            </div>
                        </div>
                    </div>

                    ${workouts.map((item,index) => (
                        `<div class="customer-profile-workout-row">
                        <div class="customer-profile-workout-row-namedate-container">
                            <p>${item.workout_plan_type}</p>
                            <div class="customer-profile-workout-row-date">
                                <iconify-icon icon="bx:calendar" class="customer-profile-date-icon"></iconify-icon>
                                <p>${item.date}</p>
                            </div>
                        </div>

                        <div class="customer-profile-workoutdetails-container">
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                <p>${Math.floor(item.time/60)}mins ${item.time%60}sec</p>
                            </div>
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                <p>${item.calories}</p>
                            </div>
                        </div>
                    </div>`
                    ))}


        `)
                    }
                });

    }
    //getting the last 7 days from today
    function Last7Days () {
        var result = [];
        for (var i=1; i<=7; i++) {
            var d = new Date();
            d.setDate(d.getDate() - i);
            result.push( formatDate(d) )
        }

        return(result);
    }
    //formatting the date of last 7 days
    function formatDate(date){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        var dd = date.getDate();
        // var mm = monthNames[date.getMonth()];
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear();
        if(dd<10) {dd='0'+dd}
        if(mm<10) {mm='0'+mm}
        date = yyyy+'-'+mm+'-'+dd;
        return date
    }

    //rendering last 7 days water circle progress
    function renderCircle(total,taken){
        var result = taken / total
        var color
        console.log('last 7 days',taken)

        if(taken < 3000 ){
            console.log("fail")
            $(".customer-profile-water-track-history-text span").text('Mission Failed')
            color = '#FF0000'
            $('.water-chart').circleProgress({
                startAngle: 1.5 * Math.PI,
                lineCap: 'round',
                value: result,
                emptyFill: '#D9D9D9',
                fill: { 'color': '#FF0000' }
            });
        }else if(taken >= 3000){
            console.log("complete")
            $(".customer-profile-water-track-history-text  span").text('Mission Complete')
            $('.water-chart').circleProgress({
                startAngle: 1.5 * Math.PI,
                lineCap: 'round',
                value: result,
                emptyFill: '#D9D9D9',
                fill: {
                     gradient: ["#3aeabb", "#fdd250"]
                }
            });
        }

        $(".customer-profile-water-track-history-text p").text(`You Drunk ${taken}/${total} ML of Your Daily Mission.`)

    }


    //rendering today water circle progress
    function renderTodayCircle(total,taken){
        var result = taken / total
        console.log('today',taken)

        if(taken < 3000 ){
            console.log("keep drinking")
            $(".customer-profile-water-track-history-text  span").text('Keep Drinking')
            $('.water-chart').circleProgress({
                startAngle: 1.5 * Math.PI,
                lineCap: 'round',
                value: result,
                emptyFill: '#D9D9D9',
                fill: { 'color': "#3CADDD" }
            });

        }else if(taken >= 3000){
            console.log("complete")
            $(".customer-profile-water-track-history-text  span").text('Mission Complete')
            $('.water-chart').circleProgress({
                startAngle: 1.5 * Math.PI,
                lineCap: 'round',
                value: result,
                emptyFill: '#D9D9D9',
                fill: {
                     gradient: ["#3aeabb", "#fdd250"]
                }
            });
        }



        $(".customer-profile-water-track-history-text p").text(`You Drunk ${taken}/${total} ML of Your Daily Mission.`)

    }

    //rendering meal table
    function renderMealTable(){
        $(".customer-7days-meal-tables-container").empty()

        var breakFast = []
        var lunch = []
        var snack = []
        var dinner = []



    }

    //rendering workoutList
    function renderWorkoutList(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = today.toLocaleString('default', { month: 'short' });
        var yyyy = today.getFullYear();

        today =  yyyy+'-'+mm+'-'+dd;
        const workouts = @json($workouts);
        const time_sec=@json($time_sec);
        const time_min=@json($time_min);
        const cal_sum=@json($cal_sum);

        $(".customer-profile-workout-list-parent-container").empty()
        $(".customer-profile-workout-list-parent-container").append(`
        <div class="customer-profile-workout-list-header">
                        <p>${dd}, ${mm}, ${yyyy}</p>
                        <div class="customer-profile-workoutdetails-container">
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                <p>${time_min}mins ${time_sec}sec</p>
                            </div>
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                <p>${cal_sum}</p>
                            </div>
                        </div>
                    </div>

                    ${workouts.map((item,index) => (
                        `<div class="customer-profile-workout-row">
                        <div class="customer-profile-workout-row-namedate-container">
                            <p>${item.workout_plan_type}</p>
                            <div class="customer-profile-workout-row-date">
                                <iconify-icon icon="bx:calendar" class="customer-profile-date-icon"></iconify-icon>
                                <p>${item.date}</p>
                            </div>
                        </div>

                        <div class="customer-profile-workoutdetails-container">
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                                <p>${Math.floor(item.time/60)}mins ${item.time%60}sec</p>
                            </div>
                            <div class="customer-profile-workoutdetail">
                                <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                                <p>${item.calories}</p>
                            </div>
                        </div>
                    </div>`
                    ))}


        `)
    }
</script>
@endhasanyrole
@hasanyrole('Free|Gold|Ruby|Ruby Premium')
<script>
    $( document ).ready(function() {
        $(".name").hide();
        $('.customer-name-calculate-btn').hide();
        $(".customer-bmi-calculate-btn").hide();
        $("#pen1").on('click', function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(".age").removeAttr("readonly");
            $(".weight").removeAttr("readonly");
            $(".neck").removeAttr("readonly");
            $(".waist").removeAttr("readonly");
            $(".hip").removeAttr("readonly");
            $(".shoulders").removeAttr("readonly");
            $(".customer-bmi-calculate-btn").show();
            $('select.height_ft').attr('disabled', false);
            $('select.height_in').attr('disabled', false);
            $('.change-name-icon').hide();
            $('.customer-name-calculate-btn').hide();
            $("#name").show();
            $(".name").hide();
        });



        $("#customer_cancel").on('click', function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(".age").attr('readonly', true);
            $(".weight").attr('readonly', true);
            $(".neck").attr('readonly', true);
            $(".waist").attr('readonly', true);
            $(".hip").attr('readonly', true);
            $(".shoulders").attr('readonly', true);
            $(".customer-bmi-calculate-btn").hide();
            $('select.height_ft').attr('disabled', true);
            $('select.height_in').attr('disabled', true);
            $('.change-name-icon').show();
            $('.customer-name-calculate-btn').show();
            $("#name").show();
            $(".name").hide();
            $('.customer-name-calculate-btn').hide();
            $('#customer_name_cancel').hide();

        });

        // $('#name_edit_pen').on('click',function(){
        //     $(".name").show();
        //     $('.customer-name-calculate-btn').show();
        //     $('#name_edit_pen').hide();
        //     $("#name").hide();
        // })

        // $("#customer_name_cancel").on('click',function(event){
        //     $(".name").hide();
        //     $('.customer-name-calculate-btn').hide();
        //     $('#name_edit_pen').show();
        //     $("#name").show();
        // })

        $(".personal_detail").submit(function(){
            $('.customer-bmi-calculate-btn').attr('disabled', true);
        })
    })
</script>
@endhasanyrole
<script>
    $( document ).ready(function() {
        $(".customer-profile-social-media-photoes-container").hide()
        $(".social-media-profile-photos-link").click(function(){
            $(".customer-profile-social-media-photoes-container").show()
            $(".customer-profile-social-media-default-container").hide()
        })

        $(".customer-profile-social-media-photoes-back").click(function(){
            $(".customer-profile-social-media-photoes-container").hide()
            $(".customer-profile-social-media-default-container").show()
        })

        $(".social-media-profiles-tab").addClass("social-media-photos-tab-active")

            $(".social-media-covers-container").hide()

            $(".social-media-profiles-tab").click(function(){
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

        $(".name").hide();
        $('.customer-name-calculate-btn').hide();
        $(".customer-bmi-calculate-btn").hide();
        $('#name_edit_pen').on('click',function(){
            console.log("testing");
            $(".name").show();
            $('.customer-name-calculate-btn').show();
            $('#name_edit_pen').hide();
            $("#name").hide();
        });

        $("#customer_name_cancel").on('click',function(event){
            $(".name").hide();
            $('.customer-name-calculate-btn').hide();
            $('#name_edit_pen').show();
            $("#name").show();
        })

        const profileImgInput = document.querySelector('.customer-profile-img-change-input')
        const profileImg = document.querySelector('.customer-profile-img')

        const coverImgInput = document.querySelector('.customer-cover-img-change-input')
        const coverImg = document.querySelector('.customer-cover-photo')

        profileImgInput.addEventListener('change', (e) =>{
            console.log(profileImgInput.files[0])
            if(profileImgInput.files[0]){
                const reader = new FileReader();
                reader.onload = e => profileImg.setAttribute('src', e.target.result);
                reader.readAsDataURL(profileImgInput.files[0]);
                if(profileImgInput.files.length === 0){
                    $('.customer-profile-change-btns-container').hide()
                }else{
                    $('.customer-profile-change-btns-container').show()
                }
            }else{
                profileImgInput.value = ""
                // profileImg.removeAttribute("src")
                profileImg.setAttribute('src',"{{asset('img/user.jpg')}}");
                $('.customer-profile-change-btns-container').hide()
            }

        });//

        coverImgInput.addEventListener('change', (e) =>{
            console.log(coverImgInput.files[0])
            if(coverImgInput.files[0]){
                const reader = new FileReader();
                reader.onload = e => coverImg.setAttribute('src', e.target.result);
                reader.readAsDataURL(coverImgInput.files[0]);
                if(coverImgInput.files.length === 0){
                    $('.customer-cover-change-btns-container').hide()
                }else{
                    $('.customer-cover-change-btns-container').show()
                }
            }else{
                coverImgInput.value = ""
                // profileImg.removeAttribute("src")
                coverImg.setAttribute('src',"{{asset('image/trainer2.jpg')}}");
                $('.customer-cover-change-btns-container').hide()
            }

        });//



        $('.customer-profile-change-btns-container').hide()
        $('.customer-cover-change-btns-container').hide()
        $('.customer-bio-btns-container').hide()
        $('.customer-bio-text input').hide()


        $(".customer-profile-change-cancel-btn").click(function(){
                profileImgInput.value = ""
                // profileImg.removeAttribute("src")
                profileImg.setAttribute('src',"{{asset('img/user.jpg')}}");
                $('.customer-profile-change-btns-container').hide()
        })

        $(".customer-cover-change-cancel-btn").click(function(){
            coverImgInput.value = ""
            // profileImg.removeAttribute("src")
            coverImg.setAttribute('src',"{{asset('image/trainer2.jpg')}}");
            $('.customer-cover-change-btns-container').hide()
        })

        $('.customer-bio-change-icon').click(function(){
            // console.log("hello")
            $('.customer-bio-text input').show()

            $('.customer-bio-change-icon').hide()
            $('.customer-bio-btns-container').show()

            $('.customer-bio-form p').hide()
        })

        $(".customer-bio-change-cancel-btn").click(function(){
            $('.customer-bio-text input').hide()

            $('.customer-bio-change-icon').show()
            $('.customer-bio-btns-container').hide()

            $('.customer-bio-form p').show()
        })

        $('.customer-profile-training-center-tab').addClass("customer-profile-training-center-tab-active")
        $('.customer-profile-training-center-container').show()
        $('.customer-profile-socialmedia-container').hide()
        $('.customer-profile-shop-container').hide()

        $('.customer-profile-training-center-tab').click(function(){
            $('.customer-profile-training-center-tab').addClass("customer-profile-training-center-tab-active")
            $('.customer-profile-socialmedia-tab').removeClass("customer-profile-training-center-tab-active")
            $(".customer-profile-shop-tab").removeClass("customer-profile-training-center-tab-active")



            $('.customer-profile-training-center-container').show()
            $('.customer-profile-socialmedia-container').hide()
            $('.customer-profile-shop-container').hide()
        })

        $('.customer-profile-socialmedia-tab').click(function(){
            $('.customer-profile-training-center-tab').removeClass("customer-profile-training-center-tab-active")
            $('.customer-profile-socialmedia-tab').addClass("customer-profile-training-center-tab-active")
            $(".customer-profile-shop-tab").removeClass("customer-profile-training-center-tab-active")

            $('.customer-profile-training-center-container').hide()
            $('.customer-profile-socialmedia-container').show()
            $('.customer-profile-shop-container').hide()
        })

        $(".customer-profile-shop-tab").click(function(){
            $('.customer-profile-training-center-tab').removeClass("customer-profile-training-center-tab-active")
            $('.customer-profile-socialmedia-tab').removeClass("customer-profile-training-center-tab-active")
            $(".customer-profile-shop-tab").addClass("customer-profile-training-center-tab-active")

            $('.customer-profile-training-center-container').hide()
            $('.customer-profile-socialmedia-container').hide()
            $('.customer-profile-shop-container').show()
        })

        $('.customer-post-header-icon').click(function(){
            $(this).next().toggle()
        })

    });
</script>
@endpush
