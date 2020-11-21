          @extends('udc.masterUDC')
          @section('content')
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                   ভাতার জন্য আবেদন
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"></h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1--> 
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


<div class="row">
 <div class="col-md-12">
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption" style="text-transform: uppercase;">
             ভাতার জন্য আবেদন </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['url' =>'addOldAgeAllowanceApplicationInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
            <div class="form-body row">

                <div class="col-md-6">

                  <div class="form-group">
                    <label class="col-md-4 control-label">ভাতার প্রকারভেদ<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="allowance_type" required>
                          <option value="">ভাতার প্রকারভেদ নির্বাচন</option>
                          <?php foreach ($allowance_type as $allowance_value) { ?>
                          <option value="<?php echo $allowance_value->id ?>"><?php echo $allowance_value->type_name; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">নাম বাংলায়<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name_bangla" placeholder="নাম বাংলায়" required="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">পিতা / স্বামীর নাম <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="father_name" placeholder="পিতা / স্বামীর নাম" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nid_number" placeholder="জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর" required="">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">লিঙ্গ<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="gender" required="">
                          <option value="">লিঙ্গ নির্বাচন</option>
                          <option value="পুরুষ">পুরুষ</option>
                          <option value="মহিলা">মহিলা</option>
                          <option value="অন্যান্য">অন্যান্য</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">বর্তমান ঠিকানা <span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control spinner" name="present_address" placeholder="বর্তমান ঠিকানা" rows="4" cols="70"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">বৈবাহিক অবস্থা<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="married_status" placeholder="বৈবাহিক অবস্থা" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জমির পরিমান<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="land_amount" placeholder="জমির পরিমান" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">আপনার পরিবারের কোন সদস্য এই সুবিধা ভোগ করে<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <select name="other_member_use_this_advantage" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            <option value="হ্যাঁ">হ্যাঁ</option>
                            <option value="না">না</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">স্বাস্থ্যগত অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="health_condition" >
                            <option value="">স্বাস্থ্যগত অবস্থা নির্বাচন করুন</option>
                            <option value="সম্পূর্ণ কর্মক্ষমতাহীন">সম্পূর্ণ কর্মক্ষমতাহীন</option>
                            <option value="অসুস্থ">অসুস্থ</option>
                            <option value="অপ্রকৃতিস্থ">অপ্রকৃতিস্থ</option>
                            <option value="প্রতিবন্ধী">প্রতিবন্ধী</option>
                            <option value="আংশিক কর্মক্ষমতাহীন">আংশিক কর্মক্ষমতাহীন</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">সামাজিক অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="social_status">
                            <option value="">সামাজিক অবস্থা নির্বাচন করুন</option>
                            <option value="বিধবা">বিধবা</option>
                            <option value="তালাকপ্রাপ্তা">তালাকপ্রাপ্তা</option>
                            <option value="বিপত্নীক">বিপত্নীক</option>
                            <option value="পরিবার থেকে বিচ্ছিন্ন">পরিবার থেকে বিচ্ছিন্ন</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর নাম</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nominee_name" placeholder="নমিনীর নাম">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">ভাতাভোগীর সাথে সম্পর্ক</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="relationship_with_allowance" placeholder="ভাতাভোগীর সাথে সম্পর্ক">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">আবেদনকারীর পাসপোর্ট সাইজের সত্যায়িত ছবি <span style="color:green">(ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে)</span></label>
                    <div class="col-md-8">
                         <input type="file" class="form-control m-input m-input--square" name="member_photo" required="">
                    </div>
                  </div>

       
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label class="col-md-4 control-label">নাম ইংরেজিতে<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name" placeholder="নাম ইংরেজিতে" required="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">মাতার নাম <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="mother_name" placeholder="মাতার নাম" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জন্ম তারিখ<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input class="form-control date-picker" data-date-format="dd-mm-yyyy"  type="text" name="dob" required="">
                      </div>
                  </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">ধর্ম<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="religion" required="">
                            <option value="">ধর্ম নির্বাচন করুন</option>
                            <option value="ইসলাম">ইসলাম</option>
                            <option value="হিন্দু">হিন্দু</option>
                            <option value="খ্রীষ্টান">খ্রীষ্টান</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                      </div>
                    </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">স্থায়ী ঠিকানা <span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control spinner" name="permanent_address" placeholder="স্থায়ী ঠিকান" rows="4" cols="70"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">মোবাইল নম্বর</label>
                      <div class="col-md-8">
                          <input type="number" class="form-control spinner" name="mobile_number" placeholder="মোবাইল নম্বর">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">পেশা <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="occupation" placeholder="পেশা" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">বার্ষিক গড় আয় <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="number" class="form-control spinner" name="annual_income" placeholder="বার্ষিক গড় আয়" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">আর্থিক অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="financial_condition" >
                            <option value="">আর্থিক অবস্থা নির্বাচন করুন</option>
                            <option value="নিঃস্ব">নিঃস্ব</option>
                            <option value="উদ্বাস্তু">উদ্বাস্তু</option>
                            <option value="ভূমিহীন">ভূমিহীন</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">সনাক্তকরণ চিহ্ন <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="identification_mark" placeholder="সনাক্তকরণ চিহ্ন" required="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর ঠিকানা</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nominee_address" placeholder="নমিনীর ঠিকানা">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর পাসপোর্ট সাইজের সত্যায়িত ছবি <span style="color:green">(ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে)</span></label>
                      <div class="col-md-8">
                          <input type="file" class="form-control m-input m-input--square" name="nominee_photo" >
                      </div>
                    </div>


                </div>
                
                <div class="form-group">
                    <label class="col-md-5 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" class="btn green">জমা দিন</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->
</div><!-- END PAGE CONTENT BODY -->
</div><!-- END PAGE CONTENT -->             
</div><!-- END CONTAINER -->
@endsection