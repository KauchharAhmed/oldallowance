<?php

  $admin_id       = Session::get('admin_id');

  if($admin_id == null){
   return Redirect::to('/admin')->send();
   exit();
  }
?>
    <!DOCTYPE HTML>
    <html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <title>সদস্যের বিস্তারিত তথ্য</title>
        <style type="text/css">
            body{
              font-family: arial;
            }
            table.siam {
                border-collapse: collapse;
            }
            
            table.siam,
            td.siam,
            th.siam {
                border: 1px solid black;
                padding: 7px;
                font-size: 14px;
            }
            .text_main {
              text-align: center;
              font-family: tahoma;
              margin: 0;
              padding: 0;
              line-height: 5px;
              padding-top: 10px;
            }
            @page {
              size: 4in 6in landscape;
            }

            @media print {
              @page {
                size: 4in 6in landscape;
              }
            }
        </style>
    </head>

    <body>
      <center><h3><span style="font-family:tahoma;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">সদস্যের বিস্তারিত তথ্য</span></h3></center> 

        <center>
            <h4 style="margin-bottom: 0;padding-bottom: 5px">সদস্যের ছবি</h4>
            <img src="{{URL::to('')}}/<?php echo $value->member_photo ; ?>" alt="<?php echo $value->name ; ?>" style="height: 100px;width: 100px;margin-bottom: 10px;border: 1px solid #fff">
        </center>
          <table class="siam" width="100%">
            <tr>
                <td class="siam">নাম বাংলায়</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->name_bangla ; ?></td>
            </tr>

            <tr>
                <td class="siam">নাম ইংরেজিতে</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->name ; ?></td>
            </tr>

            <tr>
                <td class="siam">পিতা / স্বামীর নাম</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->father_name ; ?></td>
            </tr>

            <tr>
                <td class="siam">মাতার নাম</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->mother_name ; ?></td>
            </tr>

            <tr>
                <td class="siam">জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->nid_number ; ?></td>
            </tr>

            <tr>
                  <td class="siam">জন্ম তারিখ</td>
                  <td class="siam">:</td>
                  <td class="siam"><?php echo $value->dob ; ?></td>
              </tr>

            <tr>
                <td class="siam">লিঙ্গ</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->gender ; ?></td>
            </tr>

            <tr>
                  <td class="siam">ধর্ম</td>
                  <td class="siam">:</td>
                  <td class="siam"><?php echo $value->religion ; ?></td>
              </tr>

            <tr>
                <td class="siam">বর্তমান ঠিকানা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->present_address ; ?></td>
            </tr>

            <tr>
                <td class="siam">স্থায়ী ঠিকানা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->permanent_address ; ?></td>
            </tr>

            <tr>
                <td class="siam">বৈবাহিক অবস্থা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->married_status ; ?></td>
            </tr>
            <tr>
                <td class="siam">মোবাইল নম্বর</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->mobile_number ; ?></td>
            </tr>

            <tr>
                <td class="siam">পেশা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->occupation ; ?></td>
            </tr>

            <tr>
                <td class="siam">বার্ষিক গড় আয়</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->annual_income ; ?></td>
            </tr>

            <tr>
                <td class="siam">স্বাস্থ্যগত অবস্থা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->health_condition ; ?></td>
            </tr>
            <tr>
                <td class="siam">সামাজিক অবস্থা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->social_status ; ?></td>
            </tr>
            <tr>
                <td class="siam">আর্থিক অবস্থা</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->financial_condition ; ?></td>
            </tr>
            <tr>
                  <td class="siam">সনাক্তকরণ চিহ্ন</td>
                  <td class="siam">:</td>
                  <td class="siam"><?php echo $value->identification_mark ; ?></td>
              </tr>
            <tr>
                <td class="siam">নমিনীর নাম</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->nominee_name ; ?></td>
            </tr>
            <tr>
                <td class="siam">ভাতাভোগীর সাথে সম্পর্ক</td>
                <td class="siam">:</td>
                <td class="siam"><?php echo $value->relationship_with_allowance ; ?></td>
            </tr>
            <tr>
                  <td class="siam">নমিনীর ঠিকানা</td>
                  <td class="siam">:</td>
                  <td class="siam"><?php echo $value->nominee_address ; ?></td>
              </tr>
        </table>

        
        <script type="text/javascript">
            window.print();
        </script>
    </body>

    </html>