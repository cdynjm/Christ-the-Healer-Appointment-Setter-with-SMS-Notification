@extends('layouts.app', ['class' => 'bg-blue-100'])

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header pb-0 m-auto">
                    <a class="align-items-center d-flex" href="{{ route('home') }}">
                    <img style="width: 55px; height: 55px;" src="{{ asset('storage/logo/clinic-logo.png') }}" class="ms-2 mb-3" alt="...">
                    <span class="sidebar-text fw-bolder fs-4 ms-2">
                        CTH-AS
                        <p style="font-size: 11px;">Christ The Healer Appointment Setter</p>
                    </span>
                    </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="align-items-center text-center">
                            <h5 class="fw-bolder"><i class="fa-solid fa-user-shield me-1"></i> Sign Up</h5> 
                            <p class="text-sm">Client Registration Form</p>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 m-4">
                        <form role="form" id="register-client" action="">
                            @csrf
                            <div class="alert alert-info" style="display: none;" id='processing-client'></div>
                            <div class="row">

                                <div class="col-md-6">
                                    <p class="text-sm">Personal Details</p>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Last Name</label>
                                        <input type="text" class="form-control" name="lastname" required>
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">First Name</label>
                                        <input type="text" class="form-control" name="firstname" required>
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Middle Name</label>
                                        <input type="text" class="form-control" name="middlename" required>
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="">Birth Date</label>
                                            <input type="date" class="form-control" name="birthdate" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="">Gender</label>
                                            <select name="gender" id="" class="form-select" required>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                <option value="P">Prefer Not to Say</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <p class="text-sm">Account Information</p>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" required>
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" aria-label="Password" id="password" placeholder="Password" required>
                                        <span class="text-danger text-xs pt-1" id="password-length" style="display: none;"></span><br>
                                        <span class="text-danger text-xs mt-0" id="password-validation" style="display: none;"></span>
                                    </div>
                                    <div class="" style="float:right;">
                                        <input class="" name="remember" type="checkbox" id="show-password">
                                        <label class="" for="">Show Password</label>
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Password Confirmation</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="mt-2">Profile Picture</label>
                                            <input type="file" name="photo" class="form-control mb-2" id="profile-photo" onchange="createProfilePhoto(this)" required>
                                
                                            <center>
                                                <img src="{{ asset('storage/icon/profile-placeholder.jpg') }}" alt="" class="mt-4 img-fluid rounded" id="create-profile-photo" style="width: 200px; height: auto">
                                            </center>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="mt-2">Valid ID for Verification</label>
                                            <input type="file" name="validID" class="form-control mb-2" id="valid-id" onchange="createValidID(this)" required>
                                
                                            <center>
                                                <img src="{{ asset('storage/icon/profile-placeholder.jpg') }}" alt="" class="mt-4 img-fluid rounded" id="create-valid-id" style="width: 200px; height: auto">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-info btn-lg w-100 mt-4 mb-0">Sign Up</button>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1 mb-0 mt-4">
                                <p class="text-sm mx-auto mb-0">
                                    Alreadt have an account?
                                    <a href="{{ route('login') }}" class="text-success font-weight-bold">Log In</a>
                                </p>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')

<script>
   const compressImage = async (file, { quality = 1, type = file.type }) => {
        // Get as image data
        const imageBitmap = await createImageBitmap(file);

        // Draw to canvas
        const canvas = document.createElement('canvas');
        canvas.width = imageBitmap.width;
        canvas.height = imageBitmap.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(imageBitmap, 0, 0);

        // Turn into Blob
        const blob = await new Promise((resolve) =>
            canvas.toBlob(resolve, type, quality)
        );

        // Turn Blob into File
        return new File([blob], file.name, {
            type: blob.type,
        });
    };

    // Get the selected file from the file input
    const input1 = document.querySelector('#profile-photo');
    const input2 = document.querySelector('#valid-id');

    input1.addEventListener('change', async (e) => {
        // Get the files
        const { files } = e.target;

        // No files selected
        if (!files.length) return;

        // We'll store the files in this data transfer object
        const dataTransfer = new DataTransfer();

        // For every file in the files list
        for (const file of files) {
            // We don't have to compress files that aren't images
            if (!file.type.startsWith('image')) {
                // Ignore this file, but do add it to our result
                dataTransfer.items.add(file);
                continue;
            }

            // We compress the file by 50%
            const compressedFile = await compressImage(file, {
                quality: 0.2,
                type: 'image/jpeg'
            });

            // Save back the compressed file instead of the original file
            dataTransfer.items.add(compressedFile);
        }

        // Set value of the file input to our new files list
        e.target.files = dataTransfer.files;
    });

    input2.addEventListener('change', async (e) => {
        // Get the files
        const { files } = e.target;

        // No files selected
        if (!files.length) return;

        // We'll store the files in this data transfer object
        const dataTransfer = new DataTransfer();

        // For every file in the files list
        for (const file of files) {
            // We don't have to compress files that aren't images
            if (!file.type.startsWith('image')) {
                // Ignore this file, but do add it to our result
                dataTransfer.items.add(file);
                continue;
            }

            // We compress the file by 50%
            const compressedFile = await compressImage(file, {
                quality: 0.4,
                type: 'image/jpeg'
            });

            // Save back the compressed file instead of the original file
            dataTransfer.items.add(compressedFile);
        }

        // Set value of the file input to our new files list
        e.target.files = dataTransfer.files;
    });

</script>

@endpush