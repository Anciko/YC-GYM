@extends('customer.training_center.layouts.app')

@section('content')
@hasanyrole('Diamond')
@include('sweetalert::alert')
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
        </div>
        <form>
            <input type="text" id="breakfast" placeholder="Search for food...">
        </form>

        <div class="customer-food-tracker-checkboxes-container breakfast_container">
        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Lunch</h1>

        </div>
        <form>
            <input type="text" id="launch" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container lunch_container">

        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Snack</h1>
        </div>
        <form>
            <input type="text" id="snack" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container snack_container">

        </div>
    </div>
    <div class="customer-food-tracker-container">
        <div class="customer-food-tracker-header">
            <h1>Dinner</h1>
            <!-- <p>Total : <span>600cal</span></p> -->
        </div>
        <form>
            <input type="text" id="dinner" placeholder="Search for food...">
        </form>
        <div class="customer-food-tracker-checkboxes-container dinner_container">

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

<button class="customer-addfood-confirm-btn customer-primary-btn save">
    Save And Continue
</button>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  {{-- <script src="{{asset('js/customer/js/meal.js')}}"></script> --}}
  <script>
  $(document).ready(function() {
      var foodList = []
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


      $(".save").click(function(){
        console.log(foodList,"final");

        $.ajax({
                        url : 'foodList',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:  {"foodList":foodList},
                        success   : function(data) {
                            console.log(data);
                            swal("Success!", "Good Job!", "success");
                        },
                        // error : function(err){
                        //     console.log(err)
                        // }
                    });


      });


            $('#breakfast').on('keyup', function(){
                        search();
            });
              search();
              function search(){
                  var keyword = $('#breakfast').val();
                  var search_url = "{{route('customer/training_center/breakfast')}}";
                 // search_url = search_url.replace(':id', group_id);
                  $.post(search_url,
                  {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                      keyword:keyword
                  },
                  function(data){
                      table_post_row(data);
                      console.log("breakfast",data);
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
                              type : 'Breakfast',
                              name : res.breakfast[i].name,
                              cal : res.breakfast[i].calories,
                              carb : res.breakfast[i].carbohydrates,
                              protein : res.breakfast[i].protein,
                              fat : res.breakfast[i].fat,
                              servings : 1
                          }
                          console.log(foodList)
                          console.log(foodObj)

                      var rowIdx = 0;
                      if(foodList.length === 0){
                          foodList.push(foodObj)
                      }
                      else{
                          var found = false
                          $.each(foodList, function(index,value) {
                              console.log(foodObj.id, value.id)
                              if(value.id === foodObj.id){
                                  found = true
                                  value.servings += 1
                                  console.log("same food")
                                  $(".customer-added-food-list-container tbody tr").each(function(){
                                      var idCount = $(`[id=${$(this).attr("id")}]`);
                                      console.log(idCount.length,"idcount");
                                      if (idCount.length > 0){
                                          $(`[id=${$(this).attr("id")}]`).remove();
                                      }

                                  })
                                  return false
                              }
                          })
                          if(found === false){
                              foodList.push(foodObj)
                          }
                      }
                      console.log(foodList)
                          $.each(foodList, function(index,value){
                              $(".customer-added-food-list-container tbody").append(`
                              <tr id="${value.id}">
                                  <td>${index + 1}</td>
                                  <td>${value.name}</td>
                                  <td>${value.cal}</td>
                                  <td>${value.carb}</td>
                                  <td>${value.protein}</td>
                                  <td>${value.fat}</td>
                                  <td>
                                      <input type="number" class="servingsInput" value=${value.servings}>
                                  </td>
                                  <td>
                                      <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
                                  </td>
                              </tr>
                          `)
                          })
                          $(".servingsInput").keyup(function(){
                              const child = $(this).closest('tr');
                              // console.log(child)
                              child.each(function () {
                              // Getting <tr> id.
                              var id = $(this).attr('id');
                              foodList = foodList.map(function(item) {
                                  console.log(item.id.toString(), id.toString())
                                  if(item.id.toString() === id.toString()){
                                      const servingsInputValue = $(".servingsInput").val()
                                      if(servingsInputValue === ""){
                                          // console.log("empty")
                                          $(".servingsInput").val(1)
                                          item.servings = 1
                                      }else{
                                          item.servings = parseInt(servingsInputValue)
                                      }
                                  }
                                  return item

                              });
                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                              });
                          })
                          $('.customer-add-food-delete-btn').on('click',  function () {
                             const child = $(this).closest('tr');
                              child.each(function () {
                                  // Getting <tr> id.
                                  var id = $(this).attr('id');
                                  var filterednames = foodList.filter(function(item) {
                                      // console.log(item.id.toString(), id.toString())
                                      return item.id.toString() !== id.toString()
                                  });
                                  // console.log(filterednames)
                                  foodList = filterednames
                              });
                              // Removing the current row.
                              $(this).closest('tr').remove();

                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                          });
                      circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                   });
              }
              //breakfast end
              //lunch
              $('#lunch').on('keyup', function(){
                  lunchsearch();
              });
              lunchsearch();
              function lunchsearch(){
                  var keyword = $('#lunch').val();
                  var search_url = "{{route('customer/training_center/lunch')}}";
                 // search_url = search_url.replace(':id', group_id);
                  $.post(search_url,
                  {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                      keyword:keyword
                  },
                  function(data){
                      table_post_row_lunch(data);
                      console.log("lunch",data);
                  });
              }
              // table row with ajax
              function table_post_row_lunch(res){
              let htmlView = '';
              if(res.lunch.length <= 0){
                  htmlView+= `
                     No data found.
                  `;
              }
              for(let i = 0; i < res.lunch.length; i++){
                  id = res.lunch[i].id;

                  htmlView += `
                      <div class="customer-food-tracker-checkbox">
                          <div class="customer-food-tracker-checkbox-label">
                              <p>`+res.lunch[i].name+`</p>
                              <span>`+res.lunch[i].calories+`</span>
                          </div>

                       <button class="customer-food-tracker-checkbox-btn lunch_add" data-id = `+res.lunch[i].id+` value=`+i+` >Add</button>
                       </div>
                              `
                  }


                  $('.lunch_container').html(htmlView);
                  $(".lunch_add").click(function(){
                      $(".customer-added-food-list-container tbody").empty()
                      var id = $(this).data('id');
                      var i = $(this).val();
                      foodObj = {
                              id : res.lunch[i].id,
                              type : 'lunch',
                              name : res.lunch[i].name,
                              cal : res.lunch[i].calories,
                              carb : res.lunch[i].carbohydrates,
                              protein : res.lunch[i].protein,
                              fat : res.lunch[i].fat,
                              servings : 1
                          }
                          console.log(foodList)
                          console.log(foodObj)

                      var rowIdx = 0;
                      if(foodList.length === 0){
                          foodList.push(foodObj)
                      }
                      else{
                          var found = false
                          $.each(foodList, function(index,value) {
                              console.log(foodObj.id, value.id)
                              if(value.id === foodObj.id){
                                  found = true
                                  value.servings += 1
                                  console.log("same food")
                                  $(".customer-added-food-list-container tbody tr").each(function(){
                                      var idCount = $(`[id=${$(this).attr("id")}]`);
                                      console.log(idCount.length,"idcount");
                                      if (idCount.length > 0){
                                          $(`[id=${$(this).attr("id")}]`).remove();
                                      }

                                  })
                                  return false
                              }
                          })
                          if(found === false){
                              foodList.push(foodObj)
                          }
                      }
                      console.log(foodList)
                          $.each(foodList, function(index,value){
                              $(".customer-added-food-list-container tbody").append(`
                              <tr id="${value.id}">
                                  <td>${index + 1}</td>
                                  <td>${value.name}</td>
                                  <td>${value.cal}</td>
                                  <td>${value.carb}</td>
                                  <td>${value.protein}</td>
                                  <td>${value.fat}</td>
                                  <td>
                                      <input type="number" class="servingsInput" value=${value.servings}>
                                  </td>
                                  <td>
                                      <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
                                  </td>
                              </tr>
                          `)
                          })
                          $(".servingsInput").keyup(function(){
                              const child = $(this).closest('tr');
                              // console.log(child)
                              child.each(function () {
                              // Getting <tr> id.
                              var id = $(this).attr('id');
                              foodList = foodList.map(function(item) {
                                  console.log(item.id.toString(), id.toString())
                                  if(item.id.toString() === id.toString()){
                                      const servingsInputValue = $(".servingsInput").val()
                                      if(servingsInputValue === ""){
                                          // console.log("empty")
                                          $(".servingsInput").val(1)
                                          item.servings = 1
                                      }else{
                                          item.servings = parseInt(servingsInputValue)
                                      }
                                  }
                                  return item

                              });
                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                              });
                          })
                          $('.customer-add-food-delete-btn').on('click',  function () {
                             const child = $(this).closest('tr');
                              child.each(function () {
                                  // Getting <tr> id.
                                  var id = $(this).attr('id');
                                  var filterednames = foodList.filter(function(item) {
                                      // console.log(item.id.toString(), id.toString())
                                      return item.id.toString() !== id.toString()
                                  });
                                  // console.log(filterednames)
                                  foodList = filterednames
                              });
                              // Removing the current row.
                              $(this).closest('tr').remove();

                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                          });
                      circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                   });
                }
              //lunch end
                           //dinner start
              $('#dinner').on('keyup', function(){
                  dinnersearch();
              });
              dinnersearch();
              function dinnersearch(){
                  var keyword = $('#dinner').val();
                  var search_url = "{{route('customer/training_center/dinner')}}";
                 // search_url = search_url.replace(':id', group_id);
                  $.post(search_url,
                  {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                      keyword:keyword
                  },
                  function(data){
                      table_post_row_dinner(data);
                      console.log(data);
                  });
              }
              // table row with ajax
              function table_post_row_dinner(res){
              let htmlView = '';
              if(res.dinner.length <= 0){
                  htmlView+= `
                     No data found.
                  `;
              }
              for(let i = 0; i < res.dinner.length; i++){
                  id = res.dinner[i].id;

                  htmlView += `
                      <div class="customer-food-tracker-checkbox">
                          <div class="customer-food-tracker-checkbox-label">
                              <p>`+res.dinner[i].name+`</p>
                              <span>`+res.dinner[i].calories+`</span>
                          </div>

                       <button class="customer-food-tracker-checkbox-btn dinner_add" data-id = `+res.dinner[i].id+` value=`+i+` >Add</button>
                       </div>
                              `
                  }


                  $('.dinner_container').html(htmlView);
                  $(".dinner_add").click(function(){
                      $(".customer-added-food-list-container tbody").empty()
                      var id = $(this).data('id');
                      var i = $(this).val();
                      foodObj = {
                              id : res.dinner[i].id,
                              type : 'dinner',
                              name : res.dinner[i].name,
                              cal : res.dinner[i].calories,
                              carb : res.dinner[i].carbohydrates,
                              protein : res.dinner[i].protein,
                              fat : res.dinner[i].fat,
                              servings : 1
                          }
                          console.log(foodList)
                          console.log(foodObj)

                      var rowIdx = 0;
                      if(foodList.length === 0){
                          foodList.push(foodObj)
                      }
                      else{
                          var found = false
                          $.each(foodList, function(index,value) {
                              console.log(foodObj.id, value.id)
                              if(value.id === foodObj.id){
                                  found = true
                                  value.servings += 1
                                  console.log("same food")
                                  $(".customer-added-food-list-container tbody tr").each(function(){
                                      var idCount = $(`[id=${$(this).attr("id")}]`);
                                      console.log(idCount.length,"idcount");
                                      if (idCount.length > 0){
                                          $(`[id=${$(this).attr("id")}]`).remove();
                                      }

                                  })
                                  return false
                              }
                          })
                          if(found === false){
                              foodList.push(foodObj)
                          }
                      }
                      console.log(foodList)
                          $.each(foodList, function(index,value){
                              $(".customer-added-food-list-container tbody").append(`
                              <tr id="${value.id}">
                                  <td>${index + 1}</td>
                                  <td>${value.name}</td>
                                  <td>${value.cal}</td>
                                  <td>${value.carb}</td>
                                  <td>${value.protein}</td>
                                  <td>${value.fat}</td>
                                  <td>
                                      <input type="number" class="servingsInput" value=${value.servings}>
                                  </td>
                                  <td>
                                      <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
                                  </td>
                              </tr>
                          `)
                          })
                          $(".servingsInput").keyup(function(){
                              const child = $(this).closest('tr');
                              // console.log(child)
                              child.each(function () {
                              // Getting <tr> id.
                              var id = $(this).attr('id');
                              foodList = foodList.map(function(item) {
                                  console.log(item.id.toString(), id.toString())
                                  if(item.id.toString() === id.toString()){
                                      const servingsInputValue = $(".servingsInput").val()
                                      if(servingsInputValue === ""){
                                          // console.log("empty")
                                          $(".servingsInput").val(1)
                                          item.servings = 1
                                      }else{
                                          item.servings = parseInt(servingsInputValue)
                                      }
                                  }
                                  return item

                              });
                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                              });
                          })
                          $('.customer-add-food-delete-btn').on('click',  function () {
                             const child = $(this).closest('tr');
                              child.each(function () {
                                  // Getting <tr> id.
                                  var id = $(this).attr('id');
                                  var filterednames = foodList.filter(function(item) {
                                      // console.log(item.id.toString(), id.toString())
                                      return item.id.toString() !== id.toString()
                                  });
                                  // console.log(filterednames)
                                  foodList = filterednames
                              });
                              // Removing the current row.
                              $(this).closest('tr').remove();

                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                          });
                      circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                   });
              }

              //snack
              $('#snack').on('keyup', function(){
                snacksearch();
              });
              snacksearch();
              function snacksearch(){
                  var keyword = $('#snack').val();
                  var search_url = "{{route('customer/training_center/snack')}}";
                 // search_url = search_url.replace(':id', group_id);
                  $.post(search_url,
                  {
                      _token: $('meta[name="csrf-token"]').attr('content'),
                      keyword:keyword
                  },
                  function(data){
                      table_post_row_snack(data);
                      console.log(data);
                  });
              }
              // table row with ajax
              function table_post_row_snack(res){
              let htmlView = '';
              if(res.snack.length <= 0){
                  htmlView+= `
                     No data found.
                  `;
              }
              for(let i = 0; i < res.snack.length; i++){
                  id = res.snack[i].id;

                  htmlView += `
                      <div class="customer-food-tracker-checkbox">
                          <div class="customer-food-tracker-checkbox-label">
                              <p>`+res.snack[i].name+`</p>
                              <span>`+res.snack[i].calories+`</span>
                          </div>

                       <button class="customer-food-tracker-checkbox-btn snack_add" data-id = `+res.snack[i].id+` value=`+i+` >Add</button>
                       </div>
                              `
                  }


                  $('.snack_container').html(htmlView);
                  $(".snack_add").click(function(){
                      $(".customer-added-food-list-container tbody").empty()
                      var id = $(this).data('id');
                      var i = $(this).val();
                      foodObj = {
                              id : res.snack[i].id,
                              type : 'snack',
                              name : res.snack[i].name,
                              cal : res.snack[i].calories,
                              carb : res.snack[i].carbohydrates,
                              protein : res.snack[i].protein,
                              fat : res.snack[i].fat,
                              servings : 1
                          }
                          console.log(foodList)
                          console.log(foodObj)

                      var rowIdx = 0;
                      if(foodList.length === 0){
                          foodList.push(foodObj)
                      }
                      else{
                          var found = false
                          $.each(foodList, function(index,value) {
                              console.log(foodObj.id, value.id)
                              if(value.id === foodObj.id){
                                  found = true
                                  value.servings += 1
                                  console.log("same food")
                                  $(".customer-added-food-list-container tbody tr").each(function(){
                                      var idCount = $(`[id=${$(this).attr("id")}]`);
                                      console.log(idCount.length,"idcount");
                                      if (idCount.length > 0){
                                          $(`[id=${$(this).attr("id")}]`).remove();
                                      }

                                  })
                                  return false
                              }
                          })
                          if(found === false){
                              foodList.push(foodObj)
                          }
                      }
                      console.log(foodList)
                          $.each(foodList, function(index,value){
                              $(".customer-added-food-list-container tbody").append(`
                              <tr id="${value.id}">
                                  <td>${index + 1}</td>
                                  <td>${value.name}</td>
                                  <td>${value.cal}</td>
                                  <td>${value.carb}</td>
                                  <td>${value.protein}</td>
                                  <td>${value.fat}</td>
                                  <td>
                                      <input type="number" class="servingsInput" value=${value.servings}>
                                  </td>
                                  <td>
                                      <button type="button" class="customer-add-food-delete-btn customer-red-btn">Delete</button>
                                  </td>
                              </tr>
                          `)
                          })
                          $(".servingsInput").keyup(function(){
                              const child = $(this).closest('tr');
                              // console.log(child)
                              child.each(function () {
                              // Getting <tr> id.
                              var id = $(this).attr('id');
                              foodList = foodList.map(function(item) {
                                  console.log(item.id.toString(), id.toString())
                                  if(item.id.toString() === id.toString()){
                                      const servingsInputValue = $(".servingsInput").val()
                                      if(servingsInputValue === ""){
                                          // console.log("empty")
                                          $(".servingsInput").val(1)
                                          item.servings = 1
                                      }else{
                                          item.servings = parseInt(servingsInputValue)
                                      }
                                  }
                                  return item

                              });
                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                              });
                          })
                          $('.customer-add-food-delete-btn').on('click',  function () {
                             const child = $(this).closest('tr');
                              child.each(function () {
                                  // Getting <tr> id.
                                  var id = $(this).attr('id');
                                  var filterednames = foodList.filter(function(item) {
                                      // console.log(item.id.toString(), id.toString())
                                      return item.id.toString() !== id.toString()
                                  });
                                  // console.log(filterednames)
                                  foodList = filterednames
                              });
                              // Removing the current row.
                              $(this).closest('tr').remove();

                              circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                          });
                      circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)
                   });
              }














      circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList)

  });

  function circleCounter(totalCal,takenCal,resultCal,totalCarb,takenCarb,resultCarb,totalProtein,takenProtein,resultProtein,totalFat,takenFat,resultFat,foodList){
       // takenCal = 0
       if(foodList.length === 0){
                              // takenCal = 0
      }else{
          var sum = 0
          for(var i =0;i < foodList.length;i++){
              console.log(foodList[i])
              sum = sum + (foodList[i].cal * foodList[i].servings)
          }

          takenCal = sum
      }
      resultCal = takenCal / totalCal;

      // takenCarb = 0
      if(foodList.length === 0){
          // takenCarb = 0
      }else{
          var sum = 0
          for(var i =0;i < foodList.length;i++){
              console.log(foodList[i])
              sum = sum + (foodList[i].carb * foodList[i].servings)
          }

          takenCarb = sum
      }
      resultCarb = takenCarb/totalCarb


      // takenProtein = 0
      if(foodList.length === 0){
          // takenProtein = 0
      }else{
          var sum = 0
          for(var i =0;i < foodList.length;i++){
              console.log(foodList[i])
              sum = sum + (foodList[i].protein * foodList[i].servings)
          }

          takenProtein = sum
      }
      resultProtein = takenProtein/totalProtein


      // takenFat = 0
      if(foodList.length === 0){
          // takenFat = 0
      }else{
          var sum = 0
          for(var i =0;i < foodList.length;i++){
              console.log(foodList[i])
              sum = sum + (foodList[i].fat * foodList[i].servings)
          }

          takenFat = sum
      }
      resultFat = takenFat/totalFat


      // add circle chart
      $('.card-calChart').circleProgress({
          startAngle: 1.5 * Math.PI,
          lineCap: 'round',
          value: resultCal,
          emptyFill: '#D9D9D9',
          // fill: { 'color': '#3CDD57' }
      });
      $(".totalCalTracker .card-value").text(`${takenCal}`)
      $(".totalCalTracker .card-label").text(`of ${totalCal} cal`)


      $('.card-carbChart').circleProgress({
          startAngle: 1.5 * Math.PI,
          lineCap: 'round',
          value: resultCarb,
          emptyFill: '#D9D9D9',
          // fill: { 'color': '#3CDD57' }
      });

      $(".totalCarbTracker .card-value").text(`${takenCarb}`)
      $(".totalCarbTracker .card-label").text(`of ${totalCarb} carb`)

      $('.card-proteinChart').circleProgress({
          startAngle: 1.5 * Math.PI,
          lineCap: 'round',
          value: resultProtein,
          emptyFill: '#D9D9D9',
          // fill: { 'color': '#3CDD57' }
      });

      $(".totalProteinTracker .card-value").text(`${takenProtein}`)
      $(".totalProteinTracker .card-label").text(`of ${totalProtein} protein`)

      $('.card-fatChart').circleProgress({
          startAngle: 1.5 * Math.PI,
          lineCap: 'round',
          value: resultFat,
          emptyFill: '#D9D9D9',
          // fill: { 'color': '#3CDD57' }
      });

      $(".totalFatTracker .card-value").text(`${takenFat}`)
      $(".totalFatTracker .card-label").text(`of ${totalFat} fat`)
  }
</script>
@endhasanyrole

@endsection
