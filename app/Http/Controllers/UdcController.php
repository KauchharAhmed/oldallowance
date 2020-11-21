<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class UdcController extends Controller
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

    #---------------- UDC Profile ----------------------#
    public function udcProfile()
    {
    	$profile_info   = DB::table('admin')
                        ->where('id',$this->loged_id)
                        ->first();
        return view('udc.udcProfile')->with('profile_info',$profile_info);
    }

    #---------------------- Update UDC Profile Info -------------------#
    public function editUDCAdminPofile()
    {
    	$profile_info   = DB::table('admin')
                        ->where('id',$this->loged_id)
                        ->first();
        return view('udc.editUDCAdminPofile')->with('profile_info',$profile_info);
    }

    #------------------- Update ------------------------#
    public function updateUDCAdminProfileInfo(Request $request)
    {
    	$this->validate($request,[
            'name'      => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'image'     => 'mimes:jpeg,jpg,png|max:500',
        ]);

        $name   = trim($request->name);
        $email  = trim($request->email);
        $image  = $request->file('image');

        $data = array() ;
        $data['name']   = $name ;
        $data['email']   = $email ;

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
            Session()->put('success', "Thanks ! Profile Update Successfully Completed.");
            return Redirect::to('/editUDCAdminPofile') ;
        }else{
            Session()->put('failed', "Sorry ! Profile Not Update.");
            return Redirect::to('/editUDCAdminPofile') ;
        }
    }


    #---------------------- UDC Admin Change Password ------------------------#
    public function udcAdminChangePassword()
    {
        return view('udc.udcAdminChangePassword') ;
    }

    #-------------- UDC Admin Password Change --------------------------#
    public function udcAdminChangePasswordInfo(Request $request)
    {
        $this->validate($request,[
            'old_password'          => 'required',
            'new_password'          => 'required',
            'confirm_new_password'  => 'required'
        ]);

        $old_password           = trim($request->old_password);
        $new_password           = trim($request->new_password);
        $confirm_new_password   = trim($request->confirm_new_password);

        if ($new_password != $confirm_new_password) {
            Session::put('failed','দুঃখিত ! নতুন পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিলছে না.');
            return Redirect::to('/udcAdminChangePassword');
        }

        $salt                   = 'a123A321';
        $current_admin_password = sha1($old_password.$salt);

        $final_new_password     = sha1($confirm_new_password.$salt);

        $loged_id = Session::get('admin_id');

        #--------------------- Check Valid old Passsword ------------------#
        $old_password_check = DB::table('admin')
                        ->where('password',$current_admin_password)
                        ->where('id',$loged_id)
                        ->count();
        if ($old_password_check > 0) {
            $data = array();
            $data['password']   = $final_new_password ;

            $query = DB::table('admin')
                    ->where('id',$loged_id)
                    ->update($data);
            if ($query) {
                Session::put('success','ধন্যবাদ ! পাসওয়ার্ড পরিবর্তন সাফল্যের সাথে সম্পন্ন হয়েছে.');
                return Redirect::to('/udcAdminChangePassword');
            }else{
                Session::put('failed','দুঃখিত! পাসওয়ার্ড পরিবর্তন হয় না.');
                return Redirect::to('/udcAdminChangePassword');
            }
        }else{
            Session::put('failed','দুঃখিত! পুরানো পাসওয়ার্ড মিলছে না। আবার চেষ্টা কর.');
            return Redirect::to('/udcAdminChangePassword');
        }
    }


}
