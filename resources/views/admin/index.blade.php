@extends('app')

@section('content')

    @include('admin.components.navbar')

    <div class="container my-4">
        <h2 class="text-center">Welcome Admin</h2>

            <div class="my-4 card" style="width: 40rem;">
                <div class="card-header">
                    <h4>Pending companies to verify</h4>
                </div>
                <div class="card-body px-4 py-3">
                    @if (count($unverifiedCompanies)>0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Registered At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unverifiedCompanies as $company)
                                    <tr>
                                        <td> {{$company->name}} </td>
                                        <td> {{$company->created_at}} </td>
                                        <td><a href="{{route('adminViewCompany',['id'=>base64_encode($company->id)])}}" class='btn btn-primary'>View</a></td>
                                    </tr>
                                @endforeach                           
                            </tbody>
                        </table>
                    @else

                        <h6>No new companies</h6>
                        
                    @endif
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