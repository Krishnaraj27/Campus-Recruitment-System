@extends('app')

@section('content')

    @include('components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Welcome {{$company->name}}</h2>
        
        @if ($company->verified_at != null)
        
        
        @else
            <div class="my-4 card" style="width: 40rem;">
                <div class="card-body px-4 py-3">
                    <h4>Your account is not verified</h4>
                    <p>Our administration is verifying your account. It may take upto 3 to 4 working days to verify.</p>

                </div>
            </div>
        @endif

        <div class="my-4">
            <form action="{{route('doLogout')}}" method="post">
                @csrf
                <button class="btn btn-secondary">Logout</button>
            </form>
        </div>
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