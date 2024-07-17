@extends('components.modals.time-slots-modal')
@extends('components.modals.view-appointment-modal')
@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Appointment History'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3">
                <input type="date" class="form-control mb-4 ms-1" id="search-client-appointment-date">
            </div>
            <div class="col-md-3 text-end">
                @if(auth()->user()->type == 1)
                    <input type="text" class="form-control mb-4 ms-1" id="search-client-appointment" placeholder="Search...">
                @endif
            </div>
            
            <div class="col-md-3 text-end"></div>
            <div class="col-md-3 text-end"></div>

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-info text-capitalize">Previous Appoinments</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            @include('pages.tables.appointment-history')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
