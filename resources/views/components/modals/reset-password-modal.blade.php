<!-- The Modal -->
<div class="modal fade" id="resetPasswordModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Your Password</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    
                    <div class="alert alert-info" style="display: none;" id='processing-time'></div>
                       

                            <div class="row">

                                <form action="" id="reset-password">
                                    <div class="col-md-12 mb-2">
                                        <p class="fw-bolder">Your Credentials</p>
                                        <span class="text-sm">
                                            You can reset your password by entering your account's registered phone number. We will send you a verification code via SMS (Text Message).
                                        </span>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="">Contact Number</label>
                                        <input type="text" class="form-control" name="email" id="reset-email" required>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-success mt-4" id="send-code" value="Send Code" style="display: none;">
                                    </div>
                                </form>

                                <div class="col-md-12" id="show-code" style="display: none;">
                                    <label for="">Enter Verification Code</label>
                                    <input type="text" class="form-control" id="reset-code-token">
                                </div>

                                <div class="col-md-12" id="change-password" style="display: none;">
                                    <label for="">Create New Password</label>
                                    <input type="password" class="form-control" id="create-new-password">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember" type="checkbox" id="show-password">
                                        <label class="form-check-label" for="">Show Password</label>
                                    </div>
                                    <span class="text-danger text-xs pt-1" id="password-length" style="display: none;"></span><br>
                                    <span class="text-danger text-xs mt-0" id="password-validation" style="display: none;"></span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="button" class="btn btn-success mt-4" id="verify-code" value="Verify" style="display: none;">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="button" class="btn btn-success mt-4" id="change-new-password" value="Create" style="display: none;">
                            </div>
                       
                       
                </div>
            </div>
        </div>
    </div>
</div> 