<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class UserController extends Controller
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
        $this->loged_id     = Session::get('admin_id');
    }

    #--------------------------- Manage All System User ---------------------------------#
    public function manageAllUdc()
    {
    	$result = DB::table('admin')
    			->join('union_paurashava','admin.union_id','=','union_paurashava.id')
    			->select('admin.*','union_paurashava.unpb_name')
    			->where('type',2)->get() ;

    	return view('user.manageAllUdc')->with('result',$result) ;
    }

    #----------------------- Insert UDC ----------------------------#
    public function addUdc()
    {
    	$all_union = DB::table('union_paurashava')->where('status',1)->get() ;

    	return view('user.addUdc')->with('all_union',$all_union) ;
    }

    #-------------------- Insert UDC User Info -----------------------#
    public function addUdcUserInfo(Request $request)
    {
    	$this->validate($request,[
    		'union_id'	=> 'required',
    		'name'		=> 'required',
    		'mobile'	=> 'required',
    		'image'     => 'mimes:jpeg,jpg,png|max:500',
    	]);

    	$union_id 		= trim($request->union_id) ;
    	$name 			= trim($request->name) ;
    	$father_name 	= trim($request->father_name) ;
    	$mobile 		= trim($request->mobile) ;
    	$adddress 		= trim($request->adddress) ;
    	$image 			= $request->file('image') ;

    	$search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	    $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

	    $en_mobile = str_replace($search_array, $replace_array, $mobile);


    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate = DB::table('admin')->where('union_id',$union_id)->count() ;
    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! ইউনিয়ন বা পৌরসভা  ইতিমধ্যে ব্যবহার করি যুক্ত করা হয়েছে.') ;
    		return Redirect::to('addUdc') ;
    	}

    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate_mobile = DB::table('admin')->where('mobile',$en_mobile)->count() ;
    	if ($check_duplicate_mobile > 0) {
    		Session::put('failed','দুঃখিত ! মোবাইল নম্বর ইতিমধ্যে যুক্ত করা হয়েছে.') ;
    		return Redirect::to('addUdc') ;
    	}

    	$salt      	= 'a123A321';
     	$vpassword  = sha1($en_mobile.$salt);

    	$data = array() ;
    	$data['union_id']		= $union_id ;
    	$data['name']			= $name ;
    	$data['father_name']	= $father_name ;
    	$data['mobile']			= $en_mobile ;
    	$data['password']		= $vpassword ;
    	$data['address']		= $adddress ;
    	if ($image) {
	        $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   ='udc-'.$image_name.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url;
	     }
	    $data['type']			= 2 ;
	    $data['status']			= 1 ;
	    $data['created_at']		= $this->rcdate ;

	    DB::table('admin')->insert($data) ;

	    Session::put('success','ধন্যবাদ ! ব্যবহার করি সফল ভাবে যুক্ত হয়েছে .') ;
    	return Redirect::to('addUdc') ;
    }

    #------------------- Edit UDC User Info ----------------------#
    public function editUdcUserInfo($id)
    {

        $all_union = DB::table('union_paurashava')->where('status',1)->get() ;
        $value = DB::table('admin')->where('id',$id)->first();

        return view('user.editUdcUserInfo')->with('all_union',$all_union)->with('value',$value) ;
    }

    #----------------------- Update User Info ----------------------------#
    public function updateUdcUserInfo(Request $request)
    {
        $this->validate($request,[
            'union_id'  => 'required',
            'name'      => 'required',
            'mobile'    => 'required',
            'image'     => 'mimes:jpeg,jpg,png|max:500',
        ]);

        

        $union_id       = trim($request->union_id) ;
        $name           = trim($request->name) ;
        $father_name    = trim($request->father_name) ;
        $mobile         = trim($request->mobile) ;
        $adddress       = trim($request->adddress) ;
        $primary_id     = trim($request->primary_id) ;
        $image          = $request->file('image') ;

        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        $en_mobile = str_replace($search_array, $replace_array, $mobile);


        #--------------- Check Duplicate Union Name ---------------------#
        $check_duplicate = DB::table('admin')->where('union_id',$union_id)->whereNotIn('id',[$primary_id])->count() ;
        if ($check_duplicate > 0) {
            Session::put('failed','দুঃখিত ! ইউনিয়ন বা পৌরসভা  ইতিমধ্যে ব্যবহার করি যুক্ত করা হয়েছে.') ;
            return Redirect::to('editUdcUserInfo/'.$primary_id) ;
        }

        #--------------- Check Duplicate Union Name ---------------------#
        $check_duplicate_mobile = DB::table('admin')->where('mobile',$en_mobile)->whereNotIn('id',[$primary_id])->count() ;
        if ($check_duplicate_mobile > 0) {
            Session::put('failed','দুঃখিত ! মোবাইল নম্বর ইতিমধ্যে যুক্ত করা হয়েছে.') ;
            return Redirect::to('editUdcUserInfo/'.$primary_id) ;
        }

        $salt       = 'a123A321';
        $vpassword  = sha1($en_mobile.$salt);

        $data = array() ;
        $data['union_id']       = $union_id ;
        $data['name']           = $name ;
        $data['father_name']    = $father_name ;
        $data['mobile']         = $en_mobile ;
        $data['address']        = $adddress ;
        if ($image) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   ='udc-'.$image_name.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url;
         }
        $data['updated_at']     = $this->rcdate ;

        DB::table('admin')->where('id',$primary_id)->update($data) ;

        Session::put('success','ধন্যবাদ ! ব্যবহার কারীর তথ্য হালনাগাদ হয়েছে .') ;
        return Redirect::to('editUdcUserInfo/'.$primary_id) ;
    }


}
