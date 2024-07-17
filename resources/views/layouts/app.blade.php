<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/clinic-logo.png') }}">
    <title>
        {{ ENV('APP_NAME') }}
    </title>
     <!--     Fonts and icons     -->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
               
            @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
                
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="{{asset('storage/js/app.js')}}"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    @stack('js');

    <link href="{{asset('storage/css/fullcalendar.css')}}" rel='stylesheet' />
    <link href="{{asset('storage/css/fullcalendar.print.css')}}" rel='stylesheet' media='print' />
    <script src="{{asset('storage/js/jquery-ui.custom.min.js')}}" ></script>
    <script src="{{asset('storage/js/fullcalendar.js')}}" ></script>
    <script src="{{asset('storage/js/swiper-bundle.min.js')}}" ></script>
</body>

</html>

@php
  $maintenance = 0;
@endphp

@if($maintenance == 1)
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Server is under maintenance',
          html: '<span class="text-danger">You are not authorized to access this page.</span> <br><br> <span class="text-sm">To ensure the continued stability and security of our systems, we have scheduled routine maintenance on our servers. During this maintenance window, there will be a temporary interruption of services. <br><br>We appreciate your understanding and cooperation as we work to enhance the reliability and security of this system.</span>',
          allowOutsideClick: false,
          showCancelButton: false,
          showConfirmButton: false
      }).then(function(){ 
            location.reload();
        });
  </script>
@endif

@if(Auth::check())
    @if(auth()->user()->type == 2) 
        @if(auth()->user()->status == 1) 

        <script>
            var data = true;
            Swal.fire({
                icon: 'error',
                title: 'Account is not verified',
                text: "You do not have permission to access this page. Wait for an SMS confirmation for you to login your account.",
                confirmButtonColor: "#3a57e8",
                confirmButtonText: 'Logout',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/logout',
                        data: { data },
                        dataType: 'json',
                        success: function(response)
                        {
                            location.href = "/login";
                        }
                    })
                }
            })
        </script>
        @endif
    @endif
@endif
