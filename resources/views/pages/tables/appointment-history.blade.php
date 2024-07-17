<table class="table align-items-center mb-0" id="appointment-history-result">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Client</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Address</th>
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Purpose</th>
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Date</th>
            <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Status</th>
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
            @if($ap->status == 2 || $ap->status == 3)
                @if($ap->date <= $today)
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
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $ap->purpose }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ date('F d, Y', strtotime($ap->date)) }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        @if($ap->status == 2)
                            <span class="badge badge-sm bg-gradient-success text-capitalize">Success</span>
                        @endif
                        @if($ap->status == 3)
                            <span class="badge badge-sm bg-gradient-danger text-capitalize">Failed to visit</span>
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        <a href="javascript:;" id="view-appointment" class="text-secondary font-weight-bold text-xs"
                            data-toggle="tooltip" data-original-title="Edit user">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </a>
                    </td>
                </tr>
                @endif
            @endif
        @endforeach
        @if($count == 0)
        <tr>
            <td colspan="7" class="text-center text-sm">No data available</td>
        </tr>
        @endif
    </tbody>
</table>