@extends('components.modals.feedback-modal')
@extends('components.modals.edit.edit-feedback-modal')
@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Feedback & Rating'])
    <div class="container-fluid py-4">
        <div class="row">
            @if(auth()->user()->type == 2)
               
                <div class="col-md-6"  @foreach($feedbacks as $fb) @if($fb->client_id == auth()->user()->Client->id) style="display: none;" @endif @endforeach>
                    <button class="btn btn-success btn-sm ms-1" id="add-rating">Add Rating</button>
                </div>
                
            @endif
       
    <div class="col-12">
        @if(auth()->user()->type == 1)
        @php
            $rating = 0;
            $total = 0;
        @endphp
        @foreach($feedbacks as $fb)
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
                        <span class="badge badge-sm btn-info text-capitalize">Feedback & Rating</span>
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
                                        @if(auth()->user()->type == 2)
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @php $count = 0; @endphp
                                @foreach($feedbacks as $fb)
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
                                        @if(auth()->user()->type == 2)
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" id="edit-rating" class="text-secondary font-weight-bold text-xs me-2"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fas fa-pen-alt text-sm"></i>
                                            </a>
                                            <a href="javascript:;" id="delete-rating" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fas fa-trash text-sm"></i>
                                            </a>
                                        </td>
                                        @endif
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
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
