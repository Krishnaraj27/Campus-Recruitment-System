<title>Login</title>

@extends('app')

@section('content')

    @include('components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Login</h2>

        <div class="card px-4 py-4 my-4 mx-auto" style="width: 40rem;">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           
            <form id="loginForm" method="POST" action="{{route('doLogin')}}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">Enter your registered Email ID</div>
                </div>

                <div class="mb-3 ">
                    <label for="password" class="form-label">Password</label>
                    <i id="togglePassword" class="bi bi-eye-slash" onclick="passwordShow()"></i>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" required>
                </div>

                <button type="submit" id="btn" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>


</script>
<script type="text/javascript">
        if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    
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
    }
    
</script>    
@endsection