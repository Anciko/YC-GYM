@extends('customer.training_center.layouts.app')

@section('content')
<a class="back-btn margin-top" href="{{ url()->previous() }}">
    <iconify-icon icon="bi:arrow-left" class="back-btn-icon"></iconify-icon>
</a>

<div class="customer-workout-plan-header-container">
    <h1>Get Lean At Home</h1>
    <div class="customer-workout-plan-header-details-container">


        <div class="customer-workout-plan-header-detail-container">
            <iconify-icon icon="fluent-emoji-flat:fire" class="customer-workout-plan-detail-icon"></iconify-icon>
            <p>Calories : <span>50</span></p>
        </div>
        <div class="customer-workout-plan-header-detail-container">
            <iconify-icon icon="noto:alarm-clock" class="customer-workout-plan-detail-icon"></iconify-icon>
            <p>Minutes : <span>15</span></p>
        </div>
    </div>

    <div class="customer-workout-video-parent-container">
        <div class="customer-workout-video" >
            <video id="workoutVideo" controls>
                <!-- <source src="../imgs/Y2Mate.is - 8 Best Bicep Exercises at Gym for Bigger Arms-3pm_L-H3Th4-720p-1655925997409.mp4" type="video/mp4"> -->
            </video>
        </div>

        <div class="customer-workout-video-progress">
            <!-- <div class="completed-workout"></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div> -->
        </div>

        <button style="display: none;" class="customer-workout-pause-btn">
            <iconify-icon icon="ant-design:pause-circle-outlined" class="customer-workout-pause-icon"></iconify-icon>

        </button>
        <button  class="customer-workout-play-btn">
            <iconify-icon icon="akar-icons:play" class="customer-workout-play-icon"></iconify-icon>
        </button>


        <h1 class="customer-workout-name"></h1>

        <p class="customer-workout-counter">
            <span class="customer-workout-min">00 :</span>
            <span class="customer-workout-sec">00</span></p>
    </div>
</div>

@endsection
@push('scripts')
    <script>

        $(document).ready(function(){


            $("#workoutVideo").on(
                "timeupdate",
                function(event){
                onTrackedVideoFrame(this.currentTime, this.duration);
            });

            $("#workoutVideo").on("play",function(){
                $(".customer-workout-play-btn").hide();
                $(".customer-workout-pause-btn").show();
            })

            $("#workoutVideo").on("pause",function(){
                $(".customer-workout-play-btn").show();
                $(".customer-workout-pause-btn").hide();
            })



            $(".customer-workout-play-btn").click(function(){
                $('#workoutVideo').trigger('play');
                $(".customer-workout-play-btn").hide()
                $(".customer-workout-pause-btn").show()
            })

            $(".customer-workout-pause-btn").click(function(){
                $('#workoutVideo').trigger('pause');
                $(".customer-workout-pause-btn").hide()
                $(".customer-workout-play-btn").show()
            })
        });


        function onTrackedVideoFrame(currentTime, duration){
            const counter = parseInt(duration) - parseInt(currentTime)
            if(duration){
                const mins = Math.floor(counter/60)
                const secs = Math.ceil(counter % 60)
                // var counterText
                // if(mins < 10 && secs < 10)
                const minText = mins < 10 ? `0${mins}` : `${mins}`
                const secText = secs < 10 ? `0${secs}` : `${secs}`
                $(".customer-workout-counter").text(`${minText} : ${secText}`); //Change #current to currentTime
            }else{
                $(".customer-workout-counter").text("00 : 00")
            }

        }

        let videoSource = new Array();
        let videoDuration=0;
        let sum=0;
        var tc_workout_video = @json($tc_workouts);
        videoSource=tc_workout_video;

        for(var a = 0;a < videoSource.length;a++){

            videoDuration=@json($tc_workouts)[a].time;
            sum+=videoDuration;
            videoSource[a] = '../../storage/upload/'+videoSource[a].video;
        }
        // videoSource[0] = 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4';
        // videoSource[1] = 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4';
        let i = 0; // global
        const videoCount = videoSource.length;
        const element = document.getElementById("workoutVideo");

        for(var k = 0;k < videoSource.length;k++){
            $(".customer-workout-video-progress").append(`<div></div>`)
        }


        document.getElementById('workoutVideo').addEventListener('ended', myHandler, false);

        videoPlay(0); // load the first video
        // ensureVideoPlays(); // play the video automatically

        function myHandler() {
            i++;
            if (i == videoCount) {
                //console.log(sum);
                alert("workout session ended");
                    //window.location.href = "{{ route('workout_complete',"sum")}}";
                    window.location.href = 'customer/workout_complete/' + sum;
                // i = 0;
                // videoPlay(i);
            } else {
                videoPlay(i);
            }
        }

        function videoPlay(videoNum) {
            element.setAttribute("src", videoSource[videoNum]);
            // element.autoplay = true;
            element.load();
            // console.log(element)
            $(".customer-workout-video-progress div")[i].classList.add("completed-workout")
        }

            // function ensureVideoPlays() {
            //     const video = document.getElementById('workoutVideo');

            //     if(!video) return;

            //     const promise = video.play();
            //     if(promise !== undefined){
            //         promise.then(() => {
            //             // Autoplay started
            //         }).catch(error => {
            //             // Autoplay was prevented.
            //             video.muted = true;
            //             video.play();
            //         });
            //     }
            // }
    </script>
@endpush

