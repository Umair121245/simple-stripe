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
        <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Payment Method</h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn bg-gradient-dark mb-0" href="{{route('admin.create.order')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Order</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="{{asset('assets/img/logos/mastercard.png')}}" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;XXXX</h6>
                        <!--<i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>-->
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="{{asset('assets/img/logos/visa.png')}}" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;XXXX</h6>
                        <!--<i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3" id="orders-card">
              <ul class="list-group">
                @if($orders)
                  @foreach($orders as $order)
                  @if($order->is_paid == 1)
                  <?php $color_code = "#d6fff0"; ?>
                  @else
                  <?php $color_code = "#ffd2e8"; ?>
                  @endif
                  <li class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg" style="background-color: {{$color_code}} !important;">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm"><a href="#{{$order->order_id}}" data-href="#{{$order->order_id}}" class="order_id">Order ID: #{{$order->order_id}}</a></h6>
                      <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">{{isset($order->brand_detail)?$order->brand_detail->name:'Not Define'}}</span></span>
                      @php
                        $name = $order->billing_firstname . ' ' . $order->billing_lastname;
                      @endphp
                      <span class="mb-2 text-xs">Billing Name: <span class="text-dark font-weight-bold ms-sm-2">{{($order->billing_firstname != '')?$name:'Not Paid Yet'}}</span></span>
                      <span class="mb-2 text-xs">Billing Email Address: <span class="text-dark ms-sm-2 font-weight-bold">{{($order->billing_email != '')?$name:'Not Paid Yet'}}</span></span>
                      <span class="mb-2 text-xs">Billing Contact Number: <span class="text-dark ms-sm-2 font-weight-bold">{{($order->billing_phonenumber != '')?$name:'Not Paid Yet'}}</span></span>
                      <span class="text-xs">Amount: <span class="text-dark ms-sm-2 font-weight-bold">{{$order->sale_currency}} {{number_format($order->sale_amount , 2)}}</span></span>
                    </div>

                    <div class="ms-auto text-end">
                      <a class="btn btn-dark copytoclip mb-0" data-clipboard-text="{{route('checkout_process',$order->order_number)}}" href="javascript:void(0)"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copy to Clipboard</a>
                      @if($order->is_paid == 0)
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{route('admin.order.destroy',$order->order_number)}}" onclick="confirmDeletion(event)"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="{{route('admin.order.details',$order->id)}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      @endif
                    </div>
                  </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-5 mt-4 d-none">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Your Transaction's</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                  <i class="far fa-calendar-alt me-2"></i>
                  <small>23 - 30 March 2020</small>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                      <span class="text-xs">27 March 2020, at 12:30 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                    - $ 2,500
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Apple</h6>
                      <span class="text-xs">27 March 2020, at 04:30 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 2,000
                  </div>
                </li>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                      <span class="text-xs">26 March 2020, at 13:45 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 750
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                      <span class="text-xs">26 March 2020, at 12:30 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 1,000
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                      <span class="text-xs">26 March 2020, at 08:30 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 2,500
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-exclamation"></i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                      <span class="text-xs">26 March 2020, at 05:00 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                    Pending
                  </div>
                </li>
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
                <a href="{{route('admin.dashboard')}}" class="font-weight-bold" target="_blank">{{env("APP_NAME")}}</a>
                Payment Gateway.
              </div>
            </div>
            
          </div>
        </div>
      </footer>
    </div>
  </main>

</body>

@endsection 
@section('css')

@endsection 
@section('js')

 <script type="text/javascript">
 
 function confirmDeletion(event) {
  event.preventDefault(); // Prevent the default link navigation

  const result = confirm('Are you sure you want to delete this record?');
  if (result) {
    // If the user confirmed, proceed with the deletion
    window.location.href = event.target.href; // Navigate to the delete link
  } else {
    // If the user canceled, do nothing
  }
}


  $(function(){
    new Clipboard('.copytoclip');
  });

  $(".copytoclip").click(function(){
    $(this).removeClass("btn-dark")
    $(this).addClass("btn-success")
    $(this).html('<i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copied')
  })
  
  
    $(document).ready(function(){
        if (window.location.hash) {
            var hash = window.location.hash;
            
            $(".border-radius-lg .order_id").each(function(i,e){
                if($(e).data("href") == hash){
                    
                    $(e).closest("li").removeClass("d-none")
                }else{
                    $(e).closest("li").addClass("d-none")
                    
                }
            })
        }
    })

</script>



@endsection