@extends('layouts.app', ['class' => 'g-sidenav-show bg-blue-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="align-items-center text-center">
                            <h5 class="fw-bolder"><i class="fa-solid fa-user-shield me-1"></i> Account Overview</h5> 

                            @if(auth()->user()->type == 1)
                                <p class="text-sm">Administrator Profile</p>
                            @endif
                            @if(auth()->user()->type == 2)
                                @if(auth()->user()->status == 1)
                                    <p class="text-sm text-danger"><i class="fa-solid fa-circle-minus"></i> Account Under Review</p>
                                @endif
                                @if(auth()->user()->status == 2)
                                    <p class="text-sm text-warning"><i class="fa-solid fa-rotate-left"></i> Declined (Please Re-Submit your credentials)</p>
                                @endif
                                @if(auth()->user()->status == 0)
                                    <p class="text-sm text-success"><i class="fa-solid fa-circle-check"></i> Verified</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 m-4">
                        <form role="form" 
                        @if(auth()->user()->type == 1)
                            id="update-admin"
                        @endif
                        @if(auth()->user()->type == 2)
                            @if(auth()->user()->status == 0)
                                id="update-client"
                            @endif
                            @if(auth()->user()->status == 2)
                                id="resubmit-credentials"
                            @endif
                        @endif
                        action="">
                            @csrf
                            <div class="alert alert-info" style="display: none;" id='processing-update'></div>
                            <div class="row">
                                @if(auth()->user()->type == 1)
                                    <input type="hidden" class="form-control" name="update_id" value="{{ auth()->user()->id }}">
                                @endif
                                @if(auth()->user()->type == 2)
                                    <input type="hidden" class="form-control" name="update_id" value="{{ auth()->user()->Client->id }}">
                                @endif
                                <div class="col-md-6">
                                    <p class="text-sm">Personal Details</p>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Last Name</label>
                                        @if(auth()->user()->type == 1)
                                            <input type="text" class="form-control" name="lastname" value="{{ auth()->user()->lastname }}" required>
                                        @endif
                                        @if(auth()->user()->type == 2)
                                            <input type="text" class="form-control" name="lastname" value="{{ auth()->user()->Client->lastname }}" readonly>
                                        @endif
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">First Name</label>
                                        @if(auth()->user()->type == 1)
                                            <input type="text" class="form-control" name="firstname" value="{{ auth()->user()->firstname }}" required>
                                        @endif
                                        @if(auth()->user()->type == 2)
                                            <input type="text" class="form-control" name="firstname" value="{{ auth()->user()->Client->firstname }}" readonly>
                                        @endif
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Middle Name</label>
                                        @if(auth()->user()->type == 1)
                                            <input type="text" class="form-control" name="middlename" value="{{ auth()->user()->middlename }}" required>
                                        @endif
                                        @if(auth()->user()->type == 2)
                                            <input type="text" class="form-control" name="middlename" value="{{ auth()->user()->Client->middlename }}" readonly>
                                        @endif
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">Address</label>
                                        @if(auth()->user()->type == 1)
                                            <input type="text" class="form-control" name="address" value="{{ auth()->user()->address }}" required>
                                        @endif
                                        @if(auth()->user()->type == 2)
                                            <input type="text" class="form-control" name="address" value="{{ auth()->user()->Client->address }}" readonly>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="">Birth Date</label>
                                            @if(auth()->user()->type == 1)
                                                <input type="date" class="form-control" name="birthdate" value="{{ auth()->user()->birthdate }}" required>
                                            @endif
                                            @if(auth()->user()->type == 2)
                                                <input type="date" class="form-control" name="birthdate" value="{{ auth()->user()->Client->birthdate }}" readonly>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="">Gender</label>
                                            @if(auth()->user()->type == 1)
                                                <select name="gender" id="" class="form-select" required>
                                                    <option value="">Select...</option>
                                                    <option value="M" @if(auth()->user()->gender == "M") selected @endif>Male</option>
                                                    <option value="F" @if(auth()->user()->gender == "F") selected @endif>Female</option>
                                                    <option value="P" @if(auth()->user()->gender == "P") selected @endif>Prefer Not to Say</option>
                                                </select>
                                            @endif
                                            @if(auth()->user()->type == 2)
                                                <select name="gender" id="" class="form-select" disabled>
                                                    <option value="">Select...</option>
                                                    <option value="M" @if(auth()->user()->Client->gender == "M") selected @endif>Male</option>
                                                    <option value="F" @if(auth()->user()->Client->gender == "F") selected @endif>Female</option>
                                                    <option value="P" @if(auth()->user()->Client->gender == "P") selected @endif>Prefer Not to Say</option>
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-2">
                                    @if(auth()->user()->type == 1)
                                        <label for="">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" value="{{ auth()->user()->contact_number }}" required>
                                    @endif
                                       
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-sm">Account Information</p>
                                    <div class="flex flex-col mb-3">
                                        <label for="">Contact Number</label>
                                        @if(auth()->user()->type == 1)
                                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}" aria-label="Email" required>
                                        @endif
                                        @if(auth()->user()->type == 2)
                                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}" aria-label="Email" readonly>
                                        @endif
                                        @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>

                                    <p class="text-sm">Create New Password</p>

                                    <div class="flex flex-col mb-3">
                                        <label for="">Old Password</label>
                                        <input type="password" name="old_password" class="form-control" aria-label="Password" id="old-password">
                                    </div>
                                    <div class="flex flex-col mb-2">
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" id="password" name="new_password">
                                        <span class="text-danger text-xs pt-1" id="password-length" style="display: none;"></span><br>
                                        <span class="text-danger text-xs mt-0" id="password-validation" style="display: none;"></span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="mt-2">Profile Picture</label>
                                            <input type="file" name="photo" class="form-control mb-2" id="profile-photo" onchange="createProfilePhoto(this)">
                                
                                            <center>
                                            @if(auth()->user()->type == 1)
                                                <img 
                                                    @if(auth()->user()->photo == null) src="{{ asset('storage/icon/profile-placeholder.jpg') }}" @endif 
                                                    @if(auth()->user()->photo != null) src="{{ asset('storage/photo/'.auth()->user()->photo) }}" @endif 
                                                    alt="" class="mt-4 img-fluid rounded" id="create-profile-photo" style="width: 200px; height: auto">
                                            @endif

                                            @if(auth()->user()->type == 2)
                                                <img 
                                                    @if(auth()->user()->Client->photo == null) src="{{ asset('storage/icon/profile-placeholder.jpg') }}" @endif 
                                                    @if(auth()->user()->Client->photo != null) src="{{ asset('storage/photo/'.auth()->user()->Client->photo) }}" @endif 
                                                    alt="" class="mt-4 img-fluid rounded" id="create-profile-photo" style="width: 200px; height: auto">
                                            @endif
                                            </center>
                                        </div>
                                        @if(auth()->user()->type == 2)
                                            @if(auth()->user()->status == 1)
                                                <div class="col-md-6">
                                            
                                                    <label for="" class="mt-2">Valid ID for Verification</label>
                                                    <input type="file" name="validID" class="form-control mb-2" onchange="createValidID(this)" @if(auth()->user()->status == 1) disabled @else required @endif>
                                                    <center>
                                                        <img src="{{ asset('storage/photo/'.auth()->user()->Client->valid_id) }}" alt="" class="mt-4 img-fluid rounded" id="create-valid-id" style="width: 200px; height: auto">
                                                    </center>
                                                </div>
                                            @endif
                                            @if(auth()->user()->status == 2)
                                                <div class="col-md-6">
                                            
                                                    <label for="" class="mt-2">Valid ID for Verification</label>
                                                    <input type="file" name="validID" class="form-control mb-2" onchange="createValidID(this)" @if(auth()->user()->status == 1) disabled @else required @endif>
                                                    <center>
                                                        <img src="{{ asset('storage/icon/profile-placeholder.jpg') }}" alt="" class="mt-4 img-fluid rounded" id="create-valid-id" style="width: 200px; height: auto">
                                                    </center>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                    @if(auth()->user()->type == 1)
                                        <button type="submit" class="btn btn-lg btn-info btn-lg w-100 mt-4 mb-0">Update</button>
                                    @endif

                                    @if(auth()->user()->type == 2)
                                        @if(auth()->user()->status == 0)
                                            <button type="submit" class="btn btn-lg btn-info btn-lg w-100 mt-4 mb-0">Update</button>
                                        @endif
                                        @if(auth()->user()->status == 2)
                                            <button type="submit" class="btn btn-lg btn-warning btn-lg w-100 mt-4 mb-0">Re-Submit</button>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
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
    const input = document.querySelector('#profile-photo');
    input.addEventListener('change', async (e) => {
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