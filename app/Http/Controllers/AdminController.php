<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class AdminController extends Controller
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

    #---------------------- Admin Login Page ------------------------#
    public function index()
    {
    	return view('admin.index');
    }

    #---------------------- Admin Login --------------------------- #
    public function adminLogin(Request $request)
    {

    	$this->validate($request,[
    		'mobile'		=> 'required',
    		'password'	=> 'required'
    	]);
    	$mobile 	= trim($request->mobile);
    	$password 	= trim($request->password);

    	$salt      	= 'a123A321';
     	$vpassword  = sha1($password.$salt);

    	$validate_check = DB::table('admin')
    					->where('mobile',$mobile)
    					->where('password',$vpassword)
    					->where('status',1)
    					->count();
    	if ($validate_check > 0) {
    		$admin_login = DB::table('admin')
    					->where('mobile',$mobile)
    					->where('password',$vpassword)
    					->where('status',1)
    					->first();

            if($admin_login->type == 1){
                Session::put('admin_name',$admin_login->name);
                Session::put('admin_mobile',$admin_login->mobile);
                Session::put('admin_email',$admin_login->email);
                Session::put('admin_id',$admin_login->id);
                Session::put('type',$admin_login->type);
                Session::put('photo',$admin_login->image);

                return Redirect::to('/adminDashboard');
            }else{
                Session::put('admin_name',$admin_login->name);
                Session::put('admin_mobile',$admin_login->mobile);
                Session::put('admin_email',$admin_login->email);
                Session::put('admin_id',$admin_login->id);
                Session::put('type',$admin_login->type);
                Session::put('photo',$admin_login->image);

                return Redirect::to('/udcDashboard');
            }

    		
    	}else{
    		Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
          return Redirect::to('/admin');
    	}
    }

    #---------------------- Admin Profile -------------------------------#
    public function myProfile()
    {
        $profile_info   = DB::table('admin')
                        ->where('id',$this->loged_id)
                        ->first();
        return view('admin.myProfile')->with('profile_info',$profile_info);
    }

    #--------------------- Edit Admin Profile -------------------------#
    public function editAdminPofile()
    {
        $profile_info   = DB::table('admin')
                        ->where('id',$this->loged_id)
                        ->first();
        return view('admin.editAdminPofile')->with('profile_info',$profile_info);
    }

    #---------------------- Update Admin Profile --------------------------#
    public function adminEditMyProfileInfo(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'image'     => 'mimes:jpeg,jpg,png|max:500',
        ]);

        $name   = trim($request->name);
        $email  = trim($request->email);
        $mobile  = trim($request->mobile);
        $image  = $request->file('image');

        $data = array() ;
        $data['name']   = $name ;
        $data['email']   = $email ;
        $data['mobile']   = $mobile ;

        if ($image) {
            $image_name        = str_random(20);
            $ext               = strtolower($image->getClientOriginalExtension());
            $image_full_name   ='admin-'.$image_name.'.'.$ext;
            $upload_path       = "images/";
            $image_url         = $upload_path.$image_full_name;
            $success           = $image->move($upload_path,$image_full_name);
            $data['image']     = $image_url;
        }

        $update = DB::table('admin')->where('id',$this->loged_id)->update($data);
        if ($update) {
            Session()->put('success', "ধন্যবাদ! প্রোফাইল আপডেট সাফল্যের সাথে সম্পন্ন হয়েছে.");
            return Redirect::to('/editAdminPofile') ;
        }else{
            Session()->put('failed', "দুঃখিত! প্রোফাইল আপডেট হয় না.");
            return Redirect::to('/editAdminPofile') ;
        }
    }

    #---------------------- Admin Change Password --------------------------#
    public function adminChangePassword()
    {
    	return view('admin.adminChangePassword');
    }

    #--------------------- Change Password -----------------------#
    public function adminChangePasswordInfo(Request $request)
    {
    	$this->validate($request,[
    		'old_password'			=> 'required',
    		'new_password'			=> 'required',
    		'confirm_new_password'	=> 'required'
    	]);

    	$old_password 			= trim($request->old_password);
    	$new_password 			= trim($request->new_password);
    	$confirm_new_password 	= trim($request->confirm_new_password);

    	if ($new_password != $confirm_new_password) {
    		Session::put('failed','দুঃখিত! নতুন পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিলছে না.');
    		return Redirect::to('/adminChangePassword');
    	}

    	$salt      				= 'a123A321';
     	$current_admin_password = sha1($old_password.$salt);

     	$final_new_password 	= sha1($confirm_new_password.$salt);

     	$loged_id = Session::get('admin_id');

     	#--------------------- Check Valid old Passsword ------------------#
     	$old_password_check = DB::table('admin')
    					->where('password',$current_admin_password)
    					->where('id',$loged_id)
    					->count();
    	if ($old_password_check > 0) {
    		$data = array();
    		$data['password']	= $final_new_password ;

    		$query = DB::table('admin')
					->where('id',$loged_id)
					->update($data);
			if ($query) {
				Session::put('success','ধন্যবাদ! পাসওয়ার্ড পরিবর্তন সাফল্যের সাথে সম্পন্ন হয়েছে.');
    			return Redirect::to('/adminChangePassword');
			}else{
				Session::put('failed','দুঃখিত! পাসওয়ার্ড পরিবর্তন হয় না।');
    			return Redirect::to('/adminChangePassword');
			}
    	}else{
    		Session::put('failed','দুঃখিত! পুরানো পাসওয়ার্ড মিলছে না। আবার চেষ্টা কর.');
    		return Redirect::to('/adminChangePassword');
    	}

    }

    #------------------ Admin Logout ---------------------#
    public function adminLogout()
    {
       Session::put('admin_id',null);
       Session::put('type',null);
       return Redirect::to('/admin');
    }



}
