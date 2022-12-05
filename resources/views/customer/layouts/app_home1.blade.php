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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--global css-->
    {{-- <link href={{ asset('css/customer/css/globals.css')}} rel="stylesheet"/> --}}
    <link href={{ asset('css/globals.css')}} rel="stylesheet"/>

    <link href={{ asset('css/home.css')}} rel="stylesheet"/>
     <!--customer registeration-->
    <link href={{ asset('css/customer/css/customerRegisteration.css')}} rel="stylesheet"/>

    <!--customer login-->
    <link href="{{ asset('css/customer/css/customerLogin.css')}}" rel="stylesheet"/>

    <link href="{{ asset('css/customer/css/transactionChoice.css')}}" rel="stylesheet"/>
     <!--social media -->
     <link href="{{ asset('css/socialMedia.css')}}" rel="stylesheet"/>

    <!--social media -->
    <link href="{{ asset('css/socialMedia.css')}}" rel="stylesheet"/>

    <title>YC-fitness</title>
  </head>
  <body class="customer-loggedin-bg">
    <!-- <div class="customer-registeration-bgimg"> -->
        <script>
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        </script>

        @include('customer.training_center.layouts.header')
        <!--theme-->
        <script src="{{asset('js/theme.js')}}"></script>

        <div class="nav-overlay">
        </div>

    <!-- </div> -->
        <div class="customer-main-content-container">
            @yield('content')
        </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- Sweet Alert -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script src={{ asset('js/customer/js/customerRegisteration.js')}}></script>

    <!--nav bar-->
    <script src={{asset('js/navBar.js')}}></script>
    <script src={{asset('js/notify.js')}}></script>

    <script>
        // $(document).ready(function(){
            $( document ).ready(function() {
                $('.nav-icon').click(function(){
                        $('.notis-box-container').toggle()
                    })


            // })
         })
         var user_id = {{auth()->user()->id}};
                console.log(user_id);
                var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
                cluster: '{{env("PUSHER_APP_CLUSTER")}}',
                encrypted: true
                });
                var channel = pusher.subscribe('friend_request.'+ user_id);
                channel.bind('friendRequest', function(data) {
                console.log(data);
                alert(data);
                $.notify(data, "success",{ position:"left" });
                });
    </script>
    @stack('scripts')

    @push('scripts')

        <script>
             $(document).ready(function(){
                console.log("ready");


            $(window).scroll(function(){
                var scroll = $(window).scrollTop()
                if(scroll>50){
                    $('.index-page-header').addClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#ffffff")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#ffffff")
                    // $(".index-page-header select").css("color","#ffffff")
                    // $(".index-page-header select option").css("color","#000000")
                }else{
                    $('.index-page-header').removeClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#000000")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#000000")
                    // $(".index-page-header select").css("color","#000000")
                }
            })
        })


        </script>
    @endpush

  </body>
</html>

