@extends('app')

@section('content')

    @include('components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Login</h2>

        <div class="card my-4 mx-auto" style="width: 40rem;">
            
            <div class="card-body px-3 py-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <form class="" id="loginForm" method="POST" action="{{route('doLogin')}}">
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
            
            <div class="card-footer py-3 px-3">
                <div class="mb-2">Register ?</div> 
                <a class="btn btn-secondary" href="{{route('registerStudent')}}">Student Register</a>
                <a class="btn btn-secondary" href="{{route('registerCompany')}}">Company Register</a>
            </div>
        </div>

    </div>

@endsection


@section('js')

    @if (session('message'))   
        <script>
            toastr.info("{{session('message')}}");
        </script>
    @endif

    @if (session('success'))   
        <script>
            toastr.success("{{session('success')}}")
        </script>
    @endif

    @if (session('error'))   
        <script>
            toastr.error("{{session('error')}}")
            console.log("{{session('error_message')}}");
        </script>
    @endif

@endsection