<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use DateTime;
use Session;

class VataController extends Controller
{
    private $rcdate ;
     /**
     * ADMIN CLASS costructor 
     *
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y-m-d');
        $this->current_time = date('H:i:s');
        $this->year 		= date('Y');
        $this->loged_id     = Session::get('admin_id');
    }

    // Function for add Vata Type
    public function addVataType()
    {
    	return view('vata_type.addVataType');
    }

    // Function for add Vata type info
    public function addVataTypeInfo(Request $request)
    {
    	$this->validate($request,[
    		'vata_type_name'	=> 'required' 
    	]);

    	$vata_type_name 	= trim($request->vata_type_name) ;

    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate = DB::table('allowance_type')->where('type_name',$vata_type_name)->count() ;
    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! ভাতার প্রকারভেদের নাম ইতিমধ্যে যুক্ত করা হয়েছে.') ;
    		return Redirect::to('addVataType') ;
    	}

    	$data = array() ;
    	$data['added_id']		= $this->loged_id ;
    	$data['type_name']		= $vata_type_name ;
        $data['status']         = "1" ;
    	$data['created_at']		= $this->rcdate ;

    	$query = DB::table('allowance_type')->insert($data) ;

    	if ($query) {
    		Session::put('success','ধন্যবাদ ! ভাতার প্রকারভেদের নাম সফল ভাবে যুক্ত হয়েছে .') ;
    		return Redirect::to('addVataType') ;
    	}else{
    		Session::put('failed','দুঃখিত! কিছু ভুল হয়েছে.') ;
    		return Redirect::to('addVataType') ;
    	}
    }

    // Function for Manage Vata Type
    public function manageVataType()
    {
    	$result = DB::table('allowance_type')->get();
    	return view('vata_type.manageVataType')->with('result',$result);
    }

    // Function for edit Vata Type
    public function editVataType($id)
    {
    	$row = DB::table('allowance_type')->where('id',$id)->first();
    	return view('vata_type.editVataType')->with('row',$row);
    }

    // Function for Update vata type info
    public function updateVataTypeInfo(Request $request)
    {
    	$this->validate($request,[
    		'vata_type_name'	=> 'required' 
    	]);

    	$vata_type_name 	= trim($request->vata_type_name) ;
    	$id 				= trim($request->id);

    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate = DB::table('allowance_type')->where('type_name',$vata_type_name)->whereNotIn('id',[$id])->count() ;
    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! ভাতার প্রকারভেদের নাম ইতিমধ্যে যুক্ত করা হয়েছে.') ;
    		return Redirect::to('editVataType/'.$id) ;
    	}

    	$data = array() ;
    	$data['added_id']		= $this->loged_id ;
    	$data['type_name']		= $vata_type_name ;
    	$data['created_at']		= $this->rcdate ;

    	$query = DB::table('allowance_type')->where('id',$id)->update($data) ;

    	if ($query) {
    		Session::put('success','ধন্যবাদ ! ভাতার প্রকারভেদের নাম সফল ভাবে সংশোধন হয়েছে .') ;
    		return Redirect::to('editVataType/'.$id) ;
    	}else{
    		Session::put('failed','দুঃখিত! কিছু ভুল হয়েছে.') ;
    		return Redirect::to('editVataType/'.$id) ;
    	}
    }

    // Function for Choose Vata Type
    public function chooseVataType()
    {
    	$result = DB::table('allowance_type')->where('status',1)->get();
    	return view('vata_type.chooseVataType')->with('result',$result);
    }

    // Function for online application
    public function onlineApplication($allowance_type_id)
    {
    	$unionQuery = DB::table('union_paurashava')->get();
    	$allowanceQuery = DB::table('allowance_type')->where('id',$allowance_type_id)->first();
    	return view('web.onlineApplication')->with('allowance_type_id',$allowance_type_id)->with('allowanceQuery',$allowanceQuery)->with('unionQuery',$unionQuery);
    }

    // Function for add online application info
    public function addOnlineApplicationInfo(Request $request)
    {
    	$this->validate($request,[
    		'name_bangla'			=> 'required',
    		'name'					=> 'required',
    		'father_name'			=> 'required',
    		'mother_name'			=> 'required',
    		'nid_number'			=> 'required',
    		'gender'				=> 'required',
    		'present_address'		=> 'required',
    		'married_status'		=> 'required',
    		'member_photo'			=> 'mimes:jpeg,jpg,png|max:500',
    		'dob'					=> 'required',
    		'religion'				=> 'required',
    		'permanent_address'		=> 'required',
    		'annual_income'			=> 'required',
    		'identification_mark'	=> 'required',
    		'occupation'			=> 'required',
            'land_amount'           => 'required',
            'other_member_use_this_advantage' => 'required',
    		'nominee_photo'			=> 'mimes:jpeg,jpg,png|max:500',
    	]);

    	$name_bangla 					= trim($request->name_bangla) ;
    	$name 							= trim($request->name) ;
    	$father_name 					= trim($request->father_name) ;
    	$nid_number 					= trim($request->nid_number) ;
    	$gender 						= trim($request->gender) ;
    	$present_address 				= trim($request->present_address) ;
    	$married_status 				= trim($request->married_status) ;
    	$health_condition 				= trim($request->health_condition) ;
    	$health_condition 				= trim($request->health_condition) ;
    	$social_status 					= trim($request->social_status) ;
    	$nominee_name 					= trim($request->nominee_name) ;
    	$relationship_with_allowance 	= trim($request->relationship_with_allowance) ;
    	$mother_name 					= trim($request->mother_name) ;
    	$member_photo					= $request->file('member_photo') ;
    	$mother_name 					= trim($request->mother_name) ;
    	$dob 							= trim($request->dob) ;
    	$religion 						= trim($request->religion) ;
    	$permanent_address 				= trim($request->permanent_address) ;
    	$annual_income 					= trim($request->annual_income) ;
    	$financial_condition 			= trim($request->financial_condition) ;
    	$identification_mark 			= trim($request->identification_mark) ;
    	$nominee_address 				= trim($request->nominee_address) ;
    	$occupation 					= trim($request->occupation) ;
    	$mobile_number 					= trim($request->mobile_number) ;
    	$nominee_photo					= $request->file('nominee_photo') ;
    	$allowance_type_id      		= trim($request->allowance_type_id);
    	$union_id						= trim($request->union_id);
        $land_amount                    = trim($request->land_amount);
        $other_member_use_this_advantage = trim($request->other_member_use_this_advantage);

    	#====================== Check Duplicate Application =====================#
    	$check_duplicate = DB::table('member')->where('nid_number',$nid_number)->count();

    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর ইতিমধ্যে ব্যবহার করি যুক্ত করা হয়েছে.') ;
    		return Redirect::to('onlineApplication/'.$allowance_type_id) ;
    	}

    	#======================= Age Check =========================#
    	$exDob 	= date('Y-m-d',strtotime($dob));
    	$stdate = $this->year.'-'.'06-01' ;
    	$a 		= new DateTime($stdate);
		$b 		= new DateTime($exDob);
		$years 	= $b->diff($a)->y;
		$year 	= intval($years) ;

        #------------------- Age Settng ----------------------#
        $age_settings   = DB::table('age_setting')->where('id',1)->first() ;
        $maleYear       = $age_settings->male ;
        $femaleYear     = $age_settings->female ;

		if ($gender == "পুরুষ" AND $year < $maleYear) {
			Session::put('failed','দুঃখিত ! বয়স্ক ভাতার জন্য আবেদন করতে হলে পুরুষ এর জন্য সর্ব নিম্ন বয়স '.$maleYear.' হতে হবে.') ;
    		return Redirect::to('onlineApplication/'.$allowance_type_id) ;
		}elseif($gender == "মহিলা" AND $year < $femaleYear){
			Session::put('failed','দুঃখিত ! বয়স্ক ভাতার জন্য আবেদন করতে হলে মহিলা এর জন্য সর্ব নিম্ন বয়স '.$femaleYear.' হতে হবে.') ;
			return Redirect::to('onlineApplication/'.$allowance_type_id) ;
		}

		#----------------- Get User Info ------------------#
		// $udc_info = DB::table('admin')->where('id',$this->loged_id)->first() ;
		// $union_id = "1" ;

		$data = array() ;
		$data['allowance_type_id']				= $allowance_type_id ;
		$data['union_id']						= $union_id ;
		$data['year']							= $this->year ;
		$data['name']							= $name ;
		$data['name_bangla']					= $name_bangla ;
		$data['father_name']					= $father_name ;
		$data['mother_name']					= $mother_name ;
		$data['nid_number']						= $nid_number ;
		$data['dob']							= $exDob ;
		$data['age']							= $year ;
		$data['gender']							= $gender ;
		$data['religion']						= $religion ;
		$data['occupation']						= $occupation ;
		$data['mobile_number']					= $mobile_number ;
		$data['present_address']				= $present_address ;
		$data['permanent_address']				= $permanent_address ;
		$data['married_status']					= $married_status ;
		$data['annual_income']					= $annual_income ;
		$data['health_condition']				= $health_condition ;
		$data['financial_condition']			= $financial_condition ;
		$data['social_status']					= $social_status ;
		$data['identification_mark']			= $identification_mark ;
		$data['nominee_name']					= $nominee_name ;
		$data['nominee_address']				= $nominee_address ;
		$data['relationship_with_allowance']	= $relationship_with_allowance ;
        $data['land_amount']                    = $land_amount ;
        $data['other_member_use_this_advantage'] = $other_member_use_this_advantage ;

		if ($member_photo) {
            $image_name        = str_random(20);
            $ext               = strtolower($member_photo->getClientOriginalExtension());
            $image_full_name   ='member-'.$image_name.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $member_photo->move($upload_path,$image_full_name);
            $data['member_photo']     = $image_url;
        }

        if ($nominee_photo) {
            $image_name2       = str_random(20);
            $ext               = strtolower($nominee_photo->getClientOriginalExtension());
            $image_full_name   ='member-'.$image_name2.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $nominee_photo->move($upload_path,$image_full_name);
            $data['nominee_photo']     = $image_url;
        }

		$data['created_at']						= $this->rcdate ;
		$data['created_time']					= $this->current_time ;

		DB::table('member')->insert($data) ;

		Session::put('success','ধন্যবাদ ! আপনার আবেদন সফলভাবে যুক্ত হয়েছে') ;
    	return Redirect::to('onlineApplication/'.$allowance_type_id) ;
    }

} // end of controller
