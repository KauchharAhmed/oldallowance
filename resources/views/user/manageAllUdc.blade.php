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

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)      
 <div class="alert alert-danger alert-dismissible" role="alert">
   <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
  <strong>{{ $error }}</strong>
</div>
@endforeach
@endif
<div class="row">
 
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">সকল বব্যবহারকারীদের তালিকা</span>
                    </div>
                    <a href="{{URL::to('addUdc')}}" style="float:right;margin-right:6px;" class="btn btn-success" >ব্যবহারকারী যুক্ত </a>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th>ক্রমিক সংখ্যা</th>
                                <th>ইউনিয়ন / পৌরসভা</th>
                                <th>নাম</th>
                                <th>মোবাইল</th>
                                <th>ঠিকানা</th>
                                <th>ছবি</th>
                                <th>অবস্থা</th>
                                <th>সংশোধন</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ;
                            foreach ($result as $value) { ?>
                            <tr>
                                <td><?php echo $i++ ; ?></td>
                                <td><?php echo $value->unpb_name ; ?></td>
                                <td><?php echo $value->name ; ?></td>
                                <td><?php echo $value->mobile ; ?></td>
                                <td><?php echo $value->address ; ?></td>
                                <td>
                                    <img src="{{URL::to('/'.$value->image)}}" alt="" style="width: 50px;height: 50px;">
                                </td>
                                <td><?php if($value->status == 1){echo "সক্রিয়"; }else{echo "নিষ্ক্রিয়"; } ?></td>
                                <td>
                                    <a href="{{URL::to('editUdcUserInfo/'.$value->id)}}" title="">
                                        <button type="button" class="btn btn-info btn-sm">সংশোধন</button>
                                    </a>
                                </td>

                            </tr>
                            <?php } ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div><!-- END PAGE CONTENT BODY -->
</div><!-- END PAGE CONTENT -->             
</div><!-- END CONTAINER -->
@endsection