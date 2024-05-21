<html lang="en"><head>

  <meta charset="UTF-8">
  
<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">

<link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">


  <title>Secure Checkout Completed!</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Open+Sans&amp;display=swap">
  
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

body {
  background: linear-gradient(50deg, #f3c680, #a1e3e2);
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
/*--------------------
Buttons
--------------------*/
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
  width: 460px;
  background: white;
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
    padding: 30px 70px;
    padding-bottom: 60px;
}

.checkout.checkout-head h3 {
    text-align: center;
    font-size: 40px;
    margin-bottom: 50px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

.checkout.checkout-head ul.checkout-table {
    display: flex;
    width: 100%;
    justify-content: space-between;
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

.checkout.checkout-head ul.checkout-table li {width: 30% !important;}
</style>

  
  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


<style>tcxspan{text-decoration: underline;cursor: pointer;}</style></head>

<body translate="no">

<div class="checkout checkout-head" style="width:50% !important">
<h3>Checkout Completed</h3>
<ul class="checkout-table">
    <li><strong>Your Order Number {{$order->order_id}} was Completed Successfully!</strong>
        <!-- <input type="text"> -->
    </li>
    

</ul>

</div>



    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      

  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-5e03f34e38152f20eb79c96b0b89c2d99c5085e9ae9386dc71e2f0b3c30bf513.js"></script>



 
</body></html>