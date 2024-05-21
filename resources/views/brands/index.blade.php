@extends('layouts.main') @section('content')
<body class="g-sidenav-show bg-gray-100">
    @include('layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        @include('layouts.header')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Brand table</h6>
              <a href="{{route('brand.create')}}" class="btn btn-primary" data-toggle="tooltip" data-original-title="Create Brand">
                          Create
                        </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      
                    @if($brands)
                    @foreach($brands as $brand)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset($brand->upload)}}" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$brand->name}}</h6>
                          </div>
                        </div>
                      </td>

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Active</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{date("M d , Y" , strtotime($brand->created_at))}}</span>
                      </td>
                      <td class="align-middle">
                        <a href="{{route('brand.edit' , $brand->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Brand">
                          Edit
                        </a>
                        <form action="{{ route('brand.destroy', ['brand' => $brand->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-danger delete_program">Delete</button>
                        </form>
                        
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
 </div>
  </main>
   </body>
@endsection 
@section('css')

@endsection 
@section('js')

 

@endsection