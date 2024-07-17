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
            @if($cl->User->status == 1)
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