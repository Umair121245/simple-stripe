@extends('layouts.main') 
@section('content')
<body class="g-sidenav-show  bg-gray-100">
@include('layouts.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.header')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
      <div class="row">
        <div class="col-md-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Orders Information</h6>
            </div>
             <div class="card-header pb-0 px-3">
              <a href="{{route('admin.create.order')}}">Create Order</a>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                @foreach($orders as $order)
                <li class="list-group-item border-0 d-flex p-4 mb-6 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{$order->brand}}</h6>
                    <label>Link:<input class="form-control link" readonly="" type="text" name="link" id="link" value="{{route('checkout_process',$order->id)}}"></label>
                    <button class="btn btn-dark copytoclip"  data-clipboard-text="{{route('checkout_process',$order->id)}}" type="button"><svg aria-hidden="true" height="1em" preserveaspectratio="xMidYMid meet" role="img" viewbox="0 0 24 24" width="1em" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g fill="none"><path d="M13 6.75V2H8.75A2.25 2.25 0 0 0 6.5 4.25v13a2.25 2.25 0 0 0 2.25 2.25h9A2.25 2.25 0 0 0 20 17.25V9h-4.75A2.25 2.25 0 0 1 13 6.75z" fill="currentColor"><path d="M14.5 6.75V2.5l5 5h-4.25a.75.75 0 0 1-.75-.75z" fill="currentColor"><path d="M5.503 4.627A2.251 2.251 0 0 0 4 6.75v10.504a4.75 4.75 0 0 0 4.75 4.75h6.494c.98 0 1.813-.626 2.122-1.5H8.75a3.25 3.25 0 0 1-3.25-3.25l.003-12.627z" fill="currentColor"></path></path></path></g></svg> Copy</button>
                    
                   
                    <span class="mb-2 text-xs">Amount: <span class="text-dark font-weight-bold ms-sm-2">{{$order->amount}}</span></span>
                    <span class="mb-2 text-xs">Name: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->name}}</span></span>
                    <span class="text-xs">Email: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->email}}</span></span>
                     <span class="text-xs">Phone Number: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->phonenumber}}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript::void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{route('admin.order.details',$order->id)}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
               @endforeach
              </ul>
            </div>
          </div>
        </div>
       
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="{{route('admin.dashboard')}}" class="font-weight-bold" target="_blank">Secure TSC</a>
                Payment Gateway.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">{{env('APP_NAME')}}</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.dashboard')}}" class="nav-link text-muted" target="_blank">Return</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.dashboard')}}" class="nav-link text-muted" target="_blank">Privacy</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.dashboard')}}" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

@endsection 
@section('css')

@endsection 
@section('js')
<script type="text/javascript">
  $(function(){
    new Clipboard('.copytoclip');
  });
</script>
 

@endsection