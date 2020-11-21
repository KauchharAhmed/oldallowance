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
                                    প্রোফাইল
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
 <div class="col-md-4">
     <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption" style="text-transform: uppercase;">
             প্রোফাইল </div>
        </div>
        <div class="portlet-body form">
            
            <div class="row" style="padding: 10px;">
                <div class="col-md-4">
                    <img src="{{URL::to('')}}/<?php echo $profile_info->image; ?>" alt="Profile Image" style="width: 100px;height: 80px;display: <?php if(empty($profile_info->image)){echo "none"; }else{echo ""; } ?>">
                    <img src="{{URL::to('public/assets/layouts/layout/img/avatar.jpg')}}" alt="Profile Image" style="width: 100px;height: 100px;display: <?php if(empty($profile_info->image)){echo ""; }else{echo "none"; } ?>">
                </div>
                <div class="col-md-8">
                    <h4><?php echo $profile_info->name; ?></h4>
                    <P style="margin: 0px!important;"><?php echo $profile_info->email; ?></P>
                    <P style="margin: 0px!important;"><?php echo $profile_info->mobile; ?></P>
                    <br>
                    <a href="{{URL::to('editUDCAdminPofile')}}" title="Edit Profile" class="btn btn-success">সংশোধন</a>
                </div>
            </div>  

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