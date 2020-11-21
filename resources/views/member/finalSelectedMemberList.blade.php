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
     <?php if(Session::get('succes') != null) { ?>
   <div class="alert alert-info alert-dismissible" role="alert">
  <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
  <strong><?php echo Session::get('succes') ;  ?></strong>
  <?php Session::put('succes',null) ;  ?>
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
               <!-- BEGIN SAMPLE FORM PORTLET-->
              <div class="portlet box blue">
                  <div class="portlet-title">
                      <div class="caption">
                      চুড়ান্ত ভাবে নির্বাচিত সদস্য প্রতিবেদন
                    </div>
                  </div>
                  <div class="portlet-body form">
                           
                           <form class="form-horizontal">
                          <div class="form-body" style="background-color: whitesmoke">
                              <div class="form-group">
                                  
                                    <div class="col-md-5">
                                      ইউনিয়ন / পৌরসভা নির্বাচন করুন
                                       <select class="form-control spinner selectpicker" data-live-search="true" id="union_id" required="">
                                        <option value="">নির্বাচন করুন</option>
                                         <?php foreach ($result as $value) { ?>
                                         <option value="<?php echo $value->id;?>">
                                           <?php echo $value->unpb_name ;?>
                                        </option>
                                         <?php } ?>
                                       </select>
                                    </div>

                                    <div class="col-md-5">
                                      বছর নির্বাচন করুন
                                       <select class="form-control spinner selectpicker" data-live-search="true" id="year">
                                        <option value="">নির্বাচন করুন</option>
                                         <?php foreach ($member_info as $value2) { ?>
                                         <option value="<?php echo $value2->year;?>">
                                           <?php echo $value2->year ;?>
                                        </option>
                                         <?php } ?>
                                       </select>
                                    </div>
                                     <div class="col-md-1">
                                      <button  type="button" class="btn btn-info btn-sm" id="report" style="margin-top:21px">প্রতিবেদন দেখুন</button>
                                    </div>
                              </div>

                     </form>
              </div>
              <!-- END SAMPLE FORM PORTLET-->

          </div>
      </div>
      <div class="clearfix"></div>
      <!-- END DASHBOARD STATS 1-->
  <div class="col-md-12" style="display:none;" id="loader">
  <div class="col-md-5"></div>
  <div class="col-md-2">
<div class="loader">
</div>
</div>
<div class="col-md-5"></div>
</div>
   <span id="failed" style="color:red"></span>
   <div id="get_content" style="display: none;"></div>


  </div><!-- END PAGE CONTENT BODY -->

</div><!-- END PAGE CONTENT -->             
</div><!-- END CONTAINER -->
@endsection
@section('js')
   <script>
     $('#report').click(function(e){
       e.preventDefault();
       var union_id      = $('#union_id').val();
       var year          = $('#year').val();

       if(union_id == ''){
        alert('ইউনিয়ন / পৌরসভা নির্বাচন করুন');
        return false ;
       }

        $('#loader').removeAttr( 'style' );
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
       $.ajax({
        'url':"{{ url('/viewFinalSelectedMemberList') }}",
        'type':'post',
        'dataType':'text',
        data:{  
          union_id:union_id, 
          year:year ,
        },
         success:function(data)
         {
          if(data =='f1'){
          $('#failed').text('No Data Found');
          $('#loader').attr("style", "display: none;");
          $('#get_content').attr("style", "display: none;");
          }else{
          $('#failed').text('');
          $('#loader').attr("style", "display: none;");
          $('#get_content').removeAttr( 'style' );
          $('#get_content').html(data);
        }
        }
        });
       });
    </script>
    @endsection