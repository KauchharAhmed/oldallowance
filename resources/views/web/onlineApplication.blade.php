<!DOCTYPE html>
<html lang="en">
<head>
  <title>ভাতার আবেদন</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{URL::to('images/favicon.ico')}}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
</head>
<body>

<div class="container">

  @if (count($errors) > 0)
  <div class="alert alert-danger">
  <ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
  </ul>
  </div>
  @endif

  <?php if(Session::get('success') != null) { ?>
  <div class="alert alert-info alert-dismissible" role="alert">
  <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
  <strong><?php echo Session::get('success') ;  ?></strong>
  <?php Session::put('success',null) ;  ?>
  </div>
  <?php } ?>

  <?php
  if(Session::get('failed') != null) { ?>
   <div class="alert alert-danger alert-dismissible" role="alert">
    <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
   <strong><?php echo Session::get('failed') ; ?></strong>
   <?php echo Session::put('failed',null) ; ?>
  </div>
  <?php } ?>

  <center><h3 style="margin-top: 10px;"><?php echo $allowanceQuery->type_name; ?> এর জন্য আবেদন</h3></center><br>
  {!! Form::open(['url' =>'addOnlineApplicationInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}

  <div class="row" style="background-color: #e9ebee;padding: 10px;border-radius: 5px;">
    <div class="col-md-6">
      <div class="form-group">
      <label>নাম বাংলায় <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="নাম বাংলায়" name="name_bangla" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>নাম ইংরেজিতে <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="নাম ইংরেজিতে" name="name" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>পিতা / স্বামীর নাম <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="পিতা / স্বামীর নাম" name="father_name" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>মাতার নাম <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="মাতার নাম" name="mother_name" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর" name="nid_number" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>জন্ম তারিখ <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" id="datepicker" class="form-control" placeholder="জন্ম তারিখ" name="dob" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>লিঙ্গ <span style="font-weight: bolder;color:red;">*</span></label>
      <select class="form-control spinner selectpicker" data-live-search="true" name="gender" required>
        <option value="">লিঙ্গ নির্বাচন</option>
        <option value="পুরুষ">পুরুষ</option>
        <option value="মহিলা">মহিলা</option>
        <option value="অন্যান্য">অন্যান্য</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>ধর্ম <span style="font-weight: bolder;color:red;">*</span></label>
      <select class="form-control spinner selectpicker" data-live-search="true" name="religion" required>
        <option value="">ধর্ম নির্বাচন করুন</option>
        <option value="ইসলাম">ইসলাম</option>
        <option value="হিন্দু">হিন্দু</option>
        <option value="খ্রীষ্টান">খ্রীষ্টান</option>
        <option value="অন্যান্য">অন্যান্য</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>বর্তমান ঠিকানা <span style="font-weight: bolder;color:red;">*</span></label>
      <textarea class="form-control spinner" name="present_address" placeholder="বর্তমান ঠিকানা" rows="4" cols="70" required></textarea>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>স্থায়ী ঠিকানা <span style="font-weight: bolder;color:red;">*</span></label>
      <textarea class="form-control spinner" name="permanent_address" placeholder="স্থায়ী ঠিকান" rows="4" cols="70" required></textarea>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>ইউনিয়ন / পৌরসভা <span style="font-weight: bolder;color:red;">*</span></label>
      <select name="union_id" class="form-control">
        <option value="">ইউনিয়ন / পৌরসভা নির্বাচন করুন</option>
        <?php foreach($unionQuery as $value){ ?>
        <option value="<?php echo $value->id; ?>"><?php echo $value->unpb_name; ?></option>
        <?php } ?>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>বৈবাহিক অবস্থা <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="বৈবাহিক অবস্থা" name="married_status" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>মোবাইল নম্বর </label>
      <input type="number" class="form-control" placeholder="মোবাইল নম্বর" name="mobile_number">
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>স্বাস্থ্যগত অবস্থা </label>
      <select class="form-control spinner selectpicker" data-live-search="true" name="health_condition">
        <option value="">স্বাস্থ্যগত অবস্থা নির্বাচন করুন</option>
        <option value="সম্পূর্ণ কর্মক্ষমতাহীন">সম্পূর্ণ কর্মক্ষমতাহীন</option>
        <option value="অসুস্থ">অসুস্থ</option>
        <option value="অপ্রকৃতিস্থ">অপ্রকৃতিস্থ</option>
        <option value="প্রতিবন্ধী">প্রতিবন্ধী</option>
        <option value="আংশিক কর্মক্ষমতাহীন">আংশিক কর্মক্ষমতাহীন</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>পেশা <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="পেশা" name="occupation" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>সামাজিক অবস্থা </label>
      <select class="form-control spinner selectpicker" data-live-search="true" name="social_status">
        <option value="">সামাজিক অবস্থা নির্বাচন করুন</option>
        <option value="বিধবা">বিধবা</option>
        <option value="তালাকপ্রাপ্তা">তালাকপ্রাপ্তা</option>
        <option value="বিপত্নীক">বিপত্নীক</option>
        <option value="পরিবার থেকে বিচ্ছিন্ন">পরিবার থেকে বিচ্ছিন্ন</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>বার্ষিক গড় আয় <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="number" class="form-control" placeholder="বার্ষিক গড় আয়" name="annual_income" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>জমির পরিমান <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="জমির পরিমান" name="land_amount" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>আপনার পরিবারের কোন সদস্য এই সুবিধা ভোগ করে <span style="font-weight: bolder;color:red;">*</span></label>
      <select name="other_member_use_this_advantage" class="form-control">
        <option value="">নির্বাচন করুন</option>
        <option value="হ্যাঁ">হ্যাঁ</option>
        <option value="না">না</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>নমিনীর নাম </label>
      <input type="text" class="form-control" placeholder="নমিনীর নাম" name="nominee_name">
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>আর্থিক অবস্থা <span style="font-weight: bolder;color:red;">*</span></label>
      <select class="form-control spinner selectpicker" data-live-search="true" name="financial_condition"  required>
        <option value="">আর্থিক অবস্থা নির্বাচন করুন</option>
        <option value="নিঃস্ব">নিঃস্ব</option>
        <option value="উদ্বাস্তু">উদ্বাস্তু</option>
        <option value="ভূমিহীন">ভূমিহীন</option>
      </select>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>ভাতাভোগীর সাথে সম্পর্ক</label>
      <input type="text" class="form-control" placeholder="ভাতাভোগীর সাথে সম্পর্ক" name="relationship_with_allowance">
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>সনাক্তকরণ চিহ্ন <span style="font-weight: bolder;color:red;">*</span></label>
      <input type="text" class="form-control" placeholder="সনাক্তকরণ চিহ্ন" name="identification_mark">
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>আবেদনকারীর পাসপোর্ট সাইজের সত্যায়িত ছবি (ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে) </label>
      <input type="file" name="member_photo" required>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>নমিনীর ঠিকানা </label>
      <input type="text" class="form-control" placeholder="নমিনীর ঠিকানা" name="nominee_address">
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>নমিনীর পাসপোর্ট সাইজের সত্যায়িত ছবি (ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে) </label>
      <input type="file" name="nominee_photo">
    </div>
    </div>
    <input type="hidden" name="allowance_type_id" value="<?php echo $allowance_type_id; ?>">
    <div class="col-md-12">
      <button type="submit" class="btn btn-info btn-block">জমা দিন</button>
    </div>
  </div>
  </form>
</div>

</body>
</html>
