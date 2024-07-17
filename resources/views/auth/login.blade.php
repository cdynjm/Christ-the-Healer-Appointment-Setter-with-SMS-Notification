@extends('components.modals.reset-password-modal')
@extends('layouts.app', ['class' => 'bg-blue-100'])

@section('content')
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 m-auto">
                    <a class="align-items-center d-flex" href="{{ route('home') }}">
                    <img style="width: 55px; height: 55px;" src="{{ asset('storage/logo/clinic-logo.png') }}" class="ms-2 mb-3" alt="...">
                    <span class="sidebar-text fw-bolder fs-4 ms-2">
                        CTH-AS
                        <p style="font-size: 11px;">Christ The Healer Appointment Setter</p>
                    </span>
                    </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="align-items-center text-center">
                            <h5 class="fw-bolder"><i class="fa-solid fa-user-shield me-1"></i> Sign In</h5> 
                            <p class="text-sm">Enter your email and password to proceed</p>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 m-4">
                        <form role="form" method="POST" action="{{ route('login.perform') }}">
                            @csrf
                            @method('post')
                            <div class="flex flex-col mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email')}}" placeholder="Username" aria-label="">
                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" aria-label="Password" id="password" placeholder="Password" >
                                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="show-password">
                                <label class="form-check-label" for="">Show Password</label>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg bg-gradient-info btn-lg w-100 mt-4 mb-0">Sign in</button>
                            </div>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1 mt-4">
                                <p class="mb-0 text-sm mx-auto">
                                    Reset your password
                                    <a href="#" class="text-success font-weight-bold" id="show-reset-password">here</a>
                                </p>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1 mb-0">
                                <p class="text-sm mx-auto mb-0">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="text-success font-weight-bold">Sign up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
