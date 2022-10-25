@extends('layouts.app')
@section('workoutplan-active','active')

@section('content')

<a href="{{route('workoutview')}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-arrow-left-long"></i>&nbsp; Back</a>

<div class="container d-flex justify-content-center">


    <div class="card my-3 shadow rounded" style="max-width: 40%">
        <div class="card-header text-center"><h3>Edit Workouts</h3></div>
        <div class="card-body">

          <form class="referee-remark-input-container" action="{{route('workoutupdate',[$data->id])}}" enctype="multipart/form-data" method = "POST">
            @csrf

            <div class="offset-1 col-md-10" class="previewvideo">
                <video width="100%" height="200px" controls>
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="row g-3 mb-3">
                <div class="form-floating col-md-6">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Workout Name" name="workoutname" value="{{$data->workout_name}}">
                    <label for="floatingInput">Workout Name</label>
                </div>
                <div class="form-floating col-md-6">
                    <select class="form-select" aria-label="Default select example" placeholder="Member level" name="memberType">
                        <option value=""></option>
                        @foreach ($member as $members)
                        @if ($members->member_type == "Platinum")
                            <option value="{{$members->member_type}}" id="platinum">{{$members->member_type}}</option>
                        @elseif($members->member_type == "Gold"){
                            <option value="{{$members->member_type}}" id="gold">{{$members->member_type}}</option>
                        }
                        @endif

                        @endforeach

                    </select>
                    <label for="floatingInput">Workout level select</label>
                </div>
            </div>

              <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="number" class="form-control" id="floatingPassword" placeholder="Calories" name="calories" value="{{$data->calories}}">
                        <label for="floatingPassword">Calories</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <select class="form-select" aria-label="Default select example" placeholder="Workout level select" name="workoutlevel">
                            <option value="{{$data->workout_level}}"></option>
                            <option value="Beginner" id="beginner">Beginner</option>
                            <option value="Advance" id="advance">Advance</option>
                            <option value="Professional" id="professional">Professional</option>
                        </select>
                        <label for="floatingInput">Workout level select</label>
                    </div>
              </div>

              <div class="d-flex justify-content mb-3">
                <label for="">Gender Type : &nbsp;</label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label"><input class="form-check-input" type="radio" name="gendertype" value="male" id="male">
                    Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label"><input class="form-check-input" type="radio" name="gendertype" id="female" value="female">Female</label>
                  </div>
                  <div class="form-check form-check-inline">

                    <label class="form-check-label" for="inlineRadio3"> <input class="form-check-input" type="radio" name="gendertype" id="both" value="both"> Both</label>
                  </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="form-floating col-md-6">
                        <select class="form-select" aria-label="Default select example" placeholder="Select workout day" name="workoutday">
                            <option value=""></option>
                            <option value="Monday" id="Monday">Monday</option>
                            <option value="Tuesday" id="Tuesday">Tuesday</option>
                            <option value="Wednesday" id="Wednesday">Wednesday</option>
                            <option value="Thursday" id="Thursday">Thursday</option>
                            <option value="Friday" id="Friday">Friday</option>
                            <option value="Saturday" id="Saturday">Saturday</option>
                            <option value="Sunday" id="Sunday">Sunday</option>
                        </select>
                        <label for="floatingInput">Select Workout day</label>
                </div>
                <div class="form-floating col-md-6">
                        <select class="form-select" aria-label="Default select example" placeholder="Select workout place" name="workoutplace">
                            <option value=""></option>
                            <option value="Gym" id="Gym">Gym</option>
                            <option value="Home" id="Home">Home</option>
                        </select>
                        <label for="floatingInput">Select Workout Place</label>
                </div>
          </div>


              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Upload photo</label>
                <input type="file" class="form-control" id="inputGroupFile01" name="image">
                <input type="input-group-text" value="{{$data->image}}" disabled>
              </div>

              <div class="input-group mb-3">
                <label class="input-group-text"> Upload video
                <input type="file" class="form-control" name="video" id="videoUpload">
                <input type="input-group-text" value="{{$data->video}}" disabled>
                <input type="hidden" name="videoTime" value="" class="video-duration">
            </label>
              </div>


            <div class="referee-remark-input-btns-container">
                <button type ="submit" class="btn btn-primary">Update</button>
                <a href="{{route('workoutview')}}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
        </div>
    </div>



</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        var user = @json($data);

        if (user.gender_type == 'male') {
            $("#male").attr('checked', 'checked');
        }else if(user.gender_type == 'female'){
            $("#female").attr('checked', 'checked');
        }else{
            $("#both").attr('checked', 'checked');
        }

        if (user.member_type == 'Platinum') {
            $("#platinum").attr('selected',true);
        } else {
            $("#gold").attr('selected',true);
        }

        if(user.workout_level == 'Beginner'){
            var select = $("#beginner");
            select.attr('selected',true);
        }else if(user.workout_level == 'Advance'){
            var select = $("#advance");
            select.attr('selected',true);
        }else if(user.workout_level == 'Professional'){
            var select = $("#professional");
            select.attr('selected',true);
        }
        if (user.day == 'Monday') {
            $("#Monday").attr('selected',true);
        } else if(user.day == 'Tuesday'){
            $("#Tuesday").attr('selected',true);
        }else if(user.day == 'Wednesday'){
            $("#Wednesday").attr('selected',true);
        }else if(user.day == 'Thursday'){
            $("#Thursday").attr('selected',true);
        }else if(user.day == 'Friday'){
            $("#Friday").attr('selected',true);
        }else if(user.day == 'Saturday'){
            $("#Saturday").attr('selected',true);
        }else if(user.day == 'Sunday'){
            $("#Sunday").attr('selected',true);
        }

        if (user.place == 'Gym') {
            $("#Gym").attr('selected',true);
        } else {
            $("#Home").attr('selected',true);
        }
    })

document.getElementById("videoUpload")
    .onchange = function(event) {
      var file = event.target.files[0];
      console.log(file);
      var blobURL = URL.createObjectURL(file);
      var video = document.querySelector("video");
      video.src = blobURL;
      video.addEventListener('loadedmetadata', function () {
        var minutes = Math.floor(video.duration / 60) %60;
        var seconds = Math.floor(video.duration % 60);
        document.querySelector('.video-duration').value = minutes
        });

    }

</script>
@endpush
