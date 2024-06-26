<html lang="en"><head>


  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1" />

  
<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">

<link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">


  <title>Secure Checkout Process</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Open+Sans&amp;display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
*,
*::before,
*::after {
  box-sizing: border-box;
}

html,
body {
  min-height: 100%;
  font-family: "Open Sans", sans-serif;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
/*--------------------
Buttons
--------------------*/

li.company-name {
    display: none;
}
.require-validation p.error {
    padding-top: 73px;
    color: red;
    font-size: unset;
}
input.has-error {
    border: 1px solid red !important;
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    transition: 0.5s;
    outline: none;
}

.btn {
  display: block;
  background: #bded7d;
  color: white;
  text-decoration: none;
  margin: 20px 0;
  padding: 15px 15px;
  border-radius: 5px;
  position: relative;
}
.btn::after {
  content: "";
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: all 0.2s ease-in-out;
  box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0), 0 3px 3px rgba(0, 0, 0, 0.2);
  border-radius: 5px;
}
.btn:hover::after {
  background: rgba(0, 0, 0, 0.1);
  box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.2);
}

/*--------------------
Form
--------------------*/
.form fieldset {
  border: none;
  padding: 0;
  padding: 10px 0;
  position: relative;
  clear: both;
}
.form fieldset.fieldset-expiration {
  float: left;
  width: 60%;
}
.form fieldset.fieldset-expiration .select {
  width: 84px;
  margin-right: 12px;
  float: left;
}
.form fieldset.fieldset-ccv {
  clear: none;
  float: right;
  width: 86px;
}
.form fieldset label {
  display: block;
  text-transform: uppercase;
  font-size: 11px;
  color: rgba(0, 0, 0, 0.6);
  margin-bottom: 5px;
  font-weight: bold;
  font-family: Inconsolata;
}
.form fieldset input,
.form fieldset .select {
  width: 100%;
  height: 38px;
  color: #333333;
  padding: 10px;
  border-radius: 5px;
  font-size: 15px;
  outline: none !important;
  border: 1px solid rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
}
.form fieldset input.input-cart-number,
.form fieldset .select.input-cart-number {
  width: 82px;
  display: inline-block;
  margin-right: 8px;
}
.form fieldset input.input-cart-number:last-child,
.form fieldset .select.input-cart-number:last-child {
  margin-right: 0;
}
.form fieldset .select {
  position: relative;
}
.form fieldset .select::after {
  content: "";
  border-top: 8px solid #222;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  position: absolute;
  z-index: 2;
  top: 14px;
  right: 10px;
  pointer-events: none;
}
.form fieldset .select select {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  position: absolute;
  padding: 0;
  border: none;
  width: 100%;
  outline: none !important;
  top: 6px;
  left: 6px;
  background: none;
}
.form fieldset .select select :-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #000;
}
.form button {
  width: 100%;
  outline: none !important;
  background: linear-gradient(180deg, #49a09b, #3d8291);
  text-transform: uppercase;
  font-weight: bold;
  border: none;
  box-shadow: none;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  margin-top: 90px;
}
.form button .fa {
  margin-right: 6px;
}

/*--------------------
Checkout
--------------------*/
.checkout {
  margin: 150px auto 30px;
  position: relative;
  border-radius: 15px;
  padding: 160px 45px 30px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

/*--------------------
Credit Card
--------------------*/
.credit-card-box {
  perspective: 1000;
  width: 400px;
  height: 280px;
  position: absolute;
  top: -112px;
  left: 50%;
  transform: translateX(-50%);
}
.credit-card-box:hover .flip, .credit-card-box.hover .flip {
  transform: rotateY(180deg);
}
.credit-card-box .front,
.credit-card-box .back {
  width: 400px;
  height: 250px;
  border-radius: 15px;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  background: linear-gradient(135deg, #bd6772, #53223f);
  position: absolute;
  color: #fff;
  font-family: Inconsolata;
  top: 0;
  left: 0;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
}
.credit-card-box .front::before,
.credit-card-box .back::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: url("http://cdn.flaticon.com/svg/44/44386.svg") no-repeat center;
  background-size: cover;
  opacity: 0.05;
}
.credit-card-box .flip {
  transition: 0.6s;
  transform-style: preserve-3d;
  position: relative;
}
.credit-card-box .logo {
  position: absolute;
  top: 9px;
  right: 20px;
  width: 60px;
}
.credit-card-box .logo svg {
  width: 100%;
  height: auto;
  fill: #fff;
}
.credit-card-box .front {
  z-index: 2;
  transform: rotateY(0deg);
}
.credit-card-box .back {
  transform: rotateY(180deg);
}
.credit-card-box .back .logo {
  top: 185px;
}
.credit-card-box .chip {
  position: absolute;
  width: 60px;
  height: 45px;
  top: 20px;
  left: 20px;
  background: linear-gradient(135deg, #ddccf0 0%, #d1e9f5 44%, #f8ece7 100%);
  border-radius: 8px;
}
.credit-card-box .chip::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  border: 4px solid rgba(128, 128, 128, 0.1);
  width: 80%;
  height: 70%;
  border-radius: 5px;
}
.credit-card-box .strip {
  background: linear-gradient(135deg, #404040, #1a1a1a);
  position: absolute;
  width: 100%;
  height: 50px;
  top: 30px;
  left: 0;
}
.credit-card-box .number {
  position: absolute;
  margin: 0 auto;
  top: 103px;
  left: 19px;
  font-size: 38px;
}
.credit-card-box label {
  font-size: 10px;
  letter-spacing: 1px;
  text-shadow: none;
  text-transform: uppercase;
  font-weight: normal;
  opacity: 0.5;
  display: block;
  margin-bottom: 3px;
}
.credit-card-box .card-holder,
.credit-card-box .card-expiration-date {
  position: absolute;
  margin: 0 auto;
  top: 180px;
  left: 19px;
  font-size: 22px;
  text-transform: capitalize;
}
.credit-card-box .card-expiration-date {
  text-align: right;
  left: auto;
  right: 20px;
}
.credit-card-box .ccv {
  height: 36px;
  background: #fff;
  width: 91%;
  border-radius: 5px;
  top: 110px;
  left: 0;
  right: 0;
  position: absolute;
  margin: 0 auto;
  color: #000;
  text-align: right;
  padding: 10px;
}
.credit-card-box .ccv label {
  margin: -25px 0 14px;
  color: #fff;
}

.the-most {
  position: fixed;
  z-index: 1;
  bottom: 0;
  left: 0;
  width: 50vw;
  max-width: 200px;
  padding: 10px;
}
.the-most img {
  max-width: 100%;
}
.checkout.checkout-head {
    padding: 33px 0px;
    margin-right: 30px;
}

.checkout.checkout-head h3 {
    text-align: center;
    font-size: 40px;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

.checkout.checkout-head ul.checkout-table {
    width: 100%;
    justify-content: space-between;
    display: inline-block;
    padding: 0;
}

.checkout.checkout-head ul.checkout-table strong {
    display: block;
    margin-bottom: 10px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
}

.checkout.checkout-head ul.checkout-table li {
    list-style-type: none !important;
}
.checkout.checkout-head ul.checkout-table input {
    width: 100%;
    padding: 10px 0;
    border-radius: 10px;
    border-color: #00000014;
}

.checkout.checkout-head ul.checkout-table li {
    width: 100% !important;
    margin: 0 0px;
    padding: 0 40px;
}
.container.checkout-page {
    margin: 0 auto;
    padding: 100px 0;
}

.container.checkout-page .row {
}
img.logo-top {
    width: 250px;
    position: absolute;
    top: 140px;
}
li.checkout-amount strong {
    font-weight: 700 !important;
    font-size: 18px !important;
    margin: 20px 0;
    background: #f3f3f3;
    padding: 10px 20px;
}
@media screen and (max-width: 991px) {
.container.checkout-page .row {display: block;}   
}

@media screen and (max-width: 575px) {

    .checkout.checkout-head {margin: 0 auto;}

    img.logo-top {
        position: static;
        margin: 40px 0;
    }
    
    .container.checkout-page {
        padding-top: 0;
    }
    
    .container.checkout-page .row {
        margin: 0 15px;
    }

.credit-card-box {
    display: none;
}
.checkout {
    margin-top: 30px;
    padding-top: 50px;
}

.form fieldset input.input-cart-number, .form fieldset .select.input-cart-number {width: 43%;margin: 10px 10px 0 0;}

.form fieldset.fieldset-expiration .select {width: 80px;}

.form fieldset.fieldset-expiration {
    width: 100%;
}

.form fieldset.fieldset-ccv {
    float: left;
}

.form fieldset input.input-cart-number:nth-child(odd) {
    margin-right: 0;
}

input#card-holder {
    width: 93%;
}
.checkout.checkout-head h3 {
    font-size: 25px;
}
}
</style>
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


<style>tcxspan{text-decoration: underline;cursor: pointer;}</style></head>

<body translate="no">

<form class="form require-validation" autocomplete="off" novalidate="" action="{{route('submit_checkout_process')}}" method="POST" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
  @csrf
  <input type="hidden" name="id" value="{{$order->id}}">
  
<div class="container checkout-page">
  <div class="row">
    <div class="col">
        <img src="{{asset($order->brand_detail->upload)}}" class="logo-top" alt="{{$order->brand_detail->name}}">        
        <div class="checkout checkout-head">
            <h3>Checkout Details</h3>
                <ul class="checkout-table">
                    <li class="order-id"><strong>Order  ID : {{$order->order_id}}</strong></li>
                    <li class="order-id"><strong>Order  Details : {{$order->description}}</strong></li>
                    <li class="company-name"> <strong>Company Name: {{$order->payment_brand}}</strong> </li>
                    <li class="checkout-amount"><strong> Amount : {{$order->sale_currency}} {{number_format($order->sale_amount , 2)}}</strong></li>
                </ul>
                <ul class="checkout-table">
                    <li><strong>First Name</strong>
                        <input type="text" name="billing_firstname" id="billing_firstname" required>
                    </li>
                    <li><strong>Last Name</strong>
                        <input type="text" name="billing_lastname" id="billing_lastname" required>
                    </li>
                    <li> <strong>Email</strong>
                    <input type="email" name="billing_email" id="billing_email" required>
                     </li>
                    <li><strong> Phone Number </strong>
                    <input type="tel" name="billing_phonenumber" id="billing_phonenumber" required>
                     </li>
                     
                </ul>
        </div>
    </div>
<div class="col">
<div class="checkout">
  <div class="credit-card-box">
    <div class="flip">
      <div class="front">
        <div class="chip"></div>
        <div class="logo">
          <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
            <g>
              <g>
                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z"></path>
              </g>
            </g>
          </svg>
        </div>
        <div class="number">    </div>
        <div class="card-holder">
          <label>Card holder</label>
          <div></div>
        </div>
        <div class="card-expiration-date">
          <label>Expires</label>
          <div></div>
        </div>
      </div>
      <div class="back">
        <div class="strip"></div>
        <div class="logo">
          <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
            <g>
              <g>
                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z"></path>
              </g>
            </g>
          </svg>

        </div>
        <div class="ccv">
          <label>CCV</label>
          <div></div>
        </div>
      </div>
    </div>
  </div>
    <fieldset>
      <label for="card-number">Card Number</label>
       <input type="num" id="card-number" name="card1" class="input-cart-number card-number" maxlength="4">
      <input type="num" id="card-number-1" name="card2" class="input-cart-number card-number" maxlength="4">
      <input type="num" id="card-number-2" name="card3" class="input-cart-number card-number" maxlength="4">
      <input type="num" id="card-number-3" name="card4" class="input-cart-number card-number" maxlength="4"> 

                                <!-- <input autocomplete='off' class='form-control card-number' size='20' type='text'> -->

    </fieldset>
    <fieldset>
      <label for="card-holder">Card holder</label>
      <input type="text" id="card-holder" name="card_name" >
    </fieldset>
    <fieldset class="fieldset-expiration">
      <label for="card-expiration-month">Expiration date</label>
      <div class="select">
        <select id="card-expiration-month" name="expiry_month" class="card-expiry-month">
          <option></option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
      </div>
      <div class="select">
        <select id="card-expiration-year" class="card-expiry-year" name="expiry_year">
          <option></option>
          
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
          <option value="2031">2031</option>
          <option value="2032">2032</option>
          <option value="2033">2033</option>
          <option value="2034">2034</option>
          <option value="2035">2035</option>
          <option value="2036">2036</option>
        </select>
      </div>
    </fieldset>
    <fieldset class="fieldset-ccv">
      <label for="card-ccv">CCV</label>
      <input type="text" id="card-ccv" class="card-cvc" name="cvv" maxlength="3">
    </fieldset>
    <div><p class="error"></p></div>
    <button type="submit" class="btn"><i class="fa fa-lock"></i> submit</button>
  </form>
</div>
</div>
</div>
</div>



    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script id="">
$('.input-cart-number').on('keyup change', function () {
  $t = $(this);

  if ($t.val().length > 3) {
    $t.next().focus();
  }

  var card_number = '';
  $('.input-cart-number').each(function () {
    card_number += $(this).val() + ' ';
    if ($(this).val().length == 4) {
      //$(this).next().focus();
    }
  });

  $('.credit-card-box .number').html(card_number);
});

$('#card-holder').on('keyup change', function () {
  $t = $(this);
  $('.credit-card-box .card-holder div').html($t.val());
});

$('#card-holder').on('keyup change', function () {
  $t = $(this);
  $('.credit-card-box .card-holder div').html($t.val());
});

$('#card-expiration-month, #card-expiration-year').change(function () {
  m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
  m = m < 10 ? '0' + m : m;
  y = $('#card-expiration-year').val().substr(2, 2);
  $('.card-expiration-date div').html(m + '/' + y);
});

$('#card-ccv').on('focus', function () {
  $('.credit-card-box').addClass('hover');
}).on('blur', function () {
  $('.credit-card-box').removeClass('hover');
}).on('keyup change', function () {
  $('.ccv div').html($(this).val());
});




/*--------------------
CodePen Tile Preview
--------------------*/
setTimeout(function () {
  $('#card-ccv').focus().delay(1000).queue(function () {
    $(this).blur().dequeue();
  });
}, 500);

/*function getCreditCardType(accountNumber) {
  if (/^5[1-5]/.test(accountNumber)) {
    result = 'mastercard';
  } else if (/^4/.test(accountNumber)) {
    result = 'visa';
  } else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
    result = 'maestro';
  } else {
    result = 'unknown'
  }
  return result;
}

$('#card-number').change(function(){
  console.log(getCreditCardType($(this).val()));
})*/
//# sourceURL=pen.js
    </script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
      
    $(function() {
      
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/
        
        var $form = $(".require-validation");
         
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                             'input[type=text]', 'input[type=file]',
                             'input[name=billing_firstname]','input[name=billing_lastname]',
                             'input[name=billing_email]','input[name=billing_phonenumber]',
                             'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            var  is_error = 0;
            $errorMessage.addClass('hide');
          
            $('.has-error').removeClass('has-error');
            console.log($inputs);
            // $inputs.each(function(i, el) {
            //   var $input = $(el);
              
            //   if($input != ""){
            //     if ($input.val() === '') {
            //       $input.parent().addClass('has-error');
            //       $errorMessage.removeClass('hide');
            //       e.preventDefault();
            //     }
            //   } 
              
            // });

            $('form.require-validation input').each(function(i,e){
                if($(e).val() == ""){
                  $(e).addClass("has-error")
                  is_error++;
                }else{
                  $(e).removeClass("has-error")
                }
            })

            if(is_error > 0){
              //$('.error').removeClass('hide').text("There are " + is_error + " errors");
              return false;
            }else{
              $('.error').addClass('hide').text("");
            }
            if (!$form.data('cc-on-file')) {
              var card_number = $("#card-number").val() + $("#card-number-1").val() + $("#card-number-2").val() + $("#card-number-3").val()

              e.preventDefault();
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
              Stripe.createToken({
                number: card_number,
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
              }, stripeResponseHandler);
            }else{
              
            }
        
        });
          
        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    // .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                     
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
         
    });
    </script>
  

  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-5e03f34e38152f20eb79c96b0b89c2d99c5085e9ae9386dc71e2f0b3c30bf513.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



 
</body></html>