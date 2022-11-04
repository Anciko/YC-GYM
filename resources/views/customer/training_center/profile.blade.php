@extends('customer.training_center.layouts.app')

@section('content')

<div class="customer-profile-parent-container">
    <div class="customer-profile-img-name-container">
        <div class="customer-profile-img-container">
            <img src="{{asset('img/avatar.jpg')}}">
        </div>
        <div class="customer-profile-name-container">
            <p>{{auth()->user()->name}}</p>
            <iconify-icon icon="cil:pen" class="change-name-icon"></iconify-icon>
            <span>(User ID: 1234567890)</span>
        </div>
    </div>

    <form class="customer-profile-personaldetails-parent-container">
        <h1>Your Profile</h1>
        <div class="customer-profile-personaldetails-grid">
            <div class="customer-profile-personaldetails-left">
                <div class="customer-profile-personaldetail-container">
                    <p>Age:</p>
                    <div>
                        <input type="number" value="{{auth()->user()->age}}">
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
                    <select>
                        <option value="3" {{"3" == $height_ft ? 'selected' : ''}}>3</option>
                        <option value="4" {{"4" == $height_ft ? 'selected' : ''}}>4</option>
                        <option value="5" {{"5" == $height_ft ? 'selected' : ''}}>5</option>
                        <option value="6" {{"6" == $height_ft ? 'selected' : ''}}>6</option>
                    </select>
                    <span>ft</span>
                    <select>
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
                        <input type="number" value="{{auth()->user()->weight}}">
                        <span>lb</span>
                    </div>

                </div>
                <div class="customer-profile-personaldetail-container">
                    <p>Neck:</p>
                    <div>
                        <input type="number" value="{{auth()->user()->neck}}">
                        <span>in</span>
                    </div>
                </div>
            </div>
            <div class="customer-profile-personaldetails-right">
                <div class="customer-profile-personaldetail-container">
                    <p>Waist:</p>
                    <div>
                        <input type="number" value="{{auth()->user()->waist}}">
                        <span>in</span>
                    </div>
                </div>

                <div class="customer-profile-personaldetail-container ">
                    <p>Hip:</p>
                    <div>
                        <input type="number"  value="{{auth()->user()->hip}}">
                        <span>in</span>
                    </div>
                </div>

                <div class="customer-profile-personaldetail-container">
                    <p>Shoulders:</p>
                    <div>
                        <input type="number"  value="{{auth()->user()->shoulders}}">
                        <span>lb</span>
                    </div>

                </div>

            </div>
        </div>

        <button type="button" class="customer-primary-btn customer-bmi-calculate-btn">Calculate BMI</button>
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

                <?php $bmi=auth()->user()->bmi ?>
                @if ($bmi <=18.5)
                <p>Your BMi , {{$bmi}} , is low.</p>
                @elseif ($bmi >=25)
                <p>Your BMi , {{$bmi}} , is high.</p>
                @else
                <p>Your BMi , {{$bmi}} , is normal.</p>
                @endif
            </div>
        </div>
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
                        <input type="date">
                    </div>
                    <div class="customer-profile-to">
                        <p>To:</p>
                        <input type="date">
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
        $("#my-calendar").zabuto_calendar({
            data: [
            {
                'date': '2022-11-11',

            },
            {
                'date': '2022-11-13',

            }
        ]
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
            event.stopPropagation();
            event.stopImmediatePropagation();

            console.log($(this).text())
            // renderCircle(3000,600)
            renderMealTable()
        });


        //hide 7days buttons (default)
        $(".customer-7days-filter-water-container").hide()
        $(".customer-7days-filter-meal-container").hide()

        //workout tab active by default
        $('#workout').addClass('customer-profile-tracker-header-active')
        $('.customer-profile-tracker-workout-container').show()
        $('.customer-profile-tracker-meal-container').hide()
        $('.customer-profile-tracker-water-container').hide()


        //show today's meal by default
        $("#meal-today").addClass("customer-profile-days-btn-active")
        renderMealTable()

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
            renderMealTable()
        })

        //on clicking last 7 days (meal)
        $("#meal-7days").click(function(){
            $("#meal-today").removeClass("customer-profile-days-btn-active")
            $("#meal-7days").addClass("customer-profile-days-btn-active")
            $(".customer-7days-filter-meal-container").show()
            $(".customer-7days-day-meal-btn").removeClass("customer-7days-day-btn-active")
            $(".customer-7days-day-meal-btn").last().addClass("customer-7days-day-btn-active")
            console.log($(".customer-7days-day-meal-btn").last().text())
            renderMealTable()
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
            renderWorkoutList()
        })


    });


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

        var personal_meal_infos = @json($personal_meal_infos);
        console.log(personal_meal_infos);

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
                                ` <tr>
                                <td></td>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td>${item.cal}</td>
                                <td>${item.carb}</td>
                                <td>${item.protein}</td>
                                <td>${item.fat}</td>
                                <td>${item.servings}</td>
                            </tr>`
                            ))}
                        </tbody>
                        <tr class="meal-table-total">
                            <td>Total</td>
                            <td>5</td>
                            <td></td>
                            <td>500</td>
                            <td>1250</td>
                            <td>750</td>
                            <td>750</td>
                            <td>15</td>
                        </tr>
                    </table>
                </div>
        `)
    }

    //rendering workoutList
    function renderWorkoutList(){
        const workouts = []
        $(".customer-profile-workout-list-parent-container").empty()
        $(".customer-profile-workout-list-parent-container").append(`
        <div class="customer-profile-workout-list-header">
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

                    ${workouts.map((item,index) => (
                        `<div class="customer-profile-workout-row">
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
                    </div>`
                    ))}


        `)
    }
</script>

@endpush
