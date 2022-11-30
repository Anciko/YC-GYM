<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--iconify-->
    <script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!--global css-->
    {{-- <link href={{ asset('css/customer/css/globals.css')}} rel="stylesheet"/> --}}
    <link href={{ asset('css/globals.css')}} rel="stylesheet"/>
    <link href={{ asset('css/customer/css/customerTrainingCenter.css')}} rel="stylesheet"/>
    <link href={{ asset('css/customer/css/customerProfile.css')}} rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    {{-- calender --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.6.4/zabuto_calendar.min.css" integrity="sha512-WRcIo/ywVhLZ5L/zO19ph3+xFT0fL4OZEQeP5oxbeUgcXvlWsDUuHq0ODulhxi68CaWQ9XEy1g5ictPkaxnfow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>YC-Training Center</title>
  </head>
  <body class="customer-loggedin-bg">
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    </script>


    @include('customer.training_center.layouts.header')

    <!--theme-->
    <script src="{{asset('js/theme.js')}}"></script>

    <div class="nav-overlay">
    </div>

    <div class="customer-main-content-container">
        @yield('content')
    </div>

    {{-- pusher --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- Optional JavaScript; choose one of the two! -->

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/emoji-picker.min.js" integrity="sha512-EDnYyP0SRH/j5K7bYQlIQCwjm8dQtwtsE+Xt0Oyo9g2qEPDlwE+1fbvKqXuCoMfRR/9zsjSBOFDO6Urjefo28w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="../js/emoji.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js" integrity="sha512-6kvhZ/39gRVLmoM/6JxbbJVTYzL/gnbDVsHACLx/31IREU4l3sI7yeO0d4gw8xU5Mpmm/17LMaDHOCf+TvuC2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.6.4/zabuto_calendar.min.js" integrity="sha512-HvdZfHEdDyE5r66O4BLg+GE/kCwpviitPcq/H5L2gmr1P+tqDKBUfY9UP7ll6Idle+zeulQDXYYKbTiiUwLF+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
     <!--nav bar-->
     <script src={{asset('js/navBar.js')}}></script>

      <!--calendar-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.6.4/zabuto_calendar.min.js" integrity="sha512-HvdZfHEdDyE5r66O4BLg+GE/kCwpviitPcq/H5L2gmr1P+tqDKBUfY9UP7ll6Idle+zeulQDXYYKbTiiUwLF+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <!--chart js-->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
                    $( document ).ready(function() {
                $('.nav-icon').click(function(){
                        $('.notis-box-container').toggle()
                    })


            // })
                console.log("ready");
                var user_id = {{auth()->user()->id}};
                console.log(user_id);
                var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
                cluster: '{{env("PUSHER_APP_CLUSTER")}}',
                encrypted: true
                });

                var channel = pusher.subscribe('friend_request.'+user_id);
                channel.bind('App\\Events\\Friend_Request', function(data) {
                console.log(data);
                $.notify(data, "success",{ position:"left" });
                });
         })
    </script>

    @stack('scripts')

  </body>
</html>
