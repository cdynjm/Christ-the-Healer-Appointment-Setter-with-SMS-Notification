<!-- The Modal -->
<div class="modal fade" id="viewClientModal-{{ $cl->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Client Information</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                        <div class="alert alert-info" style="display: none;" id='review-processing-client'></div>
                        <div class="row">

                            <input type="hidden" class="form-control bg-white" value="{{ $cl->id }}" id="client-id" name="client_id" readonly>
                            
                            <div class="col-md-6">
                                <p class="text-sm">Personal Details</p>
                                <div class="flex flex-col mb-2">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control bg-white" name="lastname" value="{{ $cl->lastname }}" readonly>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control bg-white" name="firstname" value="{{ $cl->firstname }}" readonly>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="">Middle Name</label>
                                    <input type="text" class="form-control bg-white" name="middlename" value="{{ $cl->middlename }}" readonly>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control bg-white" name="address" value="{{ $cl->address }}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="">Birth Date</label>
                                        <input type="text" class="form-control bg-white" name="birthdate" value="{{ date('F d, Y', strtotime($cl->birthdate)) }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="">Gender</label>
                                        @if($cl->gender == "M")
                                            <input type="text" class="form-control bg-white" name="birthdate" value="Male" readonly>
                                        @endif
                                        @if($cl->gender == "F")
                                            <input type="text" class="form-control bg-white" name="birthdate" value="Female" readonly>
                                        @endif
                                        @if($cl->gender == "P")
                                            <input type="text" class="form-control bg-white" name="birthdate" value="Prefer Not to Say" readonly>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <p class="text-sm">Account Information</p>
                                <div class="flex flex-col mb-3">
                                    <label for="">Contact Number</label>
                                    <input type="email" name="email" class="form-control bg-white" placeholder="example@gmail.com" aria-label="Email" value="{{ $cl->User->email }}" readonly>
                                    @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="mt-2">Profile Picture</label>
                                        <center>
                                            <img src="{{ asset('storage/photo/'.$cl->photo) }}" alt="" class="mt-2 img-fluid rounded" id="create-profile-photo" style="width: 200px; height: auto">
                                        </center>
                                    </div>
                                    @if($cl->User->status == 1)
                                    <div class="col-md-12">
                                        <label for="" class="mt-2">Valid ID for Verification</label>
                                        <center>
                                            <img src="{{ asset('storage/photo/'.$cl->valid_id) }}" alt="" class="mt-2 img-fluid rounded" id="create-valid-id" style="width: 300px; height: auto">
                                        </center>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if($cl->User->status == 1)
                            <div class="d-flex justify-content-center">
                                <input type="button" class="btn btn-danger mt-4 me-2" id="decline-client" value="Decline">
                                <input type="button" class="btn btn-success mt-4" id="verify-client" value="Verify">
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div> 