<?php
$admin_id       = Session::get('admin_id');
$type           = Session::get('type');
       
       if($admin_id == null && $type == null){
       return Redirect::to('/admin')->send();
       exit();
        }

       if($admin_id == null && $type != '1'){
       return Redirect::to('/admin')->send();
       exit();
        }
        
        if($type != '1'){
       return Redirect::to('/admin')->send();
       exit();
        }

        ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>চুড়ান্ত ভাবে নির্বাচিত সদস্য সমূহ</title>
  <style type="text/css">
    table.nila {
      border-collapse: collapse;
    }

    table.nila, td.nila, th.nila {
      border: 1px solid black;
      padding:7px;
    }
  </style>
</head>
<body style="font-family: arial;">

      <center><h3><span style="font-family:tahoma;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">চুড়ান্ত ভাবে নির্বাচিত সদস্য সমূহ</span></h3></center>      
      <div class="row">
          <table style="font-size:12px;">
                <tr>
                  <td>ইউনিয়ন / পৌরসভা নাম</td>
                  <td>:</td>
                    <td><strong> 
                        <?php foreach ($result as $value1) {
                          
                        } ?>
                       <?php echo $value1->unpb_name ; ?>
                    </strong>
                  </td>
                 
                </tr>
                <tr>
                    <td>মুদ্রণ তারিখ</td>
                    <td>:</td>
                    <td><?php echo "Print : ".date('d-m-Y , h:i:s a') ; ?></td>
                </tr>
                <tr>
                    <td>সদস্য সংখ্যা</td>
                    <td>:</td>
                    <td><?php echo $check_count ; ; ?></td>
                </tr>
          </table>

<table width="100%" class="nila" style="font-size: 14px;">
  <thead>
 <tr>
      <th class="nila">সিরিয়াল</th>
      <th class="nila">আইডি</th>
      <th class="nila">তারিখ</th>
      <th class="nila">নাম</th>
      <th class="nila">পিতার / স্বামীর নাম</th>
      <th class="nila">জন্মনিবন্দন / জাতীয় পরিচয় পত্র</th>
      <th class="nila">বয়স</th>
      <th class="nila">স্বাস্থ্যগত অবস্থা</th>
      <th class="nila">বর্তমান ঠিকানা</th>
      <th class="nila">ছবি</th>
  </tr>
  </thead>
  <?php $i = 1 ;
    $total_collection = 0 ;
    foreach ($result as $value) {
     ?>
    <tbody>
      <tr>
          <td class="nila"><?php echo $i++ ;?></td>
          <td class="nila"><?php echo $value->id ;?></td>
          <td class="nila"><?php echo $value->created_at ; ?></td>
          <td class="nila"><?php echo $value->name_bangla ; ?></td>
          <td class="nila"><?php echo $value->father_name ; ?></td>
          <td class="nila"><?php echo $value->nid_number ; ?></td>
          <td class="nila"><?php echo $value->age ; ?></td>
          <td class="nila"><?php echo $value->health_condition ; ?></td>
          <td class="nila"><?php echo $value->present_address ; ?></td>
          <td class="nila"><img src="{{URL::to('/'.$value->member_photo)}}" alt="" style="width: 50px;height: 50px;"></td>
      </tr>
  </tbody>
<?php } ?>
</table>
  <script type="text/javascript">
  window.print();
  </script>
    </body>
</html>

   