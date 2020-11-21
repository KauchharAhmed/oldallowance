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
                                    সম্পাদনা
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
 <div class="col-md-6">
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption" style="text-transform: uppercase;">
              প্রোফাইলের তথ্য সম্পাদনা করুন </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['url' =>'updateUDCAdminProfileInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 control-label">নাম<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="name" value="<?php echo $profile_info->name; ?>"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">ই-মেইল</label>
                    <div class="col-md-8">
                        <input type="email" class="form-control spinner" name="email" value="<?php echo $profile_info->email; ?>" required=""></div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">মুঠোফোন<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="mobile" value="<?php echo $profile_info->mobile; ?>" required="" readonly=""></div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">বর্তমান ছবি<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <img src="{{URL::to('')}}/<?php echo $profile_info->image; ?>" alt="Profile Image" style="width: 100px;height: 80px;display: <?php if(empty($profile_info->image)){echo "none"; }else{echo ""; } ?>">
                        <img src="{{URL::to('public/assets/layouts/layout/img/avatar.jpg')}}" alt="Profile Image" style="width: 100px;height: 100px;display: <?php if(empty($profile_info->image)){echo ""; }else{echo "none"; } ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">ছবি<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                        <input type="file" name="image" class="form-control spinner">
                    </div>
                </div>
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