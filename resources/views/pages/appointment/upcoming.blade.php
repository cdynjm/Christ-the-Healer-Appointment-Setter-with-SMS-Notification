@extends('components.modals.decline-modal')
@extends('components.modals.time-slots-modal')
@extends('components.modals.view-appointment-modal')

@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Appointment'])
    <div class="container-fluid py-4">
        <div class="row">
            @if(auth()->user()->type == 1)
            <div class="col-md-3 text-end">
                <input type="text" class="form-control mb-4 ms-1" id="search-client-appointment" placeholder="Search...">
            </div>
            <div class="col-md-3 text-end">
                <input type="date" class="form-control mb-4 ms-1" id="search-client-appointment-date">
            </div>
            @endif

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-success text-capitalize">Upcoming Appointments</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            @include('pages.tables.upcoming-appointment')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
