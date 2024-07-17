@extends('components.modals.time-slots-modal')
@extends('components.modals.edit.edit-time-slots-modal')
@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Time Slots'])
    <div class="container-fluid py-4">
        <div class="row">
         <div class="col-md-6">
            <div class="d-flex">
                <button class="btn btn-sm btn-success ms-1" id="create-time-slots">Add Slots</button>
            </div>
         </div>
         <div class="col-md-6"></div>
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-warning text-capitalize">Time Slots</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ">
                                            From
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center ">
                                            To
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($time_slots as $ts)
                                    <tr>
                                        <td time_id="{{ $ts->id }}" hidden></td>
                                        <td from_time="{{ $ts->from_time }}" hidden></td>
                                        <td to_time="{{ $ts->to_time }}" hidden></td>

                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ date('h:i A', strtotime($ts->from_time)) }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ date('h:i A', strtotime($ts->to_time)) }}</p>
                                        </td>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" id="edit-time-slots" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fa-solid fa-pen-clip text-sm"></i>
                                            </a>
                                            <a href="javascript:;" id="delete-time-slots" class="text-secondary font-weight-bold text-xs ms-2"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fa-solid fa-trash text-sm"></i>
                                            </a>
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
