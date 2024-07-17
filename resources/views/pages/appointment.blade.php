@extends('components.modals.decline-modal')
@extends('components.modals.time-slots-modal')
@extends('components.modals.view-appointment-modal')
@if(auth()->user()->type == 1)
    @extends('pages.calendar.calendar-script')
@endif
@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Appointment'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('page', ['page' => 'appointment-history']) }}" class="btn btn-success btn-sm ms-1">Appointment History</a>
                @if(auth()->user()->type == 1)
                <button class="btn btn-warning btn-sm ms-2" id="view-calendar"><i class="fas fa-calendar-alt text-lg"></i></button>
                @endif
            </div>
            @if(auth()->user()->type == 1)
            <div class="col-md-12 mt-2" style="display: none" id="calendar-schedule">
                <div class="table-responsive p-0 mb-4">
                    <div id='wrap'>
                    <div id='calendar' class="p-4"></div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
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
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
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

            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-danger text-capitalize">Today's Pending Appointments</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="today-appointment-result">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Queue No.</th>
                                        @if(auth()->user()->type == 1)
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Client</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Address</th>
                                        @endif
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Purpose</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($appointments as $ap)
                                        @if($ap->status == 1)
                                            @if($ap->date == $today)
                                            @php
                                                $count += 1;
                                            @endphp
                                            <tr>

                                            <td appointment_id="{{ $ap->id }}" hidden></td>
                                            <td lastname="{{ $ap->Client->lastname }}" hidden></td>
                                            <td firstname="{{ $ap->Client->firstname }}" hidden></td>
                                            <td middlename="{{ $ap->Client->middlename }}" hidden></td>

                                            <td address="{{ $ap->Client->address }}" hidden></td>
                                            <td contact_number="{{ $ap->Client->contact_number }}" hidden></td>
                                            <td gender="{{ $ap->Client->gender }}" hidden></td>

                                            <td date="{{ $ap->date }}" hidden></td>
                                            <td time="{{ $ap->time_id }}" hidden></td>
                                            <td queue="{{ $ap->queue }}" hidden></td>
                                            <td purpose="{{ $ap->purpose }}" hidden></td>
                                            <td status="{{ $ap->status }}" hidden></td>

                                            <td class="text-center">
                                                <p class="text-lg font-weight-bolder mb-0">{{ $ap->queue }}</p>
                                            </td>
                                            @if(auth()->user()->type == 1)
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
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $ap->Client->address }}</p>
                                                </td>
                                                @endif
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center text-wrap">{{ $ap->purpose }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ date('F d, Y', strtotime($ap->date)) }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" id="view-appointment" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="fa-solid fa-eye text-sm"></i>
                                                    </a>
                                                    <a href="javascript:;" id="delete-appointment" class="text-danger font-weight-bold text-xs ms-2"
                                                        data-toggle="tooltip" title="Cancel">
                                                    Cancel
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endif
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
            </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
