          @extends('admin.masterAdmin')
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
                                   ব্যবহারকারী
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
 <div class="col-md-8">
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue"> 
        <div class="portlet-title">
            <div class="caption" style="text-transform: uppercase;">
                ব্যবহার কারীর তথ্য হালনাগাদ করুন
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['url' =>'updateUdcUserInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
            <div class="form-body">

            	<div class="form-group">
                    <label class="col-md-4 control-label">ইউনিয়ন / পৌরসভা নির্বাচন করুন<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="union_id" required="">
                          <option value="">নির্বাচন</option>
                          <?php foreach ($all_union as $value2) { ?>
                              <option value="<?php echo $value2->id ; ?>" <?php if($value2->id == $value->union_id){echo "selected";}else{echo ""; } ?>><?php echo $value2->unpb_name ; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">নাম<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name" value="<?php echo $value->name ; ?>" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">পিতা / স্বামীর নাম</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="father_name" placeholder="পিতা / স্বামীর নাম" value="<?php echo $value->father_name ; ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">মোবাইল<span style="color:red; font-weight: bold">*</span>  <span style="color:red">(মোবাইল নম্বর অবশ্যই ইংরেজি হতে হবে)</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="mobile" value="<?php echo $value->mobile ; ?>" required="" readonly="">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">ঠিকানা</label>
                    <div class="col-md-8">
                        <textarea class="form-control spinner" name="adddress" rows="4" cols="70"><?php echo $value->address ; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">ছবি</label>
                    <div class="col-md-8">
                        <img src="{{URL::to('/'.$value->image)}}" alt="" style="width: 100px;height: 100px;">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">ছবি<span style="color:green">(ছবি অবশ্যই জেপিজি, জেপিজি, পিএনজি টাইপ এবং সর্বোচ্চ আকার ৫০০ কেবি হতে হবে)</span></label>
                    <div class="col-md-8">
                        <input type="file" class="form-control m-input m-input--square" name="image" >
                    </div>
                </div>

                <input type="hidden" name="primary_id" value="<?php echo $value->id ; ?>">

                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-8">
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
