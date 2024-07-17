<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 fixed-start " style="position: fixed; z-index: 10;min-width:17.1rem;"
    id="sidenav-main">
    <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex mt-3" href="{{ route('home') }}">
            <img style="width: 50px; height: 50px;" src="{{ asset('storage/logo/clinic-logo.png') }}" class="ms-4 mb-4 mt-2" alt="...">
            <span class="ms-3 sidebar-text fw-bolder fs-4">
                CTH-AS
            <p style="font-size: 10px;">Christ The Healer Appointment Setter</p>
          </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active bg-dark text-white' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house-laptop text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active bg-dark text-white' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'appointment') == true ? 'active bg-dark text-white' : '' }}" @if(auth()->user()->status == 0) href="{{ route('page', ['page' => 'appointment']) }}" @else id="not-verified-appointment" @endif>
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Appointments</span>
                </a>
            </li>
            @if(auth()->user()->type == 1)
           <!-- <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'time-slots') == true ? 'active bg-dark text-white' : '' }}" href="{{ route('page', ['page' => 'time-slots']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-clock mb-2 text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Time Slots</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'clients') == true ? 'active bg-dark text-white' : '' }}" href="{{ route('page', ['page' => 'clients']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'sms-configuration') == true ? 'active bg-dark text-white' : '' }}" href="{{ route('page', ['page' => 'sms-configuration']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-comment-sms text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">SMS Configuration</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'feedback-rating') == true ? 'active bg-dark text-white' : '' }}" @if(auth()->user()->status == 0) href="{{ route('page', ['page' => 'feedback-rating']) }}" @else id="not-verified-feedback" @endif>
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-regular fa-star-half-stroke text-lg opacity-10 text-success text-gradient"></i>
                    </div>
                    <span class="nav-link-text ms-1">Feedback & Rating</span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
