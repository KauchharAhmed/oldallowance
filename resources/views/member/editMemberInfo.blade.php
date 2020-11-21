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
                                    সদস্যার তথ্য হালনাগাদ করুন 
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
              সদস্যার তথ্য হালনাগাদ করুন </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['url' =>'updateOldAgeAllowanceApplicationInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
            <div class="form-body row">

                <div class="col-md-6">

                  <div class="form-group">
                    <label class="col-md-4 control-label">ভাতার প্রকারভেদ<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="allowance_type" required>
                          <option value="<?php echo $value->allowance_type_id; ?>"><?php echo $value->type_name; ?></option>
                          <?php foreach ($allowance_type as $allowance_value) { ?>
                          <option value="<?php echo $allowance_value->id ?>"><?php echo $allowance_value->type_name; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">নাম বাংলায়<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name_bangla" value="<?php echo $value->name_bangla ; ?>" required="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">পিতা / স্বামীর নাম <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="father_name" value="<?php echo $value->father_name ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nid_number" value="<?php echo $value->nid_number ; ?>" required="" readonly>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">লিঙ্গ<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="gender" required="">
                          <option value="">লিঙ্গ নির্বাচন</option>
                          <option value="পুরুষ" <?php if($value->gender == "পুরুষ"){echo "selected";}else{echo "";} ?>>পুরুষ</option>
                          <option value="মহিলা" <?php if($value->gender == "মহিলা"){echo "selected";}else{echo "";} ?>>মহিলা</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">বর্তমান ঠিকানা <span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control spinner" name="present_address" rows="4" cols="70"><?php echo $value->present_address ; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">বৈবাহিক অবস্থা<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="married_status" value="<?php echo $value->married_status ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জমির পরিমান<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="land_amount" value="<?php echo $value->land_amount ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">আপনার পরিবারের কোন সদস্য এই সুবিধা ভোগ করে কি<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <select name="other_member_use_this_advantage" class="form-control">
                            <option value="<?php echo $value->other_member_use_this_advantage ; ?>"><?php echo $value->other_member_use_this_advantage ; ?></option>
                            <?php if($value->other_member_use_this_advantage == "হ্যাঁ" ){ ?>
                            <option value="না">না</option>
                            <?php } ?>
                            <?php if($value->other_member_use_this_advantage == "না" ){ ?>
                            <option value="হ্যাঁ">হ্যাঁ</option>
                            <?php } ?>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">স্বাস্থ্যগত অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="health_condition" >
                            <option value="">স্বাস্থ্যগত অবস্থা নির্বাচন করুন</option>
                            <option value="সম্পূর্ণ কর্মক্ষমতাহীন" <?php if($value->health_condition == "সম্পূর্ণ কর্মক্ষমতাহীন"){echo "selected";}else{echo "";} ?>>সম্পূর্ণ কর্মক্ষমতাহীন</option>
                            <option value="অসুস্থ" <?php if($value->health_condition == "অসুস্থ"){echo "selected";}else{echo "";} ?>>অসুস্থ</option>
                            <option value="অপ্রকৃতিস্থ" <?php if($value->health_condition == "অপ্রকৃতিস্থ"){echo "selected";}else{echo "";} ?>>অপ্রকৃতিস্থ</option>
                            <option value="প্রতিবন্ধী" <?php if($value->health_condition == "প্রতিবন্ধী"){echo "selected";}else{echo "";} ?>>প্রতিবন্ধী</option>
                            <option value="আংশিক কর্মক্ষমতাহীন" <?php if($value->health_condition == "আংশিক কর্মক্ষমতাহীন"){echo "selected";}else{echo "";} ?>>আংশিক কর্মক্ষমতাহীন</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">সামাজিক অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="social_status">
                            <option value="">সামাজিক অবস্থা নির্বাচন করুন</option>
                            <option value="বিধবা" <?php if($value->social_status == "বিধবা"){echo "selected";}else{echo "";} ?>>বিধবা</option>
                            <option value="তালাকপ্রাপ্তা" <?php if($value->social_status == "তালাকপ্রাপ্তা"){echo "selected";}else{echo "";} ?>>তালাকপ্রাপ্তা</option>
                            <option value="বিপত্নীক" <?php if($value->social_status == "বিপত্নীক"){echo "selected";}else{echo "";} ?>>বিপত্নীক</option>
                            <option value="পরিবার থেকে বিচ্ছিন্ন" <?php if($value->social_status == "পরিবার থেকে বিচ্ছিন্ন"){echo "selected";}else{echo "";} ?>>পরিবার থেকে বিচ্ছিন্ন</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর নাম</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nominee_name" value="<?php echo $value->nominee_name ; ?>">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">ভাতাভোগীর সাথে সম্পর্ক</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="relationship_with_allowance" value="<?php echo $value->relationship_with_allowance ; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">সত্যায়িত ছবি</label>
                    <div class="col-md-8">
                        <img src="{{URL::to('/'.$value->member_photo)}}" alt="" style="width: 100px;height: 100px;">
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-4 control-label">আবেদনকারীর পাসপোর্ট সাইজের সত্যায়িত ছবি <span style="color:green">(ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে)</span></label>
                    <div class="col-md-8">
                         <input type="file" class="form-control m-input m-input--square" name="member_photo" >
                    </div>
                  </div>

       
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label class="col-md-4 control-label">নাম ইংরেজিতে<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name" value="<?php echo $value->name ; ?>" required="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">মাতার নাম <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="mother_name" value="<?php echo $value->mother_name ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">জন্ম তারিখ<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input class="form-control"  type="text" name="dob" value="<?php echo date('d-m-Y',strtotime($value->dob)) ; ?>" required="" readonly>
                      </div>
                  </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">ধর্ম<span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="religion" required="">
                            <option value="">ধর্ম নির্বাচন করুন</option>
                            <option value="ইসলাম" <?php if($value->religion == "ইসলাম"){echo "selected";}else{echo "";} ?>>ইসলাম</option>
                            <option value="হিন্দু" <?php if($value->religion == "হিন্দু"){echo "selected";}else{echo "";} ?>>হিন্দু</option>
                            <option value="খ্রীষ্টান" <?php if($value->religion == "খ্রীষ্টান"){echo "selected";}else{echo "";} ?>>খ্রীষ্টান</option>
                            <option value="অন্যান্য" <?php if($value->religion == "অন্যান্য"){echo "selected";}else{echo "";} ?>>অন্যান্য</option>
                        </select>
                      </div>
                    </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label">স্থায়ী ঠিকানা <span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control spinner" name="permanent_address" rows="4" cols="70"><?php echo $value->permanent_address ; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">মোবাইল নম্বর</label>
                      <div class="col-md-8">
                          <input type="number" class="form-control spinner" name="mobile_number" value="<?php echo $value->mobile_number ; ?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">পেশা <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="occupation" value="<?php echo $value->occupation ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">বার্ষিক গড় আয় <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="number" class="form-control spinner" name="annual_income" value="<?php echo $value->annual_income ; ?>" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-md-4 control-label">আর্থিক অবস্থা</label>
                      <div class="col-md-8">
                        <select class="form-control spinner selectpicker" data-live-search="true" name="financial_condition" >
                            <option value="">আর্থিক অবস্থা নির্বাচন করুন</option>
                            <option value="নিঃস্ব" <?php if($value->financial_condition == "নিঃস্ব"){echo "selected";}else{echo "";} ?>>নিঃস্ব</option>
                            <option value="উদ্বাস্তু" <?php if($value->financial_condition == "উদ্বাস্তু"){echo "selected";}else{echo "";} ?>>উদ্বাস্তু</option>
                            <option value="ভূমিহীন" <?php if($value->financial_condition == "ভূমিহীন"){echo "selected";}else{echo "";} ?>>ভূমিহীন</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">সনাক্তকরণ চিহ্ন <span style="color:red; font-weight: bold">*</span></label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="identification_mark" value="<?php echo $value->identification_mark ; ?>" required="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর ঠিকানা</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control spinner" name="nominee_address" value="<?php echo $value->nominee_address ; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর সত্যায়িত ছবি</label>
                      <div class="col-md-8">
                          <img src="{{URL::to('/'.$value->nominee_photo)}}" alt="" style="width: 100px;height: 100px;">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label">নমিনীর পাসপোর্ট সাইজের সত্যায়িত ছবি <span style="color:green">(ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে)</span></label>
                      <div class="col-md-8">
                          <input type="file" class="form-control m-input m-input--square" name="nominee_photo" >
                      </div>
                    </div>

                </div>

                <input type="hidden" name="primary_id" value="<?php echo $value->id ; ?>">
                
                <div class="form-group">
                    <label class="col-md-5 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" class="btn green">সংশোধন</button>
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