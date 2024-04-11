@extends('app')

@section('content')

    @include('student.components.header')

    <div class="container my-4">
        <h2 class="text-center">Welcome {{$student->first_name}}</h2>
        
        @if ($user->email_verified_at != null)
        
        
        @else
            <div class="my-4 card" style="width: 40rem;">
                <div class="card-body px-4 py-3">
                    <h4>Your email is not verified</h4>
                    <p>Kindly verify by clicking on the verification link sent to your primary email address</p>
                    
                    <a class="btn btn-primary" href="{{route('sendVerificationLink')}}">Resend verification link</a>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('js')

    @if (session('message'))   
    <script>
        toastr.info("{{session('message')}}")
    </script>
    @endif

    @if (session('success'))   
    <script>
        toastr.success("{{session('message')}}")
    </script>
    @endif

    @if (session('error'))   
    <script>
        toastr.error("{{session('error')}}")
        console.log("{{session('error_message')}}");
    </script>
    @endif

@endsection