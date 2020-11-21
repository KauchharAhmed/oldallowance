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
                                    ওয়ার্ড
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
              ইউনিয়ন / পৌরসভা ওয়ার্ড যুক্ত করুন</div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['url' =>'addUnionPaurashavaWardInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
            <div class="form-body">

                <div class="form-group">
                    <label class="col-md-4 control-label">ইউনিয়ন / পৌরসভা নির্বাচন করুন<span style="color:red; font-weight: bold">*</span></label>
                    <div class="col-md-8">
                      <select class="form-control spinner selectpicker" data-live-search="true" name="union_id" required="">
                          <option value="">নির্বাচন</option>
                          <?php foreach ($all_union as $value) { ?>
                              <option value="<?php echo $value->id ; ?>"><?php echo $value->unpb_name ; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">ওয়ার্ড এর নাম</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control spinner" name="wb_name" placeholder="ওয়ার্ড এর নাম" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn green">যুক্ত করুন</button>
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
