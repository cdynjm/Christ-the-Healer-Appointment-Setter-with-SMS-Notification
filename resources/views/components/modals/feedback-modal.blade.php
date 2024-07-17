<!-- The Modal -->
<div class="modal fade" id="feedbackModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Feedbacks & Rating</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='processing-feedback'></div>
                        <form action="" id="create-feedback">
                            @csrf
                            <div class="col-md-12 text-center" id="open-comment">
                                <label><input type="radio" value="1" id="value-one"><span class="label" id="color-one"><i class="fas fa-star"></i></span></label>    
                                <label><input type="radio" value="2" id="value-two"><span class="label" id="color-two"><i class="fas fa-star"></i></span></label>
                                <label><input type="radio" value="3" id="value-three"><span class="label" id="color-three"><i class="fas fa-star"></i></span></label>
                                <label><input type="radio" value="4" id="value-four"><span class="label" id="color-four"><i class="fas fa-star"></i></span></label>
                                <label><input type="radio" value="5" id="value-five"><span class="label" id="color-five"><i class="fas fa-star"></i></span></label>
                            </div>

                            <input type="hidden" id="rating-value" name="rating" class="form-control" required>

                            <div class="col-md-12" id="comment" style="display: none;">
                                <label for="">Feedback/Comments: (Optional)</label>
                                <input type="text" class="form-control" name="comment">
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

<style>
    input[type=radio] {
        display: none;
    }
    .label {
        border: none;
        display: inline-block;
        padding: 0px;
        font-size: 20px;
        /* background: url("unchecked.png") no-repeat left center; */ 
        /* padding-left: 15px; */
    }

</style>
