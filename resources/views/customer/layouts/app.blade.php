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
    <link href={{ asset('css/customer/css/globals.css')}} rel="stylesheet"/>

     <!--customer registeration-->
    <link href={{ asset('css/customer/css/customerRegisteration.css')}} rel="stylesheet"/>

    <!--customer login-->
    <link href="{{ asset('css/customer/css/customerLogin.css')}}" rel="stylesheet"/>

    <link href="{{ asset('css/customer/css/transactionChoice.css')}}" rel="stylesheet"/>

    <title>Hello, world!</title>
  </head>
  <body class="customer-registeration-bgimg">
    <!-- <div class="customer-registeration-bgimg"> -->

        <div class="overlay">

        </div>
        @include('customer.layouts.header')

    <!-- </div> -->
        <div class="customer-main-content-container">
            @yield('content')
        </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- Sweet Alert -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>

    <script src={{ asset('js/customer/js/customerRegisteration.js')}}></script>

    <!--theme-->
    <script src="{{asset('js/theme.js')}}"></script>



    @stack('scripts')

  </body>
</html>
