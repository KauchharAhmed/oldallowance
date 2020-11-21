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
                                    আবেদন কারী সদস্যদের তালিকা
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
                        <span class="caption-subject bold uppercase">আবেদন কারী সদস্যদের তালিকা</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th>ক্রমিক সংখ্যা</th>
                                <th>নাম</th>
                                <th>পিতা / স্বামীর নাম</th>
                                <th>বয়স</th>
                                <th>লিঙ্গ</th>
                                <th>বার্ষিক গড় আয়</th>
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
                                <td><?php echo $value->name_bangla ; ?></td>
                                <td><?php echo $value->father_name ; ?></td>
                                <td><?php echo $value->age ; ?></td>
                                <td><?php echo $value->gender ; ?></td>
                                <td><?php echo $value->annual_income ; ?></td>
                                <td>
                                    <img src="{{URL::to('/'.$value->member_photo)}}" alt="" style="width: 50px;height: 50px;">
                                </td>
                                <td><?php if($value->status == 0){echo "অমীমাংসিত"; }elseif($value->status == 1){echo "প্রাথমিক নির্বাচিত"; } elseif($value->status == 2){echo "নির্বাচিত"; }else{echo "গ্রহণ করা হয়নি";} ?></td>
                                <td>
                                    <a href="{{URL::to('editMemberInfo/'.$value->id)}}" title="">
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