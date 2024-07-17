@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Clients'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control mb-4 ms-1" id="search-client" placeholder="Search...">
            </div>

            <div class="col-12" id="sectionB">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span class="badge badge-sm btn-success text-capitalize">Verified Accounts</span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            @include('pages.tables.verified-client')
                        </div>
                    </div>
                </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
