  <div class="row">
 
    <div class="col-md-12">
         
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase">
                     <?php foreach ($result as $value1) {
                        
                     }
                     ?>
                      <?php echo $value1->unpb_name ; ?> প্রথমিক নির্বাচিত সদস্য সমূহ
                    </span>
                </div>
                {!! Form::open(['url' =>'printPrimarySelectedMemberList','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                  <input type="hidden" name="union_id" value="<?php echo $union_id;?>">
                  <input type="hidden" name="year" value="<?php echo $year;?>">

                <button type="submit" style="float:right;margin-right:6px;" class="btn btn-success">Print</button> 
              {!! Form::close() !!}  
            </div>
            <div class="portlet-body">
                 <div class="header">
        
             </div>
                <div class="table-responsive">
                  {!! Form::open(['url' =>'oldAllowanceMemberFinalSelection','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}

                  <button type="submit" class="btn btn-success btn-sm">চুড়ান্ত ভাবে নির্বাচন</button>
                <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>নির্বাচন</th>
                            <th>আইডি</th>
                            <th>তারিখ</th>
                            <th>নাম</th>
                            <th>পিতার / স্বামীর নাম</th>
                            <th>জন্মনিবন্দন / জাতীয় পরিচয় পত্র</th>
                            <th>বয়স</th>
                            <th>ছবি</th>
                            <th>বিস্তারিত</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ;
                        foreach ($result as $value) { 
                          ?>
                        <tr>
                            <td><input type="checkbox" name="primary_id[]" value="<?php echo $value->id ; ?>"></td>
                            <td><?php echo $value->id ;?></td>
                            <td><?php echo $value->created_at ; ?></td>
                            <td><?php echo $value->name_bangla ; ?></td>
                            <td><?php echo $value->father_name ; ?></td>
                            <td><?php echo $value->nid_number ; ?></td>
                            <td><?php echo $value->age ; ?></td>
                            <td>
                              <img src="{{URL::to('/'.$value->member_photo)}}" alt="" style="width: 50px;height: 50px;">
                            </td>
                            <td><a href="{{URL::to('viewMemberDetails/'.$value->id)}}" title="" class="btn btn-info btn-sm" target="_new">বিস্তারিত</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>

                    {!! Form::close() !!}
                </table>
            </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

  <!-- END DASHBOARD STATS 1-->
  </div><!-- END PAGE CONTENT BODY -->
             