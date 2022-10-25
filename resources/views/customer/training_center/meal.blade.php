@extends('customer.training_center.layouts.app')

@section('content')
@hasanyrole('Diamond')
<a class="back-btn margin-top">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>

<div class="card-chart totalCalTracker">
    <div class="card-donut card-calChart" data-size="300" data-thickness="18"></div>
    <div class="card-center">
      <span class="card-value"></span>
      <div class="card-label"></div>
    </div>

</div>
<div class="small-card-charts-container">
    <div class="card-chart totalCarbTracker">
        <div class="card-donut card-carbChart" data-size="200" data-thickness="18"></div>
        <div class="card-center">
        <span class="card-value"></span>
        <div class="card-label"></div>
        </div>

    </div>
    <div class="card-chart totalProteinTracker">
        <div class="card-donut card-proteinChart" data-size="200" data-thickness="18"></div>
        <div class="card-center">
        <span class="card-value"></span>
        <div class="card-label"></div>
        </div>

    </div>
    <div class="card-chart totalFatTracker">
        <div class="card-donut card-fatChart" data-size="200" data-thickness="18"></div>
        <div class="card-center">
        <span class="card-value"></span>
        <div class="card-label"></div>
        </div>

    </div>
</div>

<div class="customer-diamond-food-track-header">
    <h1>Log Everything you eat today</h1>
    <span>Be honest and track everything. We’ll optimize your program and based on the data</span>
</div>

<div class="customer-food-tracker-parent-container">
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Breakfast</h1>
            <!-- <p>Total : <span>600cal</span></p> -->
        </div>
        <form>
            <input type="text" id="breakfast" placeholder="Search for food...">
        </form>

        <div class="customer-food-tracker-checkboxes-container breakfast_container">
            {{-- @foreach ($meals as  $meal)


            <div class="customer-food-tracker-checkbox">
                <div class="customer-food-tracker-checkbox-label">
                    <p>{{$meal->name}}</p>
                    <span>200cal</span>
                </div>
                <button class="customer-food-tracker-checkbox-btn">Add</button>
            </div>

            @endforeach --}}
        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Lunch</h1>
            <!-- <p>Total : <span>600cal</span></p> -->
        </div>
        <form>
            <input type="text" id="launch" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container">
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                {{-- <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button> --}}
            </div>
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                {{-- <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button> --}}
            </div>
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                {{-- <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button> --}}
            </div>

        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Dinner</h1>
            <!-- <p>Total : <span>600cal</span></p> -->
        </div>
        <form>
            <input type="text" id="ddinner" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container">
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button>
            </div>
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button>
            </div>
        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Snack</h1>
            <!-- <p>Total : <span>600cal</span></p> -->
        </div>
        <form>
            <input type="text" id="snack" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container">
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button>
            </div>
            <div class="customer-food-tracker-checkbox">

                <div class="customer-food-tracker-checkbox-label">
                    <p>Mont Hin Khar</p>
                    <span>200cal</span>
                </div>
                <button class="customer-food-tracker-checkbox-btn" onclick="addFood()">Add</button>
            </div>
        </div>
    </div>
</div>

<table class="customer-added-food-list-container">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Cal</th>
            <th>Carb</th>
            <th>Protein</th>
            <th>Fat</th>
            <th>No. of servings</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>

<button class="customer-addfood-confirm-btn customer-primary-btn">
    Save And Continue
</button>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <script>
    $(document).ready(function() {
        var foodList = []

        $('#breakfast').on('keyup', function(){
                    search();
                });
                search();
                function search(){
                    var keyword = $('#breakfast').val();
                    var search_url = "{{ route('customer/training_center/breakfast') }}";
                   // search_url = search_url.replace(':id', group_id);
                    $.post(search_url,
                    {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        keyword:keyword
                    },
                    function(data){
                        table_post_row(data);
                        console.log(data);
                    });
                }
                // table row with ajax
                function table_post_row(res){
                let htmlView = '';
                if(res.breakfast.length <= 0){
                    htmlView+= `
                       No data found.
                    `;
                }
                for(let i = 0; i < res.breakfast.length; i++){
                    id = res.breakfast[i].id;

                    htmlView += `
                        <div class="customer-food-tracker-checkbox">
                            <div class="customer-food-tracker-checkbox-label">
                                <p>`+res.breakfast[i].name+`</p>
                                <span>`+res.breakfast[i].calories+`</span>
                            </div>

                         <button class="customer-food-tracker-checkbox-btn breakfast_add" data-id = `+res.breakfast[i].id+` value=`+i+` >Add</button>
                         </div>
                `
                    }


                    $('.breakfast_container').html(htmlView);
                    $(".breakfast_add").click(function(){
                        $(".customer-added-food-list-container tbody").empty()
                        var id = $(this).data('id');
                        var i = $(this).val();
                        foodObj = {
                                id : res.breakfast[i].id,
                                name : res.breakfast[i].name,
                                cal : res.breakfast[i].calories,
                                carb : res.breakfast[i].carbohydrates,
                                protein : res.breakfast[i].protein,
                                fat : res.breakfast[i].fat,
                                servings : 0
                            }
                            console.log(foodList)
                            console.log(foodObj)

                        var rowIdx = 0;
                        if(foodList.length === 0){
                            foodList.push(foodObj)
                            console.log('attr');
                        }

                        // console.log(foodList);
                        // console.log(foodList,"foodlist")

                            $.each(foodList, function(index,value) {
                                if(value.id == foodObj.id){
                                    value.servings += 1
                                    console.log("same food")
                                    $(".customer-added-food-list-container tbody tr").each(function(){
                                        // console.log($(this).attr("id"))
                                        var idCount = $(`[id=${$(this).attr("id")}]`);
                                        console.log(idCount.length,"idcount");
                                        if (idCount.length > 0){
                                            console.log("id same")
                                            $(`[id=${$(this).attr("id")}]`).remove();
                                            }
                                    })

                                }else{
                                    console.log("different food")
                                    foodList.push(foodObj)
                                    // console.log(foodList)
                                }

                            $.each(foodList, function(index,value){
                                $(".customer-added-food-list-container tbody").append(`
                                <tr id="R${++rowIdx}">
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>${value.cal}</td>
                                    <td>${value.carb}</td>
                                    <td>${value.protein}</td>
                                    <td>${value.fat}</td>
                                    <td>
                                        <input type="number" value=${value.servings}>
                                    </td>
                                    <td>
                                        <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
                                    </td>
                                </tr>
                            `)
                            })

                        })
                     });

                }



        var totalCal = 1775
        var takenCal = 0

        var resultCal = takenCal / totalCal;

        var totalCarb = (totalCal/100) * 50
        var takenCarb = 0
        var resultCarb = takenCarb/totalCarb

        var totalProtein = (totalCal/100) * 30
        var takenProtein = 0
        var resultProtein = takenProtein/totalProtein

        var totalFat = (totalCal/100) * 20
        var takenFat = 0
        var resultFat = takenFat/totalFat

    //     $(".customer-food-tracker-checkbox-btn").click(function(){
    //         console.log("aa");
    //         var rowIdx = 0;
    //         if(foodList.length === 0){
    //             foodList.push(foodObj)
    //         }
    //         $.each(foodList, function(index,value) {
    //             // console.log(value?.name === foodObj.name)
    //             if(value.id === foodObj.id){
    //                 value.servings += 1
    //                 console.log("same food")
    //                 $(".customer-added-food-list-container tbody tr").each(function(){
    //                     // console.log($(this).attr("id"))
    //                     var idCount = $(`[id=${$(this).attr("id")}]`);
    //                     if (idCount.length > 0){
    //                         $(`[id=${$(this).attr("id")}]`).remove();
    //                     }
    //                 })

    //             }else{
    //                 console.log("different food")
    //                 foodList.push(foodObj)
    //                 console.log(foodList)
    //             }


    //         $.each(foodList, function(index,value){

    //             $(".customer-added-food-list-container tbody").append(`
    //             <tr id="R${++rowIdx}">
    //                 <td>${index}</td>
    //                 <td>${value.name}</td>
    //                 <td>${value.cal}</td>
    //                 <td>${value.carb}</td>
    //                 <td>${value.protein}</td>
    //                 <td>${value.fat}</td>
    //                 <td>
    //                     <input type="number" value=${value.servings}>
    //                 </td>
    //                 <td>
    //                     <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
    //                 </td>
    //             </tr>
    //         `)
    //         })

    //     })

    //         $('.customer-add-food-delete-btn').on('click',  function () {

    //             // Getting all the rows next to the row
    //             // containing the clicked button
    //             var child = $(this).closest('tr');
    //             console.log(child)
    //             // Iterating across all the rows
    //             // obtained to change the index
    //             child.each(function () {

    //                 // Getting <tr> id.
    //                 var id = $(this).attr('id');

    //                 // Getting the <p> inside the .row-index class.
    //                 var idx = $(this).children('.row-index').children('p');
    //                 console.log(idx)
    //                 // Gets the row number from <tr> id.
    //                 var dig = parseInt(id.substring(1));

    //                 // Modifying row index.
    //                 idx.html(`Row ${dig - 1}`);

    //                 // Modifying row id.
    //                 $(this).attr('id', `R${dig - 1}`);
    //             });

    //             // Removing the current row.
    //             $(this).closest('tr').remove();

    //             // Decreasing total number of rows by 1.
    //             rowIdx--;
    //         });

    //         takenCal = 0
    //         if(foodList.length === 0){
    //             takenCal = 0
    //         }else{
    //             var sum = 0
    //             for(var i =0;i < foodList.length;i++){
    //                 console.log(foodList[i])
    //                 sum = sum + (foodList[i].cal * foodList[i].servings)
    //             }

    //             takenCal = sum
    //         }
    //         resultCal = takenCal / totalCal;

    //         takenCarb = 0
    //         if(foodList.length === 0){
    //             takenCarb = 0
    //         }else{
    //             var sum = 0
    //             for(var i =0;i < foodList.length;i++){
    //                 console.log(foodList[i])
    //                 sum = sum + (foodList[i].carb * foodList[i].servings)
    //             }

    //             takenCarb = sum
    //         }
    //         resultCarb = takenCarb/totalCarb


    //         takenProtein = 0
    //         if(foodList.length === 0){
    //             takenProtein = 0
    //         }else{
    //             var sum = 0
    //             for(var i =0;i < foodList.length;i++){
    //                 console.log(foodList[i])
    //                 sum = sum + (foodList[i].protein * foodList[i].servings)
    //             }

    //             takenProtein = sum
    //         }
    //         resultProtein = takenProtein/totalProtein


    //         takenFat = 0
    //         if(foodList.length === 0){
    //             takenFat = 0
    //         }else{
    //             var sum = 0
    //             for(var i =0;i < foodList.length;i++){
    //                 console.log(foodList[i])
    //                 sum = sum + (foodList[i].fat * foodList[i].servings)
    //             }

    //             takenFat = sum
    //         }
    //         resultFat = takenFat/totalFat

    //         // add circle chart
    //         circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat)
    //     })


    //         circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat)

    });

    function circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat){
        // add circle chart
        $('.card-calChart').circleProgress({
            startAngle: 1.5 * Math.PI,
            lineCap: 'round',
            value: resultCal,
            emptyFill: '#D9D9D9',
            fill: { 'color': '#3CDD57' }
        });
        $(".totalCalTracker .card-value").text(`${takenCal}`)
        $(".totalCalTracker .card-label").text(`of ${totalCal} cal`)


        $('.card-carbChart').circleProgress({
            startAngle: 1.5 * Math.PI,
            lineCap: 'round',
            value: resultCarb,
            emptyFill: '#D9D9D9',
            fill: { 'color': '#3CDD57' }
        });

        $(".totalCarbTracker .card-value").text(`${takenCarb}`)
        $(".totalCarbTracker .card-label").text(`of ${totalCarb} carb`)

        $('.card-proteinChart').circleProgress({
            startAngle: 1.5 * Math.PI,
            lineCap: 'round',
            value: resultProtein,
            emptyFill: '#D9D9D9',
            fill: { 'color': '#3CDD57' }
        });

        $(".totalProteinTracker .card-value").text(`${takenProtein}`)
        $(".totalProteinTracker .card-label").text(`of ${totalProtein} protein`)

        $('.card-fatChart').circleProgress({
            startAngle: 1.5 * Math.PI,
            lineCap: 'round',
            value: resultFat,
            emptyFill: '#D9D9D9',
            fill: { 'color': '#3CDD57' }
        });

        $(".totalFatTracker .card-value").text(`${takenFat}`)
        $(".totalFatTracker .card-label").text(`of ${totalFat} fat`)
    }
  </script>


@endhasanyrole

@endsection
