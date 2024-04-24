@extends('app')

@section('content')

    @include('admin.components.navbar')

    <div class="container my-4">
        <h2 class="text-center">View Company</h2>

            <div class="my-4 card" style="width: 40rem;">
                <div class="card-header">
                    {{$company->name}}
                </div>
                <div class="card-body px-4 py-3">
                    <div>
                        <b>Description : </b> <p>{{$company->description}}</p>
                    </div>
                    <div>
                        <b>Email : </b><p>{{$company->user->email}}</p>
                    </div>
                    <div>
                        <b>Contact : </b><p>{{$company->mobile}}</p>
                    </div>
                    <div>
                        <b>Address :</b><p>{{$company->address}}</p>
                    </div>
                    <div>
                        <b>Website : </b><p><a href="{{$company->website_url}}">Click</a></p>
                    </div>
                    <div>
                        <b>Status : </b><p>{{$company->status}}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="my-2">
                        @if ($company->status=='pending')
                            <a class="mx-2 btn btn-success" onclick="confirm('Are you sure?')" href="{{route('doVerifyCompany',['id'=>base64_encode($company->id)])}}">Verify</a>
                            <a class="mx-2 btn btn-danger" onclick="confirm('This will delete the company\'s account also. Are you sure?')" href="{{route('doRejectCompany',['id'=>base64_encode($company->id)])}}">Reject</a>                    
                        @endif
                        {{-- @if ($company->status=='active')
                            <a class="btn btn-danger" onclick="confirm('Are you sure?')" href="">Block</a>
                        @endif
                        @if ($company->status=='inactive')
                            <a class="btn btn-success" onclick="confirm('Are you sure?')" href="">Unblock</a>
                        @endif --}}
                    </div>
                </div>
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