<title>Company Register</title>

@extends('app')

@section('content')

    @include('components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Register as Company</h2>

        <div class="card my-4 mx-auto" style="width: 50rem;">
            <div class="card-body px-4 py-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="registrationForm" method="POST" action="{{ route('doCompanyRegister') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            required>
                        <div id="emailHelp" class="form-text">Enter your Email ID. This email will be used or further communication as well as for login
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

                    <div class="mb-3">
                            <label for="name" class="form-label">Organization Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                           <textarea name="description" id="description" class="form-control" aria-describedby="descriptionHelp" cols="25" rows="5" required='required'></textarea>
                            <div id="descriptionHelp" class="form-text">Write about your company in brief</div>
                    </div>

                    <div class="mb-3">         
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>


                    <div class="row mb-3">
                        <div class="col">
                            <label for="website_url">Your Website URL</label>
                            <input type="text" name="website_url"
                            id="website_url" class="form-control" required>
                        </div>


                        <div class="col">
                            <label for="mobile" class="form-label">Contact No.</label>
                            <input type="number" class="form-control" name="mobile" id="mobile" step="1" required>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="submit" id="btn" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>

            <div class="card-footer px-2 py-2">
                <a href="{{route('login')}}" class="btn btn-secondary">Login</a>
            </div>
            
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
