@extends('app')

@section('content')

    @include('student.components.navbar2')

    <div class="container my-4">
        <h2 class="text-center">Welcome {{$student->first_name}}</h2>
        

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