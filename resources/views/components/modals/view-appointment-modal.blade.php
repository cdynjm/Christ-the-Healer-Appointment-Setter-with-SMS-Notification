<!-- The Modal -->
<div class="modal fade" id="viewAppointmentModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Schedule</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='processing-view-appointment'></div>

                            <div class="row">

                                <div class="col-md-12">
                                    <p class="mb-2 text-sm">Client Information</p>
                                </div>
                               <div class="col-md-12">
                                    <label for="">Queue No.</label>
                                    <input type="text" class="form-control bg-white text-lg fw-bolder" id="queue" readonly>

                                    <label for="">Name</label>
                                    <input type="text" class="form-control bg-white" id="client-name" readonly>

                                    <label for="">Address</label>
                                    <input type="text" class="form-control bg-white" id="client-address" readonly>
                               </div>
                               <div class="col-md-6">
                                    <label for="">Contact Number</label>
                                    <input type="text" class="form-control bg-white" id="client-number" readonly>
                               </div>
                               <div class="col-md-6">
                                    <label for="">Gender</label>
                                    <select name="gender" id="client-gender" class="form-select bg-white" disabled>
                                        <option value="">Select...</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="P">Prefer Not to Say</option>
                                    </select>
                               </div>

                               <p class="mb-2 mt-4 text-sm">Appointment Information</p>
                                    <div class="form-check form-switch mb-2 ms-2" id="reschedule-form">
                                        <input class="form-check-input" name="" type="checkbox" id="reschedule">
                                        <label class="form-check-label" for="">Re-Schedule</label>
                                    </div>
                                <form action="" id="update-appointment">
                                    @csrf
                                    <input type="hidden" id="appointment-id" class="form-control bg-white" name="appointment_id" readonly>
                                    <div class="col-md-12">
                                        <label for="">Date</label>
                                        <input type="date" class="form-control bg-white" name="date_scheduled" id="appointment-date" disabled>
                                    </div>
                                    <!--
                                    <div class="col-md-12">
                                        <label for="">Time</label>
                                        @include('components.modals.select-time-schedule-modal')
                                    </div> -->

                                    <div class="col-md-12">
                                        <label for="">Purpose</label>
                                        <textarea name="purpose" class="form-control bg-white" id="appointment-purpose" cols="30" rows="3" disabled></textarea>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn bg-gradient-info mt-4" id="update-btn" value="Update" style="display: none;">
                                    </div>
                                </form>
                            </div>
                            @if(auth()->user()->type == 1)
                            <form action="" id="approve-appointment">
                                @csrf
                                <input type="hidden" id="approve-appointment-id" class="form-control bg-white" name="appointment_id" readonly>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn bg-gradient-success mt-4 me-2" id="approve-btn" value="Approve" style="display: none;">
                                </div>
                            </form>
                            @endif
                </div>
            </div>
        </div>
    </div>
</div> 