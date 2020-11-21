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
                                    সদস্য
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
            সদস্যের বিস্তারিত তথ্য</div>
        </div>
        <div class="portlet-body form">
            <center>
                <img src="{{URL::to('')}}/<?php echo $value->member_photo ; ?>" alt="<?php echo $value->name ; ?>" style="height: 100px;width: 100px;margin-top: 10px;">
            </center>
            <div class="form-body row">
              
              <div class="col-md-6">
                  <div class="table-responsive" style="padding: 5px;">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>নাম বাংলায়</td>
                            <td>:</td>
                            <td><?php echo $value->name_bangla ; ?></td>
                        </tr>

                        <tr>
                            <td>পিতা / স্বামীর নাম</td>
                            <td>:</td>
                            <td><?php echo $value->father_name ; ?></td>
                        </tr>

                        <tr>
                            <td>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর</td>
                            <td>:</td>
                            <td><?php echo $value->nid_number ; ?></td>
                        </tr>

                        <tr>
                            <td>লিঙ্গ</td>
                            <td>:</td>
                            <td><?php echo $value->gender ; ?></td>
                        </tr>
                        <tr>
                            <td>বর্তমান ঠিকানা</td>
                            <td>:</td>
                            <td><?php echo $value->present_address ; ?></td>
                        </tr>
                        <tr>
                            <td>বৈবাহিক অবস্থা</td>
                            <td>:</td>
                            <td><?php echo $value->married_status ; ?></td>
                        </tr>
                        <tr>
                            <td>স্বাস্থ্যগত অবস্থা</td>
                            <td>:</td>
                            <td><?php echo $value->health_condition ; ?></td>
                        </tr>
                        <tr>
                            <td>সামাজিক অবস্থা</td>
                            <td>:</td>
                            <td><?php echo $value->social_status ; ?></td>
                        </tr>
                        <tr>
                            <td>নমিনীর নাম</td>
                            <td>:</td>
                            <td><?php echo $value->nominee_name ; ?></td>
                        </tr>
                        <tr>
                            <td>ভাতাভোগীর সাথে সম্পর্ক</td>
                            <td>:</td>
                            <td><?php echo $value->relationship_with_allowance ; ?></td>
                        </tr>
                    </table>
                  </div>  
              </div> 

              <div class="col-md-6">
                  <div class="table-responsive" style="padding: 5px;">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>নাম ইংরেজিতে</td>
                            <td>:</td>
                            <td><?php echo $value->name ; ?></td>
                        </tr>

                        <tr>
                            <td>মাতার নাম</td>
                            <td>:</td>
                            <td><?php echo $value->mother_name ; ?></td>
                        </tr>

                        <tr>
                            <td>জন্ম তারিখ</td>
                            <td>:</td>
                            <td><?php echo $value->dob ; ?></td>
                        </tr>

                        <tr>
                            <td>ধর্ম</td>
                            <td>:</td>
                            <td><?php echo $value->religion ; ?></td>
                        </tr>
                        <tr>
                            <td>স্থায়ী ঠিকানা</td>
                            <td>:</td>
                            <td><?php echo $value->permanent_address ; ?></td>
                        </tr>
                        <tr>
                            <td>মোবাইল নম্বর</td>
                            <td>:</td>
                            <td><?php echo $value->mobile_number ; ?></td>
                        </tr>
                        <tr>
                            <td>পেশা</td>
                            <td>:</td>
                            <td><?php echo $value->occupation ; ?></td>
                        </tr>
                        <tr>
                            <td>বার্ষিক গড় আয়</td>
                            <td>:</td>
                            <td><?php echo $value->annual_income ; ?></td>
                        </tr>
                        <tr>
                            <td>আর্থিক অবস্থা</td>
                            <td>:</td>
                            <td><?php echo $value->financial_condition ; ?></td>
                        </tr>
                        <tr>
                            <td>সনাক্তকরণ চিহ্ন</td>
                            <td>:</td>
                            <td><?php echo $value->identification_mark ; ?></td>
                        </tr>
                        <tr>
                            <td>নমিনীর ঠিকানা</td>
                            <td>:</td>
                            <td><?php echo $value->nominee_address ; ?></td>
                        </tr>
                    </table>
                  </div>  
              </div>    


            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
    <div class="clearfix"></div>

</div><!-- END PAGE CONTENT BODY -->

</div><!-- END PAGE CONTENT -->             
</div><!-- END CONTAINER -->
@endsection