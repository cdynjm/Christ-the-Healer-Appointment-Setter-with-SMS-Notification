@php

use App\Models\Cancel;
use App\Models\Appointments;
use App\Models\User;

date_default_timezone_set("Asia/Singapore"); 

$serving = Appointments::where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->first();

if(auth()->user()->type == 1) {
    $count = Cancel::where(['admin_read' => 1])->count();
    $cancel = Cancel::orderBy('created_at', 'DESC')->limit(8)->get();
    $appointment = Appointments::where(['status' => 0])->where(['date' => date('Y-m-d')])->count();
}

if(auth()->user()->type == 2) {
    $count = Cancel::where(['userid' => auth()->user()->Client->id])->where(['user_read' => 1])->count();
    $cancel = Cancel::where(['userid' => auth()->user()->Client->id])->orderBy('created_at', 'DESC')->limit(5)->get();
    $appointment = Appointments::where(['status' => 0])->where(['client_id' => auth()->user()->Client->id])->where(['date' => date('Y-m-d')])->count();
    $client_number = Appointments::where(['client_id' => auth()->user()->Client->id])->where(['status' => 0])->where(['date' => date('Y-m-d')])->orderBy('queue', 'ASC')->first();
    $button = User::where(['type' => 1])->first();
}
    


@endphp

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg me-0 bg-white sticky
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
        data-scroll="false">
    <div class="container-fluid py-1 px-0">
        <li class="nav-item d-xl-none d-flex align-items-center me-2">
            <a href="javascript:;" class="nav-link text-dark p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-dark"></i>
                    <i class="sidenav-toggler-line bg-dark"></i>
                    <i class="sidenav-toggler-line bg-dark"></i>
                </div>
            </a>
        </li>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-8">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-dark mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                
            </div>
            <ul class="navbar-nav  justify-content-end">

            <li class="nav-item dropdown pe-4 d-flex align-items-center">
                @if(auth()->user()->type == 1)
                    @if(auth()->user()->button == 0)
                        <span class="text-danger fs-4 fw-bolder">Serving Client is Disabled</span></span>
                    @endif
                    @if(auth()->user()->button == 1)
                        <span class="text-danger fw-bolder fs-5">Currently Serving Number: <span class="text-danger fw-bolder fs-1">@if($appointment != 0 ) {{ $serving->queue }} @else 0 @endif</span></span>
                    @endif
                @endif
                @if(auth()->user()->type == 2)
                    @if($button->button == 0)
                        @if($appointment != 0)
                            <span class="text-danger fw-bolder fs-4">Serving Client is Disabled</span></span>
                        @endif
                    @endif
                    @if($button->button == 1)
                        @if($appointment != 0)
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                                <li class="breadcrumb-item text-sm"><a class="text-dark" href="javascript:;"><span class="text-xs text-danger me-2">Currently Serving Number: <span class="text-danger fw-bolder text-lg">{{ $serving->queue }}</span></span></a></li>
                            </ol>
                            <h6 class="font-weight-bolder text-dark mb-0">Your Number: <span class="fw-bolder text-lg">{{ $client_number->queue }}</span></h6>
                        </nav>
                        @endif
                    @endif
                @endif
            </li>

            <li class="nav-item dropdown pe-4 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-dark p-0"
                        data-bs-toggle="dropdown" aria-expanded="false" id="notify-click">
                        <i class="fa fa-bell cursor-pointer"></i>
                        <span class="position-absolute top-10 mt-1 start-95 ms-2 translate-middle badge rounded-pill bg-danger" id="notify-count">
                            {{ $count }}
                        </span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 overflow-auto position-absolute" style="height: 400px;"
                        aria-labelledby="dropdownMenuButton">
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($cancel as $ap)
                        @php
                            $count += 1;
                        @endphp
                            <li class="mb-0 

                            @if(auth()->user()->type == 1)
                                @if($ap->admin_read == 1) bg-gray-200 @endif
                            @endif

                            @if(auth()->user()->type == 2)
                                @if($ap->user_read == 1) bg-gray-200 @endif
                            @endif
                            
                            ">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ asset('storage/photo/'.$ap->Client->photo) }}" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                @if(auth()->user()->type == 1)
                                                <span class="font-weight-normal text-sm">Appointment Cancelled</span> 
                                                <p class="text-xs mb-0 fw-bold">{{ $ap->Client->lastname }}, {{ $ap->Client->firstname }}</p>
                                                @endif
                                                @if(auth()->user()->type == 2)
                                                <span class="font-weight-normal text-sm">Your Appointment</span>
                                                @endif
                                                <p class="text-xs mt-2 mb-2 text-wrap">Reason: {{ $ap->reason }}</p>
                                                <p class="text-xs mt-2 mb-2"></p>
                                                <span class="badge badge-sm bg-gradient-danger text-capitalize mt-1">Cancelled</span>
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ date('M d, Y - h:i a', strtotime($ap->created_at)) }}
                                            </p>
                                            <hr class="mb-0">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        @if($count == 0)
                        <li class="text-center">
                            <span class="text-center">No data available</span>
                        </li>
                        @endif
                    </ul>
                </li>

            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-dark p-0"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        
                        @if(Auth::user()->type == 1)
                            @if(auth()->user()->photo == null)
                            <div class="text-center" style="text-align:center;">
                                <img src="{{ asset('storage/icon/profile-placeholder.jpg') }}" class="avatar avatar-sm rounded-circle" alt="user1">
                            </div>
                            @else
                            <div class="text-center" style="text-align:center;">
                                <img src="{{ asset('storage/photo/'.auth()->user()->photo) }}" class="avatar avatar-sm rounded-circle" alt="user1" >
                            </div>
                            @endif
                        @endif

                        @if(Auth::user()->type == 2)
                            @if(auth()->user()->Client->photo == null)
                            <div class="text-center" style="text-align:center;">
                                <img src="{{ asset('storage/icon/profile-placeholder.jpg') }}" class="avatar avatar-sm rounded-circle" alt="user1">
                            </div>
                            @else
                            <div class="text-center" style="text-align:center;">
                                <img src="{{ asset('storage/photo/'.auth()->user()->Client->photo) }}" class="avatar avatar-sm rounded-circle" alt="user1">
                            </div>
                            @endif
                        @endif
                        <span class="d-block text-center">
                            @if(Auth::user()->type == 1)
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            @endif
                            @if(Auth::user()->type == 2)
                                {{ Auth::user()->Client->firstname }} {{ Auth::user()->Client->lastname }} 
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 mt-0 me-sm-n4" style="height: 120px;"
                        aria-labelledby="dropdownMenuButton">
                        <a class="nav-link text-dark p-0 m-0 ms-2 mt-1" href="{{ route('profile') }}">
                                <i class="fas fa-user-circle me-1 text-lg"></i>
                               Profile
                            </a>
                            <hr>
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link text-dark p-0 m-0 ms-2 mt-1">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>
                                Log Out
                            </a>
                        </form>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
