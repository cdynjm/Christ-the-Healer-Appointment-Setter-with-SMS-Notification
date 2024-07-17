@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Clients'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control mb-4 ms-1" id="search-client" placeholder="Search...">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>

            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
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
          
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
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

            <div class="col-12 mt-4" id="sectionB">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-danger text-capitalize">Today's Pending Accounts</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="pending-client-result">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Client</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Address</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($clients as $cl)
                                        @if($cl->User->status == 1 && date('Y-m-d', strtotime($cl->created_at)) == $today)
                                        @php $count += 1; @endphp
                                            @include('components.modals.view-client-modal')
                                            <tr>
                                                <td clientid="{{ $cl->id }}">
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('storage/photo/'.$cl->photo) }}" class="avatar avatar-sm me-3"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $cl->lastname }}, {{ $cl->firstname }} {{ $cl->middlename }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $cl->User->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $cl->address }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm btn-danger text-capitalize">Pending</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ date('F d, Y', strtotime($cl->created_at)) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" id="view-client" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="fa-solid fa-eye text-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
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
