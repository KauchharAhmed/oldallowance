<!DOCTYPE html>
<html lang="en">
<head>
  <title>বয়স্ক ভাতা কর্মসূচি | অ্যাডমিন লগিন পেজ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="shortcut icon" href="{{URL::to('images/favicon.ico')}}" /> 
  <link rel="stylesheet" type="text/css" href="{{URL::to('public/assets/login_css.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css" media="screen">
      body{
        background-image:url('{{URL::to("images/background.jpg")}}') ;
        background-size: cover ;
      }

  </style>

</head>
<body>
<div class="bg-image"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <center><img src="./images/appsLogo.png" id="loginPagelogo" style="display:none;padding: 20px;"></center>
        <br>
        <div style="background: #fbf5f58f!important;padding: 10px;">
          <div style="background-color: #f2dede;border-color: #ebccd1;padding: 10px;">
            <p style="color: #a94442;text-align: justify;font-size: 18px;">অনুগ্রহর্পূবক অ্যাপ্লকিশেনরে সকল র্কাযক্রম উপভোগ করতে Google Chrome ব্যবহার করুন। Google Chrome ইন্সটল না থাকলে <a href="https://www.google.com/chrome/" target="_new" title="Google Chrome">এখানে ক্লিক করুন</a> ।</p>
          </div>
          <br>

           @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                 @endforeach
                </ul>
            </div>
            @endif
            @if (!empty(Session::get('login_faild')))
            <div class="alert alert-danger">
            <?php
            $message= Session::get('login_faild');
            if($message){
                echo $message;
                Session::put('login_faild',null);
                }
            ?>
            </div>
            @endif
            @if (!empty(Session::get('password_change')))
            <div class="alert alert-info">
            <?php
            $message1 = Session::get('password_change');
            if($message1){
                echo $message1;
                Session::put('password_change',null);
                }
            ?>
            </div>
            @endif
          
          <div style="background: white;margin-top: 20px;padding: 10px;">
                {!! Form::open(['url' => 'adminLogin','method' => 'post' , 'class'=> 'form-inline' ]) !!}
              <input type="text" class="form-control" placeholder="ইউজারনেম / ইউজার আইডি" name="mobile" style="width: 245px!important" required="">

              <input type="password" class="form-control" placeholder="পাসওয়ার্ড" name="password" id="password_input" required="">

              <button type="submit" class="btn btn-primary mb-2 ml-auto" style="margin-top: 20px;">প্রবেশ <i class="fa fa-sign-in" aria-hidden="true"></i></button>  
            {!! Form::close() !!}
          </div>
          <br>
          <a href="#" title="" id="helpDesk">হেল্প ডেস্ক </a>


          <div class="row container" id="clickToggle">
            <div class="col-md-12" style="background: white;margin-top: 10px;padding: 10px;">
              <div class="row">
                <div class="col-md-7">
                  <span> <i class="fa fa-mobile" aria-hidden="true" style="font-size: 23px;"></i>&nbsp; ০৭৫১-৬২১৩০</span><br>
                  <span><i class="fa fa-mobile" aria-hidden="true" style="font-size: 23px;"></i>&nbsp; +৮৮  ০১৭৩৩-৩৩৫০৩০</span><br>
                  <span><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<a href="http://sirajganjsadar.sirajganj.gov.bd/" title="" target="_new">sirajganjsadar.sirajganj.gov.bd</a></span><br>
                  <span><i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp;<a href="" title="">facebook</a></span><br>
                </div>
                <div class="col-md-5">
                  <span><i class="fa fa-mobile" aria-hidden="true" style="font-size: 23px;"></i>&nbsp;<a href="http://www.e-certificatecasesadarsiraj.gov.bd/download/ecertificate.apk" title="">মোবাইল অ্যাপ</a></span><br>
                  <span><i class="fa fa-question" aria-hidden="true"></i><a href="#" title="">&nbsp; আপনার জিজ্ঞাসা</a></span><br>
                  <span><i class="fa fa-book" aria-hidden="true"></i><a href="#" title="">&nbsp; ব্যবহার সহায়িকা</a></span><br>
                  <span><i class="fa fa-play" aria-hidden="true"></i>&nbsp;<a href="" title="">ভিডিও টিউটোরিয়াল</a></span><br>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-6">
              কারিগরি সহযোগিতায়ঃ <br>
              আমিনুল ইসলাম <br>
              (উপজেলা টেকনিশিয়ান)
            </div>
            <div class="col-md-6 developer">
                Developed By:
                <a href="http://www.asianitinc.com" target="_new">ASIAN IT INC.</a>
                <center><img src="{{URL::to('images/logo.png')}}" style="margin-top: 5px;"></center>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>
</html>

  <script>
    $("#helpDesk").click(function() {
      $("#clickToggle").toggleClass("activeDeactive");
    });  
  </script>
