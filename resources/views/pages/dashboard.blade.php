@extends('components.modals.feedback-modal')
@extends('pages.calendar.calendar-script')
@extends('components.modals.appointment-modal')
@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            @if(auth()->user()->type == 1)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info mt-2 text-center rounded">
                                    <i class="fa-solid fa-users text-lg opacity-10"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('page', ['page' => 'validated-clients']) }}">
                                        <p class="text-sm mb-0 font-weight-bold">Validated</p>
                                        <h4 class="font-weight-bolder">
                                            {{ $count_clients }}
                                        </h4>
                                        <p class="mb-0 text-xs">
                                            Clients
                                        </p>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger mt-2 text-center rounded">
                                    <i class="fa-solid fa-user-pen text-lg opacity-10"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('page', ['page' => 'pending-clients']) }}">
                                        <p class="text-sm mb-0 font-weight-bold">Pending</p>
                                        <h4 class="font-weight-bolder">
                                            {{ $count_pending_clients }}
                                        </h4>
                                        <p class="mb-0 text-xs">
                                            Clients
                                        </p>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="@if(auth()->user()->type == 1) col-xl-3 @endif @if(auth()->user()->type == 2) col-xl-4 @endif col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success mt-2 text-center rounded">
                                 <i class="fa-solid fa-house-medical-circle-check text-lg opacity-10"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('page', ['page' => 'today']) }}">
                                        <p class="text-sm mb-0 font-weight-bold">Today</p>
                                        <h4 class="font-weight-bolder">
                                            {{ $count_todays_appointment }}
                                        </h4>
                                        <p class="mb-0 text-xs">
                                            Appointments
                                        </p>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="@if(auth()->user()->type == 1) col-xl-3 @endif @if(auth()->user()->type == 2) col-xl-4 @endif col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger mt-2 text-center rounded">
                                <i class="fa-solid fa-hospital-user text-lg opacity-10"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('page', ['page' => 'pending']) }}">
                                        <p class="text-sm mb-0 font-weight-bold">Pending</p>
                                        <h4 class="font-weight-bolder">
                                            {{ $count_pending_appointment }}
                                        </h4>
                                        <p class="mb-0 text-xs">
                                            Appointments
                                        </p>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->type == 2)
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-danger mt-2 text-center rounded">
                                <i class="fa-solid fa-person-circle-check text-lg opacity-10"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('page', ['page' => 'upcoming']) }}">
                                        <p class="text-sm mb-0 font-weight-bold">Upcoming</p>
                                        <h4 class="font-weight-bolder">
                                            {{ $count_total_appointment }}
                                        </h4>
                                        <p class="mb-0 text-xs">
                                            Appointments
                                        </p>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(auth()->user()->type == 1)

            <div class="col-md-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-success text-capitalize">Recent Appointments</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="today-appointment-result">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Client</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Purpose</th>
                                         <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Address</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($recent_appointments as $ap)
                                    @php $count += 1; @endphp
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('storage/photo/'.$ap->Client->photo) }}" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $ap->Client->lastname }}, {{ $ap->Client->firstname }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $ap->Client->User->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-wrap text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $ap->purpose }}</p>
                                            </td>
                                            <td class="text-wrap text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $ap->Client->address }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ date('F d, Y', strtotime($ap->date)) }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if($ap->status == 0)
                                                    @if($ap->date == date('Y-m-d'))
                                                        <span class="badge badge-sm btn-success text-capitalize text-center">Today</span>
                                                    @else
                                                        <span class="badge badge-sm btn-success text-capitalize text-center">Upcoming</span>
                                                    @endif
                                                @endif
                                                @if($ap->status == 1)
                                                    <span class="badge badge-sm btn-danger text-capitalize text-center">Pending</span>
                                                @endif
                                                @if($ap->status == 2)
                                                    <span class="badge badge-sm btn-info text-capitalize text-center">Visited</span>
                                                @endif
                                                @if($ap->status == 3)
                                                    <span class="badge badge-sm btn-warning text-capitalize text-center">Failed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($count == 0)
                                    <tr>
                                        <td colspan="6" class="text-center text-sm">No data available</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    <div class="col-md-12 mt-4">
        @if(auth()->user()->type == 1)
        @php
            $rating = 0;
            $total = 0;
        @endphp
        @foreach($recent_feedbacks as $fb)
            @php
                $total += 1;
                $rating += $fb->rating;
            @endphp
        @endforeach

        @if($rating != 0)
            @php
                $rating = $rating / $total
            @endphp
        @endif
                <div class="mb-3">
                    <span class="ms-2">Overall Rating: 
                        <span class="fs-4 fw-bolder ms-2 me-2">{{ number_format($rating, 2) }}</span>
                    </span>
                    @if($rating >= 0 && $rating < 1)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star "></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " ></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star "></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star"></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                    @endif
                    @if($rating >= 1 && $rating < 2)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star "></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " ></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star"></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                    @endif
                    @if($rating >= 2 && $rating < 3)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star "></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star" ></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                    @endif
                    @if($rating >= 3 && $rating < 4)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star" ></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                    @endif
                    @if($rating >= 4 && $rating < 5)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star" style="color: orange"></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                    @endif
                    @if($rating == 5)
                    <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                    <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                    <label><input type="radio" value="4"><span class="label"><i class="fas fa-star" style="color: orange"></i></span></label>
                    <label><input type="radio" value="5"><span class="label"><i class="fas fa-star" style="color: orange"></i></span></label>
                    @endif
                </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-info text-capitalize">Recent Feedbacks</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Client</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Feedback/Comment</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Rating</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date Rated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $count = 0; @endphp
                                @foreach($recent_feedbacks as $fb)
                                @php $count += 1; @endphp
                                    <tr>
                                        <td feedback_id="{{ $fb->id }}">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('storage/photo/'.$fb->Client->photo) }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $fb->Client->lastname }}, {{ $fb->Client->firstname }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $fb->Client->User->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-wrap" comment="{{ $fb->comment }}">
                                            <p class="text-xs font-weight-bold mb-0">{{ $fb->comment }}</p>
                                        </td>
                                        <td class="text-center" rating="{{ $fb->rating }}">
                                            @if($fb->rating == 1)
                                                <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                                                <label><input type="radio" value="2"><span class="label"><i class="fas fa-star "></i></span></label>
                                                <label><input type="radio" value="3"><span class="label"><i class="fas fa-star "></i></span></label>
                                                <label><input type="radio" value="4"><span class="label"><i class="fas fa-star"></i></span></label>
                                                <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                                            @endif
                                            @if($fb->rating == 2)
                                                <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                                                <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="3"><span class="label"><i class="fas fa-star "></i></span></label>
                                                <label><input type="radio" value="4"><span class="label"><i class="fas fa-star"></i></span></label>
                                                <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                                            @endif
                                            @if($fb->rating == 3)
                                                <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                                                <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="4"><span class="label"><i class="fas fa-star"></i></span></label>
                                                <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                                            @endif
                                            @if($fb->rating == 4)
                                                <label><input type="radio" value="1"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>    
                                                <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="4"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="5"><span class="label"><i class="fas fa-star"></i></span></label>
                                            @endif
                                            @if($fb->rating == 5)
                                                <label><input type="radio" value="1"><span class="label"><i class="fas fa-star" style="color: orange"></i></span></label>    
                                                <label><input type="radio" value="2"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="3"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="4"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                                <label><input type="radio" value="5"><span class="label"><i class="fas fa-star " style="color: orange"></i></span></label>
                                            @endif
                                        </td>
                                        <td class="text-wrap text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ date('F d, Y', strtotime($fb->created_at)) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if($count == 0)
                                <tr>
                                    <td colspan="6" class="text-center text-sm">No data available</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->type == 2)
                @if(auth()->user()->status == 0)
                <div class="col-md-12 mt-4">
                    <div class="table-responsive p-0 mb-4">
                        <div id='wrap'>
                        <div id='calendar' class="p-4"></div>
                        <div style='clear:both'></div>
                    </div>
                </div>
                @endif
            @endif
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
   
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush