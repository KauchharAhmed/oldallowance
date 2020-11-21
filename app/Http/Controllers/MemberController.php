<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use DateTime;
use Session;

class MemberController extends Controller
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


    #----------------------- Old Age Allowance Application -------------------#
    public function addMemberApplication()
    {
        $allowance_type = DB::table('allowance_type')->where('status',1)->get();
    	return view('member.addMemberApplication')->with('allowance_type',$allowance_type);
    }

    #-------------------- Insert Old Allowance Application Info ----------------------#
    public function addOldAgeAllowanceApplicationInfo(Request $request)
    {
    	$this->validate($request,[
    		'allowance_type'	    => 'required',
            'name_bangla'           => 'required',
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

    	$allowance_type 		        = trim($request->allowance_type) ;
        $name_bangla                    = trim($request->name_bangla) ;
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
        $land_amount                    = trim($request->land_amount);
        $other_member_use_this_advantage = trim($request->other_member_use_this_advantage);

    	#====================== Check Duplicate Application =====================#
    	$check_duplicate = DB::table('member')->where('nid_number',$nid_number)->count();

    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর ইতিমধ্যে ব্যবহার করি যুক্ত করা হয়েছে.') ;
    		return Redirect::to('addMemberApplication') ;
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
    			return Redirect::to('addMemberApplication') ;
		}elseif($gender == "মহিলা" AND $year < $femaleYear){
			Session::put('failed','দুঃখিত ! বয়স্ক ভাতার জন্য আবেদন করতে হলে মহিলা এর জন্য সর্ব নিম্ন বয়স '.$femaleYear.' হতে হবে.') ;
			return Redirect::to('addMemberApplication') ;
		}

		#----------------- Get User Info ------------------#
		$udc_info = DB::table('admin')->where('id',$this->loged_id)->first() ;
		$union_id = $udc_info->union_id ;

		$data = array() ;
		$data['allowance_type_id']			    = $allowance_type ;
        $data['added_id']                       = $this->loged_id ;
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

		Session::put('success','ধন্যবাদ ! বয়স্ক ভাতার জন্য আবেদন যুক্ত হয়েছে.') ;
    	return Redirect::to('addMemberApplication') ;
    }

    #======================== Manage UDC Member Application =============================#
    public function manageUDCMemberApplication()
    {
    	#----------------- Get User Info ------------------#
		$udc_info = DB::table('admin')->where('id',$this->loged_id)->first() ;
		$union_id = $udc_info->union_id ;

		$result = DB::table('member')->where('union_id',$union_id)->get() ;

		return view('member.manageUDCMemberApplication')->with('result',$result) ;
    }

    #--------------------- Edit Member Info ------------------------------#
    public function editMemberInfo($id)
    {
    	$value = DB::table('member')
        ->join('allowance_type','allowance_type.id','=','member.allowance_type_id')
        ->select('member.*','allowance_type.type_name')
        ->where('member.id',$id)->first() ;
        $allowance_type = DB::table('allowance_type')->where('status',1)->get();
    	return view('member.editMemberInfo')->with('value',$value)->with('allowance_type',$allowance_type) ;

    }

    #-------------------------- UPDATE MEMBER INFO ----------------------------#
    public function updateOldAgeAllowanceApplicationInfo(Request $request)
    {
    	$this->validate($request,[
            'allowance_type'        => 'required',
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

    	$allowance_type                 = trim($request->allowance_type) ;
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
    	$primary_id 					= trim($request->primary_id) ;
    	$nominee_photo					= $request->file('nominee_photo') ;
        $land_amount                    = trim($request->land_amount);
        $other_member_use_this_advantage = trim($request->other_member_use_this_advantage);

    	#====================== Check Duplicate Application =====================#
    	$check_duplicate = DB::table('member')->where('nid_number',$nid_number)->whereNotIn('id',[$primary_id])->count();

    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নম্বর ইতিমধ্যে ব্যবহার করি যুক্ত করা হয়েছে.') ;
    		return Redirect::to('editMemberInfo/'.$primary_id) ;
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
				Session::put('failed','দুঃখিত ! বয়স্ক ভাতার জন্য আবেদন করতে হলে পুরুষ এর জন্য সর্ব নিম্ন বয়স '.$maleYear.'হতে হবে.') ;
    			return Redirect::to('editMemberInfo/'.$primary_id) ;
		}elseif($gender == "মহিলা" AND $year < $femaleYear){
			Session::put('failed','দুঃখিত ! বয়স্ক ভাতার জন্য আবেদন করতে হলে মহিলা এর জন্য সর্ব নিম্ন বয়স '.$femaleYear.' হতে হবে.') ;
			return Redirect::to('editMemberInfo/'.$primary_id) ;
		}

		#----------------- Get User Info ------------------#
		$udc_info = DB::table('admin')->where('id',$this->loged_id)->first() ;
		$union_id = $udc_info->union_id ;

		$data = array() ;
		$data['added_id']						= $this->loged_id ;
        $data['allowance_type_id']              = $allowance_type ;
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

		$data['updated_at']						= $this->rcdate ;

		DB::table('member')->where('id',$primary_id)->update($data) ;

		Session::put('success','ধন্যবাদ ! সদস্যার তথ্য হালনাগাদ হয়েছে.') ;
    	return Redirect::to('editMemberInfo/'.$primary_id) ;
    }

    #====================== View Single Member Info ============================#
    public function viewMemberDetails($id)
    {
        $value = DB::table('member')
                ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                ->select('member.*','union_paurashava.unpb_name') 
                ->where('member.id',$id)
                ->first();
        return view('member.viewMemberDetails')->with('value',$value) ;
    }


    #-------------------------- Old Allowance Pending Member List -----------------------#
    public function oldAllowanceApplication()
    {
        $result      = DB::table('union_paurashava')->orderBy('id','desc')->get() ;
        $member_info = DB::table('member')->groupBy('year')->get() ;

        return view('member.oldAllowanceApplication')->with('result',$result)->with('member_info',$member_info) ;
    }

    #-------------------------- VIEW OLD ALLOWANCE REPORT -----------------------------#
    public function viewOldAllowanceApplication(Request $request)
    {
        $union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',0)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',0)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewOldAllowanceApplication')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',0)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',0)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewOldAllowanceApplication')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #===================== Old Allowance Member Primary Selection =====================#
    public function oldAllowanceMemberPrimarySelection(Request $request)
    {
        $primary_id = $request->primary_id ;
        $count = count($primary_id) ;

        if ($count == 0) {
            Session::put('failed','দুঃখিত ! আপনি কোন সদস্য নির্বাচন করেন নাই.') ;
            return Redirect::to('oldAllowanceApplication/') ;
        }

        foreach ($primary_id as $value) {
            $data = array();
            $data['status'] = 1 ;

            DB::table('member')->where('id',$value)->update($data);
        }

        Session::put('succes','ধন্যবাদ ! প্রাথমিক ভাবে সদস্য নির্বাচন করা হয়েছে.') ;
        return Redirect::to('oldAllowanceApplication/') ;
    }

    #========================= Primary Selected Member list =============================#
    public function primarySelectedMemberList()
    {
        $result      = DB::table('union_paurashava')->orderBy('id','desc')->get() ;
        $member_info = DB::table('member')->groupBy('year')->get() ;

        return view('member.primarySelectedMemberList')->with('result',$result)->with('member_info',$member_info) ;
    }

    #---------------------------- View Primary Selected Member List ------------------#
    public function viewPrimarySelectedMemberList(Request $request)
    {
        $union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',1)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',1)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewPrimarySelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',1)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',1)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewPrimarySelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #---------------- Old Allowance Member Final Selection ------------------------#
    public function oldAllowanceMemberFinalSelection(Request $request)
    {
        $primary_id = $request->primary_id ;
        $count = count($primary_id) ;

        if ($count == 0) {
            Session::put('failed','দুঃখিত ! আপনি কোন সদস্য নির্বাচন করেন নাই.') ;
            return Redirect::to('primarySelectedMemberList/') ;
        }

        foreach ($primary_id as $value) {
            $data = array();
            $data['status'] = 2 ;

            DB::table('member')->where('id',$value)->update($data);
        }

        Session::put('succes','ধন্যবাদ ! চুড়ান্ত ভাবে সদস্য নির্বাচন করা হয়েছে.') ;
        return Redirect::to('primarySelectedMemberList/') ;
    }

    #-------------------- Final Selected Member List ---------------------------------#
    public function finalSelectedMemberList()
    {
        $result      = DB::table('union_paurashava')->orderBy('id','desc')->get() ;
        $member_info = DB::table('member')->groupBy('year')->get() ;

        return view('member.finalSelectedMemberList')->with('result',$result)->with('member_info',$member_info) ;
    }

    #------------------- Get Final Selected Member List ---------------------------#
    public function viewFinalSelectedMemberList(Request $request)
    {
        $union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',2)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->join('allowance_type','member.allowance_type_id','=','allowance_type.id')
                        ->select('member.*','union_paurashava.unpb_name','allowance_type.type_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',2)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewFinalSelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',2)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->join('allowance_type','member.allowance_type_id','=','allowance_type.id')
                        ->select('member.*','union_paurashava.unpb_name','allowance_type.type_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',2)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewFinalSelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #------------------------- Edit Final Selected Member Info -----------------------#
    public function manageFinalSelectedMember()
    {
        $result = DB::table('member')
                ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                ->select('member.*','union_paurashava.unpb_name') 
                ->where('member.status',2)
                ->orderBy('id','desc')
                ->get();
        return view('member.manageFinalSelectedMember')->with('result',$result) ;
    }

    #============== Dead Member Selection =======================#
    public function oldAllowanceDeadMember(Request $request)
    {
        $primary_id = $request->primary_id ;
        $count = count($primary_id) ;

        if ($count == 0) {
            Session::put('failed','দুঃখিত ! আপনি কোন সদস্য নির্বাচন করেন নাই.') ;
            return Redirect::to('finalSelectedMemberList/') ;
        }

        foreach ($primary_id as $value) {
            $data = array();
            $data['status'] = 3 ;

            DB::table('member')->where('id',$value)->update($data);
        }

        Session::put('succes','ধন্যবাদ ! মৃত সদস্য নির্বাচন করা হয়েছে.') ;
        return Redirect::to('finalSelectedMemberList/') ;
    }

    #=================== Dead Member List =======================#
    public function deadMemberList()
    {
        $result      = DB::table('union_paurashava')->orderBy('id','desc')->get() ;
        return view('member.deadMemberList')->with('result',$result);
    }

    #================ View Dead Member List =======================#
    public function viewDeadMemberList(Request $request)
    {
        $union_id   = trim($request->union_id) ;

        if (empty($union_id)) {
            $check_count = DB::table('member')->where('status',3)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.status',3)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewDeadMemberList')->with('result',$result)->with('union_id',$union_id) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',3)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',3)
                        ->orderBy('id','desc')
                        ->get();

                return view('member.viewDeadMemberList')->with('result',$result)->with('union_id',$union_id) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }


}
