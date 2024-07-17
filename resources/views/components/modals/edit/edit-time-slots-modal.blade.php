<!-- The Modal -->
<div class="modal fade" id="editTimeSlotModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Time Schedule</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='edit-processing-time'></div>
                        <form action="" id="update-time-slots">

                            <input type="hidden" id="edit-time-id" class="form-control" name="time_id" readonly>

                            <div class="row">

                                <div class="col-md-12">
                                    <p>Slot Information</p>
                                </div>

                                <div class="col-md-6">
                                    <label for="">From Time</label>
                                    <input type="time" class="form-control" name="from_time" id="edit-from-time" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">To Time</label>
                                    <input type="time" class="form-control" name="to_time" id="edit-to-time" required>
                                </div>
                          
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success mt-4" value="Update">
                            </div>
                        </form>
                       
                </div>
            </div>
        </div>
    </div>
</div> 