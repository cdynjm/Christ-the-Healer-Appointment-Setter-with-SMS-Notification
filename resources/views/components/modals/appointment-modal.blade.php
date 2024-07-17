<!-- The Modal -->
<div class="modal fade" id="setAppointmentModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Appointment</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='processing-appointment'></div>
                        <form action="" id="create-appointment">

                            <input type="hidden" id="date-value" class="form-control" name="date_scheduled" readonly>

                            <div class="row">

                                <div class="col-md-12">
                                    <p class="mb-0">Appointment Information</p>
                                   <!-- <span class="text-xs text-danger mt-0">Appointment should be done 1 hour before the appointment target time</span> -->
                                </div>

                                <div class="col-md-12">
                                    <label for="">Date Scheduled</label>
                                    <input type="text" class="form-control" id="date-scheduled" readonly>
                                    <!--
                                    <label for="">Date Scheduled</label>
                                    @include('components.modals.select-time-schedule-modal')
                                    -->
                                     <label for="">Purpose</label>
                                     <textarea name="purpose" class="form-control" id="" cols="30" rows="5" required></textarea>
                                </div>
                          
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn bg-gradient-success mt-4" value="Set Schedule">
                            </div>
                        </form>
                       
                </div>
            </div>
        </div>
    </div>
</div> 