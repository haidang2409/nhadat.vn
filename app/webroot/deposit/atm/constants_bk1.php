<?php
//82d5c876fa21345b
//CẤU HÌNH TÀI KHOẢN (Configure account)
define('EMAIL_BUSINESS','haidangdhct24@gmail.com');//Email Bảo kim
define('MERCHANT_ID','32832');                // Mã website tích hợp
define('SECURE_PASS','82d5c876fa21345b');   // Mật khẩu

// Cấu hình tài khoản tích hợp
define('API_USER','haidang2409');  //API USER
//define('API_PWD','2q1vYc8pJ57bAW9VjCnXH1htk3GOK');       //API PASSWORD
define('API_PWD','lYQU1pAgH2J641Zah2rI2R8912Lom');       //API PASSWORD
define('PRIVATE_KEY_BAOKIM','-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAu26eH79JDavAzUHtYHFMbPIzMmn5IHguGlFXpvLdEeP6hq4b
bPSmVkAiTifPXVQ2Y8Ez7pmFGuh8a18u0lDI32s3dUKGeco5qvUfpBps7h5Vzk4z
8kFdJbw7K7qDoIxy0EadXgxA0Og074bh9dGrNQcdugxKdVZa2lSLqoMeCIDyM3ka
YdPSqgRTIifCzl1i2ifVR/U9UUx+kiJIus+aRBHVB++hpIsN6wbpX3jET8coyTCM
Q+wDXd3whoHlUSj0hsmA/zkTJQLHcp8zIPebLhf9ID7edgJw+OhEx89StuYMfAkC
hlW3VrU/hi1pFxzqfm5DXG7YCjdbF+7bqv+ZIQIDAQABAoIBABgYU1mPdKu+Pa3l
YMe6KPIEfNJpTy5+ZKbbeCItLIBFR4qSzVHHba6+1eooMf80eT1/s9Zjg/n+kygW
d2VwHzKhjOKVJ8Z2Wc2Bb4zgHMrLuYopAYKOJpRYS18Gvi8gfw4JVeemOZrhjxSP
yXKZfqH1hTvKorPM4ycYIVBNRMog2Seqn+MCXn0IH0eHW8ywYcJjEPjBF+7uF5gY
CiYSZ1oT9K7xADVLHPB3+XWjutl4YDzObquRKvQ9czt8O6whzfB9sMpOZy60fDe7
uNwfPxbN9EI14xHih2Ba7DtykNfnJHGe3n0qSojhS7ojxZOLy127myCcxOY1/3vl
d/eAybUCgYEA4q9AA4fA2uxdz7i1f6INzTZaeiu/9qcRZv8AWtFaZaTMQAun+Dm3
eUJPsgHGX+Bg40Rmg56ArynpVLDiY47yAL0Bgt5R3xZZfdpu0SLGp/GX7gXGcYAx
g3RtEelTg2j4CorqJmLqUBoatRKrP5rY08zBzzMcFuU74M5Rp5buL1sCgYEA06va
TJ2Jsz04wCIckIilzkFrG5wCNQKXgndXN/VpvLxXdL/SZgsKc0ceh6/yAVdTvsCZ
MHtey01/ZYG2v0dZvefAuNGXJwS8OFvvlRN9B5feb2vWy5ahNteENJb9+Tj2x034
TAxNe3+zWPhPNrlUf+dlgdvXvMT/Mas27duWnjMCgYBogpHJzuHMTSNnLGqJYKZq
UT/fiaIkTpxIVxLLzC+YIyWD9ZvIZpu/TSI/GHBkLaedwCBfWElN+M25nR+S9Ql/
66PxuRwX9U7nJjjnNNhP/6OjOohmNcseJyROGLvHHzMUcT1I21vZ+F8N0oCff32u
EH3eUFsH90HnAFhHIt/HdwKBgQC4Pm0MpU/XsWF1c/uzHw5bwvuNE7WkGLZyfJhx
f+9itfnWCKYF5nRZNT1w1AhtfGrLre9pkOlJQxKx8z9zrZKCx3gsJ1tPPkLrN7MJ
6uW4t0uJZq+XlGyNRPixogA9b4T2pHqND2ReLCCbP8ALnTPdBTiI2SgnCr4qqKJu
VeX7mwKBgQCIrUdE1Vvy6UlUioaL7C5UeGVFYYD3lJTAfxtpyWWbJWmw8YL7HFQz
1t8AUmrs3ABOVEbplCMG19BO1/9Xcs+ttz2Mr50JRWlvjlHDPPMlrd8fy9jRBf+l
To7VCe0KUZwQwzy8IENvYyu1iBY+CLOr91aG1jRaS4jV+YVuhxUKAA==
-----END RSA PRIVATE KEY-----');

define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT','/payment/order/version11');

// define('BAOKIM_URL','https://www.baokim.vn');
// define('BAOKIM_URL','http://baokim.dev');
define('BAOKIM_URL','https://sandbox.baokim.vn');

//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);

?>