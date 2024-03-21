<title>Student Register</title>

@extends('app')

@section('content')

    @include('components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Register as Student</h2>

        <div class="card px-4 py-4 my-4 mx-auto" style="width: 50rem;">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="registrationForm" method="POST" action="{{ route('doStudentRegister') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        required>
                    <div id="emailHelp" class="form-text">Enter your college Email ID. This email will be used to login
                        everytime</div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <i id="togglePassword" class="bi bi-eye-slash" onclick="passwordShow()"></i>
                        <input type="password" class="form-control" name="password" id="password"
                            aria-describedby="passwordHelp" required>
                        <div id="passwordHelp" class="form-text">Create a password</div>
                    </div>

                    <div class="col">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <i id="toggleConfirmPassword" class="bi bi-eye-slash" onclick="passwordShow()"></i>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                            aria-describedby="confirmPasswordHelp" required>
                        <div id="confirmPasswordHelp" class="form-text">Confirm your password</div>
                    </div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>

                    <div class="col">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="enrollment" class="form-label">Enrollment No.</label>
                        <input type="text" class="form-control" id="enrollment" name="enrollment"
                            aria-describedby="enrollmentHelp" required>
                        <div id="enrollmentHelp" class="form-text">Enter your 12 digit enrollment number</div>
                    </div>

                    <div class="col">
                        <label for="mobile" class="form-label">Mobile No.</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="course" class="form-label">Course</label>
                        <select name="course" class="form-select" id="course" required>
                            <option value="" selected hidden>Select course</option>
                            <option value="BE-IT">B.E. IT</option>
                            <option value="BE-CE">B.E. CE</option>
                            <option value="BE-EC">B.E. EC</option>
                            <option value="BE-ME">B.E. ME</option>
                            <option value="BE-CL">B.E. CL</option>
                            <option value="BE-EE">B.E. EE</option>
                            <option value="BCA">BCA</option>
                            <option value="MCA">MCA</option>
                            <option value="MCA">BBA</option>
                            <option value="MCA">MBA</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" name="semester" id="semester" required>
                    </div>
                </div>

                <div class="row mb-3">         
                    <div class="col">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
                    </div>
                    
                    <div class="col">
                        <label for="cgpa" class="form-label">Current CGPA</label>
                        <input type="text" class="form-control" name="cgpa" id="cgpa" required>
                    </div>

                    <div class="col">
                        <label for="backlogs" class="form-label">Current Backlogs</label>
                        <input type="text" class="form-control" name="backlogs" id="backlogs" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="personal_email" class="form-label">Personal Email</label>
                        <input type="email" class="form-control" id="personal_email" name="personal_email"
                            aria-describedby="personalEmailHelp" required>
                        <div id="personalEmailHelp" class="form-text">Your personal email ID will be used by companies for further communication with you</div>
                    </div>

                    <div class="col">
                        <div class="mb-2">Select Gender</div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" id="btn" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script></script>
    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "4000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection
