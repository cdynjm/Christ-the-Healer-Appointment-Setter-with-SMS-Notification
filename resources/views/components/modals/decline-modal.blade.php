<!-- The Modal -->
<div class="modal fade" id="declineModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reason of Cancellation</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                        <form action="" id="decline-appointment">
                            @csrf
                            
                            <input type="hidden" id="appointmentid" name="appointment_id" class="form-control" required>

                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success mt-4" value="Decline">
                            </div>
                        </form>
                       
                </div>
            </div>
        </div>
    </div>
</div> 