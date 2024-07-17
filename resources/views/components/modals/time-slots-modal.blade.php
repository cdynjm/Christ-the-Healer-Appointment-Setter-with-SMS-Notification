<!-- The Modal -->
<div class="modal fade" id="timeSlotModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Time Schedule</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='processing-time'></div>
                        <form action="" id="create-time-slots">

                            <input type="hidden" id="date-value" class="form-control" name="date_scheduled" readonly>

                            <div class="row">

                                <div class="col-md-12">
                                    <p>Slot Information</p>
                                </div>

                                <div class="col-md-6">
                                    <label for="">From Time</label>
                                    <input type="time" class="form-control" name="from_time" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">To Time</label>
                                    <input type="time" class="form-control" name="to_time" required>
                                </div>
                          
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success mt-4" value="Save">
                            </div>
                        </form>
                       
                </div>
            </div>
        </div>
    </div>
</div> 