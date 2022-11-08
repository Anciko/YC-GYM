@extends('customer.training_center.layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="customer-profile-parent-container">
    <form class="personal_detail" method="POST" action="{{route('customer-profile-name.update')}}">
        @csrf
        @method('POST')
    <div class="customer-profile-img-name-container">
        <div class="customer-profile-img-container">
            <img src="{{asset('img/avatar.jpg')}}">
        </div>
        <div class="customer-profile-name-container">
            <p id="name">{{auth()->user()->name}}</p>
            <input type="text" value="{{auth()->user()->name}}" class="name" name="name">

            <span>(User ID: {{auth()->user()->member_code}})</span>
        </div>
        <iconify-icon icon="cil:pen" class="change-name-icon" id="name_edit_pen"></iconify-icon>
        <button type="submit" class="customer-primary-btn customer-name-calculate-btn">Save</button>
        <button type="button" onclick="window.history.go(-1); return false;" class="customer-secondary-btn customer-name-calculate-btn" id="customer_cancel">Cancel</button>
    </div>
    </form>

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
                        <span>lb</span>
                    </div>

                </div>

            </div>
        </div>
        <button type="button" onclick="window.history.go(-1); return false;" class="customer-secondary-btn customer-bmi-calculate-btn" id="customer_cancel">Cancel</button>
        <button type="submit" class="customer-primary-btn customer-bmi-calculate-btn">Save and Calculate BMI</button>

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

    <div class="weight-chart-container" id="weightchart">
        <select class="weight-chart-filter">
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
            <option value="2031">2031</option>
            <option value="2032">2032</option>
            <option value="2033">2033</option>
            <option value="2034">2034</option>
            <option value="2035">2035</option>
            <option value="2036">2036</option>
            <option value="2037">2037</option>
            <option value="2038">2038</option>
            <option value="2039">2039</option>
            <option value="2040">2040</option>
            <option value="2041">2041</option>
            <option value="2042">2042</option>
            <option value="2043">2043</option>
            <option value="2044">2044</option>
            <option value="2045">2045</option>
            <option value="2046">2046</option>
            <option value="2047">2047</option>
            <option value="2048">2048</option>
            <option value="2049">2049</option>
            <option value="2050">2050</option>
        </select>
        <p>Your {{$plan}} History</p>
        <canvas id="myChart"></canvas>
    </div>

    <div class="no-weight-chart" id="weightreview">
        <p style="margin-top:100px">Currently, you don’t have ‘{{$plan}}’ history  to review.
            Keep working out and check at {{$newDate}}.</p>
    </div>

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
                <!-- <div class="customer-profile-workout-list-header">
                    <p>11, oct, 2022 - 17, oct, 2022</p>
                    <div class="customer-profile-workoutdetails-container">
                        <div class="customer-profile-workoutdetail">
                            <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                            <p>1hr 40mins</p>
                        </div>
                        <div class="customer-profile-workoutdetail">
                            <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                            <p>400</p>
                        </div>
                    </div>
                </div>

                <div class="customer-profile-workout-row">
                    <div class="customer-profile-workout-row-namedate-container">
                        <p>Weight Loss Plan</p>
                        <div class="customer-profile-workout-row-date">
                            <iconify-icon icon="bx:calendar" class="customer-profile-date-icon"></iconify-icon>
                            <p>17,oct,2022</p>
                        </div>
                    </div>

                    <div class="customer-profile-workoutdetails-container">
                        <div class="customer-profile-workoutdetail">
                            <iconify-icon icon="icon-park-outline:time" class="customer-profile-time-icon"></iconify-icon>
                            <p>1hr 40mins</p>
                        </div>
                        <div class="customer-profile-workoutdetail">
                            <iconify-icon icon="codicon:flame" class="customer-profile-flame-icon"></iconify-icon>
                            <p>400</p>
                        </div>
                    </div>
                </div> -->
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

</div>

@endsection
@push('scripts')
<script>
    $( document ).ready(function() {
        var bmi=@json($bmi);
        // var bmi=17;
        // var maxBmi = 50

        // var indicator = (bmi/maxBmi)*100

        // console.log(indicator)

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

        $('#name_edit_pen').on('click',function(){
            $(".name").show();
            $('.customer-name-calculate-btn').show();
            $('#name_edit_pen').hide();
            $("#name").hide();
        })

        // $("#pen2").on('click', function(event){
        //     var newDate = @json($newDate);
        //     Swal.fire({
        //         icon:'warning',
        //         title:"Can't Edit Profile",
        //         text: "Your profile can edit on "+newDate ,
        //         confirmButtonColor: '#3CDD57',
        //         timer: 5000
        //       });
        // });

        var weight_history = @json($weight_history);
        if(weight_history.length<2){
            $("#weightreview").show();
            $("#weightchart").hide();
        }else{
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

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        }

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
                            renderTodayCircle(3000,0)
                        }
                        else{
                            renderTodayCircle(3000,data.water.update_water)
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

    //rendering today water circle progress
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


    //rendering last 7 days water circle progress
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

@endpush
