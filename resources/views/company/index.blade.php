@extends('app')

@section('content')

    @include('admin.components.navbar')

    <div class="container my-4">
        <h2 class="text-center">Welcome {{$company->name}}</h2>
        
        @if ($company->status == 'active')
        
        
        @else

            @if ($company->status == 'pending')
                <div class="my-4 card" style="width: 40rem;">
                    <div class="card-body px-4 py-3">
                        <h4>Your account is not verified</h4>
                        <p>Our administration is verifying your account. It may take upto 3 to 4 working days to verify.</p>

                    </div>
                </div>
            @endif

            @if ($company->status == 'blocked')
                <div class="my-4 card" style="width: 40rem;">
                    <div class="card-body px-4 py-3">
                        <h4>Your account is blocked by admin</h4>
                        <p>Please contact the administration for more details</p>
                    </div>
                </div>
            @endif
            
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